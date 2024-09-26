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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->unsignedBigInteger('product_id'); // Khóa ngoại đến bảng sản phẩm
            $table->string('image_type'); // Loại ảnh (ví dụ: chính, phụ)
            $table->string('image_url'); // Đường dẫn ảnh

            // Thêm khóa ngoại
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');;

            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
