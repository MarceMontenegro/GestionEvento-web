<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitaciones extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_invitaciones';
    protected $table = 'invitaciones';

    // Agrega los campos que deseas permitir para asignación masiva
    protected $fillable = [
        'ID_eventos', // Agrega este campo para permitir la asignación masiva
        'user_id',
        'fecha_envio',
        'fecha_respuesta',
        'estado',
    ];

    // Relación con la tabla 'eventos'
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'ID_eventos', 'ID_eventos');
    }

    // Relación con la tabla 'users'
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
