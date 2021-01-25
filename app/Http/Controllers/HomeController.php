<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {

     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all()->take(10);
        for ($i=0; $i < count($products); $i++) {
            if(!$products[$i]->image){
                $products[$i]->image = url("img/product-img/dummy.png");
            }else{
                $products[$i]->image = url("img/product-img")."/".$products[$i]->image;
            }
        }
        return view('welcome',[
            'totalOrder'=> Order::totalOrder(),
            'Products' => $products,
        ]);
    }



}
