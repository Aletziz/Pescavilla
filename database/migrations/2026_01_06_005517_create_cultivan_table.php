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
        Schema::create('cultivan', function (Blueprint $table) {
            // Llaves foráneas
            $table->foreignId('embalse_id')->constrained('embalses')->onDelete('cascade');
            $table->foreignId('especie_id')->constrained('especies')->onDelete('cascade');
            
            // Llave primaria compuesta
            $table->primary(['embalse_id', 'especie_id']);
            
            // Campos adicionales para la relación
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cultivan');
    }
};
