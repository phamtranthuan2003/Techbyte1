<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Phương thức up để tạo bảng
    public function up(): void
    {
        // Kiểm tra xem bảng đã tồn tại hay chưa
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();  // Tạo cột id tự động tăng
                $table->string('name');
                $table->date('birthday');
                $table->string('sex');
                $table->text('address');
                $table->string('phone');
                $table->string('email')->unique(); // Thêm unique để tránh trùng email
                $table->string('password'); // Đổi từ text thành string cho password
                $table->enum('role', ['admin', 'user'])->default('user'); // Giới hạn giá trị role
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('users'); // Xóa bảng nếu tồn tại
    }
};
