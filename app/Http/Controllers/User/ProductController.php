<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\OrderProduct;
use App\Models\Order;
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
        $products = Product::get();
        if (!$user) {
            return redirect()->route('users.login');
        }
    
        // Tìm giỏ hàng của người dùng
        $cart = Cart::where('user_id', $user->id)->first();
        
        // Nếu không có giỏ hàng, đặt giá trị mặc định
        if (!$cart) {
            return view('users.products.cart', [
                'products' => Product::all(),
                'cart' => null,
                'cartproducts' => collect(),
                'totalPrice' => 0,
            ]);
        }
    
        // Lấy danh sách sản phẩm trong giỏ hàng
        $cartproducts = CartProduct::with('products')->where('cart_id', $cart->id)->get();
    
        // Tính tổng giá
        $totalPrice = $cartproducts->sum(function ($cartproduct) {
            return ($cartproduct->quantity ?? 0) * ($cartproduct->price ?? 0);
        });
    
        return view('users.products.cart', compact('products', 'cart', 'cartproducts', 'totalPrice','user'));
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


    public function pay(Request $request)
{   
 
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        $cartproducts = CartProduct::with('products')
                                    ->where('cart_id', $cart->id)
                                    ->get();

        if ($cartproducts->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn không có sản phẩm nào!');
        }

        $products = Product::all(); 
        $totalPrice = $cartproducts->sum(function ($cartproduct) {
            return $cartproduct->quantity * $cartproduct->price;
        });

        return view('users.products.pay', compact('products', 'cart', 'cartproducts', 'totalPrice','user'));
    }   
    public function order()
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('users.login');
    }

    // Kiểm tra xem có đơn hàng nào đang chờ xác nhận không
    $existingOrder = Order::where('user_id', $user->id)
                          ->where('status', 0)
                          ->first();

    $cart = Cart::where('user_id', $user->id)->first();
    $cartproducts = CartProduct::with('products')->where('cart_id', $cart->id)->get();
    $totalPrice = $cartproducts->sum(function ($cartproducts) {
        return ($cartproducts->quantity ?? 0) * ($cartproducts->price ?? 0);
    
    });

    if ($existingOrder) {
        // Cập nhật thông tin của đơn hàng (order)
        $existingOrder->name = $user->name;
        $existingOrder->address = $user->address;
        $existingOrder->phone = $user->phone;
        $existingOrder->price = $totalPrice;
        $existingOrder->save();
        // Nếu có đơn hàng chờ xác nhận
        foreach ($cartproducts as $cartproduct) {
            $existingProductInOrder = OrderProduct::where('order_id', $existingOrder->id)
                ->where('product_id', $cartproduct->product_id)
                ->first();
        
            if ($existingProductInOrder) {
                // Nếu sản phẩm đã có trong đơn hàng, cập nhật số lượng và giá
                $existingProductInOrder->quantity = $cartproduct->quantity;
                $existingProductInOrder->price = $totalPrice;
                $existingProductInOrder->save();

            } else {
                // Nếu sản phẩm chưa có trong đơn hàng, tạo mới
                OrderProduct::create([
                    'user_id' => $user->id,
                    'order_id' => $existingOrder->id,
                    'product_id' => $cartproduct->product_id,
                    'quantity' => $cartproduct->quantity,
                    'price' => $cartproduct->price,
                    'name_product' => $cartproduct->products->name,
                ]);
            }
        }

    } else {
        // Nếu không có đơn hàng nào đang chờ xác nhận, tạo đơn hàng mới
        $totalPrice = $cartproducts->sum(function ($cartproduct) {
            return ($cartproduct->quantity ?? 0) * ($cartproduct->price ?? 0);
        });

        $order = Order::create([
            'name' => $user->name,
            'address' => $user->address,
            'phone' => $user->phone,
            'user_id' => $user->id,
            'status' => 0,
            'price' => $totalPrice,
        ]);

        // Lưu các sản phẩm vào đơn hàng
        foreach ($cartproducts as $cartproduct) {
            OrderProduct::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'product_id' => $cartproduct->product_id,
                'quantity' => $cartproduct->quantity,
                'price' => $cartproduct->price,
                'name_product' => $cartproduct->products->name,
            ]);
        }
    }

    // Chuyển hướng đến trang thanh toán
    return redirect()->route('users.products.pay');
}

    
    
    
    public function logout(){   
        Auth::logout();
        
        return redirect()->route('users.home');
    }
    public function ordersucess(Request $request){
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $order = Order::where('user_id', $user->id)->where('status', 0)->first();

        $order->update([
        'name'=>$request->name,
        'address'=> $request->address,
        'phone'=> $request->phone,
        'user_id'=> $user->id ,
        'status'=> '1',
        'price'=> $request->total_price,
     ]);
         $cart->delete();
     return redirect()->route('users.home');
    }
}
    