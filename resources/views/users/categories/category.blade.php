<x-app-layout>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    </head>

    <body>
        <header>
            <h1>Cửa Hàng Điện Tử Cao Cấp</h1>
            <nav>
                <a href="{{ route('users.home') }}">Trang Chủ</a>
                <a href="{{ route('users.introduce') }}">Giới thiệu</a>
                <a href="{{ route('users.products.list') }}">Sản Phẩm</a>
                <a href="{{ route('users.promotion') }}">Khuyến Mãi</a>
                <a href="{{ route('users.contact') }}">Liên Hệ</a>
                <a href="{{ route('users.products.cart') }}" class="cart-link">
                    <button class="cart-button" type="button" onclick="showCart()">
                    <i class="fa-solid fa-cart-shopping"></i>
                        <span class="cart-count" id="cart-count">0</span>
                    </button>
                </a>
            </nav>
            <a href="{{ route('users.login') }}" class="login-button" aria-label="Đăng Nhập">Đăng Nhập</a>
        </header>

        <div class="container">
            <h2>{{ $category->name }}</h2>
            <div class="search-bar">
                    <input type="text" id="search" placeholder="Tìm kiếm sản phẩm..." oninput="searchProducts()">
            </div>
            <div class="categories">
            <a href="{{route('users.products.list') }}" class="category">Tất cả</a>
            @foreach ($categories as $category)
            <a href="{{ route('users.category', ['id' => $category->id]) }}" class="category" value="{{ $category->id }}">{{ $category->name }}</a>

            @endforeach
        </div>
               
            <div class="products" id="product-list">
                @if($products->isEmpty())
                    <p>Không có sản phẩm nào thuộc danh mục này.</p>
                @else
                    @foreach ($products as $item)
                        <div class="product">
                            <h3>{{ $item->name }}</h3>
                            <img src="{{ $item->image }}">
                            <p>Giá: {{ number_format($item->price, 0, ',', '.') }} VND</p>
                            <button onclick="addToCart()">Thêm vào Giỏ</button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </body>
</x-app-layout>
