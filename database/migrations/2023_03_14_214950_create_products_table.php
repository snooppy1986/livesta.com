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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 512);
            $table->string('image', 512)->default('no-image.jpg');
            $table->text('content', 2048);
            $table->integer('category')->default(null);
            $table->string('code', 128)->default(null);
            $table->integer('price_balls')->default(null);
            $table->integer('price_discount')->default(null);
            $table->integer('price_special')->default(null);
            $table->integer('price_through')->default(null);
            $table->integer('raiting')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
