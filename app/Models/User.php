<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    public function moderandoEventos()
{
    return $this->belongsToMany(Evento::class, 'evento_moderadores', 'user_id', 'evento_id')
                ->withTimestamps();
}
    
    // Relación uno a muchos con eventos
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'user_id', 'id');
    }

    // Relación muchos a muchos con eventos (aceptan)
    public function eventosAceptados()
    {
        return $this->belongsToMany(Evento::class, 'aceptan', 'user_id', 'ID_eventos')
                    ->withPivot('asistencia')
                    ->withTimestamps();
    }

    // Relación muchos a muchos con eventos (reciben invitaciones)
    public function eventosRecibidos()
    {
        return $this->belongsToMany(Evento::class, 'reciben', 'user_id', 'ID_eventos')
                    ->withTimestamps();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
