<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('metas', function (Blueprint $table) {
            $table->id();
            $table->string('page_name');
            $table->string('title');
            $table->string('keywords')->nullable();
            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        if(app()->isLocal()){
            Schema::dropIfExists('metas');
        }
    }
};
