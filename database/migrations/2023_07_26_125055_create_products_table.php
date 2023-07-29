<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('title');
            $table->string('image')
                ->default('no-image.jpg');
            $table->text('content');
            $table->string('code')
                ->nullable();
            $table->float('price_balls')
                ->nullable();
            $table->unsignedInteger('price_discount')
                ->nullable();
            $table->unsignedInteger('price_special')
                ->nullable();
            $table->unsignedInteger('price_through')
                ->nullable();
            $table->unsignedInteger('rating')
                ->nullable();
            $table->unsignedInteger('new')
                ->default(0);
            $table->foreignIdFor(Brand::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Product::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        if(app()->isLocal()){
            Schema::dropIfExists('category_product');
            Schema::dropIfExists('products');
        }
    }
};
