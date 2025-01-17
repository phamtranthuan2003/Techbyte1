<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị - Admin</title>

</head>

<body>
    <div class="sidebar">
        <div class="logo">
            <h2>Admin Dashboard</h2>
        </div>
        <ul class="menu">
            <li><a href="{{ route('admins.home') }}">Tổng quan</a></li>
            <li><a href="{{ route('admins.user') }}">Quản lý người dùng</a></li>
            <li><a href="{{ route('products.list') }}">Quản lý đơn hàng</a></li>
            <!-- <li><a href="./admin_setting_management.html">Cài đặt</a></li> -->
            <li><a href="{{ route('users.login') }}" onclick="logout()">Đăng xuất</a></li>
        </ul>
    </div>
    
    <div class="main-content">
        <header>
            <h1>Tổng quan</h1>
        </header>
        
        <section class="statistics" name="statistics">
            <div class="stat-card">
                <h3 name="1">Người dùng</h3>
                <p></p>
            </div>
            <div class="stat-card">
                <h3 name="2">Số lượng sản phẩm</h3>
                <p></p>
            </div>
            <div class="stat-card">
                <h3 name="3">Số  lượng sản phẩm tồn kho</h3>
                <p></p>
            </div>
        </section>

        <section class="latest-orders">
            <h2>Đơn hàng gần đây</h2>
            <table border="1" name="userTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Ngày Sinh</th>
                        <th>Giới Tính</th>
                        <th>Địa Chỉ</th>
                        <th>Email</th>
                        <th>Vai Trò</th>
                    </tr>
                </thead>
                <tbody>
                   
                
                </tbody>
            </table>
        </section>
    </div>

</body>

</html>
