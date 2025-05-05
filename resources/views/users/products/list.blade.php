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
                    <div class="relative">
                    @if($user)
                        <a href="{{ route('users.orders.index', ['id' => $user->id]) }}" class="bg-gray-300 text-black px-4 py-2 rounded-lg font-semibold hover:bg-yellow-400 transition">ĐƠN HÀNG</a>
                        @endif
                    </div>
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

    <!-- Danh sách sản phẩm -->
    <div class="container mx-auto px-4 py-8 mt-20 flex-grow">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4 text-center">Tất Cả Sản Phẩm</h2>

        <div class="mb-6 text-center">
            <input type="text" id="search" placeholder="Tìm kiếm sản phẩm..." class="p-2 border rounded-lg" oninput="searchProducts()">
        </div>

        <div class="flex justify-center space-x-4 mb-6">
            <a href="{{ route('users.products.list') }}" class="bg-black text-white px-4 py-2 rounded-lg">Tất cả</a>
            @foreach ($categories as $category)
                <a href="{{ route('users.category', ['id' => $category->id]) }}" class="bg-black text-white px-4 py-2 rounded-lg">{{ $category->name }}</a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id ="product-list">
            @foreach ($products as $product)
            <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-2xl transition text-center flex flex-col justify-between min-h-[520px]">
                <a href="{{ route('users.products.productDetail', ['id' => $product->id]) }}">
                    <img src="{{ asset($product->images->where('sort_order', 0)->first()->image_path ?? $product->images->first()->image_path ?? 'default-image.jpg') }}" class="w-full h-[19rem] object-cover rounded-lg hover:scale-105 transition">
                </a>
                <div class="mt-3 flex flex-col justify-between flex-grow">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h3>
                        <p class="text-red-500 font-bold mt-2 text-xl">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                        <p class="text-gray-600">Còn lại: {{ $product->sell }}</p>
                    </div>
                    <div class="mt-4">
                        @if($product->sell < 0)
                            <p class="text-red-500 font-semibold">Sản phẩm này hiện đang hết hàng</p>
                        @else
                            <form action="{{ route('users.products.addtocart') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="w-full bg-black text-white py-3 rounded-lg font-semibold hover:opacity-75 transition shadow-lg">Thêm vào Giỏ</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div><br><br>

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

    <script>
        function searchProducts() {
            let input = document.getElementById("search").value.toLowerCase();
            let products = document.querySelectorAll(".product");

            products.forEach(product => {
                let productName = product.querySelector("h3").textContent.toLowerCase();
                product.style.display = productName.includes(input) ? "block" : "none";
            });
        }
    </script>
</body>
</html>
