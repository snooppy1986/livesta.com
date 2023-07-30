<?php

use App\Models\Category;
use App\Models\Product;
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

        Schema::table('category_product', function (Blueprint $table) {
           /* $table->bigInteger('category_id')->unsigned()->index()->change();
            $table->bigInteger('product_id')->unsigned()->index()->change();*/
           /* $table
                ->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
            ;
            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade')
            ;*/
           /*$table->dropColumn('category_id');
           $table->dropColumn('product_id');*/
           $table->foreignIdFor(Category::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

           $table->foreignIdFor(Product::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_product', function(Blueprint $table){
            $table->dropForeign('category_id');
            $table->dropForeign('product_id');
        });
    }
};
