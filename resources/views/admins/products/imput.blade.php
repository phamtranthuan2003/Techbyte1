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
    <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Nhập Kho</h1>

    <form action="{{ route('admins.products.inputSuccess') }}" method="post" class="space-y-4" enctype="multipart/form-data">
        @csrf

        <!-- Tên sản phẩm -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700">Mã hàng</label>
            <input type="text" id="name" name="name" required placeholder="Nhập mã hàng"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Giá sản phẩm -->
        <div>
            <label for="quantity" class="block text-sm font-semibold text-gray-700">Số lượng</label>
            <input type="number" id="quantity" name="quantity" required min="1" placeholder="Nhập số lượng"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Mô tả -->
        <div>
            <label for="description" class="block mb-1 text-sm font-semibold text-gray-700">Đơn vị tính</label>
            <input type="text" id="description" name="description" required  placeholder="Nhập đơn vị tính"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
        </div>


        <!-- Số lượng bán ra -->
        
        <div>
            <label class="block text-sm font-semibold text-gray-700">Nhà cung cấp</label>
            <select name="provider_id" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
            @foreach ($providers as $provider)
            <option value="{{ $provider->id }}">{{ $provider->name }}</option>
            @endforeach
        </select>
        </div>
        <div>
            <label for="position" class="block mb-1 text-sm font-semibold text-gray-700">Vị trí cung cấp</label>
            <input type="text" id="position" name="position" required placeholder="Nhập vị trí"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
        </div>

    <!-- Nút submit -->
        <button type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg text-lg font-semibold transition duration-200">
            Tạo sản phẩm
        </button>
    </form>
</div>

</body>
</html>
