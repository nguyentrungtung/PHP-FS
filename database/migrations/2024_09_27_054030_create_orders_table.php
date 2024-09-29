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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable()->default(null); // ID khách hàng (NULL nếu là khách không đăng nhập)

            // Thông tin người đặt hàng
            $table->string('customer_name'); // Họ và tên
            $table->string('customer_phone'); // Số điện thoại

            // Trạng thái đơn hàng pending': Đang chờ xử lý - processing': Đang xử lý - completed': Đã hoàn thành - cancelled': Đã hủy
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->decimal('total', 10, 2); // Tổng giá trị đơn hàng
            $table->text('customer_address'); // Địa chỉ giao hàng
//            $table->string('shipping_method', 100)->nullable(); // Phương thức giao hàng
            $table->string('payment_method', 100)->nullable(); // Phương thức thanh toán
            $table->string('order_note', 100)->nullable();
//            $table->enum('payment_status', ['paid', 'unpaid', 'refunded'])->default('unpaid'); // Trạng thái thanh toán paid': Đã thanh toán - unpaid': Chưa thanh toán - refunded': Đã hoàn tiền - failed': Thanh toán thất bại
            $table->timestamp('order_date')->useCurrent(); // Ngày đặt hàng
            $table->timestamps(); // Tạo cột created_at và updated_at

            // Khóa ngoại (liên kết bảng customers nhưng cho phép NULL trườngb hợp mua hàng không đăng nhập)
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
