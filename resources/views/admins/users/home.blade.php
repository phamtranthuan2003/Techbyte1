<x-app-layout>
    <div class="admin">
    <div class="main-content">
        <header>
            <h1>👋 Chào mừng, Admin!</h1>
            <p>Trang tổng quan hệ thống</p>
        </header>
        <div class="filter-container">
            <label for="filterDay">Chọn ngày:</label>
            <input type="date" id="filterDay">

            <button id="filterBtn">Lọc dữ liệu</button>
        </div>
        <!-- Dashboard Overview -->
        <section class="dashboard-grid">

            <div class="dashboard-card">
                <h3>👥 Người dùng</h3>
                <p>Tổng số: <strong>{{ $totaluser ?? 0 }}</strong></p>
                <a href="{{ route('admins.users.list') }}">Quản lý</a>
            </div>
            <div class="dashboard-card">
                <h3>📦 Đơn hàng</h3>
                <p>Tổng số: <strong>{{ $pendingOrders ?? 0 }}</strong></p>
                <a href="{{ route('admins.orders.orderNotPlaced') }}">Quản lý</a>
            </div>
            <div class="dashboard-card">
                <h3>🛒 Sản phẩm</h3>
                <p>Tổng số: <strong>{{ $totalProducts ?? 0 }}</strong></p>
                <a href="{{ route('admins.products.list') }}">Quản lý</a>
            </div>
            <div class="dashboard-card">
                <h3>🏬 Tồn kho</h3>
                <p>Số lượng: <strong>{{ $totalStocks ?? 0 }}</strong></p>
                <a href="{{ route('admins.products.list') }}">Kiểm tra</a>
            </div>
            <div class="dashboard-card">
                <h3>🗂️ Danh mục</h3>
                <p>Tổng số: <strong>{{ $totalCategories ?? 0 }}</strong></p>
                <a href="{{ route('admins.categories.list') }}">Quản lý</a>
            </div>
            <div class="dashboard-card">
                <h3>🚚 Nhà Cung Cấp</h3>
                <p>Tổng số: <strong>{{ $totalProviders ?? 0 }}</strong></p>
                <a href="{{ route('admins.providers.list') }}">Quản lý</a>
            </div>
            <div class="dashboard-card">
                <h3>📊 Tổng số đơn hàng trong tuần</h3>
                <p><strong>{{ $totalOrdersWeek ?? 0 }}</strong></p>
            </div>
            <div class="dashboard-card">
                <h3>💰 Tổng doanh thu trong tuần</h3>
                <p><strong>{{ number_format($totalRevenueWeek ?? 0, 0, ',', '.') }} VNĐ</strong></p>
            </div>
        </section><br>



        <!-- Biểu đồ đơn hàng trong tuần -->
        <section class="chart-container">
            <div class="chart-box">
                <h2>📊 Số đơn hàng bán trong tuần</h2>
                <canvas id="ordersChart"></canvas>
            </div>
            <div class="chart-box">
                <h2>💰 Doanh thu trong tuần</h2>
                <canvas id="revenueChart"></canvas>
            </div>
        </section>
    </div>
</div>

<!-- Import Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   document.addEventListener("DOMContentLoaded", function () {
    var ctxOrders = document.getElementById("ordersChart").getContext("2d");
    var ctxRevenue = document.getElementById("revenueChart").getContext("2d");

    var allOrderData = @json($orderCounts);
    var allRevenueData = @json($revenueCounts );
    var allLabels = @json($daysOfWeek); // Đổi từ $orderDates sang $daysOfWeek

    var ordersChart = new Chart(ctxOrders, {
        type: "bar",
        data: {
            labels: allLabels,
            datasets: [{
                label: "Số đơn hàng",
                data: allOrderData,
                backgroundColor: "rgba(54, 162, 235, 0.6)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 1
            }]
        }
    });

    var revenueChart = new Chart(ctxRevenue, {
        type: "line",
        data: {
            labels: allLabels,
            datasets: [{
                label: "Doanh thu (VNĐ)",
                data: allRevenueData,
                borderColor: "rgba(255, 99, 132, 1)",
                backgroundColor: "rgba(255, 99, 132, 0.2)",
                borderWidth: 2,
                fill: true
            }]
        }
    });
});

</script>




<!-- CSS -->
<style>
    .filter-container {
    display: flex;
    gap: 10px;
    margin-bottom: 0px;
    align-items: center;
    padding: inherit;
}

.filter-container input, .filter-container button {
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        padding: 20px;
    }
    .dashboard-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .chart-container {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding: 20px;
    }
    .chart-box {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 48%;
    }
    .chart-box canvas {
        width: 100% !important;
        height: 250px !important;
        max-height: 250px;
    }
           .admin { display: flex; }
        .sidebar { width: 220px; background: #343a40; color: white; padding: 20px; }
        .menu li a { color: white; display: block; padding: 10px; }
        .main-content { flex: 1; padding: 20px; }
        header { display: flex; justify-content: space-between; align-items: center; }
        .search-container input { padding: 8px; width: 300px; border-radius: 5px; }
        .table-admin { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table-admin th, .table-admin td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        .product-img { width: 50px; height: 50px; object-fit: cover; border-radius: 5px; }
        .add-btn, .edit-btn, .delete-btn { padding: 5px 10px; border: none; cursor: pointer; border-radius: 5px; }
        .add-btn { background: #28a745; color: white; }
        .edit-btn { background: #ffc107; color: black; }
        .delete-btn { background: #dc3545; color: white; }
    </style>

</x-app-layout>
