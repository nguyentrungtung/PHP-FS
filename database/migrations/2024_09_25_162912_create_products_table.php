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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name'); // Tên sản phẩm
            $table->decimal('product_price', 10, 2); // Giá sản phẩm
            $table->decimal('product_price_old', 10, 2)->nullable(); // Giá cũ của sản phẩm
            $table->string('product_sku')->unique(); // SKU của sản phẩm
            $table->text('product_description')->nullable(); // Mô tả sản phẩm
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); // Khóa ngoại tới bảng categories
            $table->foreignId('brand_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); // Khóa ngoại tới bảng brands
//            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade'); // Khóa ngoại tới bảng coupons
            $table->integer('product_quantity');
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
