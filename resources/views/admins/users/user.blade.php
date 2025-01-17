<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
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
            <h1 class="dsnd">Danh sách người dùng</h1>
          
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Tìm kiếm người dùng...">
            </div>
        </header>
        <section class="add-user" >
            <a href="./admin_adduser_management.html">
            <button>Thêm người dùng</button>
            </a>
        </section>

        <section>
         
            <table id="userTable">
                <thead>
                    <tr>
                        <th>ID</th> 
                        <th>Họ Tên</th>
                        <th>Ngày Sinh</th>
                        <th>Giới Tính</th>
                        <th>Địa Chỉ</th>
                        <th>Email</th>
                        <th>Vai Trò</th>
                        <th>Tùy Chỉnh</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
    </div>

    <script src="../js/admin_user_management.js"></script>
</body>

</html>
