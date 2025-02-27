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
    <div class="container mx-auto mt-[100px] px-6">
    <!-- Slider chính -->
<div class="w-full  mx-auto">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('image/bannerxx1.png') }}" alt="Slide 1" class="w-full h-64 object-cover rounded-lg">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('image/bannerxx2.png') }}" alt="Slide 2" class="w-full h-64 object-cover rounded-lg">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('image/banner2.png') }}" alt="Slide 3" class="w-full h-64 object-cover rounded-lg">
            </div>
        </div>
    </div>
</div>

    </div>
    <!-- Danh sách sản phẩm -->
    <div class="container mx-auto px-6 py-12">
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
        </div>

        <div class=" py-12">
        <img src="{{ asset('image/banner1.png') }}">
        </div>
        <h3 class="text-2xl text-gray-800 mb-6 title relative pl-[20px]">SẢN PHẨM MỚI</h3>
        <div class="grid grid-cols-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($products as $product)
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition text-center">
                <img src="{{ $product->image }}" class="w-full h-64 object-cover rounded-lg hover:scale-105 transition">
                <h4 class="text-2xl font-bold mt-3 text-gray-900">{{ $product->name }}</h4>
                <p class="text-red-500 font-bold mt-2 text-xl">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                <p class="text-gray-600">Còn lại: {{ $product->sell }}</p>
                <form action="{{ route('users.products.addtocart') }}" method="post">
                    @csrf
                    <button type="submit" class="mt-4 w-full bg-black text-white py-3 rounded-lg font-semibold hover:opacity-75 transition shadow-lg">Thêm vào Giỏ</button>
                </form>
                    
        </div>
        @endforeach    
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-black text-[#999999] p-4 w-full">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center py-3">
            <p>&copy; 2025 Cửa Hàng Điện Tử Pros studio</p>
            <div class="flex space-x-4">
                <a href="https://www.facebook.com/thuan.phamtran.9/" target="_blank" class="hover:text-gray-300"><i class="fab fa-facebook text-xl"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fab fa-instagram text-xl"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fab fa-twitter text-xl"></i></a>
            </div>
        </div>
    </footer>

</body>

</html>
<style>
.title::before{
    position: absolute;
    content: '';
    border-width: 0 10px 0 0;
    left: 0;
    right: auto;
    top: 3px;
    bottom: 3px;
    border-color: red;
}
.swiper-slide img {
    width: 100%; /* Chiều rộng 100% của slide */
    height: 100%; /* Chiều cao 100% của slide */
    object-fit: cover; /* Cắt ảnh để vừa khung mà không méo */
    border-radius: 8px; /* Bo góc nhẹ */
}

/* Đảm bảo kích thước khung hình */
.swiper-slide {
    width: 100%;
    height: 300px; /* Hoặc kích thước mong muốn */
    display: flex;
    justify-content: center;
    align-items: center;
}

</style>
<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true, // Lặp vô tận
        autoplay: {
            delay: 3000, // Tự động chuyển sau 3 giây
            disableOnInteraction: false, // Tiếp tục chạy sau khi người dùng tương tác
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
