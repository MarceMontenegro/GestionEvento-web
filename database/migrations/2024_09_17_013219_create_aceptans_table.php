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
        Schema::create('aceptan', function (Blueprint $table) {
            $table->id();
            
            // Clave foránea hacia la tabla 'eventos'
            $table->unsignedBigInteger('ID_eventos');
            $table->foreign('ID_eventos')
                  ->references('ID_eventos')
                  ->on('eventos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            // Clave foránea hacia la tabla 'users'
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            // Asistencia del usuario (booleano o tinyInteger)
            $table->tinyInteger('asistencia')->default(0); // 0 = No asistirá, 1 = Asistirá

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('aceptan');
    }
};
