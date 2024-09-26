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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id(); 
            $table->string('code', 100); // Mã coupon
            $table->string('title', 255); // Tiêu đề coupon
            $table->text('description')->nullable(); // Mô tả coupon
            $table->enum('discount_type', ['fixed', 'percentage']); // Loại giảm giá
            $table->decimal('discount_value', 10, 2); // Giá trị giảm
            $table->decimal('max_discount', 10, 2)->nullable(); // Giá trị giảm tối đa
            $table->decimal('min_order_value', 10, 2)->nullable(); // Giá trị đơn hàng tối thiểu
            $table->date('start_date'); // Ngày bắt đầu
            $table->date('end_date'); // Ngày kết thúc
            $table->integer('usage_limit')->nullable(); // Giới hạn số lần sử dụng
            $table->integer('used_times')->default(0); // Số lần đã sử dụng
            $table->enum('status', ['active', 'inactive']); // Trạng thái
            $table->string('applicable_brand_ids')->nullable(); // Danh sách ID thương hiệu áp dụng 
            $table->timestamps(); // created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};