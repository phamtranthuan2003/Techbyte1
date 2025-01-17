<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận email</title>
</head>

<body>
    <h2 class="forgot-password-title" id="title">Xác nhận email</h2>
    <form action="{{ route('users.Emailsucces') }}" method="post">
    @csrf
        <p id="content">Vui lòng nhập email của bạn!</p>
        @csrf
        <input type="email" name="email" class="email" placeholder="Nhập email">
        <button type="submit" name="submit">Xác nhận</button>
    </form>

        


</body>

</html>