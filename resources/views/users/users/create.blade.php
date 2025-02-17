<x-app-layout>
<div class="signup" >
<h2 class="signup-title">Đăng Ký</h2>
    <form action="{{ route('users.store') }}" method="post">
    @csrf
            <label for="name">Họ tên</label>
            <input type="text" name="name" placeholder="Nhập họ tên" required>

            <label for="birthday">Ngày sinh</label>
            <input type="date" name="birthday" required>

            <label for="sex">Giới tính</label>
            <div class="sex-options">
                <div class="radio-group" required>
                    <input type="radio" id="male" name="sex" value="Nam" required> Nam
                </div>
                <div class="radio-group">
                    <input type="radio" id="female" name="sex" value="Nữ"required> Nữ
                </div>
            </div>

            <label for="address">Địa chỉ</label>
            <input type="text" name="address" placeholder="Nhập địa chỉ"required>

            <label for="phone">Số điện thoại</label>
            <input type="text" name="phone" placeholder="Nhập Số điện thoại"required>

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Nhập email"required>

            <label for="password">Mật khẩu</label>
            <input type="password" name="password" placeholder="Nhập mật khẩu"required>

            <label for="re-password">Nhập lại mật khẩu</label>
            <input type="password" name="re-password" placeholder="Nhập lại mật khẩu"required>

            

            <button class="btn-signup" type="submit">Đăng ký</button>
        </form>

        <div>
            Bạn đã có tài khoản?
            <a href="{{ route('users.login') }}">Dăng Nhập</a>
        </div>
    </div>

    </x-app-layout>
