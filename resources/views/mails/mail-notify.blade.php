<h2>Thông tin khách hàng</h2>

@if(isset($data) && is_array($data))
    <p><strong>Họ tên:</strong> {{ $data['name'] ?? 'Không có tên' }}</p>
    <p><strong>Email:</strong> {{ $data['email'] ?? 'Không có email' }}</p>
    <p><strong>Số điện thoại:</strong> {{ $data['tele'] ?? 'Không có số điện thoại' }}</p>
    <p><strong>Nội dung:</strong></p>
    <p>{{ $data['message'] ?? 'Không có nội dung' }}</p>
@else
    <p>Không có dữ liệu được gửi.</p>
@endif
