<?php

namespace App\Http\Controllers;

use App\Models\DeliveryAdd;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\PayerInfo;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\Redirect;


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
                return view('checkout', [
                    'totalOrder' => Order::totalOrder(),
                    'totalPrice' => Order::subtotal(),
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

        $amountToBePaid = (double)Order::totalOrder();

        switch ($input["paymentmethod"]) {

            case "paypal":
                // TODO Tester si l'api paypal marche
                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $item_1 = new Item();
                $item_1->setName('Mobile Payment')/** item name **/
                ->setCurrency('USD')
                    ->setQuantity(1)
                    ->setPrice($amountToBePaid);
                /** unit price **/

                $item_list = new ItemList();
                $item_list->setItems(array($item_1));

                $amount = new Amount();
                $amount->setCurrency('USD')
                    ->setTotal($amountToBePaid);
                $redirect_urls = new RedirectUrls();
                /** Specify return URL **/
                $redirect_urls->setReturnUrl(URL::route('status'))
                    ->setCancelUrl(URL::route('status'));

                $transaction = new Transaction();
                $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription('Your transaction description');

                $payment = new Payment();
                $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));

                try {
                    $payment->create($this->_api_context);
                } catch (\PayPal\Exception\PPConnectionException $ex) {
                    echo '<pre>';
                    print_r(json_decode($ex->getData()));
                    exit;
//                    if (\Config::get('app.debug')) {
//                        \Session::put('error', 'Connection timeout');
//                        return Redirect::route('/');
//                    } else {
//                        \Session::put('error', 'Some error occur, sorry for inconvenient');
//                        return Redirect::route('/');
//                    }
                }
                foreach ($payment->getLinks() as $link) {
                    if ($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }

                /** add payment ID to session **/
                \Session::put('paypal_payment_id', $payment->getId());
                if (isset($redirect_url)) {
                    /** redirect to paypal **/
                    return Redirect::away($redirect_url);
                }

                \Session::put('error', 'Unknown error occurred');
                return Redirect::route('status');
                break;
            case "cheque":
                // TODO generer un pdf
                return Redirect::route('genPDF');
                break;

        }

        $deliveryAdd->save();


    }

    public function getPaymentStatus(Request $request)
    {

        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty($request->PayerID) || empty($request->token)) {
            session()->flash('error', 'Payment failed');
            return view('status.error', [
                'totalOrder' => Order::totalOrder(),
            ]);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            session()->flash('success', 'Payment success');
            return view('status.sucess', [
                'totalOrder' => Order::totalOrder(),
            ]);

        }
        session()->flash('error', 'Payment failed');
        return view('status.error', [
            'totalOrder' => Order::totalOrder(),
        ]);
    }

    // Generate PDF
    public function createPDF()
    {
        $order = Order::where('customer_id', Auth::user()->id)->first();
        $order_items = OrderItem::where('order_id', $order->id)->get();

        $products = Product::select('products.id', 'name', 'price', 'image')
            ->join('order_items', 'order_items.product_id', '=', 'products.id')
            ->where('order_id', '=', $order->id)
            ->get();


//        view()->share('totalorder', ['totalOrder'=>$data]);
        return view('layouts.pdf_view', [
            'totalPrice' => Order::subtotal(),
            'totalOrder' => Order::totalOrder(),
            'order_items' => $order_items,
            'Products' => $products,]);

        $pdf = PDF::loadView('layouts.pdf_view', ['totalOrder' => $totalAmount]);


        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }
}
