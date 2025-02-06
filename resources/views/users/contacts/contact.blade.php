<x-app-layout>
    
<form class="contact">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ Chúng Tôi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h2>Liên Hệ Chúng Tôi</h2>
        <div class="contact-info">
            <p><strong>Số điện thoại:</strong> 0876386369</p>
            <p><strong>Email:</strong> phamtranthuan2003@gmail.com</p>
            <p><strong>Địa chỉ:</strong> Dai Hoc Tai Nguyen Va Moi Truong Ha Noi</p>
        </div>
        <input type="text" placeholder="Tên của bạn" required>
        <input type="text" placeholder="Số điện thoại của bạn" required>
        <input type="email" placeholder="Email của bạn" required>
        <textarea rows="4" placeholder="Nội dung yêu cầu của bạn" required></textarea>
        <button type="submit">Gửi Yêu Cầu</button>
    </div>
    </form>  
    </x-app-layout>