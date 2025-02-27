<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .bg-image {
            background-image: url("{{ asset('image/login1.png') }}");
            background-size: cover; /* Hiển thị toàn bộ ảnh */
            background-position: bottom; /* Căn giữa ảnh */
            background-repeat: no-repeat; /* Không lặp lại ảnh */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Đưa ảnh nền xuống dưới */
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center bg-gray-100 relative bg-image">
    
    <!-- Form đăng nhập -->
    <div class="relative bg-white p-8 rounded-lg shadow-lg w-96 text-center mt-[-100px]">
        <h2 class="text-2xl font-bold text-gray-700">Đăng Nhập</h2>

        <!-- Hiển thị lỗi -->
        @if ($errors->has('email'))
            <div class="text-red-500 text-sm mt-2">
                <p>{{ $errors->first('email') }}</p>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('users.loginIndex') }}" method="POST" class="mt-4">
            @csrf  

            <!-- Nhập email -->
            <label class="block text-gray-700 text-left">Email</label>
            <input type="email" name="email" placeholder="Nhập email" 
                   class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">

            <!-- Nhập mật khẩu -->
            <label class="block text-gray-700 text-left mt-4">Mật khẩu</label>
            <input type="password" name="password" placeholder="Nhập mật khẩu" 
                   class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">

            <!-- Nút đăng nhập -->
            <button type="submit" 
                    class="w-full mt-6 bg-black hover:bg-blue-700 text-white py-2 rounded-lg font-semibold">
                Đăng nhập
            </button>
        </form><br>
        <div class="text-center mt-4">
    <a href="{{ route('users.create') }}" 
       class="inline-block text-blue-500 hover:text-blue-600 font-semibold transition duration-200">
       Chưa có tài khoản? <span class="underline">Đăng ký ngay</span>
    </a>
    <br>
    <a href="{{ route('users.confirmEmail') }}" 
       class="inline-block text-gray-500 hover:text-gray-600 transition duration-200 mt-2">
       <i class="fas fa-lock mr-1"></i> Quên mật khẩu?
    </a>
</div>


    </div>
</body>
</html>
