<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'id',
        'order_id',
        'product_id'
    ];
    public $timestamps = false;


    public function scopeModifyItem($id)
    {
        $total = (int)OrderItem::find($id)["quantity"];
        $total +=1;
        OrderItem::find($id)->update("quantity",$total);
    }
}
