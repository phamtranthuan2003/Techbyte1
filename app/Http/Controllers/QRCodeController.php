<?php

namespace App\Http\Controllers;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class QRCodeController extends Controller
{
    public function index()
    {
        return view('qrcode.index');
    }

    public function create()
    {
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data('')
            ->size(300)
            ->margin(20)
            ->build();

        // Lưu file QR vào thư mục public/qrcodes
        $filePath = public_path('qrcodes/qrcode.png');
        File::ensureDirectoryExists(dirname($filePath));
        file_put_contents($filePath, $result->getString());

        return redirect()->route('qrcode.index')->with('success', 'QR code đã được tạo!');
    }
}
