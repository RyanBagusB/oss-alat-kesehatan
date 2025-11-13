<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('order_id');
            $table->uuid('product_id');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 15, 2)->default(0.00);
            $table->timestamps();

            // Relasi ke tabel orders & products
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Hapus tabel saat rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
