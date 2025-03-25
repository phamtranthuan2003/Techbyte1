<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa Hàng Điện Tử - Pros Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <div class="fixed top-0 left-0 z-50 w-full shadow-lg bg-white">
        <div class="container mx-auto">
            <header class="bg-gradient-to-r text-black p-4 w-full flex justify-between items-center">
                <a href="{{ route('users.home') }}">
                    <h1 class="text-3xl font-bold tracking-widest ml-4">ProsStudio Store</h1>
                </a>
                <nav class="space-x-6 hidden md:flex">
                    <a href="{{ route('users.home') }}" class="hover:text-yellow-300 transition">TRANG CHỦ</a>
                    <a href="{{ route('users.introduce') }}" class="hover:text-yellow-300 transition">GIỚI THIỆU</a>
                    <a href="{{ route('users.products.list') }}" class="hover:text-yellow-300 transition">SẢN PHẨM</a>
                    <a href="{{ route('users.promotion') }}" class="hover:text-yellow-300 transition">KHUYẾN MÃI</a>
                    <a href="{{ route('users.contact') }}" class="hover:text-yellow-300 transition">LIÊN HỆ</a>
                </nav>
                <div class="flex items-center space-x-4 mr-4">
                    <div class="relative">
                        <a href="{{ route('users.orders.index', ['id' => $user->id]) }}" class="bg-gray-300 text-black px-4 py-2 rounded-lg font-semibold hover:bg-yellow-400 transition">ĐƠN HÀNG</a>
                    </div>
                    @if(!$user)
                        <a href="{{ route('users.login') }}" class="bg-black text-white px-4 py-2 rounded-lg font-semibold">Đăng Nhập</a>
                    @else
                        <form action="{{ route('users.products.logout') }}" method="post">
                            @csrf
                            <button type="submit" class="underline text-black px-4 py-2 rounded-lg">Đăng Xuất</button>
                        </form>
                    @endif
                </div>
            </header>
        </div>
    </div><br><br><br>
     <!-- end Header -->


     <form action="{{ route("users.products.ordersucess") }}" method="post">
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-2xl p-8 bg-white shadow-xl rounded-2xl">
            <!-- Thông tin khách hàng -->
            <div class="space-y-4">
                <label for="name" class="block text-sm font-semibold text-gray-700">Tên</label>
                <input type="text" id="name" name="name" placeholder="Nhập tên của bạn" required
                    class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:outline-none transition">

                <label for="address" class="block text-sm font-semibold text-gray-700">Địa Chỉ</label>
                <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" required
                    class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:outline-none transition">

                <label for="phone" class="block text-sm font-semibold text-gray-700">Số Điện Thoại</label>
                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" required
                    class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:outline-none transition">
            </div>

            <!-- Danh sách sản phẩm -->
            <div class="bg-gray-100 p-5 rounded-xl shadow-md">
                <h2 class="text-lg font-semibold mb-3 text-gray-700">🛍 Sản Phẩm</h2>
                @php
                    $filteredCartProducts = $cartproducts->filter(fn($cartproduct) => $cartproduct->products && $cartproduct->products->sell != 0);
                @endphp

                @if ($filteredCartProducts->isEmpty())
                    <p class="text-center text-gray-500">Không có sản phẩm hợp lệ để đặt hàng.</p>
                @else
                    @foreach ($filteredCartProducts as $cartproduct)
                        <div class="flex items-center justify-between p-3 bg-white rounded-lg shadow-sm mb-3">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset($cartproduct->products->image) }}" alt="{{ $cartproduct->products->name }}"
                                    class="w-16 h-16 object-cover rounded-lg border border-gray-300">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $cartproduct->products->name }}</p>
                                    <p class="text-sm text-gray-500">Số lượng: {{ $cartproduct->quantity }}</p>
                                </div>
                            </div>
                            <h3 class="text-sm text-red-500 font-bold">{{ number_format($cartproduct->price, 0, ',', '.') }} VND</h3>
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- Phương thức thanh toán -->
            <div>
                <label for="payment_method" class="block text-sm font-semibold text-gray-700">💳 Phương thức thanh toán</label>
                <select name="payment_method" id="payment_method"
                    class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:outline-none transition">
                    <option value="0">💵 Thanh toán khi nhận hàng (COD)</option>
                    <option value="1">🏦 Chuyển khoản ngân hàng</option>
                    <option value="2">📱 Ví MoMo</option>
                    <option value="3">📱 Ví ZaloPay</option>
                    <option value="4">💳 Thẻ tín dụng/Ghi nợ</option>
                </select>
            </div>

            <!-- Tổng đơn hàng -->
            <div class="bg-gray-200 p-6 rounded-xl shadow-lg text-center">
                <h3 class="text-lg font-bold text-gray-700">📦 Tổng Giỏ Hàng</h3>
    <p id="totalPrice" class="text-3xl text-red-500 font-bold">{{ number_format($totalPrice, 0, ',', '.') }} VND</p>
    <input type="hidden" name="price" id="final_price" value="{{ $totalPrice }}">
                <!-- Mã giảm giá -->
                <select name="promotion_id" id="promotion_id"
                    class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:outline-none transition">
                    <option value="">-- Chọn mã khuyến mãi --</option>
                    @foreach ($userPromotions as $userPromotion)
                        @if ($userPromotion->promotion) {{-- Đảm bảo có promotion --}}
                            <option value="{{ $userPromotion->promotion->id }}">
                                {{ $userPromotion->promotion->name }} - Giảm {{ number_format($userPromotion->promotion->discount, 0, ',', '.') }} VND
                            </option>
                        @endif
                    @endforeach
                </select>

                @csrf
                <button class="mt-4 w-full bg-black text-white py-3 rounded-lg font-semibold hover:opacity-75 transition shadow-lg">
                    🚀 Thanh Toán Ngay
                </button>
                </form>
            </div>
        </form>
    </div>
</div>



<!-- footer -->
<footer class="bg-black text-[#999999] p-4 w-full">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center py-3">
            <p>&copy; 2025 Cửa Hàng Điện Tử Pros studio</p>
            <div class="flex space-x-4">
                <a href="https://www.facebook.com/thuan.phamtran.9/" class="hover:text-gray-300"><i class="fab fa-facebook text-xl"></i></a>
                <a href="https://www.instagram.com/phamtran.thuan/" class="hover:text-gray-300"><i class="fab fa-instagram text-xl"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fab fa-twitter text-xl"></i></a>
            </div>
        </div>
    </footer>

    </body>
</div>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const totalPriceElement = document.querySelector("#totalPrice");
        const promotionSelect = document.querySelector("#promotion_id");
        const finalPriceInput = document.querySelector("#final_price"); // New hidden input
        const baseTotal = {{ $totalPrice }}; // Get the base price from Laravel

        function updateTotalPrice() {
            const selectedOption = promotionSelect.options[promotionSelect.selectedIndex];
            const discount = selectedOption.value ? parseInt(selectedOption.text.match(/\d+/g)[0]) : 0;
            const newTotal = baseTotal - discount;

            // Update displayed total
            totalPriceElement.textContent = newTotal.toLocaleString("vi-VN") + " VND";
            // Update the hidden input for final price
            finalPriceInput.value = newTotal; // Store final price in hidden input
        }

        promotionSelect.addEventListener("change", updateTotalPrice);
    });
</script>
