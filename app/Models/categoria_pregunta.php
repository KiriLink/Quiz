<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria_pregunta extends Model
{
    use HasFactory;

    protected $table = 'categoria_preguntas'; // Nombre de la tabla si es diferente al nombre del modelo
    protected $primaryKey = 'id_categoria_preguntas'; // Nombre de la clave primaria
    public $incrementing = true; // Indica si la clave primaria es autoincremento
    protected $fillable = [
        'area',
        'estado',
        'categoria',
        'fk_usuario',
    ];
}
