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
        
        return view('admins.orders.list', compact('orders'));
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
        return view('admins.orders.orderhasbeenship',compact('orders'));

    }
    public function orderNotPlaced()
    {
        $orders = Order::where('status', 0)->get();
        return view('admins.orders.orderNotPlaced',compact('orders'));
    }
    public function orderComplete()
    {
        $orders = Order::where('status', 3)->get();
        return view('admins.orders.orderComplete', compact('orders'));
    }
    public function orderCancelled()
    {
        $orders = Order::where('status', 4)->get();
        return view('admins.orders.orderCancelled', compact('orders'));
    }
}