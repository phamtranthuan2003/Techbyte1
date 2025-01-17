<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>

<body>

    <div>
        <h2>Đăng Nhập</h2>
        
        <!-- Form đăng nhập -->
        <form action="{{ route('users.loginIndex') }}" method="post">
            @csrf  

            <!-- Nhập email -->
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Nhập email" required>

            <!-- Nhập mật khẩu -->
            <label for="password">Mật khẩu</label>
            <div class="password-container">
                <input type="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>

            <!-- Nút đăng nhập -->
            <button type="submit" name="btn-login">Đăng nhập</button>
        </form>

        <!-- Liên kết quên mật khẩu -->
        <div class="forgot-password">
            <a href="{{ route('users.confirmEmail') }}">Quên mật khẩu?</a>
        </div>

        <!-- Liên kết đăng ký nếu chưa có tài khoản -->
        <div class="signup">    
            Bạn chưa có tài khoản? 
            <a href="{{ route('users.create') }}">Đăng ký</a>
        </div>
    </div>

</body>

</html>
