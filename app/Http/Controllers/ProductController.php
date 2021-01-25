<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class ProductController extends Controller
{

    public function show($id)
    {
        $product = Product::find($id);
        if($product){

            if (!$product->image) {
                $product->image = url("img/product-img/dummy.png");
            } else {
                $product->image = url("img/product-img") . "/" . $product->image;
            }

            return view('product', [
                'category'=> Category::find($product->cat_id),
                'totalOrder'=>Order::totalOrder(),
                'Product' => $product,
            ]);
        }
        return abort(404);
    }
}
