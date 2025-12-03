<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('nationality')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->text('summary')->nullable();
            $table->string('skills')->nullable();       // koma dipisah
            $table->string('photo')->nullable();        // path foto di storage
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_data');
    }
};
