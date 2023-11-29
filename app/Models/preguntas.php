<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
    protected $primaryKey = 'id_preguntas';

    use HasFactory;

    protected $fillable = [
        'fk_categoria', // Asegúrate de que 'fk_categoria' esté en la lista
        'pregunta',
        'respuesta_correcta',
        'respuesta_2',
        'respuesta_3',
        'respuesta_4',
        'retroalimentacion_positiva',
        'retroalimentacion_negativa',
        'estado',
        'dificultad',
        'fk_usuario',
    ];
}
