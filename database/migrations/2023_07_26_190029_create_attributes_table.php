<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('application')->nullable();
            $table->string('brand')->nullable();
            $table->string('country')->nullable();
            $table->string('composition')->nullable();
            $table->string('gender')->nullable();
            $table->integer('catalog_id')->nullable();
            $table->text('warning')->nullable();
            $table->string('weight')->nullable();
            $table->foreignIdFor(Product::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        if(app()->isLocal()){
            Schema::dropIfExists('attributes');
        }
    }
};
