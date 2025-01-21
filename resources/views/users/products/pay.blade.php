<x-app-layout>
<form class="pay">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cửa Hàng Gấu Bông Sang Trọng - Nơi cung cấp gấu bông và phụ kiện chất lượng cao.">
    <meta name="keywords" content="gấu bông, quà tặng, phụ kiện, cửa hàng trực tuyến">
    <title>Giỏ Hàng - Cửa Hàng Gấu Bông</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>

<header>
    <h1>Cửa Hàng Gấu Bông Sang Trọng</h1>
    <nav>
        <a href="{{ route('users.home') }}">Trang Chủ</a>
        <a href="{{ route('users.introduce') }}">Giới thiệu</a>
        <a href="{{ route('users.products.list') }}">Sản Phẩm</a>
        <a href="#">Khuyến Mãi</a>
        <a href="#">Liên Hệ</a>
    </nav>
</header>

<div class="container">
    <h2>Giỏ Hàng Của Bạn</h2>

    <div class="cart-items" id="cart-items">
        <!-- Sản phẩm trong giỏ hàng sẽ được thêm vào đây -->
    </div>

    <div class="summary">
        <h3>Tổng Giỏ Hàng</h3>
        <p id="total-price">Tổng: 0 VNĐ</p>

        <input type="text" id="discount-code" placeholder="Nhập mã giảm giá" oninput="applyDiscount()">
        
        <button class="checkout-button" onclick="checkout()">Thanh Toán</button>
    </div>
</div>

<footer>
  
</footer>
</form>
<script>
    let cart = [
        { id: 1, name: 'Gấu Bông Đáng Yêu', price: 500000, quantity: 1, img: 'your-product-image-url1.jpg' },
        { id: 2, name: 'Gấu Bông Dễ Thương', price: 600000, quantity: 1, img: 'your-product-image-url2.jpg' },
        // Thêm sản phẩm vào giỏ hàng tại đây
    ];

    let discount = 0; // Mã giảm giá mặc định

    function renderCart() {
        const cartItemsContainer = document.getElementById('cart-items');
        cartItemsContainer.innerHTML = ''; // Clear existing cart

        cart.forEach(item => {
            const cartItemDiv = document.createElement('div');
            cartItemDiv.className = 'cart-item';

            cartItemDiv.innerHTML = `
                <img src="${item.img}" alt="${item.name}">
                <div class="cart-item-info">
                    <h3>${item.name}</h3>
                    <p>Giá: ${item.price.toLocaleString()} VNĐ</p>
                    <div class="quantity-control">
                        <button onclick="updateQuantity(${item.id}, -1)">-</button>
                        <input type="text" value="${item.quantity}" readonly>
                        <button onclick="updateQuantity(${item.id}, 1)">+</button>
                    </div>
                </div>
            `;
            cartItemsContainer.appendChild(cartItemDiv);
        });

        updateTotalPrice();
    }

    function updateQuantity(id, change) {
        const item = cart.find(item => item.id === id);
        if (item) {
            item.quantity += change;
            if (item.quantity < 1) item.quantity = 1;
            renderCart();
        }
    }

    function updateTotalPrice() {
        const totalPrice = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
        const discountedPrice = totalPrice * (1 - discount);
        document.getElementById('total-price').textContent = `Tổng: ${discountedPrice.toLocaleString()} VNĐ`;
    }

    function applyDiscount() {
        const code = document.getElementById('discount-code').value;
        if (code === 'GIAOHANG10') {
            discount = 0.1; // Giảm giá 10%
        } else {
            discount = 0;
        }
        updateTotalPrice();
    }

    function checkout() {
        if (cart.length === 0) {
            alert('Giỏ hàng của bạn đang trống!');
        } else {
            alert('Chuyển đến trang thanh toán!');
            // Chuyển hướng đến trang thanh toán hoặc xử lý thanh toán
        }
    }

    // Render giỏ hàng khi trang được tải
    window.onload = renderCart;
</script>
</x-app-layout>