<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;

class OderController extends Controller
{
    public function list()
    {
        $orders = Order::get();
        
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
}