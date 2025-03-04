<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa Hàng Điện Tử - Pros Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="fixed top-0 left-0 z-50 w-full shadow-lg bg-white">
        <div class="container mx-auto">
            <div class="bg-gradient-to-r text-black p-4 w-full flex justify-between items-center">
                <a href="{{ route('users.home') }}">
                    <h1 class="text-3xl font-bold tracking-widest ml-4">ProsStudio Store</h1>
                </a>
                <nav class="space-x-6 hidden md:flex">
                    <a href="{{ route('users.home') }}" class="hover:text-yellow-300 transition">TRANG CHỦ</a>
                    <a href="{{ route('users.introduce') }}" class="hover:text-yellow-300 transition">GIỚI THIỆU</a>
                    <a href="{{ route('users.products.list') }}" class="hover:text-yellow-300 transition">SẢN PHẨM</a>
                    <a href="{{ route('users.promotion') }}" class="hover:text-yellow-300 transition">KHUYẾN MÃI</a>
                    <a href="{{ route('users.contact') }}" class="hover:text-yellow-300 transition">LIÊN HỆ</a>
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
                            <button type="submit" class="underline text-black px-4 py-2 rounded-lg">Đăng Xuất</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-24 mt-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-8 rounded-lg shadow-lg">
            <!-- Product Image -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($products->images as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset($image->image_path) }}" class="w-full h-96 object-cover rounded-lg shadow-md">
                        </div>
                    @endforeach
                </div>
                <!-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div> -->
            </div>

            <!-- Product Details -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $products->name }}</h2>
                <p class="text-red-500 font-bold text-2xl mt-2">{{ number_format($products->price, 0, ',', '.') }} VNĐ</p>
                <p class="text-gray-600 mt-2">Còn lại: {{ $products->sell }}</p>
                <p class="text-gray-600 mt-2">Sản xuất: {{ $products->provider->name }}</p>
                <p class="text-gray-600 mt-2">Xuất xứ: {{ $products->provider->address }}</p>

                <form action="{{ route('users.products.addtocart') }}" method="post" class="mt-6">
                    @csrf
                    <button class="w-full bg-black text-white py-3 rounded-lg font-semibold hover:opacity-80 transition shadow-lg">Thêm vào Giỏ</button>
                </form>
            </div>
        </div>

        <h3 class="text-2xl text-gray-800 mb-6 title relative pl-[20px] mt-12">SẢN PHẨM BÁN CHẠY NHẤT</h3>
        <div class="grid grid-cols-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($bestProduct as $product)
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

        <div class="mt-12 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Đánh giá sản phẩm</h3>
            <!-- Danh sách đánh giá -->
            <div class="space-y-4">
                @foreach($products->reviews as $review)
                    <div class="border-b pb-4">
                        <p class="text-gray-800 font-semibold">
                            {{ $review->user->name }}
                            <span class="text-gray-500 text-sm">{{ $review->created_at->format('d/m/Y') }}</span>
                        </p>
                        <div class="text-yellow-500 rating-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-star {{ $i <= $review->rating ? 'fas' : 'far' }}"></i>
                            @endfor
                        </div>
                        <p class="text-gray-700 mt-2">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Form đánh giá -->
            <!-- Form đánh giá -->
@if(auth()->check())
    <form action="{{ route('users.products.reviewProduct', $products->id) }}" method="post" class="mt-6">
        @csrf
        <label class="block text-gray-700 font-semibold">Đánh giá của bạn:</label>
        <div class="flex space-x-2 mt-2 rating-stars">
            @for ($i = 1; $i <= 5; $i++)
                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden">
                <label for="star{{ $i }}" class="cursor-pointer">
                    <i class="fas fa-star"></i>
                </label>
            @endfor
        </div>
        <textarea name="comment" required rows="3" placeholder="Viết đánh giá của bạn..." class="w-full mt-3 px-4 py-2 border border-gray-300 rounded-lg"></textarea>
        <button type="submit" class="mt-4 w-full bg-black text-white py-3 rounded-lg font-semibold hover:opacity-80 transition shadow-lg">Gửi đánh giá</button>
    </form>
@endif
        </div>
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

    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 1,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
</body>
</html>
<style>
 .rating-stars input[type="radio"] {
    display: none; /* Ẩn các radio button */
}

.rating-stars label {
    cursor: pointer;
    font-size: 2rem;
    color: gold; /* Màu xám cho các sao chưa được chọn */
}

/* Màu vàng cho sao đã chọn và các sao bên phải sẽ sáng */
.rating-stars input[type="radio"]:checked + label,
.rating-stars input[type="radio"]:checked ~ label {
    color: gray; /* Sao đã chọn và các sao bên phải sẽ sáng */
}

/* Hiệu ứng hover cho các sao */
.rating-stars label:hover,
.rating-stars label:hover ~ label {
    color: gray; /* Sáng lên khi hover */
}

    </style>