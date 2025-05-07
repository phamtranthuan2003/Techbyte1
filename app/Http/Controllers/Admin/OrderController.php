<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;

class OrderController extends Controller
{
    public function list()
    {   
        $orders = Order::where('status', 1)->get();
        $counts = [
            'orderNotPlaced' =>Order::where('status', 0)->count(),
            'orderPlaced' =>Order::where('status', 1)->count(),
            'orderShipped' =>Order::where('status', 2)->count(),
            'orderComplete' =>Order::where('status', 3)->count(),
            'orderCancelled' =>Order::where('status', 4)->count(),
        ];

        return view('admins.orders.list', compact('orders', 'counts'));
        
    }
    public function orderDetail($id)
    {
        
        $order = Order::with('orderProducts.product', 'user')->findOrFail($id);
        return view('admins.orders.orderDetail', compact('order'));
    }
    public function changestatus(Request $request, $id)
    {
        $data = $request->status;
     
        $order = Order::findOrFail($id);
        $order->update([
            'status'=> $data,
        ]);
        
        return redirect()->route('admins.orders.list');
    }
    public function orderhasbeenship()
    {
        $orders = Order::where('status', 2)->get();
        $counts = [
            'orderNotPlaced' =>Order::where('status', 0)->count(),
            'orderPlaced' =>Order::where('status', 1)->count(),
            'orderShipped' =>Order::where('status', 2)->count(),
            'orderComplete' =>Order::where('status', 3)->count(),
            'orderCancelled' =>Order::where('status', 4)->count(),
        ];

        return view('admins.orders.orderhasbeenship',compact('orders', 'counts'));

    }
    public function orderNotPlaced()
    {
        $orders = Order::where('status', 0)->get();
        $counts = [
            'orderNotPlaced' =>Order::where('status', 0)->count(),
            'orderPlaced' =>Order::where('status', 1)->count(),
            'orderShipped' =>Order::where('status', 2)->count(),
            'orderComplete' =>Order::where('status', 3)->count(),
            'orderCancelled' =>Order::where('status', 4)->count(),
        ];

        return view('admins.orders.orderNotPlaced',compact('orders','counts'));
    }
    public function orderComplete()
    {
        $orders = Order::where('status', 3)->get();
        $counts = [
            'orderNotPlaced' =>Order::where('status', 0)->count(),
            'orderPlaced' =>Order::where('status', 1)->count(),
            'orderShipped' =>Order::where('status', 2)->count(),
            'orderComplete' =>Order::where('status', 3)->count(),
            'orderCancelled' =>Order::where('status', 4)->count(),
        ];

        return view('admins.orders.orderComplete', compact('orders', 'counts'));
    }
    public function orderCancelled()
    {
        $orders = Order::where('status', 4)->get();
        $counts = [
            'orderNotPlaced' =>Order::where('status', 0)->count(),
            'orderPlaced' =>Order::where('status', 1)->count(),
            'orderShipped' =>Order::where('status', 2)->count(),
            'orderComplete' =>Order::where('status', 3)->count(),
            'orderCancelled' =>Order::where('status', 4)->count(),
        ];

        return view('admins.orders.orderCancelled', compact('orders', 'counts'));
    }
}