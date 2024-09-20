<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_evento',
        'descripcion',
        'fecha_inicio',
        'ubicacion',
        'latitud',
        'longitud',
        'user_id',
    ];
    protected $table = 'eventos';

    // Relación uno a muchos inversa (cada evento pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relación uno a muchos con invitaciones
    public function invitaciones()
    {
        return $this->hasMany(Invitaciones::class, 'ID_eventos', 'ID_eventos');
    }

    // Relación muchos a muchos con usuarios (aceptan)
    public function usuariosAceptan()
    {
        return $this->belongsToMany(User::class, 'aceptan', 'ID_eventos', 'user_id')
                    ->withPivot('asistencia')
                    ->withTimestamps();
    }

    // Relación muchos a muchos con usuarios (reciben)
    public function usuariosReciben()
    {
        return $this->belongsToMany(User::class, 'reciben', 'ID_eventos', 'user_id')
                    ->withTimestamps();
    }
}
