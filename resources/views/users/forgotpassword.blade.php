<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>

</head>

<body>
  
    <h2 class="forgot-password-title" id="title">Đặt lại mật khẩu</h2>
    <form action="{{ route('users.resetpassword') }}" method="post">
    @csrf
        
        <label for="password">Mật khẩu</label>
        <input type="password" id="password" class="email" placeholder="Nhập mật khẩu">

        <label for="re-password">Nhập lại mật khẩu</label>
        <input type="password" id="re-password" class="email" placeholder="Nhập lại mật khẩu">
    

        <button type="submit">Xác nhận</button>
    </form>

</body>
</html>