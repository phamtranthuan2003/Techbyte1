<x-app-layout>
    <div class="cartform">
    @csrf  
    
    <body>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <header>
            <h1>Cửa Hàng Điện Tử Cao Cấp</h1>
            <nav>
                <a href="{{ route('users.home') }}">Trang Chủ</a>
                <a href="{{ route('users.introduce') }}">Giới thiệu</a>
                <a href="{{ route('users.products.list') }}">Sản Phẩm</a>
                <a href="{{ route('users.promotion') }}">Khuyến Mãi</a>
                <a href="{{ route('users.contact') }}">Liên Hệ</a>
            </nav>
        </header>

        <div class="container">
            <h2>Giỏ Hàng Của Bạn</h2>

            <div class="cart-items" id="cart-items">
            @if($cartproducts->isEmpty())
                <p>Không có sản phẩm nào trong giỏ hàng.</p>
            @else
                @foreach ($cartproducts as $cartproduct)
                    <div class="cart">
                        <h3>Giá: {{ number_format($cartproduct->price, 0, ',', '.') }} VND</h3>

                        <div class="quantity-control">
                            <form action="{{ route('users.products.updateQuantity', $cartproduct->id) }}" method="post">
                                @csrf
                                <button type="submit" name="action" value="decrease" class="decrease">-</button>
                                <input type="number" id="quantity-{{ $cartproduct->id }}" name="quantity" value="{{ $cartproduct->quantity }}" min="1" readonly>
                                <button type="submit" name="action" value="increase" class="increase">+</button>
                            </form>
                        </div>

                        @if ($cartproduct->products)
                            <div class="cart-product">
                                <p>{{ $cartproduct->products->name }}</p>
                                <img src="{{ asset($cartproduct->products->image) }}" >
                            </div>
                        @endif

                        <form action="{{ route('users.products.removeProduct', $cartproduct->id) }}" method="post">
                            @csrf
                            <button type="submit" class="delete-product">
                                <i class="fa-solid fa-trash"></i> Xóa
                            </button>
                        </form>
                    </div>
                @endforeach
            @endif

            </div>
            <div class="summary">
                <h3>Tổng Giỏ Hàng</h3>
                <p>{{ number_format($totalPrice, 0, ',', '.') }} VND</p>
                
                <input type="text" id="discount-code" placeholder="Nhập mã giảm giá" oninput="applyDiscount()">
                    @csrf
                    <a href="{{ route('users.products.pay') }}">
                    <button class="checkout-button" type="submit">Thanh Toán</button>
                </a>
            </div>
        </div>
    </body>
</div>
</x-app-layout>
