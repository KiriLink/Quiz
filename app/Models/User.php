<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rut',
        'nombre', // Asegúrate de incluir 'nombre' si está en tu tabla
        'apellido_paterno', // Asegúrate de incluir 'apellido_paterno' si está en tu tabla
        'apellido_materno', // Asegúrate de incluir 'apellido_materno' si está en tu tabla
        'ruta_foto', // Asegúrate de incluir 'ruta_foto' si está en tu tabla
        'anio_actual', // Asegúrate de incluir 'anio_actual' si está en tu tabla
        'horario', // Asegúrate de incluir 'horario' si está en tu tabla
        'estado', // Asegúrate de incluir 'estado' si está en tu tabla
        'email_verified_at',
        'tipo_usu'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
}
