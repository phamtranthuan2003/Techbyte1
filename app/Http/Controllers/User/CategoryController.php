<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\Cart;


class CategoryController extends Controller
{
    public function category($id)
    {
        $user = Auth::user();
        $category = Category::with('products')->findOrFail($id);
        $categories = Category::get();
        $cartCount = 0; // Mặc định giỏ hàng trống
        
        if ($user) { // Kiểm tra user có đăng nhập không
            $cart = Cart::where('user_id', $user->id)->first();
            if ($cart) {
                $cartCount = CartProduct::where('cart_id', $cart->id)->count();
            }
        }
        $products = $category->products;

        return view('users.categories.category', compact('categories', 'products', 'category','cartCount','user'));
    }
}