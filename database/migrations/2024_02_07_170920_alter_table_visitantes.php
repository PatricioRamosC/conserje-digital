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
        Schema::table('visitantes', function (Blueprint $table) {
            $table->dropForeign('visitantes_condominio_id_foreign');
            $table->dropColumn('condominio_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitantes', function (Blueprint $table) {
            $table->unsignedBigInteger('condominio_id');
            $table->foreign('condominio_id')->references('id')->on('condominios');
        });
    }
};
