<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Nhà Cung Cấp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<!-- Hiển thị thông báo nếu có -->
@if(session('success'))
    <div class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
        {{ session('success') }}
    </div>
@endif

<div class="w-full max-w-lg p-8 bg-white shadow-xl rounded-2xl">
    <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Sửa Nhà Cung Cấp</h1>
    
    <form action="{{ route('admins.providers.update', ['id' => $provider->id]) }}" method="post" class="space-y-4">
        @csrf
        @method('PUT')
        
        <!-- Tên Nhà Cung Cấp -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700">Tên Nhà Cung Cấp</label>
            <input type="text" id="name" name="name" required value="{{ old('name', $provider->name) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Địa Chỉ -->
        <div>
            <label for="address" class="block text-sm font-semibold text-gray-700">Địa Chỉ</label>
            <input type="text" id="address" name="address" required value="{{ old('address', $provider->address) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Số Điện Thoại -->
        <div>
            <label for="phone" class="block text-sm font-semibold text-gray-700">Số Điện Thoại</label>
            <input type="tel" id="tele" name="tele" required value="{{ old('phone', $provider->tele) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Nút Submit -->
        <button type="submit"
            class="w-full bg-black hover:bg-blue-600 text-white py-2 rounded-lg text-lg font-semibold transition duration-200">
            <i class="fa fa-save mr-2"></i>Lưu Thay Đổi
        </button>
    </form>
</div>

</body>
</html>
