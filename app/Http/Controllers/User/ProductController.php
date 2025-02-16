<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryProduct;
class ProductController extends Controller

{
    public function list()
    {
        $user = Auth::user();
        $cartCount = 0; // Mặc định giỏ hàng trống
    
        if ($user) { // Kiểm tra user có đăng nhập không
            $cart = Cart::where('user_id', $user->id)->first();
            if ($cart) {
                $cartCount = CartProduct::where('cart_id', $cart->id)->count();
            }
        }
    
        $categoryProduct = CategoryProduct::all();
        $categories = Category::all();
        $products = Product::where('role', 'hiện')->get();
    
        return view('users.products.list', compact('products', 'categories', 'user', 'cartCount'));
    }
    

    public function addToCart(Request $request)
    {
        $user = Auth::user();
        if(!$user){
            return redirect()->route('users.login');
        }else{
        
            $product = Product::find($request->product_id);
    
        if (!$product) {
            return redirect()->route('users.products.list');
        }
    
     
            $cart = Cart::where('user_id', $user->id)->first();
    
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
                'price' => 0,
            ]);
        }
    
      
            $cart_product = CartProduct::where('product_id', $product->id)
                                        ->where('cart_id', $cart->id)
                                        ->first();
    
        if (!$cart_product) {
            CartProduct::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => $request->quantity ?? 1,
            ]);
        } else {

            $cart_product->quantity += $request->quantity ?? 1;
            $cart_product->save();
        }
    
    
        return redirect()->route('users.products.list');
    }
}
    
    public function removeProduct($id)
    {  
        $cartproduct = CartProduct::findOrFail($id);
        $cartproduct->delete();
        return redirect()->route('users.products.cart')->with('success', 'Xoa sản phẩm thành công');
    }

    public function cart()
    {   
        $user = Auth::user();
    
        if(!$user){
            return redirect()->route('users.login');
        }
        $cart = Cart::where('user_id', $user->id)->first();


        $products = Product::all();
        
        $cartproducts = CartProduct::with('products')->where('cart_id', $cart->id)->get();
     
        $totalPrice = $cartproducts->sum(function($cartproduct) {
            return $cartproduct->quantity * $cartproduct->price;
        });
        return view('users.products.cart', compact('products', 'cart', 'cartproducts', 'totalPrice'));
    
    }
    public function updateQuantity(Request $request, $id)
    {
        
        // Tìm sản phẩm trong giỏ hàng bằng id
        $cartProduct = CartProduct::findOrFail($id);
    
        // Kiểm tra xem hành động là tăng hay giảm và cập nhật số lượng
        if ($request->action == 'increase') {
            $cartProduct->quantity += 1;  // Tăng số lượng
        } elseif ($request->action == 'decrease' && $cartProduct->quantity > 1) {
            $cartProduct->quantity -= 1;  // Giảm số lượng nếu không phải 1
        }
    
        // Lưu lại thay đổi
        $cartProduct->save();
    
        // Chuyển hướng lại trang giỏ hàng
        return redirect()->route('users.products.cart');
    }


    public function pay()
    {   
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        $products = Product::all(); 
        $cartproducts = CartProduct::with('products')
                                    ->where('cart_id',$cart->id)->get();
        $cart = Cart::all();
        $totalPrice = $cartproducts->sum(function($cartproduct) {
            return $cartproduct->quantity * $cartproduct->price;
        });
        return view('users.products.pay',compact('products', 'cart', 'cartproducts', 'totalPrice'));
    }
    public function logout()
    {   
        Auth::logout();
        
        return redirect()->route('users.home');
    }
}
    