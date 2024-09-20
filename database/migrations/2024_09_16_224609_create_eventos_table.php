<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id('ID_eventos');  // Primary Key
            $table->date('fecha_inicio');
            $table->string('nombre_evento', 20);
            $table->string('descripcion', 20);
            $table->string('ubicacion');
            $table->decimal('latitud', 10, 8); // 10 dígitos en total, 8 decimales
            $table->decimal('longitud', 11, 8); // 11 dígitos en total, 8 decimales

            // Clave foránea hacia la tabla 'users'
            $table->unsignedBigInteger('user_id');  // Referencia a 'users'
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('no action')
                  ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
