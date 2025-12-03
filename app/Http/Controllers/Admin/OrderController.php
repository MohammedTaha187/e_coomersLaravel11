<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy("id", "desc")->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($order_id)
    {
        $order = Order::find($order_id);
        if (!$order) {
            return redirect()->route('admin.orders')->with('error', 'Order not found!');
        }
        $orderItems = $order->orderItems()->orderBy('id')->paginate(12);
        $transaction = $order->transaction;
        return view('admin.orders.details', compact('order', 'orderItems', 'transaction'));
    }

    public function update_status(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = $request->order_status;
        if ($request->order_status == 'delivered') {
            $order->delivered_date = \Carbon\Carbon::now();
        } elseif ($request->order_status == 'canceled') {
            $order->canceled_date = \Carbon\Carbon::now();
        }
        $order->save();

        if ($request->order_status == 'delivered') {
            $transaction = $order->transaction;
            $transaction->status = 'approved';
            $transaction->save();
        }

        return back()->with('status', 'Status changed successfully!');
    }
}
