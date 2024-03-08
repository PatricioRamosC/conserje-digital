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
        Schema::table('visitas', function (Blueprint $table) {
            $table->unsignedBigInteger('delivery_id');
            $table->unsignedBigInteger('servicio_general_id');
            $table->foreign('delivery_id', 'visitas_delivery_id_deliveries')->references('id')->on('deliveries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitas', function (Blueprint $table) {
            $table->dropColumn('delivery_id');
            $table->dropColumn('servicio_general_id');
            $table->dropForeign('visitas_delivery_id_deliveries');
        });
    }
};
