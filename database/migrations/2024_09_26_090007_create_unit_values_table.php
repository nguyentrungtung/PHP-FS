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
        Schema::create('unit_values', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->unsignedBigInteger('unit_id'); // Khóa ngoại đến bảng đơn vị
            $table->unsignedBigInteger('product_id'); // Khóa ngoại đến bảng sản phẩm
            $table->decimal('value', 10, 2); // Giá trị cho đơn vị

            // Thêm khóa ngoại
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');;

            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_values');
    }
};
