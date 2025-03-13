<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa người dùng - Pros Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="w-full max-w-lg p-8 bg-white shadow-xl rounded-2xl">
    <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Chỉnh sửa người dùng</h2>

    <form action="{{ route('users.update', $user->id) }}" method="post" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Họ tên -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700">Họ tên</label>
            <input type="text" name="name" placeholder="Nhập họ tên" value="{{ $user->name }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- Ngày sinh -->
        <div>
            <label for="birthday" class="block text-sm font-semibold text-gray-700">Ngày sinh</label>
            <input type="date" name="birthday" value="{{ $user->birthday }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- Giới tính -->
        <div>
            <label class="block text-sm font-semibold text-gray-700">Giới tính</label>
            <div class="flex space-x-6 mt-1">
                <label class="flex items-center">
                    <input type="radio" name="sex" value="Nam" @checked($user->sex === 'Nam') class="mr-2"> Nam
                </label>
                <label class="flex items-center">
                    <input type="radio" name="sex" value="Nữ" @checked($user->sex === 'Nữ') class="mr-2"> Nữ
                </label>
            </div>
        </div>

        <!-- Địa chỉ -->
        <div>
            <label for="address" class="block text-sm font-semibold text-gray-700">Địa chỉ</label>
            <input type="text" name="address" placeholder="Nhập địa chỉ" value="{{ $user->address }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- Số điện thoại -->
        <div>
            <label for="phone" class="block text-sm font-semibold text-gray-700">Số điện thoại</label>
            <input type="text" name="phone" placeholder="Nhập số điện thoại" value="{{ $user->phone }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
            <input type="email" name="email" placeholder="Nhập email" value="{{ $user->email }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- Mật khẩu -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700">Mật khẩu</label>
            <input type="password" name="password" placeholder="Để trống nếu không đổi mật khẩu"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:outline-none">
        </div>

        <!-- Quyền -->
        <div>
            <label class="block text-sm font-semibold text-gray-700">Quyền</label>
            <div class="flex space-x-6 mt-1">
                <label class="flex items-center">
                    <input type="radio" name="role" value="admin" @checked($user->role === 'admin') class="mr-2"> Admin
                </label>
                <label class="flex items-center">
                    <input type="radio" name="role" value="user" @checked($user->role === 'user') class="mr-2"> User
                </label>
            </div>
        </div>

        <!-- Nút Cập nhật -->
        <button type="submit"
                class="w-full bg-black hover:bg-blue-600 text-white py-2 rounded-lg text-lg font-semibold transition duration-200">
            Cập nhật
        </button>
    </form>
</div>
</body>
</html>
