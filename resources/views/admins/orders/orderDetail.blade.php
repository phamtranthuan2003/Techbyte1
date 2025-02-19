<x-app-layout>
    <div class="container">
        <div class="orderDetail">
            <h2 class="order-title">Chi tiết đơn hàng: #{{ $order->id }}</h2>


            <div class="order-info">
                <p><strong>Khách hàng:</strong> {{ $order->name }}</p>
                <p><strong>SDT:</strong> {{ $order->phone }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
            </div>
            

            
            
            <div class="status 
                @if ($order->status == 0) chua-dat 
                @elseif ($order->status == 1) da-dat 
                @elseif ($order->status == 2) da-van-chuyen 
                @endif">
                @if ($order->status == 0)
                    Chưa đặt hàng
                @elseif ($order->status == 1)
                    Đã đặt hàng
                @elseif ($order->status == 2)
                    Đã vận chuyển
                @endif
            </div>

            <h4 class="product-list-title">Danh sách sản phẩm:</h4>
            @if ($order->orderProducts->isEmpty())
                <p>Không có sản phẩm trong đơn hàng.</p>
            @else
                <table class="table product-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderProducts as $orderProduct)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $orderProduct->product->name ?? 'Sản phẩm không tồn tại' }}</td>
                                <td>{{ $orderProduct->quantity }}</td>
                                <td>{{ number_format($orderProduct->price, 0, ',', '.') }} VND</td>
                                <td>{{ number_format($orderProduct->quantity * $orderProduct->price, 0, ',', '.') }} VND</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table><br>
            @endif
            <p class="total-price"><strong>Tổng tiền:</strong> {{ number_format($order->price, 0, ',', '.') }} VND</p><br>
            <form action="{{ route('admins.orders.changestatus', $order->id) }}" method="POST">
            @csrf
                <div class="form-group">
                    <label for="status" class="status-label">Thay đổi trạng thái:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Chưa đặt hàng</option>
                        <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Đã đặt hàng</option>
                        <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đã vận chuyển</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary update-status-btn">Cập nhật trạng thái</button>
            </form>
        </div>
    </div>
</x-app-layout>
