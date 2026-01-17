<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get()->take(10);
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

        $monthlyRevenue = DB::table('orders')
            ->select(DB::raw('SUM(total) as revenue'), DB::raw('DATE(created_at) as date'))
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->get();

        $monthlyOrders = DB::table('orders')
            ->select(DB::raw('COUNT(*) as count'), DB::raw('DATE(created_at) as date'))
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->get();

        $revenueData = $monthlyRevenue->pluck('revenue');
        $orderCountData = $monthlyOrders->pluck('count');
        $labelData = $monthlyRevenue->pluck('date');

        return view('admin.index', compact('orders', 'dashboardDatas', 'revenueData', 'orderCountData', 'labelData'));
    }
}
