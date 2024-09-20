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
        Schema::create('aceptans', function (Blueprint $table) {
            // Claves foráneas hacia 'users' y 'eventos'
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ID_eventos');

            // Definimos la clave foránea hacia 'users'
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // Definimos la clave foránea hacia 'eventos'
            $table->foreign('ID_eventos')
                  ->references('ID_eventos')
                  ->on('eventos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // Clave primaria compuesta
            $table->primary(['user_id', 'ID_eventos']); 

            $table->string('asistencia', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aceptans');
    }
};
