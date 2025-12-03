<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('personal_data_id')
                  ->constrained('personal_data')
                  ->onDelete('cascade');

            $table->string('institution');
            $table->string('degree')->nullable();
            $table->string('location')->nullable();
            $table->string('period')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('order')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
