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
        Schema::create('delivery_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable(false);
            $table->string('type', 128)->default(null)->nullable(false);
            $table->string('area', 128)->default(null)->nullable(false);
            $table->string('city', 128)->default(null)->nullable(false);
            $table->string('warehouse', 128)->default(null)->nullable(false);
            $table->string('payment_type', 128)->default(null)->nullable(false);
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_options');
    }
};
