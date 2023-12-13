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
        Schema::create('condominios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('direccion', 255);
            $table->string('numero', 20);
            $table->unsignedBigInteger('codigo_postal');
            $table->unsignedBigInteger('comuna_id');
            $table->unsignedBigInteger('administrador_id');
            $table->timestamps();

            $table->foreign('comuna_id')->references('id')->on('comunas');
            $table->foreign('administrador_id')->references('id')->on('administradores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condominios');
    }
};
