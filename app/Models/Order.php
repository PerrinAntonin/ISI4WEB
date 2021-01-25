<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    public $fillable = ['delivery_add_id', 'total', 'status','payment_type'];
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
            Order::find($id)->update(["total" => $price]);

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

    public function getProduct()
    {
        return Product::select('products.id', 'name', 'price', 'image')
            ->join('order_items', 'order_items.product_id', '=', 'products.id')
            ->where('order_id', '=', $this->id)
            ->get();
    }

    public function getItems()
    {
        return OrderItem::where('order_id', '=', $this->id)->get();
    }

    public function getClient()
    {
        $customer = Custormer::find($this->customer_id);
        if ($customer) {
            return $customer;
        }else{
            return null;
        }
    }
    public function getDeliveryAdd()
    {
        $deliveryAdd = DeliveryAdd::find($this->delivery_add_id);
        if ($deliveryAdd) {
            return $deliveryAdd;
        }else{
            return null;
        }
    }
}
