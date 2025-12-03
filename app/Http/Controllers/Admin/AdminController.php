<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();
        $dashboardDatas = [
            'TotalAmount' => Order::sum('total'),
            'TotalOrders' => Order::count(),
            'TotalPendingAmount' => Order::where('status', 'ordered')->sum('total'),
            'TotalPendingOrders' => Order::where('status', 'ordered')->count(),
            'TotalDeliveredAmount' => Order::where('status', 'delivered')->sum('total'),
            'TotalDeliveredOrders' => Order::where('status', 'delivered')->count(),
            'TotalCanceledAmount' => Order::where('status', 'canceled')->sum('total'),
            'TotalCanceledOrders' => Order::where('status', 'canceled')->count(),
        ];
        return view('admin.index', compact('orders', 'dashboardDatas'));
    }
}
