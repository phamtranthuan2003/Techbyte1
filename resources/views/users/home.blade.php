<x-app-layout>
<div class="user">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <body>

    <header>
        <h1>Cửa Hàng Điện Tử Cao Cấp</h1>
        <nav>
                <a href="{{ route('users.home') }}">Trang Chủ</a>
                <a href="{{ route('users.introduce') }}">Giới thiệu</a>
                <a href="{{ route('users.products.list') }}">Sản Phẩm</a>
                <a href="{{route('users.promotion')}}">Khuyến Mãi</a>
                <a href="{{route('users.contact')}}">Liên Hệ</a>
                <a href="{{ route('users.products.cart') }}" class="cart-link">
                    <button class="cart-button" type="button" onclick="showCart()">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="cart-count" id="cart-count">{{$cartCount}}</span>
                    </button>
                </a>
            </nav>
            @if(!$user)
                <a href="{{ route('users.login') }}" class="login-button">Đăng Nhập</a>
                @else
                <form action="{{ route('users.products.logout') }}" method="post">
                @csrf
                <button type="submit" name="logout" class="logout-button">Đăng Xuất</button>
                </form>
            @endif
        
    </header>



        <div class="banner">
            <h2>Khám Phá Bộ Sưu Tập Thiết Bị Điện Tử Hiện Đại</h2>
            <div class="container">
            <div class="categories">
            <a href="{{route('users.products.list') }}" class="category">Tất cả</a>
            @foreach ($categories as $category)
            <a href="{{ route('users.category', ['id' => $category->id]) }}" class="category" value="{{ $category->id }}">{{ $category->name }}</a>

            @endforeach
        </div>
                <div class="products">
                @foreach ($products as $product)
                <div class="product" data-category="{{ $product->category }}">
                    <img src="{{ $product->image }}">
                    <h3>{{ $product->name }}</h3>
                    <p>Giá: {{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                
                </div>
                @endforeach
                   
                </div>
                </div>
            </div>
        </div>



        </body>
</div>
</x-app-layout>