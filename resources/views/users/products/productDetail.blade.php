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
                <a href="{{ route("users.home") }}">
                    <h1 class="text-3xl font-bold tracking-widest ml-4">ProsStudio Store</h1>
                </a>
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

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-24">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-8 rounded-lg shadow-lg">
            <!-- Product Image -->
            <div>
            <img src="{{ $products->image }}" class="w-full h-96 object-cover rounded-lg shadow-md">
            </div>
            
            <!-- Product Details -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $products->name }}</h2>
                <p class="text-red-500 font-bold text-2xl mt-2">{{ number_format($products->price, 0, ',', '.') }} VND</p>
                <p class="text-gray-600 mt-2">Còn lại: {{ $products->sell }}</p>
                <p class="text-gray-600 mt-2">Sản xuất: {{ $products->provider->name }}</p>
                <p class="text-gray-600 mt-2">Suất xứ: {{ $products->provider->address }}</p>
                <div class="mt-4">
                    <h4 class="text-lg font-semibold">Thông số kỹ thuật:</h4>
                    <ul class="list-disc list-inside text-gray-700">
                        <li>Thương hiệu: {{ $products->brand }}</li>
                        <li>Mô hình: {{ $products->model }}</li>
                        <li>Khối lượng: {{ $products->weight }} kg</li>
                        <li>Kích thước: {{ $products->dimensions }}</li>
                        <li>Bảo hành: {{ 12 }} tháng</li>
                    </ul>
                </div>
                <form action="{{ route('users.products.addtocart') }}" method="post">
                @csrf
                <button class="mt-6 w-full bg-black text-white py-3 rounded-lg font-semibold hover:opacity-80 transition shadow-lg" onclick="addToCart()">Thêm vào Giỏ</button>
                </form>
            </div>
        </div><br><br>
        <h3 class="text-2xl text-gray-800 mb-6 title relative pl-[20px]">SẢN PHẨM BÁN CHẠY NHẤT</h3>
        <div class="grid grid-cols-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($bestProduct as $product)
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition text-center">
                    <img src="{{ $product->image }}" class="w-full h-64 object-cover rounded-lg hover:scale-105 transition">
                    <h4 class="text-2xl font-bold mt-3 text-gray-900">{{ $product->name }}</h4>
                    <p class="text-red-500 font-bold mt-2 text-xl">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                    <p class="text-gray-600">Còn lại: {{ $product->sell }}</p>
                    
                    <form action="{{ route('users.products.addtocart') }}" method="post">
                        @csrf
                        <button type="submit" class="mt-4 w-full bg-black text-white py-3 rounded-lg font-semibold hover:opacity-75 transition shadow-lg">
                            Thêm vào Giỏ
                        </button>
                    </form>
                </div>
            @endforeach
    </main>

    <!-- Footer -->
    <footer class="bg-black text-[#999999] p-4 w-full mt-[35px]">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center py-3">
            <p>&copy; 2025 Cửa Hàng Điện Tử Pros studio</p>
            <div class="flex space-x-4">
                <a href="https://www.facebook.com/thuan.phamtran.9/" class="hover:text-gray-300"><i class="fab fa-facebook text-xl"></i></a>
                <a href="https://www.instagram.com/phamtran.thuan/" class="hover:text-gray-300"><i class="fab fa-instagram text-xl"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fab fa-twitter text-xl"></i></a>
            </div>
        </div>
    </footer>
</body>

</html>
