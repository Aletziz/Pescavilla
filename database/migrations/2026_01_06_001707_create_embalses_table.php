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
        Schema::create('embalses', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('ueb_id')->constrained('u_e_b_s')->onDelete('cascade');
            $table->decimal('area', 12, 2)->nullable(); // Hasta 9,999,999,999.99 m²
            $table->string('municipio')->nullable();
            $table->decimal('profundidad_media', 8, 2)->nullable(); // Hasta 999,999.99 m
            $table->integer('cantidad_arroyo')->nullable();
            $table->decimal('volumen', 15, 2)->nullable(); // Hasta 9,999,999,999,999.99 m³
            $table->enum('tipo_cultivo', ['Intensivo', 'Extensivo', 'Semiintensivo'])->nullable();
            $table->enum('tipo_embalse', ['Presa', 'Micropresa'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('embalses');
    }
};
