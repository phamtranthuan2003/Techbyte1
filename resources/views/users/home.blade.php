<x-app-layout>
    <form class="user">
        <!DOCTYPE html>
        <html lang="vi">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Cửa Hàng Điện Tử</title>
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
        </head>
        <body>

    <header>
        <h1>Cửa Hàng Điện Tử Cao Cấp</h1>
        <nav>
            <a href="{{ route('users.home') }}">Trang Chủ</a>
            <a href="{{ route('users.introduce') }}">Giới thiệu</a>
            <a href="{{route('users.products.list')}}">Sản Phẩm</a>
            <a href="#">Khuyến Mãi</a>
            <a href="#">Liên Hệ</a>
        </nav>
    <!-- Login button -->
            <a href="{{ route('users.login') }}" class="login-button">Đăng Nhập</a>
</header>


        <div class="banner">
            <h2>Khám Phá Bộ Sưu Tập Thiết Bị Điện Tử Hiện Đại</h2>
            <div class="container">
                <div class="categories">
                    <div class="category">Điện Thoại</div>
                    <div class="category">Laptop</div>
                    <div class="category">Phụ Kiện</div>
                </div>
                <h2 style="margin: 20px 0;">Sản Phẩm Bán Chạy</h2>
                <div class="products">
                    <div class="product">
                        <img src="your-electronics-image1.jpg" alt="Điện Thoại 1">
                        <h3>Điện Thoại Thông Minh</h3>
                        <p>Giá: 15.000.000 VNĐ</p>
          
                        <button>Thêm vào Giỏ</button>
                    </div>
                    <div class="product">
                        <img src="your-electronics-image2.jpg" alt="Laptop 1">
                        <h3>Laptop Cao Cấp</h3>
                        <p>Giá: 25.000.000 VNĐ</p>
                        
                        <button>Thêm vào Giỏ</button>
                    </div>
                    <div class="product">
                        <img src="your-electronics-image3.jpg" alt="Tai Nghe 1">
                        <h3>Tai Nghe Không Dây</h3>
                        <p>Giá: 3.000.000 VNĐ</p>
                   
                        <button>Thêm vào Giỏ</button>
                    </div>
                    <div class="product">
                        <img src="your-electronics-image4.jpg" alt="Smartwatch">
                        <h3>Đồng Hồ Thông Minh</h3>
                        <p>Giá: 5.000.000 VNĐ</p>
                  
                        <button>Thêm vào Giỏ</button>
                    </div>
                    <div class="product">
                        <img src="your-electronics-image5.jpg" alt="Bàn phím cơ">
                        <h3>Bàn Phím Cơ</h3>
                        <p>Giá: 2.500.000 VNĐ</p>
                   
                        <button>Thêm vào Giỏ</button>
                    </div>
                </div>
            </div>
        </div>



        </body>
        </html>
    </form>
</x-app-layout>