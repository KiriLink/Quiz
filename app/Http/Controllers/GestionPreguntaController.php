<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\preguntas;
use App\Models\Categoria_pregunta;

class GestionPreguntaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function gestionar_pregunta()
    {
        $preguntas = preguntas::join('categoria_preguntas', 'preguntas.fk_categoria', '=', 'categoria_preguntas.id_categoria_preguntas')
            ->where('preguntas.estado', 1)
            ->get(['preguntas.*', 'categoria_preguntas.area', 'categoria_preguntas.categoria']);

        $categorias = categoria_pregunta::where('estado', 1)->get(); // Filtra las categorías por estado 1


        return view('gestion_pregunta', array('preguntas' => $preguntas), array('categorias' => $categorias));
    }}
