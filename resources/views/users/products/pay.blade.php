<x-app-layout>
<div class="container">
    <div class="payform">
        <body>
            <h1 class="text-center mb-4">Thông Tin Thanh Toán</h1>
            
            <form action="{{ route('users.products.ordersucess') }}" method="POST">
                @csrf

                <div class="pay-product">
                    <label for="name" class="form-label">Tên</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên của bạn" required>

                    <label for="address" class="form-label">Địa Chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" required>

                    <label for="phone" class="form-label">Số Điện Thoại</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                </div>

                <div class="mb-3">
                    @foreach ($cartproducts as $cartproduct)
                        <div class="cart">
                            <h3 name="price">Giá: {{ number_format($cartproduct->price, 0, ',', '.') }} VND</h3>
                            <p name="quantity">Số lượng: {{ $cartproduct->quantity }}</p>

                            @if ($cartproduct->products)
                                <div class="cart-product">
                                    <p>{{ $cartproduct->products->name }}</p>
                                    <img src="{{ asset($cartproduct->products->image) }}" >
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="payment_method">
                    <label for="payment_method">Phương thức thanh toán</label>
                    <select name="payment_method" id="payment_method">
                        <option name="cash" value="cash">Thanh toán khi nhận hàng (COD)</option>
                        <option name="bank" value="bank">Chuyển khoản ngân hàng</option>
                        <option name="momo" value="momo">Ví MoMo</option>
                        <option name="zalopay" value="zalopay">Ví ZaloPay</option>
                        <option name="credit" value="credit">Thẻ tín dụng/Ghi nợ</option>
                    </select>
                </div>

                <div class="summary">
                    <h3>Tổng Giỏ Hàng</h3>
                    <p>{{ number_format($totalPrice, 0, ',', '.') }} VND</p>
                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                    <input type="text" id="discount-code" name="discount_code" placeholder="Nhập mã giảm giá" oninput="applyDiscount()">
                    <button class="checkout-button" type="submit">Thanh Toán</button>
                </div>
            </form>
        </body>
    </div>
</div>
</x-app-layout>
