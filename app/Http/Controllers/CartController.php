<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::instance('cart')->content();
        if (Session::has('coupon')) {
            $this->calculate_discount();
        }
        return view('user.cart.index', compact('items'));
    }

    public function add_to_cart(Request $request)
    {
        Cart::instance('cart')->add($request->id, $request->name, $request->quantity, $request->price)->associate(Product::class);
        return redirect()->back();
    }

    public function increase_cart_quantity($rowId)
    {
        $prduct = Cart::instance('cart')->get($rowId);
        $qty = $prduct->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }

    public function decrease_cart_quantity($rowId)
    {
        $prduct = Cart::instance('cart')->get($rowId);
        $qty = $prduct->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }

    public function remove_to_cart(Request $request)
    {
        Cart::instance('cart')->remove($request->id);
        return redirect()->back();
    }

    public function empty_cart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    public function apply_coupon_code(Request $request)
    {
        $coupon_code = $request->coupon_code;
        $coupon = Coupon::where('code', $coupon_code)->where('expiry_date', '>=', Carbon::today())->where('cart_value', '<=', Cart::instance('cart')->subtotal())->first();
        if (!$coupon) {
            return redirect()->back()->with('error', 'Invalid coupon code!');
        }
        Session::put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);
        $this->calculate_discount();
        return redirect()->back()->with('success', 'Coupon has been applied!');
    }

    public function calculate_discount()
    {
        $discount = 0;
        if (Session::has('coupon')) {
            if (Session::get('coupon')['type'] == 'fixed') {
                $discount = Session::get('coupon')['value'];
            } else {
                $discount = (Cart::instance('cart')->subtotal() * Session::get('coupon')['value']) / 100;
            }
            $subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $discount;
            $taxAfterDiscount = ($subtotalAfterDiscount * config('cart.tax')) / 100;
            $totalAfterDiscount = $subtotalAfterDiscount + $taxAfterDiscount;

            Session::put('discounts', [
                'discount' => number_format(floatval($discount), 2, '.', ''),
                'subtotal' => number_format(floatval($subtotalAfterDiscount), 2, '.', ''),
                'tax' => number_format(floatval($taxAfterDiscount), 2, '.', ''),
                'total' => number_format(floatval($totalAfterDiscount), 2, '.', '')
            ]);
        }
    }

    public function remove_coupon_code()
    {
        Session::forget('coupon');
        Session::forget('discounts');
        return redirect()->back()->with('success', 'Coupon has been removed!');
    }
}
