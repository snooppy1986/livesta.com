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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->default(null);
            $table->string('name_surname', 255)->default(null);
            $table->string('advantage', 1024)->default(null);
            $table->string('flaws', 1024)->default(null);
            $table->string('message', 2048)->default(null);
            $table->string('email', 255)->default(null);
            $table->integer('rating')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
