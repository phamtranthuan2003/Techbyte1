<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa Hàng Điện Tử - Pros Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    
    <div class="w-full max-w-lg p-8 bg-white shadow-xl rounded-2xl">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Đăng Ký</h2>
        
        <form action="{{ route('users.store') }}" method="post" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">Họ Tên</label>
                <input type="text" id="name" name="name" placeholder="Nhập họ tên" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:outline-none transition">
            </div>

            <div>
                <label for="birthday" class="block text-sm font-semibold text-gray-700">Ngày Sinh</label>
                <input type="date" id="birthday" name="birthday" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Giới Tính</label>
                <div class="flex items-center space-x-6 mt-1">
                    <label class="flex items-center">
                        <input type="radio" name="sex" value="Nam" class="mr-2" required> Nam
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="sex" value="Nữ" class="mr-2" required> Nữ
                    </label>
                </div>
            </div>

            <div>
                <label for="address" class="block text-sm font-semibold text-gray-700">Địa Chỉ</label>
                <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:outline-none transition">
            </div>

            <div>
                <label for="phone" class="block text-sm font-semibold text-gray-700">Số Điện Thoại</label>
                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:outline-none transition">
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" id="email" name="email" placeholder="Nhập email" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:outline-none transition">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:outline-none transition">
            </div>

            <div>
                <label for="re-password" class="block text-sm font-semibold text-gray-700">Nhập lại mật khẩu</label>
                <input type="password" id="re-password" name="re-password" placeholder="Nhập lại mật khẩu" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:outline-none transition">
            </div>

            <button type="submit"
                class="w-full bg-black hover:bg-blue-600 text-white py-2 rounded-lg text-lg font-semibold transition duration-200">
                Đăng Ký
            </button>
        </form><br>

        <div class="mt-4 text-center text-gray-600">
            <span>Bạn đã có tài khoản?</span>
            <a href="{{ route('users.login') }}" 
            class="text-blue-500 font-semibold hover:text-blue-600 hover:underline transition duration-200">
                Đăng Nhập
            </a>
        </div>

    </div>

</body>
</html>
