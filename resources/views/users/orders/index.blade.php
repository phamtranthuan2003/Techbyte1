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
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure the body takes up full height */
        }
        .content {
            flex: 1; /* Allow content to grow and push footer down */
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <div class="fixed top-0 left-0 z-50 w-full shadow-lg bg-white">
        <div class="container mx-auto">
            <header class="p-4 w-full flex justify-between items-center">
                <a href="{{ route('users.home') }}">
                    <h1 class="text-3xl font-bold tracking-widest ml-4">ProsStudio Store</h1>
                </a>
                <nav class="space-x-6 hidden md:flex">
                    <a href="{{ route('users.home') }}" class="hover:text-yellow-500 transition">TRANG CHỦ</a>
                    <a href="{{ route('users.introduce') }}" class="hover:text-yellow-500 transition">GIỚI THIỆU</a>
                    <a href="{{ route('users.products.list') }}" class="hover:text-yellow-500 transition">SẢN PHẨM</a>
                    <a href="{{ route('users.promotion') }}" class="hover:text-yellow-500 transition">KHUYẾN MÃI</a>
                    <a href="{{ route('users.contact') }}" class="hover:text-yellow-500 transition">LIÊN HỆ</a>
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
    

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-16 mt-24 content">
        <h3 class="text-3xl text-gray-800 mb-6 font-bold text-center">CHI TIẾT ĐƠN HÀNG</h3>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm">
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Tên</th>
                        <th class="px-6 py-3">Tổng tiền</th>
                        <th class="px-6 py-3">Địa Chỉ</th>
                        <th class="px-6 py-3">Số Điện Thoại</th>
                        <th class="px-6 py-3">Trạng Thái</th>
                        <th class="px-6 py-3">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($orders != null)
                        @foreach ($orders as $order)
                            <tr class="border-t hover:bg-gray-100">
                                <td class="px-6 py-4">{{ $order->id }}</td>
                                <td class="px-6 py-4">{{ $order->name }}</td>
                                <td class="px-6 py-4">{{ $order->price }}</td>
                                <td class="px-6 py-4">{{ $order->address }}</td>
                                <td class="px-6 py-4">{{ $order->phone }}</td>
                                <td class="px-6 py-4">
                                    @if ($order->status == 1)
                                        Đã đặt hàng
                                    @elseif ($order->status == 2)
                                        Đã vận chuyển
                                    @elseif ($order->status == 3)
                                        Đã hoàn thành
                                    @else
                                        Đã hủy
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('users.orders.orderDetail', ['id' => $order->id]) }}">
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Xem</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <p>khoong cos </p>
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-black text-gray-400 p-6 w-full text-center mt-12">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
            <p>&copy; 2025 Cửa Hàng Điện Tử Pros Studio</p>
            <div class="flex space-x-4">
                <a href="https://www.facebook.com/thuan.phamtran.9/" class="hover:text-gray-300"><i class="fab fa-facebook text-xl"></i></a>
                <a href="https://www.instagram.com/phamtran.thuan/" class="hover:text-gray-300"><i class="fab fa-instagram text-xl"></i></a>
                <a href="#" class="hover:text-gray-300"><i class="fab fa-twitter text-xl"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
