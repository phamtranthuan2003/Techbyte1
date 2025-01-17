<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>

</head>

<body>
    <header>
        <h1>ShopOnline - Nơi Mua Sắm Trực Tuyến Uy Tín</h1>
        <p>Trải nghiệm mua sắm thời thượng với chất lượng vượt trội</p>
    </header>

    <div class="container">

        <section>
            <h2 class="forme">Về Chúng Tôi</h2>
            <p>
                ShopOnline là nền tảng mua sắm trực tuyến hàng đầu với hàng ngàn sản phẩm đa dạng từ thời trang, công nghệ, gia dụng đến mỹ phẩm.
                Chúng tôi cam kết cung cấp sản phẩm chính hãng và dịch vụ chuyên nghiệp, mang lại sự hài lòng tối đa cho khách hàng.
            </p>
        </section>

      
        <section>
            <h2>Dịch Vụ Của Chúng Tôi</h2>
            <div class="services">
                <div class="card">
                    <a href="../html/listProduct.html" class ="list">
                    <h3>Danh Sách Sản Phẩm</h3>
                    <p>Đảm bảo chính hãng, đa dạng và luôn cập nhật xu hướng mới nhất.</p>
                    </a>
                </div>
                <div class="card">
                    <a href="../html/ship.html" class="ship">
                    <h3>Giao Hàng Nhanh Chóng</h3>
                    <p>Hệ thống giao hàng toàn quốc, giao nhanh trong 24h tại thành phố lớn.</p>
                    </a>
                </div>
                <div class="card">
                <a href="../html/help247.html" class ="help">
                    <h3>Hỗ Trợ 24/7</h3>
                    <p>Đội ngũ hỗ trợ sẵn sàng tư vấn và giải đáp mọi thắc mắc của bạn.</p>
                    </a>
                </div>
            </div>
        </section>

    
        <section>
            <h2>Lợi Ích Khi Mua Sắm</h2>
            <div class="benefits">
                <div class="card">
                    <a href="../html/specialOffers.html" class ="special">
                    <h3>Ưu Đãi Đặc Biệt</h3>
                    <p>Tham gia ngay để nhận những ưu đãi độc quyền chỉ dành cho khách hàng thân thiết.</p>
                    </a>
                </div>
                
            </div>
        </section>
        <section>
            <h2 class="outstanding">Sản Phẩm Nổi Bật</h2>
            <div class="product-list">
                <div class="product">
                    <img src="https://product.hstatic.net/1000026602/product/dsc03170_2dfd2355eeec459b8d7d634b0214d5ca_master.jpg" alt="Product 1">
                    <h3>Áo Thun Basic</h3>
                    <p>Giá: 200,000₫</p>
                    <button onclick="addToCart('Áo Thun Basic', 200000)">Thêm vào giỏ</button>
                </div>
                <div class="product">
                    <img src="https://gman.vn/wp-content/uploads/2024/01/giay-sneaker-nam-cao-cap-g68.jpg" alt="Product 2">
                    <h3>Giày Sneaker</h3>
                    <p>Giá: 1,200,000₫</p>
                    <button onclick="addToCart('Giày Sneaker', 1200000)">Thêm vào giỏ</button>
                </div>
                <div class="product">
                    <img src="https://bizweb.dktcdn.net/100/216/592/products/464514698-122205222950044926-7732864641880078200-n-jpg-nc-cat-110-ccb-1-7-nc-sid-bd9a62-nc-ohc-may3-dvlgwoq7knvgeybvd0-nc-zt-23-nc-ht-scontent-fdad1-3-fna-nc-gid-aluxwza0yfzwi0xquebyajh-oh-00-aydsmfe8dxyc3womiuzwo2vw1ogrl.jpg?v=1730089376650" alt="Product 3">
                    <h3>Quần Jean</h3>
                    <p>Giá: 750,000₫</p>
                    <button onclick="addToCart('Quần Jean', 750000)">Thêm vào giỏ</button>
                </div>
            </div>
        </section>
        <div class="cart-icon-container">
            <i class="cart-icon" onclick="viewCart()">🛒</i>
            <span class="cart-count" id="cart-count">0</span>
        
        
        
        
    </div>

  
    <footer>
        <p>© 2024 ShopOnline. <a href="contact.html">Liên hệ chúng tôi</a> để biết thêm thông tin.</p>
    </footer>
  
</body>

</html>
