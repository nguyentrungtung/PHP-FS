<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->string('brand_name'); // Tạo trường brand_name kiểu chuỗi
            $table->string('brand_logo')->nullable(); // Tạo trường brand_logo kiểu chuỗi, cho phép null
            $table->timestamps(); // Tạo các trường created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
