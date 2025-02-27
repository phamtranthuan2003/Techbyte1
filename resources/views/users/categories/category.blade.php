<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa Hàng Điện Tử - Pros Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Thêm Swiper.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</head>
    <!-- Header -->
    <div class="fixed top-0 left-0 z-50 w-full shadow-lg bg-white">
        <div class="container mx-auto">
            <header class="bg-gradient-to-r text-black p-4 w-full flex justify-between items-center">
                <h1 class="text-3xl font-bold tracking-widest ml-4">ProsStudio STORE</h1>
                <nav class="space-x-6 hidden md:flex">
                    <a href="{{ route("users.home") }}" class="hover:text-yellow-300 transition">TRANG CHỦ</a>
                    <a href="{{ route("users.introduce") }}" class="hover:text-yellow-300 transition">GIỚI THIỆU</a>
                    <a href="{{ route("users.products.list") }}" class="hover:text-yellow-300 transition">SẢN PHẨM</a>
                    <a href="{{ route("users.promotion") }}" class="hover:text-yellow-300 transition">KHUYẾN MÃI</a>
                    <a href="{{ route("users.contact") }}" class="hover:text-yellow-300 transition">LIÊN HỆ</a>
                </nav>
                <div class="flex items-center space-x-4 mr-4">
                    <a href="{{ route('users.products.cart') }}" class="relative">
                        <i class="fa-solid fa-cart-shopping text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 rounded-full">{{ $cartCount }}</span>
                    </a>
                    @if(!$user)
                        <a href="{{ route('users.login') }}" class="bg-black text-white px-4 py-2 rounded-lg font-semibold">Đăng Nhập</a>
                    @else
                        <form action="{{ route('users.products.logout') }}" method="post">
                            @csrf
                            <button type="submit" class="underline text-back px-4 py-2 rounded-lg">Đăng Xuất</button>
                        </form>
                    @endif
                </div>
            </header>
        </div>
    </div>

    <main class="container mx-auto px-4 py-8 mt-20 flex-grow">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4 text-center">{{ $category->name }}</h2> <!-- Tăng khoảng cách dưới cho tên danh mục -->
        
        <div class="flex justify-center mb-6">
            <input type="text" id="search" placeholder="Tìm kiếm sản phẩm..." class="p-2 border rounded-lg" oninput="searchProducts()"> <!-- Giảm kích thước ô tìm kiếm xuống 1/4 -->
        </div>

        <div class="flex justify-center space-x-4 mb-6">
            <a href="{{ route('users.products.list') }}" class="bg-black text-white px-4 py-2 rounded-lg">Tất cả</a>
            @foreach ($categories as $category)
                <a href="{{ route('users.category', ['id' => $category->id]) }}" class="bg-black text-white px-4 py-2 rounded-lg">{{ $category->name }}</a>
            @endforeach
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="product-list">
            @if($products->isEmpty())
                <p class="text-center col-span-4">Không có sản phẩm nào thuộc danh mục này.</p>
            @else
                @foreach ($products as $product)
                    <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-2xl transition text-center">
                    <a href="{{ route('users.products.productDetail', ['id' => $product->id]) }}">
                    <img src="{{ $product->image }}" class="w-full h-64 object-cover rounded-lg hover:scale-105 transition">
                    </a>
                        <h3 class="text-2xl font-bold mt-3 text-gray-900">{{ $product->name }}</h3>
                        <p class="text-red-500 font-bold mt-2 text-xl">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                        <p class="text-gray-600 text-center">Còn lại: {{ $product->sell }}</p>
                        <button class="mt-4 w-full bg-black text-white py-3 rounded-lg font-semibold hover:opacity-75 transition shadow-lg" onclick="addToCart()">Thêm vào Giỏ</button>
                    </div>
                @endforeach
            @endif
        </div>
    </main><br><br>

    <footer class="bg-black text-[#999999] p-4 w-full">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center py-3">
            <p>&copy; 2025 Cửa Hàng Điện Tử Pros studio</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-gray-300"><i class="fab fa-facebook text-xl"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fab fa-instagram text-xl"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fab fa-twitter text-xl"></i></a>
            </div>
        </div>
    </footer>

    <script>
        function searchProducts() {
            let input = document.getElementById("search").value.toLowerCase();
            let products = document.querySelectorAll("#product-list .bg-white");

            products.forEach(product => {
                let productName = product.querySelector("h3").textContent.toLowerCase();
                product.style.display = productName.includes(input) ? "block" : "none";
            });
        }

        function addToCart() {
            alert("Sản phẩm đã được thêm vào giỏ hàng!");
        }
    </script>
</body>
</html>