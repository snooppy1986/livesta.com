<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('phone');
            $table->string('password');
            $table->string('role')->default('client');
            $table->string('avatar')
                ->nullable();
            $table->string('avatar_url')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if(app()->isLocal()){
            Schema::dropIfExists('users');
        }
    }
};
