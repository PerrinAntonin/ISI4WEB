<?php

namespace App\Http\Controllers;

use App\Models\Custormer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $order = Order::where('customer_id', Auth::user()->id)->latest('date')->first();
        } else {
            $Id_session = session()->getID();
            $order = Order::where('session_id', $Id_session)->latest('date')->first();
        }
        if ($order) {
            $order_id = $order->id;

            $order_items = OrderItem::where('order_id', $order_id)->get();

            $products = Product::select('products.id', 'name', 'price', 'image')
                ->join('order_items', 'order_items.product_id', '=', 'products.id')
                ->where('order_id', '=', $order_id)
                ->get();

            for ($i = 0; $i < count($products); $i++) {
                if (!$products[$i]->image) {
                    $products[$i]->image = url("img/product-img/dummy.png");
                } else {
                    $products[$i]->image = url("img/product-img") . "/" . $products[$i]->image;
                }
            }

            return view('order', [
                'totalPrice' => Order::subtotal(),
                'totalOrder' => Order::totalOrder(),
                'order_items' => $order_items,
                'Products' => $products,
            ]);
        } else {
            return view('order', [
                'totalPrice' => 0,
                'totalOrder' => 0,
                'Cart_items' => [],
                'Products' => [],
            ]);
        }
    }

    public function createOrder()
    {
        if (Auth::check()) {

            $orderValues = [
                'customer_id' => Auth::user()->custormer_id,
                'date' => Carbon::now(),
            ];
            $id = Order::insertGetId($orderValues);
        } else {
            $Id_session = session()->getID();
            $orderValues = [
                'session_id' => $Id_session,
                'date' => Carbon::now(),
            ];
            $id = Order::insertGetId($orderValues);
        }
        return $id;
    }

    public function addToOrder($id)
    {
        $product = Product::find($id);
        $productId = (int)$id;
        if ($product) {
            $orderId = Order::checkIfOrderExist();
            if ($orderId == null) {
                $orderId = $this->createOrder();
            }

            $orderItemValues = [
                'order_id' => $orderId,
                'product_id' => $productId,
                'quantity' => 1,
            ];
            $orderItem = OrderItem::where('order_id', $orderId)->where('product_id', $productId);

            if (count($orderItem->get()) == 0) {
                DB::table('order_items')->insert($orderItemValues);
            } else {
                $orderItem->increment("quantity");
            }

            return Redirect::back()->with('message', 'Add to cart Sucess');
        }

        return Redirect::back()->with('message', 'Add to cart Eror');
    }


    public function removeOrder($id)
    {
        $res = OrderItem::find($id)->delete();
        if ($res) {
            return Redirect::back()->with('message', 'Deleted');
        } else {
            return Redirect::back()->with('message', 'Cannot delete');
        }
    }

    public function updateOrder(Request $request)
    {
        $id = Order::checkIfOrderExist();

        if ($id) {
            $input = $request->all();
            $order_items = OrderItem::where('order_id', $id)->get();

            foreach ($order_items as $order_item) {
                $new_quantity = $input[$order_item->id];

                OrderItem::find($order_item->id)->update(['quantity' => $new_quantity]);
            }
            return Redirect::back()->with('message', 'Updated');

        } else {
            return Redirect::back()->with('message', 'Updated Error');
        }

    }

}
