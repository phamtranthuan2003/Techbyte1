<x-app-layout>
    <form class="allproducts">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Cửa Hàng Điện Tử Cao Cấp - Nơi cung cấp sản phẩm điện tử chất lượng cao.">
            <meta name="keywords" content="điện tử, sản phẩm công nghệ, cửa hàng trực tuyến">
            <title>Tất Cả Sản Phẩm - Cửa Hàng Điện Tử Cao Cấp</title>
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
           
        
        </head>
        <body>

            <header>
                <h1>Cửa Hàng Điện Tử Cao Cấp</h1>
                <nav>
                    <a href="{{ route('users.home') }}">Trang Chủ</a>
                    <a href="{{ route('users.introduce') }}">Giới thiệu</a>
                    <a href="{{ route('users.products.list') }}">Sản Phẩm</a>
                    <a href="#">Khuyến Mãi</a>
                    <a href="#">Liên Hệ</a>
                    <a href="{{ route('users.products.pay') }}" class="cart-link">
                        <button class="cart-button" type="button" onclick="showCart()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M7 4H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2l1 12h12l1-12h2a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H7zm0 2h12v2H7V6zm0 4h12v2H7v-2zm0 4h12v2H7v-2z"></path>
                            </svg>
                            <span class="cart-count" id="cart-count">0</span>
                        </button>
                    </a>
                </nav>
                <a href="{{ route('users.login') }}" class="login-button">Đăng Nhập</a>
            </header>

            <div class="container">
                <h2>Tất Cả Sản Phẩm</h2>
                
                <div class="category-select">
                    <label for="category">Chọn danh mục:</label>
                    <select id="category" onchange="filterProducts()">
                        <option value="all">Tất Cả</option>
                        <option value="electronics">Điện Tử</option>
                        <option value="accessories">Phụ Kiện</option>
                        <option value="gifts">Quà Tặng</option>
                    </select>
                </div>

                <div class="search-bar">
                    <input type="text" id="search" placeholder="Tìm kiếm sản phẩm..." oninput="searchProducts()">
                </div>

                <div class="products" id="product-list">
                    <div class="product" data-category="electronics">
                        <img src="your-product-image-url1.jpg" alt="Sản Phẩm Điện Tử 1">
                        <h3>Sản Phẩm Điện Tử 1</h3>
                        <p>Giá: 500.000 VNĐ</p>
                        <button onclick="addToCart()">Thêm vào Giỏ</button>
                    </div>
                    <div class="product" data-category="electronics">
                        <img src="your-product-image-url2.jpg" alt="Sản Phẩm Điện Tử 2">
                        <h3>Sản Phẩm Điện Tử 2</h3>
                        <p>Giá: 600.000 VNĐ</p>
                        <button onclick="addToCart()">Thêm vào Giỏ</button>
                    </div>
                    <div class="product" data-category="electronics">
                        <img src="your-product-image-url3.jpg" alt="Sản Phẩm Điện Tử 3">
                        <h3>Sản Phẩm Điện Tử 3</h3>
                        <p>Giá: 550.000 VNĐ</p>
                        <button onclick="addToCart()">Thêm vào Giỏ</button>
                    </div>
                    <div class="product" data-category="electronics">
                        <img src="your-product-image-url4.jpg" alt="Sản Phẩm Điện Tử 4">
                        <h3>Sản Phẩm Điện Tử 4</h3>
                        <p>Giá: 700.000 VNĐ</p>
                        <button onclick="addToCart()">Thêm vào Giỏ</button>
                    </div>
                    <div class="product" data-category="electronics">
                        <img src="your-product-image-url4.jpg" alt="Sản Phẩm Điện Tử 4">
                        <h3>Sản Phẩm Điện Tử 4</h3>
                        <p>Giá: 700.000 VNĐ</p>
                        <button onclick="addToCart()">Thêm vào Giỏ</button>
                    </div>
                    <!-- Thêm nhiều sản phẩm khác tại đây -->
                </div>
            </div>

          
        </body>
    </form>
</x-app-layout>