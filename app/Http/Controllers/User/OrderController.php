<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function userOrders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('user.account.orders.index', compact('orders'));
    }

    public function userOrderDetails($order_id)
    {
        $order = Order::find($order_id);
        if (!$order) {
            return redirect()->route('user.account.orders')->with('error', 'Order not found!');
        }
        $orderItems = $order->orderItems()->orderBy('id')->paginate(12);
        $transaction = $order->transaction;
        return view('user.account.orders.details', compact('order', 'orderItems', 'transaction'));
    }

    public function cancelOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = 'canceled';
        $order->canceled_date = \Carbon\Carbon::now();
        $order->save();
        return back()->with('status', 'Order has been canceled successfully!');
    }

    public function returnItem(Request $request)
    {
        $orderItem = OrderItem::find($request->item_id);
        $orderItem->rstatus = true;
        $orderItem->save();
        return back()->with('status', 'Return request has been sent successfully!');
    }

    public function receivedItem(Request $request)
    {
        $orderItem = OrderItem::find($request->item_id);
        $order = $orderItem->order;
        $order->status = 'delivered';
        $order->delivered_date = \Carbon\Carbon::now();
        $order->save();

        $transaction = $order->transaction;
        $transaction->status = 'approved';
        $transaction->save();

        return back()->with('status', 'Order marked as delivered!');
    }
}
