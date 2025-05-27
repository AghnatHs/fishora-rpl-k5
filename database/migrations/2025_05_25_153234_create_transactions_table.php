<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Constants\Orders;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->char('customer_id', 26);
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->char('order_id', 26);
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->string('product_name');
            $table->decimal('amount', 10, 2);
            $table->string('status')->default(Orders::TRANSACTION_STATUS_PENDING); // Status transaksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
