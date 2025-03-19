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
use App\Models\UserPromotion;
use App\Models\Review;
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
        $products = Product::with('firstImage')->where('role', 'hiện')->get();



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

        $filteredCartProducts = $cartproducts->filter(function ($cartproduct) {
            return $cartproduct->products && $cartproduct->products->sell != 0;
        });

        // Tính tổng giá
        $totalPrice = $filteredCartProducts->sum(function ($cartproduct) {
            return $cartproduct->price * $cartproduct->quantity;
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

        // Lọc sản phẩm có sell != 0
        $filteredCartProducts = $cartproducts->filter(function ($cartproduct) {
            return $cartproduct->products && $cartproduct->products->sell != 0;
        });

        // Kiểm tra nếu không có sản phẩm hợp lệ sau khi lọc
        if ($filteredCartProducts->isEmpty()) {
            return redirect()->back()->with('error', 'Không có sản phẩm hợp lệ để thanh toán!');
        }

        // Tính tổng giá từ danh sách sản phẩm hợp lệ
        $totalPrice = $filteredCartProducts->sum(function ($cartproduct) {
            return $cartproduct->price * $cartproduct->quantity;
        });
        // // Lấy danh sách khuyến mãi mà user có từ bảng `user_promotions`
        // $userPromotions = UserPromotion::where('user_id', $user->id)
        //     ->whereHas('promotion') // Đảm bảo có khuyến mãi hợp lệ
        //     ->with('promotion') // Lấy thông tin từ bảng `promotions`
        //     ->get()
        //     ->pluck('promotion'); // Chỉ lấy danh sách khuyến mãi

        return view('users.products.pay', [
            'cart' => $cart,
            'cartproducts' => $filteredCartProducts, // Chỉ truyền sản phẩm hợp lệ vào view
            'totalPrice' => $totalPrice,
            'user' => $user
        ]);
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
       // Xóa tất cả sản phẩm trong đơn hàng cũ
        OrderProduct::where('order_id', $existingOrder->id)->delete();

        // Xóa đơn hàng cũ
        $existingOrder->delete();

        // Tạo đơn hàng mới
        $order = Order::create([
            'name' => $user->name,
            'address' => $user->address,
            'phone' => $user->phone,
            'user_id' => $user->id,
            'status' => 0,
            'paymentmethod' => 0,
            'price' => $totalPrice,
        ]);
        foreach ($cartproducts as $cartproduct) {
                $orderProduct = OrderProduct::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'product_id' => $cartproduct->product_id,
                'quantity' => $cartproduct->quantity,
                'price' => $cartproduct->price,
                'name_product' => $cartproduct->products->name,
            ]);
        }


    } else {
        $order = Order::create([
            'name' => $user->name,
            'address' => $user->address,
            'phone' => $user->phone,
            'user_id' => $user->id,
            'status' => 0,
            'paymentmethod' => 0,
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
    public function ordersucess(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $order = Order::where('user_id', $user->id)->where('status', 0)->first();

        $paymenmethood = $request->payment_method;

        if ($paymenmethood == '0') {
            $order->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'user_id' => $user->id,
                'status' => '1',
                'paymentmethod' => $paymenmethood,
                'price' => $request->total_price,
            ]);
        } else {
            // Nếu phương thức thanh toán > 0, trả về JSON với link QR của order
                return redirect()->route('users.products.qrcode', ['id' => $order->id]);

        }

        // Lấy danh sách sản phẩm trong đơn hàng
        $orderProducts = OrderProduct::where('order_id', $order->id)->get();

        // Giảm số lượng sản phẩm trong bảng Product
        foreach ($orderProducts as $orderProduct) {
            $product = Product::find($orderProduct->product_id);
            if ($product) {
                $product->decrement('sell', $orderProduct->quantity);
            }
        }

        // Xóa sản phẩm trong giỏ hàng
        CartProduct::where('cart_id', $cart->id)->delete();

        return redirect()->route('users.home');
    }

    public function productDetail(Request $request, $id)
{       $products = Product::with(['images', 'colors', 'capacities'])->findOrFail($id);
        // Kiểm tra sản phẩm có tồn tại không
        if (!$products) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        // Không cho phép thêm vào giỏ hàng nếu sản phẩm không bán được
        if ($products->sell == 0) {
            return redirect()->back()->with('error', 'Sản phẩm này hiện không thể mua.');
        }

        $cartCount = 0;
        $user = Auth::user();
        $bestSellingProduct = OrderProduct::select('product_id')
        ->selectRaw('SUM(quantity) as total_sold')
        ->groupBy('product_id')
        ->orderByDesc('total_sold')
        ->limit(4)
        ->pluck('product_id'); // Trả về danh sách product_id

    // Lấy thông tin sản phẩm từ bảng products
        $bestProduct = Product::whereIn('id', $bestSellingProduct)->get();

        if ($user) {
        // Kiểm tra xem user đã có giỏ hàng chưa, nếu chưa thì tạo mới
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Đếm số sản phẩm trong giỏ hàng
        $cartCount = CartProduct::where('cart_id', $cart->id)->count();

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cart_product = CartProduct::where('product_id', $products->id)
            ->where('cart_id', $cart->id)
            ->first();

        if (!$cart_product) {
            // Thêm sản phẩm vào giỏ hàng nếu chưa có
            CartProduct::create([
                'cart_id' => $cart->id,
                'product_id' => $products->id,
                'price' => $products->price,
                'quantity' => $request->quantity ?? 1,
            ]);
        } else {
            // Nếu đã có, cập nhật số lượng
            $cart_product->quantity += $request->quantity ?? 1;
            $cart_product->save();
        }
    }

        return view('users.products.productDetail', compact('products', 'user', 'cartCount', 'bestProduct'));
}
    public function reviewProduct(Request $request, $productId) {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500'
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Đánh giá của bạn đã được thêm!');
    }
    public function qrcode($id) {
        $user = Auth::user();
        $order = Order::with('orderProducts.product', 'user')->findOrFail($id);
        $cart = Cart::where('user_id', $user->id)->first();
        $cartproducts = CartProduct::with('products')
                                    ->where('cart_id', $cart->id)
                                    ->get();
        $cartCount = CartProduct::where('cart_id', $cart->id)->count();
        return view('users.qrcode', compact('user','order','cart','cartproducts'));
     }
}
