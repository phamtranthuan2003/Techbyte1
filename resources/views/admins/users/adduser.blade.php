<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa người dùng</title>

</head>

<body>
    <div class="container">
        <h1>Thêm người dùng</h1>
        <form action="" method="POST" id="editUserForm" class="editUserForm">
            <!-- Thông tin người dùng -->
            <div class="form-group">
                <label for="userName">Họ Tên</label>
                <input type="text" id="userName" name="userName" required>
            </div>

            <div class="form-group">
                <label for="userBirthday">Ngày Sinh</label>
                <input type="date" id="userBirhday" name="userBirthday"  required>
            </div>
            <div class="form-group">
                <label for="sex">Giới Tính</label>
                <select id="userSex" name="userStatus">
                    <option value="Nam" selected>Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>

            <div class="form-group">
                <label for="userAddress">Địa chỉ</label>
                <input type="text" id="userAddress" name="userAddress"  required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="userEmail" name="userEmail"  required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="userPassword" name="userPas"  required>
            </div>

            <div class="form-group">
                <label for="userRole">Vai trò</label>
                <select id="userRole" name="userRole">
                    <option value="admin" selected>Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            

            <!-- Nút lưu thay đổi -->
            <div class="form-group">
                <button type="button" class="submit-btn" id="adduser">Thêm người dùng</button>
            </div>
        </form>
    </div>

</body>

</html>
