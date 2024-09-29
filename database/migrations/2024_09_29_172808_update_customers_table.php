<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Cột email có thể null
            $table->string('customer_email')->nullable()->change();

            // Cột phone là duy nhất
            $table->string('customer_phone')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Khôi phục lại cột email không được null
            $table->string('customer_email')->nullable(false)->change();

            // Xóa unique cho cột customer_phone
            $table->dropUnique(['customer_phone']);
        });
    }
};
