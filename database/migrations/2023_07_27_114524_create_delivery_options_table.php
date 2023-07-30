<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_options', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('type')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('payment_type')->nullable();
        });
    }

    public function down(): void
    {
        if(app()->isLocal()){
            Schema::dropIfExists('delivery_options');
        }
    }
};
