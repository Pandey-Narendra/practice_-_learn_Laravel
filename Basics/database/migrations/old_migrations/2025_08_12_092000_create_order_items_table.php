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
        Schema::create('order_items', function (Blueprint $table) {
            // $table->id();

            // $table->unsignedBigInteger('order_id');
            $table->foreignId('order_id')->references('id')->on('orders')->OnDelete('cascade')->onUpdate('cascade');
            
            // $table->unsignedBigInteger('product_id');
            $table->foreignId('product_id')->references('id')->on('products')->OnDelete('cascade')->onUpdate('cascade');

            $table->decimal('price', 10, 2);
            $table->integer('quantity');

            $table->primary(['order_id', 'product_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
