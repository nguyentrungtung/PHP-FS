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
            $table->id(); // Tạo cột id tự động tăng
            $table->unsignedBigInteger('customer_id'); // Khóa ngoại cho customer
            $table->string('status'); // Trạng thái đơn hàng
            $table->decimal('total', 10, 2); // Tổng tiền
            $table->string('shipping_address'); // Địa chỉ giao hàng
            $table->string('shipping_method'); // Phương thức giao hàng
            $table->string('payment_method'); // Phương thức thanh toán
            $table->string('payment_status'); // Trạng thái thanh toán
            $table->timestamp('order_date')->useCurrent(); // Ngày đặt hàng
            $table->timestamps(); // Tạo cột created_at và updated_at
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
