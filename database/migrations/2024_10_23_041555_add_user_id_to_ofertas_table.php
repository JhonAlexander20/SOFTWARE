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
        Schema::table('ofertas', function (Blueprint $table) {
            // Agregar la columna 'user_id' para relacionar la oferta con un usuario
            $table->unsignedBigInteger('user_id')->nullable(); // Puede ser null para ofertas que no estén asociadas a un usuario
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Clave foránea con users
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ofertas', function (Blueprint $table) {
            // Eliminar la clave foránea y la columna 'user_id'
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
