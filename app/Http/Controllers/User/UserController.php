<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Jobs\SendEmail as NotificationsSendEmail;
use Illuminate\Support\Facades\Auth;
use App\Task;
class UserController extends Controller

{
    public function create()
    {
        
        return view('users.users.create');
    }
    public function store(Request $request)
    {
        
        $data = $request->all();
        $user = User::create($data);
        $cart = Cart::where('user_id', $user->id)->first();
    
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
                'price' => 0,
            ]);
        }
        return redirect()->route('users.login');
    }

    public function edit($id){
        // Tìm đến đối tượng muốn update
        $user = User::findOrFail($id);

        // điều hướng đến view edit user và truyền sang dữ liệu về user muốn sửa đổi
        return view('admins.users.edit', compact('user'));
    }

    public function update(Request $request, $id){
        // Tìm đến đối tượng muốn update
        $user = User::findOrFail($id);

        // gán dữ liệu gửi lên vào biến data
        $data = $request->all();
 
        

        // Update user
        $user->update($data);

        return redirect()->route('admins.users.list')->with('success', 'Cập nhật sản phẩm thành công');
    }
    
    public function login(Request $request){
        $users = auth::user();

        return view('users.login');
    }
    public function loginIndex(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Kiểm tra người dùng và mật khẩu
        $user = User::where('email', $request->email)->first();
    
        if ($user &&($request->password == $user->password)) {
            // Đăng nhập người dùng
            Auth::login($user);
            // Kiểm tra role và chuyển hướng
            if ($user->role === 'admin') {
                return redirect()->route('admins.home');
            } else {
                return redirect()->route('users.home');
            }
        } else {
            // Trả lại thông báo lỗi nếu đăng nhập thất bại
            return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng']);
        }
    }
    public function confirmEmail(Request $request){

        return view('users.confirmEmail');
    }
    public function resetpassword(Request $request){   
        // Lấy email từ request
            $email = $request->input('email');
    
            // Kiểm tra email trong cơ sở dữ liệu
            $user = User::where('email', $email)->first();
    
            if ($user) {
                return view('users.forgotpassword', compact('user'));
                
            } else {
                // Email không trùng khớp
                return back()->with('error', 'Email không tồn tại trong hệ thống!');
            }
    }
    public function updatepassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();

        
        $user->update($data);
        return redirect()->route('users.login');
    }
    public function home(Request $request)
{
        $user = Auth::user();
        
        $cartCount = 0;
        $cartproducts = collect(); // Khởi tạo một collection rỗng để tránh lỗi

        if ($user) {
            $cart = Cart::where('user_id', $user->id)->first();
            if ($cart) {
                $cartproducts = CartProduct::with('products')->where('cart_id', $cart->id)->get();
                $cartCount = $cartproducts->count();
            }
        }

        $categories = Category::all();
        $products = Product::where('role', 'hiện')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

    // Lấy 4 sản phẩm bán chạy nhất
        $bestSellingProduct = OrderProduct::select('product_id')
        ->selectRaw('SUM(quantity) as total_sold')
        ->groupBy('product_id')
        ->orderByDesc('total_sold')
        ->limit(4)
        ->pluck('product_id'); // Trả về danh sách product_id

        // Lấy thông tin sản phẩm từ bảng products
        $bestProduct = Product::whereIn('id', $bestSellingProduct)->get();

return view('users.home', compact('products', 'user', 'categories', 'cartCount', 'bestProduct'));


}

public function introduce(Request $request)
{
    $user = Auth::user();
    $cartCount = 0; // Mặc định giỏ hàng trống nếu user chưa đăng nhập

    if ($user) {
        $cart = Cart::where('user_id', $user->id)->first();
        if ($cart) {
            $cartCount = CartProduct::where('cart_id', $cart->id)->count();
        }
    }

    return view('users.introduce.introduce', compact('user', 'cartCount'));
}

public function promotion()
{
    $user = Auth::user();
    $cartCount = 0; // Mặc định giỏ hàng trống nếu user chưa đăng nhập

    if ($user) { // Kiểm tra user có đăng nhập không
        $cart = Cart::where('user_id', $user->id)->first();
        if ($cart) {
            $cartCount = CartProduct::where('cart_id', $cart->id)->count();
        }
    }

    return view('users.promotions.promotion', compact('user', 'cartCount'));
}

    public function contact()
    {
        $user = Auth::user();
    $cartCount = 0; // Mặc định giỏ hàng trống nếu user chưa đăng nhập

    if ($user) { // Kiểm tra user có đăng nhập không
        $cart = Cart::where('user_id', $user->id)->first();
        if ($cart) {
            $cartCount = CartProduct::where('cart_id', $cart->id)->count();
        }
    }
        return view('users.contacts.contact', compact('user','cartCount'));
    }
    public function feedback(Request $request)
    {   $data = $request->all();
        
        try {

            dispatch(new NotificationsSendEmail($data));

        } catch (\Exception $e) {
            dd($e->getLine(), $e->getFile(), $e->getMessage());
            //throw $th;
        }
        return redirect()->back();
    }
    
    
}