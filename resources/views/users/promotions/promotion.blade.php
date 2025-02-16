<x-app-layout>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="promotion">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ưu Đãi Đặc Biệt Mua Sắm</title>
    <link rel="stylesheet" href="../css/specialOffers.css">
</head>
<body>
     <header>
        <h1>Chào Mừng Bạn Đến Với Ưu Đãi Đặc Biệt</h1>
        <nav>
            <a href="{{ route('users.home') }}">Trang Chủ</a>
            <a href="{{ route('users.introduce') }}">Giới thiệu</a>
            <a href="{{route('users.products.list')}}">Sản Phẩm</a>
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


    <section class="promotion-section">
        <div class="promotion-container">
            <h2>Ưu Đãi Đặc Biệt Cho Mua Sắm</h2>
            <p>Đừng bỏ lỡ cơ hội tuyệt vời này! Chúng tôi đang có những ưu đãi cực kỳ hấp dẫn cho các sản phẩm của mình.</p>
            <div class="promotion-details">
                <div class="offer-card">
                    <h3>Giảm Giá 50%</h3>
                    <p>Giảm ngay 50% cho tất cả các sản phẩm trong cửa hàng. Hãy nhanh tay chọn sản phẩm yêu thích của bạn.</p>
                    <button onclick="claimOffer()">Nhận Ưu Đãi</button>
                </div>
                <div class="offer-card">
                    <h3>Miễn Phí Vận Chuyển</h3>
                    <p>Miễn phí vận chuyển cho đơn hàng từ 500,000 VNĐ trở lên. Tiết kiệm chi phí và mua sắm thoải mái.</p>
                    <button onclick="claimOffer()">Nhận Ưu Đãi</button>
                </div>
            </div>
        </div>
    </section>

    <footer>
    
    </footer>

</>
</x-app-layout>