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
    </div><br><br>
    
    <!-- Contact Section -->
    <div class="max-w-4xl mx-auto bg-white p-8 mt-10 shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">Thông Tin Liên Hệ</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <p><i class="fa-solid fa-phone text-red-600"></i> <strong>Số điện thoại:</strong> 0876 386 369</p>
                <p><i class="fa-solid fa-envelope text-blue-600"></i> <strong>Email:</strong> phamtranthuan2003@gmail.com</p>
                <p><i class="fa-solid fa-map-marker-alt text-green-600"></i> <strong>Địa chỉ:</strong> Đại Học Tài Nguyên Và Môi Trường Hà Nội</p>
            </div>
            <div>
                <iframe class="w-full h-40 rounded-md" src="https://www.google.com/maps/embed?..." allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        
        <h2 class="text-2xl font-semibold text-center mt-8">Gửi Yêu Cầu</h2>
        <form class="mt-4 space-y-4">
            <input type="text" placeholder="Tên của bạn" class="w-full p-3 border rounded-md" required>
            <input type="text" placeholder="Số điện thoại của bạn" class="w-full p-3 border rounded-md" required>
            <input type="email" placeholder="Email của bạn" class="w-full p-3 border rounded-md" required>
            <textarea rows="4" placeholder="Nội dung yêu cầu của bạn" class="w-full p-3 border rounded-md" required></textarea>
            <button type="submit" class="w-full bg-black text-white p-3 rounded-md">Gửi Yêu Cầu</button>
        </form>
    </div>
    <footer class="bg-black text-[#999999] p-4 w-full mt-[149px]">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center py-3">
            <p>&copy; 2025 Cửa Hàng Điện Tử Pros studio</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-gray-300"><i class="fab fa-facebook text-xl"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fab fa-instagram text-xl"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fab fa-twitter text-xl"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>