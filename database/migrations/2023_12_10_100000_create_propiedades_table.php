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
        Schema::create('propiedades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_propiedad_id');
            $table->unsignedBigInteger('condominio_id');
            $table->unsignedBigInteger('nivel_id');
            $table->unsignedBigInteger('propietario_id');
            $table->unsignedBigInteger('barrio_id');
            $table->string('nombre', 255);
            $table->timestamps();

            $table->foreign('tipo_propiedad_id')->references('id')->on('tipo_propiedades');
            $table->foreign('condominio_id')->references('id')->on('condominios');
            $table->foreign('nivel_id')->references('id')->on('niveles');
            $table->foreign('propietario_id')->references('id')->on('propietarios');
            $table->foreign('barrio_id')->references('id')->on('barrios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propiedades');
    }
};
