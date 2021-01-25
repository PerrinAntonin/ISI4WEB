<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('admin',[
            'totalOrder'=> Order::totalOrder(),
            'orders'=> Order::all()]);
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);
        if($order){
            OrderItem::where('order_id', $id)->delete();
            $order->delete();
        }
        return view('admin',[
            'totalOrder'=> Order::totalOrder(),
            'orders'=> Order::all()]);
    }

    public function updateOrder($id,$value)
    {
        $order = Order::find($id);

        if($order){
            var_dump($value);
            $order->update(['status' => $value]);
        }
        return redirect()->route('admin.home');
    }
}
