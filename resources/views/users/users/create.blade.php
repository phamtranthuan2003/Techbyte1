<x-app-layout>
<div class="signup" >
<h2 class="signup-title">Đăng Ký</h2>
    <form action="{{ route('users.store') }}" method="post">
    @csrf
            <label for="name">Họ tên</label>
            <input type="text" name="name" placeholder="Nhập họ tên">

            <label for="birthday">Ngày sinh</label>
            <input type="date" name="birthday">

            <label for="sex">Giới tính</label>
            <div class="sex-options">
                <div class="radio-group">
                    <input type="radio" id="male" name="sex" value="Nam"> Nam
                </div>
                <div class="radio-group">
                    <input type="radio" id="female" name="sex" value="Nữ"> Nữ
                </div>
            </div>

            <label for="address">Địa chỉ</label>
            <input type="text" name="address" placeholder="Nhập địa chỉ">

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Nhập email">

            <label for="password">Mật khẩu</label>
            <input type="password" name="password" placeholder="Nhập mật khẩu">

            <label for="re-password">Nhập lại mật khẩu</label>
            <input type="password" name="re-password" placeholder="Nhập lại mật khẩu">

            

            <button class="btn-signup" type="submit">Đăng ký</button>
        </form>

        <div>
            Bạn đã có tài khoản?
            <a href="{{ route('users.login') }}">Dăng Nhập</a>
        </div>
    </div>

    </x-app-layout>
