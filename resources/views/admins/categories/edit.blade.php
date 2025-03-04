<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Danh Mục - Pros Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    
    <div class="w-full max-w-lg p-8 bg-white shadow-xl rounded-2xl">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Sửa Danh Mục</h1>

        <form action="{{ route('admins.categories.update', ['id' => $category->id]) }}" method="post" class="space-y-4">
            @csrf

            <!-- Tên danh mục -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">Tên danh mục</label>
                <input type="text" id="name" name="name" placeholder="Nhập tên danh mục" required value="{{$category->name}}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">
            </div>

            <!-- Mô tả danh mục -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700">Mô tả</label>
                <textarea id="description" name="description" placeholder="Nhập mô tả danh mục" required rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-300 focus:outline-none">{{$category->description}}</textarea>
            </div>

            <!-- Nút submit -->
            <button type="submit"
                class="w-full bg-black hover:bg-blue-600 text-white py-2 rounded-lg text-lg font-semibold transition duration-200">
                Thêm Danh Mục
            </button>
        </>
    </div>

</body>
</html>
