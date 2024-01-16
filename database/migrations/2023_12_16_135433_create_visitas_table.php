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
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin')->nullable();
            $table->unsignedBigInteger('visita_motivo_id');
            $table->unsignedBigInteger('visitante_id');
            $table->unsignedBigInteger('propiedad_id');
            $table->timestamps();

            $table->foreign('visitante_id')->references('id')->on('visitantes');
            $table->foreign('propiedad_id')->references('id')->on('propiedades');
            $table->foreign('visita_motivo_id')->references('id')->on('visita_motivos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
