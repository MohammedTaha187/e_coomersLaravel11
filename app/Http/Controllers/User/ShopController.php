<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->query('size') ? (int) $request->query('size') : 10;
        $o_column = '';
        $o_order = '';
        $order = $request->query('order') ? $request->query('order') : -1;
        $f_brands = $request->query('brands');
        $f_categories = $request->query('categories');
        $min_price = $request->query('min_price') ? (int) $request->query('min_price') : 1;
        $max_price = $request->query('max_price') ? (int) $request->query('max_price') : 10000;
        $f_colors = $request->query('colors');
        $f_sizes = $request->query('sizes');
        switch ($order) {
            case 1:
                $o_column = 'created_at';
                $o_order = 'DESC';
                break;
            case 2:
                $o_column = 'created_at';
                $o_order = 'ASC';
                break;
            case 3:
                $o_column = 'sale_price';
                $o_order = 'DESC';
                break;
            case 4:
                $o_column = 'price';
                $o_order = 'ASC';
                break;
            default:
                $o_column = 'id';
                $o_order = 'DESC';
                break;
        }
        $brands = Brand::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        $colors = Color::select('name', 'code')->groupBy('name', 'code')->orderBy('name', 'ASC')->get();
        $sizes = Size::select('name')->groupBy('name')->orderBy('name', 'ASC')->get();

        $products = Product::query();

        if ($f_brands) {
            $brandIds = explode(',', $f_brands);
            $products = $products->whereIn('brand_id', $brandIds);
        }

        if ($f_categories) {
            $categoryIds = explode(',', $f_categories);
            $products = $products->whereIn('category_id', $categoryIds);
        }

        if ($min_price && $max_price) {
            $products = $products->where(function ($query) use ($min_price, $max_price) {
                $query->whereBetween(DB::raw('CAST(COALESCE(sale_price, price) AS DECIMAL(10,2))'), [$min_price, $max_price]);
            });
        }

        if ($f_colors) {
            $colorNames = explode(',', $f_colors);
            $products = $products->whereHas('colors', function ($query) use ($colorNames) {
                $query->whereIn('name', $colorNames);
            });
        }

        if ($f_sizes) {
            $sizeNames = explode(',', $f_sizes);
            $products = $products->whereHas('sizes', function ($query) use ($sizeNames) {
                $query->whereIn('name', $sizeNames);
            });
        }

        if ($request->query('query')) {
            $q = $request->query('query');
            $products = $products->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")->orWhere('slug', 'like', "%{$q}%");
            });
        }

        $products = $products->orderBy($o_column, $o_order)->paginate($size);

        $wishlistItems = [];
        if (Auth::check()) {
            $wishlistItems = Wishlist::where('user_id', Auth::id())->pluck('id', 'product_id')->toArray();
        }

        return view('user.shop.index', compact('products', 'size', 'order', 'brands', 'f_brands', 'categories', 'f_categories', 'min_price', 'max_price', 'colors', 'f_colors', 'sizes', 'f_sizes', 'wishlistItems'));
    }

    public function productDetails($product_slug)
    {
        $product = Product::where('slug', $product_slug)->firstOrFail();
        $rproducts = Product::where('slug', '<>', $product_slug)->get()->take(8);

        $wishlistItems = [];
        if (Auth::check()) {
            $wishlistItems = Wishlist::where('user_id', Auth::id())->pluck('id', 'product_id')->toArray();
        }

        return view('user.shop.details', compact('product', 'rproducts', 'wishlistItems'));
    }
}
