<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('user.shop.index', compact('products'));
    }


    public function productDetails($product_slug)
    {
        $product = Product::where('slug' , $product_slug)->first();
        return view('user.shop.details', compact('product'));
    }
}
