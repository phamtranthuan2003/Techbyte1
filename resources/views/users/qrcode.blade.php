<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán chuyển khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 1500px;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
        }

        .left-panel {
            width: 40%;
            text-align: center;
            padding: 20px;
            border-right: 2px solid #ddd;
        }

        .countdown {
            font-size: 20px;
            color: #ff9800;
            margin-bottom: 10px;
        }

        .qr-code img {
            width: 350px;
            height: 350px;
        }

        .download-btn {
            background-color: orange;
            border: none;
            padding: 10px;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        .right-panel {
            width: 60%;
            padding: 20px;
        }

        .bank-logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: #ff0000;
            margin-bottom: 15px;
        }

        .bank-logo img {
            width: 24px;
            margin-left: 5px;
        }

        .info-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .copy-btn {
            background-color: orange;
            border: none;
            padding: 5px 10px;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        .notice {
            font-size: 14px;
            margin-top: 20px;
            color: #666;
        }

        .notice ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Cột trái (QR Code) -->
        <div class="left-panel">
            <p>Trang chuyển khoản sẽ đóng sau</p>
            <p id="countdown" class="countdown">08:00</p>
            <div class="qr-code">
                <img src="{{ asset('image/qrcode1.jpeg') }}" alt="Mã QR chuyển khoản">
            </div>
            <button class="download-btn" onclick="downloadQRCode()">Tải xuống mã QR</button>
        </div>

        <!-- Cột phải (Thông tin chuyển khoản) -->
        <div class="right-panel">
            <div class="bank-logo">
                MBBANK
            </div>

            <div class="info-box">
                <span><strong>Tên ngân hàng:</strong> MBBANK</span>
            </div>

            <div class="info-box">
                <span><strong>Số tài khoản:</strong> 250720036868</span>
            </div>

            <div class="info-box">
                <span><strong>Tên tài khoản:</strong> PHAM TRAN THUAN</span>
            </div>

            <div class="info-box">
            <span><strong>Số tiền chuyển:</strong> {{ number_format($order->price, 0, ',', '.') }}  VND</span>

            </div>

            <div class="info-box">
            <span><strong>Nội dung chuyển khoản:</strong> Thanh toán đơn hàng #{{ $order->id }}</span>
            </div>

            <div class="notice">
                <p><strong>Lưu ý:</strong></p>
                <ul>
                    <li>Vui lòng nhập chính xác nội dung và số tiền yêu cầu từ hệ thống.</li>
                    <li>Nếu không thể sử dụng mã QR Code, vui lòng sao chép tài khoản thanh toán.</li>
                    <li>Khi chuyển khoản không làm mới trình duyệt.</li>
                </ul>
            </div>
            <a href="{{ route('users.home') }}">
                <button type="button">Trang chủ</button>
            </a>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert("Đã sao chép: " + text);
            });
        }

        function downloadQRCode() {
            let qrImage = document.querySelector(".qr-code img");
            let downloadLink = document.createElement("a");
            downloadLink.href = qrImage.src;
            downloadLink.download = "qrcode.png";
            downloadLink.click();
        }

        // Đếm ngược thời gian
        let timeLeft = 8 * 60;
        function updateCountdown() {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            document.getElementById("countdown").innerText = `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
            if (timeLeft > 0) {
                timeLeft--;
                setTimeout(updateCountdown, 1000);
            }
        }
        updateCountdown();
    </script>

</body>
</html>
