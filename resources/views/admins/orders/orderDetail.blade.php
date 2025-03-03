<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen p-4">
    <div class="w-full max-w-6xl h-full bg-white p-8 rounded-lg shadow-lg overflow-auto">
        <h2 class="text-3xl font-bold text-gray-800 border-b pb-4 mb-6 text-center">📦 Chi tiết đơn hàng: #{{ $order->id }}</h2>

        <!-- Thông tin khách hàng -->
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
            <table class="w-full border-collapse border border-gray-300 text-gray-700">
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
                    @foreach ($order->orderProducts as $orderProduct)
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
        </div>

        <!-- Tổng tiền -->
        <p class="text-right text-2xl font-bold text-gray-800 mt-6">💰 Tổng tiền: <span class="text-red-500">{{ number_format($order->price, 0, ',', '.') }} VND</span></p>

        <!-- Form cập nhật trạng thái -->
        <form action="{{ route('admins.orders.changestatus', $order->id) }}" method="POST" class="mt-6">
            @csrf
            <div class="flex flex-col md:flex-row items-center gap-4">
                <label for="status" class="text-gray-700 font-semibold">🔄 Cập nhật trạng thái:</label>
                <select name="status" id="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300 text-lg">
                    <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Chưa đặt hàng</option>
                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Đã đặt hàng</option>
                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đã vận chuyển</option>
                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Đơn hàng thành công</option>
                    <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Đã hủy</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white text-lg px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    ✅ Cập nhật
                </button>
            </div>
        </form>
    </div>
</body>
</html>
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

    th, td {
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

