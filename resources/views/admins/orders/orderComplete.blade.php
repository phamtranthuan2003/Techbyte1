<x-app-layout>
    <div class="admin">
    <div class="main-content">
        <header>
            <h1>Đơn hàng thành công</h1>

            <!-- Thêm ô tìm kiếm vào đây -->
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Tìm kiếm sản phẩm..." onkeyup="searchProduct()">
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


    <table class="table-admin">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Tổng tiền đơn hàng</th>
                <th>Địa Chỉ</th>
                <th>Số Điện Thoại</th>
                <th>Hình thức thanh toán</th>
                <th>Chi tiết đơn hàng</th>
                <th>update đơn hàng</th>

        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{$order->id }}</td>
                <td>{{$order->name }}</td>
                <td>{{$order->price }}</td>
                <td>{{$order->address }}</td>
                <td>{{$order->phone }}</td>

                <td>
                @if ($order->status == 0)
                    Chưa đặt hàng
                @elseif ($order->status == 1)
                    Đã đặt hàng
                @elseif ($order->status == 2)
                    Đã vận chuyển
                @elseif ($order->status == 3)
                    Đã hoàn thành
                @else
                    Đã hủy
                @endif
                </td>
                <td>
                    <a href="{{ route('admins.orders.orderDetail', ['id' => $order->id]) }}">
                    <button type="button" class="reviewprodduct">Xem</button>
                    </a>
                </td>
                <td>
                    <form action="{{ route('admins.orders.updatestatus', ['id' => $order->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="{{ $order->status + 1 }}">
                        <button type="submit" class="updatestatus">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchInput");
            const tableRows = document.querySelectorAll(".table-admin tbody tr");

            searchInput.addEventListener("keyup", function () {
                const searchText = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const cells = row.querySelectorAll("td");
                    let found = false;

                    cells.forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(searchText)) {
                            found = true;
                        }
                    });

                    row.style.display = found ? "" : "none";
                });
            });
        });
    </script>

</x-app-layout>

