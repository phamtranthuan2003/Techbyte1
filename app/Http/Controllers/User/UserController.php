<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\error;

class UserController extends Controller

{
    public function create()
    {
        
        return view('users.create');
    }
    public function store(Request $request): void
    {
        
        $data = $request->all();
        $data['role'] = 'user';
        // $data['password'] = Hash::make($request->password);
        User::create($data);
        echo "Tao tai khoan thanh cong";
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
        // mã hóa password trước khi đẩy lên DB
        $data['password'] = Hash::make($request->password);

        // Update user
        $user->update($data);

        echo"Cap nhat nguoi dung thanh cong";
    }
    
    public function login(Request $request){
    
        return view('users.login');
    }
    public function loginIndex(Request $request){

         // Validate dữ liệu
         $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kiểm tra người dùng và mật khẩu
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // Đăng nhập người dùng
            Auth::login($user);

            return view('users.home ');
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
    public function updatepassword(Request $request)
    {
        $user = User::get();
        
            // Kiểm tra dữ liệu đầu vào
            $validatedData = $request->validate([
                'password' => 'required|string|confirmed',
            ]);
        
            if ($user) {
                // Mã hóa mật khẩu mới
                $user->password = Hash::make($request->password);
        
                // Lưu thay đổi vào cơ sở dữ liệu
                $user->save();
        
                // Chuyển hướng đến màn hình đăng nhập với thông báo thành công
                return redirect()->route('users.login')->with('success', 'Mật khẩu đã được cập nhật. Vui lòng đăng nhập lại!');
            } 
        }
    public function home(Request $request){

        return view('users.home');
}
public function introduce(Request $request){

    return view('users.introduce.introduce');
}
}