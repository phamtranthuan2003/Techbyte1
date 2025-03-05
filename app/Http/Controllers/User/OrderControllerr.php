<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\CartProduct;
use App\Models\Cart;
use App\Models\Order;


class OrderControllerr extends Controller
{
    public function index($id){
        $user = Auth::user();
       
        $orders = Order::where('user_id', $user->id)->get();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartCount = CartProduct::where('cart_id', $cart->id)->count();

        return view("users.orders.index", compact("orders","cartCount","cart","user"));
    }
    public function orderDetail($id){
        $user = Auth::user();
        $order = Order::with('orderProducts.product', 'user')->findOrFail($id);
        $cart = Cart::where('user_id', $user->id)->first();
        $cartproducts = CartProduct::with('products')
                                    ->where('cart_id', $cart->id)
                                    ->get();
        $cartCount = CartProduct::where('cart_id', $cart->id)->count();
        return view('users.orders.orderDetail', compact('order','cart','cartCount','user', 'cartproducts'));
    }
}