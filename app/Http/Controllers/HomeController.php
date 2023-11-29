<?php

namespace App\Http\Controllers;

use App\Models\Categoria_pregunta;
use App\Models\Registro_pregunta;
use Illuminate\Http\Request;
use App\Models\preguntas;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $preguntasCount = preguntas::join('categoria_preguntas', 'preguntas.fk_categoria', '=', 'categoria_preguntas.id_categoria_preguntas')
            ->join('registro_preguntas', function ($join) use ($userId) {
                $join->on('preguntas.id_preguntas', '=', 'registro_preguntas.fk_pregunta')
                    ->where('registro_preguntas.fk_usuario', '=', $userId)
                    ->where('registro_preguntas.desafio', '=', 1)
                    ->where('preguntas.estado', '=', 1);
            })
            ->get(['preguntas.*', 'categoria_preguntas.area', 'categoria_preguntas.categoria'])
            ->count();

        // Calcula el nivel actual basándote en cada 3 preguntas contestadas
        $nivelActual = (ceil($preguntasCount / 3));
        
        return view('home', compact('nivelActual'));
    }


}
