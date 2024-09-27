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
        Schema::create('invitaciones', function (Blueprint $table) {
            
            $table->id('ID_invitaciones');  // Primary Key
            $table->date('fecha_envio');
            $table->date('fecha_respuesta')->nullable();
            $table->tinyInteger('estado')->default(0);  // 0 = Pendiente, 1 = Aceptada, 2 = Rechazada

            // Clave foránea hacia la tabla 'eventos'
            $table->unsignedBigInteger('ID_eventos');  
            $table->foreign('ID_eventos')
                  ->references('ID_eventos')
                  ->on('eventos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // Clave foránea hacia la tabla 'users'
            $table->unsignedBigInteger('user_id');  // Referencia al usuario invitado
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitaciones');
    }
};
