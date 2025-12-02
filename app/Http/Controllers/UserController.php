<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }


    public function orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('user.orders.index', compact('orders'));
    }


    public function show($order_id)
    {
        $order = Order::find($order_id);
        if (!$order) {
            return redirect()->route('user.orders')->with('error', 'Order not found!');
        }
        $orderItems = $order->orderItems()->orderBy('id')->paginate(12);
        $transaction = $order->transaction;
        return view('user.orders.details', compact('order', 'orderItems', 'transaction'));
    }

    public function cancel_order(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = 'canceled';
        $order->canceled_date = \Carbon\Carbon::now();
        $order->save();
        return back()->with('status', 'Order has been canceled successfully!');
    }

    public function return_item(Request $request)
    {
        $orderItem = \App\Models\OrderItem::find($request->item_id);
        $orderItem->rstatus = true;
        $orderItem->save();
        return back()->with('status', 'Return request has been sent successfully!');
    }
}
