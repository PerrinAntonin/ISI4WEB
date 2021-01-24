<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userHome()
    {
        return view('home');
    }
        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('admin');
    }
}
