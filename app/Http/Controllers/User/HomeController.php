<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Category;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slides = Slide::where('status', 1)->get()->take(3);
        $categories = Category::orderBy('id', 'DESC')->get();
        $sale_products = \App\Models\Product::whereNotNull('sale_price')->where('sale_price', '<>', '')->inRandomOrder()->get()->take(8);
        $featured_products = \App\Models\Product::where('featured', 1)->get()->take(8);
        $wishlistItems = [];
        if (\Illuminate\Support\Facades\Auth::check()) {
            $wishlistItems = \App\Models\Wishlist::where('user_id', \Illuminate\Support\Facades\Auth::id())->pluck('id', 'product_id')->toArray();
        }
        return view('user.home.index', compact('slides', 'categories', 'sale_products', 'featured_products', 'wishlistItems'));
    }

    public function about()
    {
        return view('user.about.index');
    }
}
