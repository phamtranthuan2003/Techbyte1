<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Chinh sua nguoi dung</h2>
    <form action="{{ route('users.update', $user->id) }}" method="post">
        @csrf
        <label for="name">Họ tên</label>
            <input type="text" name="name" placeholder="Nhập họ tên" value="{{ $user->name }}">

            <label for="birthday">Ngày sinh</label>
            <input type="date" name="birthday" value="{{ $user->birthday }}">

            <label for="sex">Giới tính</label>
            <div class="sex-options">
                <div class="radio-group">
                    <input type="radio" id="male" name="sex" value="Nam" {{ $user->sex === 'Nam' ? 'checked' : '' }}> Nam
                </div>
                <div class="radio-group">
                    <input type="radio" id="female" name="sex" value="Nữ" {{ $user->sex === 'Nữ' ? 'checked' : '' }}> Nữ
                </div>
            </div>

            <label for="address">Địa chỉ</label>
            <input type="text" name="address" placeholder="Nhập địa chỉ" value="{{ $user->address }}">

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Nhập email" value="{{ $user->email }}">

            <label for="password">Mật khẩu</label>
            <input type="password" name="password" placeholder="Nhập mật khẩu" value="{{ $user->password }}">
            <button type="submit">Sua</button>
            <button type="delete">Xoa</button>
    </form>

</body>
</html>
