@extends('layouts.user')

@section('content')
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
                    @if($product->sell == 0)
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

    <div class=" py-12">
    <img src="{{ asset('image/km.png') }}">
    </div>
    <h3 class="text-2xl text-gray-800 mb-6 title relative pl-[20px]">SẢN PHẨM MỚI</h3>
    <div class="grid grid-cols-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
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
                @if($product->sell == 0)
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
</div>
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
@endsection
