<x-app-layout>
    <form action="{{ route('admins.providers.store') }}" method="post">
        @csrf
        <h1>Nhà cung cấp</h1>
        
        <label for="name">Tên nhà cung cấp</label>
        <input type="text" id="name" name="name" required>
        
        <label for="address">Địa chỉ</label>
        <input type="text" id="address" name="address" required>
        
        <label for="tele">Số điện thoại</label>
        <input type="tel" id="tele" name="tele" required>
        
        <button type="submit">Thêm nhà cung cấp</button>
    </form>
</x-app-layout>
