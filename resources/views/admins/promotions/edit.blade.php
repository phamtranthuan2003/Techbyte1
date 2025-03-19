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
    <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Sửa mã giảm giá</h1>

    <form action="{{ route('admins.promotions.update', ['id' => $promotion->id]) }}" method="post" class="space-y-4" enctype="multipart/form-data">
        @csrf

        <!-- Mã giảm giá -->
        <div>
            <label for="code" class="block text-sm font-semibold text-gray-700">Mã giảm giá</label>
            <input type="text" id="code" name="code" required  value="{{$promotion->code}}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Giá giảm -->
        <div>
            <label for="discount_price" class="block text-sm font-semibold text-gray-700">Giá giảm</label>
            <input type="number" id="discount" name="discount" required min="1"  value="{{$promotion->discount}}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Ngày hết hạn -->
        <div>
            <label for="expiry_date" class="block text-sm font-semibold text-gray-700">Ngày hết hạn</label>
            <input type="date" id="expires_at" name="expires_at" required  value="{{ \Carbon\Carbon::parse($promotion->expires_at)->format('Y-m-d') }}""
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Nút submit -->
        <button type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg text-lg font-semibold transition duration-200">
            Thêm mã giảm giá
        </button>
    </form>
</div>

</body>
</html>
