<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    public $fillable=['delivery_add_id'];
    public $timestamps = false;
    public function scopeCheckIfOrderExist()
    {
        if (Auth::check()) {
            $order = Order::where('customer_id', Auth::id())->get();

            if (count($order)) {
                return $order[0]->id;
            }
            return false;
        } else {
            $Id_session = session()->getID();
            $order = Order::where('session_id', '=', $Id_session)->get();
            if (count($order)) {
                return $order[0]->id;
            }
            return false;
        }
    }

    public function scopeSubtotal()
    {
        $id = Order::checkIfOrderExist();
        if ($id) {
            $price = Product::join('order_items', 'order_items.product_id', '=', 'products.id')
                ->where('order_id', '=', $id)
                ->sum(DB::raw('products.price*order_items.quantity'));
            return $price;
        }
        return 0;
    }

    public function scopeTotalOrder()
    {
        $id = Order::checkIfOrderExist();
        if ($id === false) {
            return 0;
        } else {
            $nb = OrderItem::where('order_id', $id)
                ->count();
            return $nb;
        }
    }
}
