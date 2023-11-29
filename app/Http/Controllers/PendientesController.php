<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\preguntas;
use App\Models\Categoria_pregunta;

class PendientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function pendientes()
    {
        $preguntas = preguntas::join('categoria_preguntas', 'preguntas.fk_categoria', '=', 'categoria_preguntas.id_categoria_preguntas')
            ->join('users', 'preguntas.fk_usuario', '=', 'users.id')
            ->where('preguntas.estado', 0)
            ->get(['preguntas.*', 'categoria_preguntas.area', 'categoria_preguntas.categoria', 'users.id', 'users.name', 'users.apellido_paterno','users.apellido_materno']);

        $categorias = categoria_pregunta::all();

        return view('pendientes', compact('preguntas', 'categorias'));
    }
}
