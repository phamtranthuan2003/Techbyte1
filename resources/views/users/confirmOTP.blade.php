<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận OTP</title>
</head>

<body>
    
    <h2 class="forgot-password-title" id="title">Xác nhận OTP</h2>
    <p id="content">Vui lòng nhập mã OTP đã được gửi đến email của bạn!</p>
    <form action="{{ route('users.Otpsucces') }}" method="post">
    @csrf
            <input type="number" id="otp" class="email" placeholder="Nhập OTP">
            <button name="btn-confirm">Xác nhận</button>
    </form>

        

    
    
</body>

</html>