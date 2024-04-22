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
        Schema::create('order_product', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained()->restrictOnDelete()->restrictOnUpdate();
            $table->foreignId('product_id')->constrained()->restrictOnDelete()->restrictOnUpdate();
            $table->unique(['order_id', 'product_id']);
            $table->integer('quantity');
            $table->timestamp('wExpireAt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
