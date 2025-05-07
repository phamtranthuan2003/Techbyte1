<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QRCodeController extends Controller
{
    public function generateQRCode(Request $request)
    {
        $data = $request->input('data');  // Nhận dữ liệu từ yêu cầu

        // Tạo mã QR
        $qrCode = new QrCode($data);  // Khởi tạo mã QR với dữ liệu

        // Tạo QR code thành chuỗi hình ảnh PNG
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Trả về mã QR dưới dạng base64
        return response()->json([
            'qr_code' => 'data:image/png;base64,' . base64_encode($result->getString())
        ]);
    }
}
