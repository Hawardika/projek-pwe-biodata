<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personal_data_id')
                ->constrained('personal_data')
                ->onDelete('cascade');

            $table->string('title');        // Technical Support Engineer — Internship
            $table->string('company');      // PT. Adhisatya Indonesia
            $table->string('location')->nullable(); // Jakarta, Indonesia
            $table->string('period')->nullable();   // Agu 2023 – Jul 2024
            $table->text('description')->nullable();
            $table->unsignedInteger('order')->default(1); // buat urutan di timeline

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
