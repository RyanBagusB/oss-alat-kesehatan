<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('buyer_id');
            $table->decimal('total_amount', 15, 2);
            $table->string('payment_method')->nullable();
            $table->string('status')->default('pending'); // pending, paid, shipped, completed
            $table->text('shipping_address');
            $table->timestamps();

            $table->foreign('buyer_id')->references('id')->on('buyers')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
