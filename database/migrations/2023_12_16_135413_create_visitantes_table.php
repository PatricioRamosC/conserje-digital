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
        Schema::create('visitantes', function (Blueprint $table) {
            $table->id();
            $table->string('cedula_identidad', 15);
            $table->string('nombre', 200);
            $table->string('telefono', 20);
            $table->string('correo', 300);
            $table->binary('foto')->nullable();
            $table->binary('firma')->nullable();
            $table->unsignedBigInteger('condominio_id');
            $table->timestamps();

            $table->foreign('condominio_id')->references('id')->on('condominios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitantes');
    }
};
