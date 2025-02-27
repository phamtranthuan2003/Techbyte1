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
     <!-- end Header -->

    <div class="container mx-auto mt-24 p-6 bg-white shadow-md rounded-lg w-full max-w-3xl">
    <h2 class="text-2xl font-bold text-center mb-6">🛒 Giỏ Hàng Của Bạn</h2>

    <div class="cart-items space-y-4">
        @if($cartproducts->isEmpty())
            <p class="text-gray-500 text-center">Không có sản phẩm nào trong giỏ hàng.</p>
        @else
            @foreach ($cartproducts as $cartproduct)
                <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg shadow-md">
                    <div class="flex items-center gap-4">
                        @if ($cartproduct->products)
                            <img src="{{ asset($cartproduct->products->image) }}" alt="{{ $cartproduct->products->name }}"
                                class="w-16 h-16 object-cover rounded-md">
                            <p class="text-lg font-semibold">{{ $cartproduct->products->name }}</p>
                        @endif
                    </div>

                    <h3 class="text-lg text-red-500 font-bold">{{ number_format($cartproduct->price, 0, ',', '.') }} VND</h3>

                    <form action="{{ route('users.products.updateQuantity', $cartproduct->id) }}" method="post" class="flex items-center space-x-2">
                        @csrf
                        <button type="submit" name="action" value="decrease"
                            class="w-8 h-8 bg-gray-300 hover:bg-gray-400 text-black font-bold rounded">
                            −
                        </button>
                        <input type="number" name="quantity" value="{{ $cartproduct->quantity }}" min="1" readonly
                            class="w-10 text-center border border-gray-300 rounded-md">
                        <button type="submit" name="action" value="increase"
                            class="w-8 h-8 bg-gray-300 hover:bg-gray-400 text-black font-bold rounded">
                            +
                        </button>
                    </form>

                    <form action="{{ route('users.products.removeProduct', $cartproduct->id) }}" method="post">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 text-lg">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        @endif
    </div>

    <div class="summary mt-6 p-4 bg-gray-200 rounded-lg text-center">
        <h3 class="text-xl font-bold">Tổng Giỏ Hàng</h3>
        <p class="text-2xl text-red-500 font-bold">{{ number_format($totalPrice, 0, ',', '.') }} VND</p>

        <form action="{{route('users.products.order') }}" method="post" class="mt-4">
            @csrf
            <button class="mt-4 w-full bg-black text-white py-3 rounded-lg font-semibold hover:opacity-75 transition shadow-lg">
                Thanh Toán
            </button>
        </form>
    </div>
</div>




<!-- footer -->
<footer class="bg-black text-[#999999] p-4 w-full mt-[497px]">
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
</div>
<html>
