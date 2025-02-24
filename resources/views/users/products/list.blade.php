<x-app-layout>
@csrf
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
            <div>
                <form action="{{ route('users.products.logout') }}" method="post">
                @csrf
                <button type="submit" name="logout" class="logout-button">Đăng Xuất</button>
                </form>
            </div>
            @endif

        </header>
            
        <div class="container">
            <h2>Tất Cả Sản Phẩm</h2>
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
                @foreach ($products as $product)
                
                <form class="allproducts" action="{{ route('users.products.addtocart') }}" method="post">
                @csrf    
                    <div class="product" data-category="{{ $product->category }}">
                        <img src="{{ $product->image }}">
                        <h3>{{ $product->name }}</h3>
                        <p>Giá: {{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                        <p>Còn lại: {{ $product->sell }}</p>
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <button type="submit">Thêm vào Giỏ</button>
                    </div>
                </form>
                @endforeach
        </div>
    </body>
<script>
    function searchProducts() {
        let input = document.getElementById("search").value.toLowerCase();
        let products = document.querySelectorAll(".product");

        products.forEach(product => {
            let productName = product.querySelector("h3").textContent.toLowerCase();
            if (productName.includes(input)) {
                product.style.display = "block";
            } else {
                product.style.display = "none";
            }
        });
    }
</script>

    
    
</x-app-layout>