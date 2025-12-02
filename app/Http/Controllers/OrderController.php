<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreorderRequest;
use App\Http\Requests\UpdateorderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy("id", "desc")->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreorderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateorderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
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
