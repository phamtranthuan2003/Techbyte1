<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

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

    // Định nghĩa thứ tự ngày trong tuần (Thứ Hai = 0, Chủ Nhật = 6)
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
        'orderCounts', 'revenueCounts', 'daysOfWeek', 'totalOrdersWeek','totalRevenueWeek'
    ));
}

}
