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
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background-color: #f3f4f6;
            font-weight: bold;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9fafb;
        }

        tbody tr:hover {
            background-color: #e5e7eb;
            transition: background-color 0.3s ease;
        }

        th {
            text-transform: uppercase;
            color: #4b5563;
        }
    </style>
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
                    <a href="{{ route('users.products.cart') }}" class="relative">
                        <i class="fa-solid fa-cart-shopping text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 rounded-full">{{ $cartCount }}</span>
                    </a>
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
    </div>

    <div class="flex items-center justify-center h-screen p-4">
        <div class="w-full max-w-6xl h-full bg-white p-8 rounded-lg shadow-lg overflow-auto"><br><br>
            <h2 class="text-3xl font-bold text-gray-800 border-b pb-4 mb-6 text-center">📦 Chi tiết đơn hàng: #{{ $order->id }}</h2>

            <!-- Thông tin khách hàng -->
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-700 mb-3">👤 Thông tin khách hàng</h3>
                <p class="text-lg text-gray-600"><strong>Họ Tên:</strong> {{ $order->name }}</p>
                <p class="text-lg text-gray-600"><strong>📞 Số điện thoại:</strong> {{ $order->phone }}</p>
                <p class="text-lg text-gray-600"><strong>🏠 Địa chỉ:</strong> {{ $order->address }}</p>
            </div>

            <!-- Trạng thái đơn hàng -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">🚚 Trạng thái đơn hàng</h3>
                <span class="px-4 py-2 rounded-lg text-white text-lg font-medium
                    {{ $order->status == 0 ? 'bg-gray-500' : '' }}
                    {{ $order->status == 1 ? 'bg-blue-500' : '' }}
                    {{ $order->status == 2 ? 'bg-yellow-500' : '' }}
                    {{ $order->status == 3 ? 'bg-green-500' : '' }}
                    {{ $order->status == 4 ? 'bg-red-500' : '' }}">
                    {{ $order->status == 0 ? 'Chưa đặt hàng' : '' }}
                    {{ $order->status == 1 ? 'Đã đặt hàng' : '' }}
                    {{ $order->status == 2 ? 'Đã vận chuyển' : '' }}
                    {{ $order->status == 3 ? 'Đã hoàn thành' : '' }}
                    {{ $order->status == 4 ? 'Đã hủy' : '' }}
                </span>
            </div>

            <!-- Danh sách sản phẩm -->
            <h3 class="text-xl font-semibold text-gray-700 mb-3">🛒 Danh sách sản phẩm</h3>
            <div class="overflow-x-auto">
                @php 
                    $filteredOrderProducts = $order->orderProducts->filter(function($orderProduct) {
                        return $orderProduct->product && $orderProduct->product->sell > 0;
                    });
                    $totalPrice = $filteredOrderProducts->sum(function($orderProduct) {
                        return $orderProduct->quantity * $orderProduct->price;
                    });
                @endphp

                @if ($filteredOrderProducts->isEmpty())
                    <p class="text-center text-gray-500">Không có sản phẩm hợp lệ để đặt hàng.</p>
                @else
                    <table>
                        <thead>
                            <tr class="bg-gray-200 text-gray-700 text-lg">
                                <th class="border border-gray-300 px-4 py-3">STT</th>
                                <th class="border border-gray-300 px-4 py-3">Sản phẩm</th>
                                <th class="border border-gray-300 px-4 py-3">Số lượng</th>
                                <th class="border border-gray-300 px-4 py-3">Giá</th>
                                <th class="border border-gray-300 px-4 py-3">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filteredOrderProducts as $orderProduct)
                                <tr class="text-center text-lg">
                                    <td class="border border-gray-300 px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-300 px-4 py-3">{{ $orderProduct->product->name ?? 'Sản phẩm không tồn tại' }}</td>
                                    <td class="border border-gray-300 px-4 py-3">{{ $orderProduct->quantity }}</td>
                                    <td class="border border-gray-300 px-4 py-3">{{ number_format($orderProduct->price, 0, ',', '.') }} VND</td>
                                    <td class="border border-gray-300 px-4 py-3">{{ number_format($orderProduct->quantity * $orderProduct->price, 0, ',', '.') }} VND</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- Tổng tiền -->
            <p class="text-right text-2xl font-bold text-gray-800 mt-6">💰 Tổng tiền: <span class="text-red-500">{{ number_format($totalPrice, 0, ',', '.') }} VND</span></p>
        </div>
    </div>
</body>

</html>