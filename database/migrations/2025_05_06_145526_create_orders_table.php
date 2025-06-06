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
            $table->id('order_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('order_number');
            $table->date('order_date');
            $table->string('status');
            $table->integer('total_price');
            $table->integer('subtotal');
            $table->integer('taxAmount');
            $table->integer('shippingCost');
            $table->integer('adminCost');
            $table->string('shipping_address');
            $table->boolean('status_del')->default(false);
            $table->timestamps();
            $table->text('payment_url')->nullable();
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
