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
        Schema::table('niveles', function (Blueprint $table) {
            $table->unsignedBigInteger('condominio_id');
            $table->foreign('condominio_id')->references('id')->on('condominios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('niveles', function (Blueprint $table) {
            $table->dropForeign(['condominio_id']);
            $table->dropColumn('condominio_id');
        });
    }
};
