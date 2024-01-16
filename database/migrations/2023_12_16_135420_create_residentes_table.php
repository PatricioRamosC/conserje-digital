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
        Schema::create('residentes', function (Blueprint $table) {
            $table->id();
            $table->string('cedula_identidad', 15);
            $table->string('nombre', 100);
            $table->string('paterno', 50);
            $table->string('materno', 50);
            $table->string('telefono', 20);
            $table->string('correo', 300);
            $table->unsignedBigInteger('propiedad_id');
            $table->timestamps();

            $table->foreign('propiedad_id')->references("id")->on("propiedades");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residentes');
    }
};
