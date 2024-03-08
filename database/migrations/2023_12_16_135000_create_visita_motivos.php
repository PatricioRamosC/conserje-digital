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
        Schema::create('visita_motivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->unsignedBigInteger('condominio_id');
            $table->boolean('delivery');
            $table->boolean('services');
            $table->timestamps();

            $table->foreign('condominio_id')->references('id')->on('condominios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visita_motivos');
    }
};
