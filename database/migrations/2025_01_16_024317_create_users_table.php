<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // Tạo cột id tự động tăng
            $table->string('name');
            $table->date('birthday'); 
            $table->string('sex');
            $table->text('address');
            $table->string('email');
            $table->text('password');
            $table->text('role');
            $table->timestamps();
        });
    }

 
    public function down(): void
    {
        //
    }
};
