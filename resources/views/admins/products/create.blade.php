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
    <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Thêm sản phẩm</h1>
    
    <form action="{{ route('admins.products.store') }}" method="post" class="space-y-4" enctype="multipart/form-data">
        @csrf
        
        <!-- Tên sản phẩm -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700">Tên sản phẩm</label>
            <input type="text" id="name" name="name" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Giá sản phẩm -->
        <div>
            <label for="price" class="block text-sm font-semibold text-gray-700">Giá</label>
            <input type="number" id="price" name="price" required min="1"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Mô tả -->
        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700">Mô tả</label>
            <textarea id="description" name="description" required rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none"></textarea>
        </div>

        <!-- Số lượng bán ra -->
        <div>
            <label for="sell" class="block text-sm font-semibold text-gray-700">Số lượng bán ra</label>
            <input type="number" id="sell" name="sell" required min="0"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Chọn danh mục -->
        <div>
            <label class="block text-sm font-semibold text-gray-700">Danh mục</label>
            <select name="category_id[]" multiple required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Ảnh sản phẩm -->
        <div>
            <label for="image" class="block text-sm font-semibold text-gray-700">Ảnh sản phẩm</label>
            <input type="file" id="images" name="images[]" accept="image/*" multiple
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
        </div>

        <!-- Chọn nhà cung cấp -->
        <div>
            <label class="block text-sm font-semibold text-gray-700">Nhà cung cấp</label>
            <select name="provider_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
                @foreach ($providers as $provider)
                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Trạng thái hiển thị -->
        <div>
            <label class="block text-sm font-semibold text-gray-700">Trạng thái</label>
            <div class="flex items-center space-x-6 mt-1">
                <label class="flex items-center">
                    <input type="radio" name="role" value="Hien" class="mr-2"> Hiện
                </label>
                <label class="flex items-center">
                    <input type="radio" name="role" value="An" checked class="mr-2"> Ẩn
                </label>
            </div>
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
