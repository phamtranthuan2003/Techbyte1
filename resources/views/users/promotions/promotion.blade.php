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

    <!-- Hero Section -->
    <section class="relative h-[500px] bg-cover bg-center flex items-center justify-center text-center text-white" style="background-image: url('https://source.unsplash.com/1600x900/?technology,store');">
        <div class="bg-black bg-opacity-50 p-8 rounded-lg">
            <h2 class="text-4xl font-bold">Chào mừng đến với ProsStudio STORE</h2>
            <p class="text-lg mt-2">Nơi cung cấp những sản phẩm công nghệ chất lượng cao với ưu đãi hấp dẫn!</p>
            <a href="{{ route('users.products.list') }}" class="mt-4 inline-block bg-black text-white px-6 py-3 rounded-lg font-semibold hover:bg-yellow-600 transition">Khám Phá Ngay</a>
        </div>
    </section>

    <!-- Ưu đãi đặc biệt -->
    <section class="container mx-auto px-6 py-16 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Ưu Đãi Đặc Biệt</h2>
        <p class="text-gray-600 mt-2">Nhận ngay những khuyến mãi HOT nhất tại ProsStudio STORE</p>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-white shadow-lg rounded-lg p-6 text-center transform transition hover:scale-105">
                <i class="fa-solid fa-tags text-red-500 text-4xl"></i>
                <h3 class="text-xl font-semibold mt-4">Giảm Giá 50%</h3>
                <p class="text-gray-600 mt-2">Giảm ngay 50% cho tất cả sản phẩm trong cửa hàng!</p>
                <button class="mt-4 bg-black text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Nhận Ngay</button>
            </div>

            <!-- Card 2 -->
            <div class="bg-white shadow-lg rounded-lg p-6 text-center transform transition hover:scale-105">
                <i class="fa-solid fa-truck text-green-500 text-4xl"></i>
                <h3 class="text-xl font-semibold mt-4">Miễn Phí Vận Chuyển</h3>
                <p class="text-gray-600 mt-2">Freeship với đơn hàng từ 500,000 VNĐ!</p>
                <button class="mt-4 bg-black text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Nhận Ngay</button>
            </div>

            <!-- Card 3 -->
            <div class="bg-white shadow-lg rounded-lg p-6 text-center transform transition hover:scale-105">
                <i class="fa-solid fa-gift text-yellow-500 text-4xl"></i>
                <h3 class="text-xl font-semibold mt-4">Quà Tặng Hấp Dẫn</h3>
                <p class="text-gray-600 mt-2">Mua hàng từ 1,000,000 VNĐ tặng ngay voucher giảm 100K!</p>
                <button class="mt-4 bg-black text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Nhận Ngay</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-[#999999] p-4 w-full mt-[40px]">
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