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
        Schema::table('propiedades', function (Blueprint $table) {
            $table->dropForeign('propiedades_condominio_id_foreign');
            $table->dropColumn('condominio_id');
            $table->unique(['barrio_id', 'nombre'], 'unique_barrio_id_nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('propiedades', function (Blueprint $table) {
            $table->unsignedBigInteger('condominio_id');
            $table->foreign('condominio_id', 'propiedades_condominio_id_foreign')->references('id')->on('condominios');
            $table->dropUnique('unique_barrio_id_nombre');
        });
    }
};
