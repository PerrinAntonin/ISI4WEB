<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display the shop with a specified category.
     *
     */
    public function index($idCategory = null)
    {
        if(!$idCategory){
            $idCategory = 1;
        }
        $activeCategory = Category::find($idCategory);


        if($activeCategory){

            $categories = Category::where('id','!=',$idCategory)->orWhereNull('id')->get();
            $products = Product::where('cat_id',$idCategory)->paginate(6);

            for ($i=0; $i < count($products); $i++) {
                if(!$products[$i]->image){
                    $products[$i]->image = url("img/product-img/dummy.png");
                }else{
                    $products[$i]->image = url("img/product-img")."/".$products[$i]->image;
                }
            }

            return view('shop', [
                'totalOrder'=>Order::totalOrder(),
                'Products' => $products,
                'ActiveCategories' => $activeCategory,
                'Categories' => $categories,
            ]);
        }else{
            return abort(404);
        }
    }
}
