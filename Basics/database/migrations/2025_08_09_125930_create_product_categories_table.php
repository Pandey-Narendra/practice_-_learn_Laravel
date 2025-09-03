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
        Schema::create('product_categories', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->OnDelete('cascade');
            $table->primary(['product_id', 'category_id']);
            $table->timestamps();

            //-------------------------------------------------------
                // $table->unsignedBigInteger('user_id');
                // $table->foreignId('user_id')->references('id')->on('users');

                // SQL
                // user_id bigint unsigned not null,
                // foreign key(user_id) references users(id);
            //-------------------------------------------------------

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
