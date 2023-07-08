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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('application', 2048)->default(null);
            $table->string('brand', 256)->default(null);
            $table->string('country', 256)->default(null);
            $table->string('composition', 2048)->default(null);
            $table->string('gender', 128)->default(null);
            $table->integer('catalog_id')->default(null);
            $table->text('warning')->default(null);
            $table->string('weight', 128)->default(null);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
