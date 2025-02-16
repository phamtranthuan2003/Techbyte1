<x-app-layout>
<div class="container">
<div class="payform">
    <body>
    
        <h2 class="text-center mb-4">Thông Tin Thanh Toán</h2>

       
            @csrf
            <!-- Tên -->
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
                        <h3>Giá: {{ number_format($cartproduct->price, 0, ',', '.') }} VND</h3>
                        <p>Số lượng: {{ $cartproduct->quantity }}</p>
                      

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
                <select name="payment_method">
                    <option value="cash">Thanh toán khi nhận hàng (COD)</option>
                    <option value="bank">Chuyển khoản ngân hàng</option>
                    <option value="momo">Ví MoMo</option>
                    <option value="zalopay">Ví ZaloPay</option>
                    <option value="credit">Thẻ tín dụng/Ghi nợ</option>
                </select>
            </div>
       
            <div class="summary">
                <h3>Tổng Giỏ Hàng</h3>
                <p>{{ number_format($totalPrice, 0, ',', '.') }} VND</p>
                <input type="text" id="discount-code" placeholder="Nhập mã giảm giá" oninput="applyDiscount()">
                @csrf
                <button class="checkout-button" type="submit">Thanh Toán</button>
            </div>
         
    </body>
    </div>
</div>
</x-app-layout>