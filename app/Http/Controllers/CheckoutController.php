<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = Cart::instance('cart')->content();
        if ($items->count() == 0) {
            return redirect()->route('user.shop.index');
        }
        $address = Address::where('user_id', Auth::user()->id)->where('isdefault', 1)->first();
        return view('user.checkout.index', compact('items', 'address'));
    }

    public function place_order(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|numeric|digits:11',
            'zip' => 'required|numeric|digits:6',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'locality' => 'required',
            'landmark' => 'required',
            'checkout_payment_method' => 'required',
        ]);

        $user_id = Auth::user()->id;

        $address = Address::where('user_id', $user_id)->where('isdefault', true)->first();
        if (!$address) {
            $request->validate([
                'name' => 'required|max:255',
                'phone' => 'required|numeric|digits:11',
                'zip' => 'required|numeric|digits:6',
                'state' => 'required',
                'city' => 'required',
                'address' => 'required',
                'locality' => 'required',
                'landmark' => 'required',
            ]);

            $address = new Address();
            $address->user_id = $user_id;
            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->zip = $request->zip;
            $address->state = $request->state;
            $address->city = $request->city;
            $address->address = $request->address;
            $address->locality = $request->locality;
            $address->landmark = $request->landmark;
            $address->country = 'Egypt'; // Default or from form
            $address->isdefault = true;
            $address->save();
        }

        $order = new Order();
        $order->user_id = $user_id;
        $order->subtotal = Session::get('discounts')['subtotal'] ?? Cart::instance('cart')->subtotal();
        $order->discount = Session::get('discounts')['discount'] ?? 0;
        $order->tax = Session::get('discounts')['tax'] ?? Cart::instance('cart')->tax();
        $order->total = Session::get('discounts')['total'] ?? Cart::instance('cart')->total();
        $order->name = $address->name;
        $order->phone = $address->phone;
        $order->locality = $address->locality;
        $order->address = $address->address;
        $order->city = $address->city;
        $order->state = $address->state;
        $order->country = $address->country;
        $order->landmark = $address->landmark;
        $order->zip = $address->zip;
        $order->save();

        foreach (Cart::instance('cart')->content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->save();
        }

        if ($request->checkout_payment_method == 'card') {
            // Handle Stripe or other payment gateway here
        } elseif ($request->checkout_payment_method == 'paypal') {
            // Handle Paypal here
        } else {
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->mode = 'cod';
            $transaction->status = 'pending';
            $transaction->save();
        }

        Cart::instance('cart')->destroy();
        Session::forget('checkout');
        Session::forget('coupon');
        Session::forget('discounts');
        Session::put('order_id', $order->id);

        return redirect()->route('user.cart.index')->with('success', 'Order placed successfully!'); // Redirect to confirmation page ideally
    }
}
