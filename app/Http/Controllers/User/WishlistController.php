<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('user.account.wishlist.index', compact('wishlistItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->id,
        ]);

        return redirect()->back()->with('status', 'Product added to wishlist!');
    }

    public function destroy($id)
    {
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return redirect()->back()->with('status', 'Product removed from wishlist!');
    }

    public function empty()
    {
        Wishlist::where('user_id', Auth::id())->delete();
        return redirect()->back();
    }

    public function moveToCart($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->where('id', $id)->first();
        if ($wishlist) {
            Cart::instance('cart')->add($wishlist->product_id, $wishlist->product->name, 1, $wishlist->product->sale_price ?? $wishlist->product->regular_price)->associate(Product::class);
            $wishlist->delete();
        }
        return redirect()->back();
    }
}
