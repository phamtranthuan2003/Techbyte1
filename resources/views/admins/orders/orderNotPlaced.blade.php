<x-app-layout>
    <div class="admin">
    <div class="main-content">
        <header>
            <h1 class="header-title">📋 Quản lý đơn hàng</h1>
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Tìm kiếm đơn hàng...">
            </div>
        </header>

        <div class="statusOrder">
            <a href="{{ route('admins.orders.orderNotPlaced') }}">
                <button type="button">Đơn hàng chờ xác nhận ({{ $counts['orderNotPlaced'] }})</button>
            </a>
            <a href="{{ route('admins.orders.list') }}">
                <button type="button">Đơn hàng đã đặt ({{ $counts['orderPlaced'] }})</button>
            </a>
            <a href="{{ route('admins.orders.orderhasbeenship') }}">
                <button type="button">Đơn hàng đã vận chuyển ({{ $counts['orderShipped'] }})</button>
            </a>
            <a href="{{ route('admins.orders.orderComplete') }}">
                <button type="button">Đơn hàng thành công ({{ $counts['orderComplete'] }})</button>
            </a>
            <a href="{{ route('admins.orders.orderCancelled') }}">
                <button type="button">Đơn hàng đã hủy ({{ $counts['orderCancelled'] }})</button>
            </a>
        </div>

        <section>
            <table class="table-admin">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Tổng tiền</th>
                        <th>Địa Chỉ</th>
                        <th>Số Điện Thoại</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>
                                @if ($order->status == 0)
                                    Chờ xác nhận
                                @elseif ($order->status == 1)
                                    Đã đặt
                                @elseif ($order->status == 2)
                                    Đã vận chuyển
                                @elseif ($order->status == 3)
                                    Hoàn thành
                                @else
                                    Đã hủy
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admins.orders.orderDetail', ['id'=> $order->id]) }}">
                                        <button type="button" class="edit-btn">✏️ Sửa</button>
                                </a>
                                <form action="{{ route('admins.orders.updatestatus', ['id' => $order->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="status" value="{{ $order->status + 1 }}">
                                    <button type="submit" class="delete-btn">🗑 Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>

</x-app-layout>
