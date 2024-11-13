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
        Schema::create('evento_moderadores', function (Blueprint $table) {
            $table->bigIncrements('id'); // Crea la columna 'id' como una clave primaria con auto incremento, tipo 'bigint'

            $table->unsignedBigInteger('user_id'); // Crea la columna 'user_id' como un campo sin signo de tipo 'bigint'
            
            $table->foreign('user_id') // Define una clave foránea en la columna 'user_id'
                  ->references('id') // Indica que la clave foránea 'user_id' hace referencia a la columna 'id' de la tabla 'users'
                  ->on('users') // Especifica que la referencia es a la tabla 'users'
                  ->onDelete('cascade'); // Configura la eliminación en cascada, lo que significa que si un 'user' es eliminado, todos los registros relacionados en esta tabla también serán eliminados
            
            $table->unsignedBigInteger('evento_id'); // Crea la columna 'evento_id' como un campo sin signo de tipo 'bigint'
            
            $table->foreign('evento_id') // Define una clave foránea en la columna 'evento_id'
                  ->references('ID_eventos') // Indica que la clave foránea 'evento_id' hace referencia a la columna 'ID_eventos' de la tabla 'eventos'
                  ->on('eventos') // Especifica que la referencia es a la tabla 'eventos'
                  ->onDelete('cascade'); // Configura la eliminación en cascada, lo que significa que si un 'evento' es eliminado, todos los registros relacionados en esta tabla también serán eliminados
            
            $table->timestamps(); // Crea dos columnas 'created_at' y 'updated_at' para registrar las fechas de creación y actualización de cada registro
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar la tabla 'evento_moderadores' si se revierte la migración
        Schema::dropIfExists('evento_moderadores');
    }
};
