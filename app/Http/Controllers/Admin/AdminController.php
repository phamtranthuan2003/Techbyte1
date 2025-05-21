<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\ImputProduct;
use App\Models\OutputProduct;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Output\Output;

class AdminController extends Controller

{
    public function home()
    {
        $totaluser = User::count();
        $pendingOrders = Order::count();
        $totalProducts = Product::count();
        $totalStocks = Product::where('sell', '>', 0)->count();
        $totalCategories = Category::count();
        $totalProviders = Provider::count();
        $totalInput = ImputProduct::count();
        $totalOutput = OutputProduct::count();
        // Lấy dữ liệu đơn hàng theo ngày
        $ordersData = Order::selectRaw('WEEKDAY(created_at) as day, COUNT(*) as total')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('day')
            ->pluck('total', 'day')
            ->toArray();

        // Lấy dữ liệu doanh thu theo ngày
        $revenueData = Order::selectRaw('WEEKDAY(created_at) as day, SUM(price) as revenue')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('day')
            ->pluck('revenue', 'day')
            ->toArray();

        $daysOfWeek = ['Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy', 'Chủ Nhật'];

        // Tạo mảng dữ liệu đầy đủ (mặc định là 0)
        $orderCounts = array_fill(0, 7, 0);
        $revenueCounts = array_fill(0, 7, 0);

        foreach ($ordersData as $day => $count) {
            $orderCounts[$day] = $count;
        }

        foreach ($revenueData as $day => $revenue) {
            $revenueCounts[$day] = $revenue;
        }
        // Lấy tổng số đơn hàng trong tuần
        $totalOrdersWeek = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        // Lấy tổng doanh thu trong tuần
        $totalRevenueWeek = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('price');

        return view('admins.users.home', compact(
            'totaluser', 'pendingOrders', 'totalProducts',
            'totalStocks', 'totalCategories', 'totalProviders',
            'orderCounts', 'revenueCounts', 'daysOfWeek', 'totalOrdersWeek','totalRevenueWeek', 'totalInput' , 'totalOutput'
        ));
    }
    public function dashboard(Request $request)
    {   
        $startdate = $request->input('start_date');
        $enddate = $request->input('end_date');
        $order = Order::whereBetween('created_at', [$startdate, $enddate])->get();
        $totalOrders = Order::whereBetween('created_at', [$startdate, $enddate])->count();
        $totalRevenue = Order::whereBetween('created_at', [$startdate, $enddate])->sum('price');
        return view('admins.users.home');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('users.login');
    }
}