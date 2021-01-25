<?php

namespace App\Http\Controllers;

use App\Models\Custormer;
use App\Models\DeliveryAdd;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

use Barryvdh\DomPDF\Facade as PDF;


class PaymentController extends Controller

{
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function checkout()
    {
        $totalOrder = Order::totalOrder();

        if ($totalOrder != 0) {
            if (Auth::check()) {
                $userinfo = Custormer::find(auth()->user()->custormer_id);
                return view('checkout', [
                    'totalOrder' => Order::totalOrder(),
                    'totalPrice' => Order::subtotal(),
                    'userinfo' =>$userinfo,
                ]);
            } else {
                return Redirect::route('login');
            }
        } else {
            return Redirect::back()->withErrors(['msg', 'no cart found']);
        }
    }

    public function payWithpaypal(Request $request)
    {
        $input = $request->all();

        $deliveryAdd = new DeliveryAdd();
        $deliveryAdd->customer_id = Auth::id();
        $deliveryAdd->firstname = $request->firstname;
        $deliveryAdd->lastname = $request->lastname;
        $deliveryAdd->add1 = $request->add1;
        $deliveryAdd->add2 = $request->add2;
        $deliveryAdd->country = $request->country;
        $deliveryAdd->city = $request->city;
        $deliveryAdd->zipCode = $request->zipCode;
        $deliveryAdd->phone_number = $request->phone_number;
        $deliveryAdd->email = $request->email;

        $amountToBePaid = (float)Order::subtotal();

        $order = Order::where('customer_id', Auth::user()->custormer_id)->latest('date')->first();
        $deliveryAdd->save();
        $order->update(['delivery_add_id' => $deliveryAdd->id]);

        switch ($input["paymentmethod"]) {

            case "paypal":
                $order->update(['payment_type' => "paypal"]);
                $order->update(['status' => "payementOk"]);

                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $amount = new Amount();
                $amount->setCurrency('EUR')
                    ->setTotal($amountToBePaid);
                $redirect_urls = new RedirectUrls();
                /** Specify return URL **/
                $redirect_urls->setReturnUrl(URL::route('status'))
                    ->setCancelUrl(URL::route('status'));

                $transaction = new Transaction();
                $transaction->setAmount($amount)
                    ->setDescription('Your transaction description');

                $payment = new Payment();
                $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));

                try {

                    $payment->create($this->_api_context);
                } catch (\PayPal\Exception\PPConnectionException $ex) {
                    if (Config::get('app.debug')) {
                        Session::put('error', 'Connection timeout');
                        return Redirect::route('/');
                    } else {
                        Session::put('error', 'Some error occur, sorry for inconvenient');
                        return Redirect::route('/');
                    }
                }
                foreach ($payment->getLinks() as $link) {
                    if ($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }

                /** add payment ID to session **/
                Session::put('paypal_payment_id', $payment->getId());
                if (isset($redirect_url)) {
                    /** redirect to paypal **/
                    return Redirect::away($redirect_url);
                }

                Session::put('error', 'Unknown error occurred');
                return Redirect::route('status');

            case "cheque":

                $order->update(['payment_type' => "cheque",'status' => "waitCheque"]);
                return Redirect::route('genPDF');

        }
    }

    public function getPaymentStatus(Request $request)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty($request->PayerID) || empty($request->token)) {
            session()->flash('error', 'Payment failed');
            $message = 'La procédure de paiement a été annulé.';
            return view('status', ['status' => $message, 'totalOrder' => Order::totalOrder(),]);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            session()->flash('success', 'Payment success');
            $message = 'Le paiement a été effectué !';
            return view('status', ['status' => $message, 'totalOrder' => Order::totalOrder(),]);
        }

        session()->flash('error', 'Payment failed');
        $message = 'La procédure de paiement a été annulé.';
        return view('status', ['status' => $message, 'totalOrder' => Order::totalOrder(),]);
    }

    // Generate PDF
    public function createPDF()
    {
        $order = Order::where('customer_id', Auth::user()->id)->latest('date')->first();
        $order_items = OrderItem::where('order_id', $order->id)->get();

        $del_add = DeliveryAdd::where('id', $order->delivery_add_id)->first();

        $products = Product::select('products.id', 'name', 'price', 'image')
            ->join('order_items', 'order_items.product_id', '=', 'products.id')
            ->where('order_id', $order->id)
            ->get();

        $data = [
            'order_id' => $order->id,
            'del_add' => $del_add,
            'totalPrice' => Order::subtotal(),
            'totalOrder' => Order::totalOrder(),
            'order_items' => $order_items,
            'Products' => $products,];

//        return view('layouts.pdf_view', $data);
        view()->share('data', $data);

        $pdf = PDF::loadView('layouts.pdf_view', $data)->setPaper('A4');;

        return $pdf->download('FactureISI4WEB.pdf');
    }
}
