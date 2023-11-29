<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria_pregunta;
use App\Models\Registro_pregunta;
use App\Models\preguntas;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function profile()
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

        // Realiza la consulta para obtener el porcentaje de preguntas contestadas correctamente por el usuario
        $preguntasContestadasCorrectas = Registro_pregunta::where('fk_usuario', $userId)
            ->where('respuesta', 1) // Considera que 1 es la respuesta correcta
            ->count();
        $preguntasContestadas = Registro_pregunta::where('fk_usuario', $userId)
            ->count();

        $preguntasTotales = preguntas::where('estado', 1)->count();

        // Calcula el porcentaje de preguntas contestadas correctamente y redondéalo
        if ($preguntasContestadasCorrectas == 0 || $preguntasContestadas == 0) {
            $porcentajeContestadas = 0;
        } else {
            $porcentajeContestadas = round(($preguntasContestadasCorrectas / $preguntasContestadas) * 100);
        }

        $preguntas = preguntas::join('categoria_preguntas', 'preguntas.fk_categoria', '=', 'categoria_preguntas.id_categoria_preguntas')
            ->where('preguntas.estado', 1)
            ->get(['preguntas.*', 'categoria_preguntas.area', 'categoria_preguntas.categoria']);

        $categorias = categoria_pregunta::all();

        // Calcula el porcentaje de preguntas correctamente acertadas en cada categoría
        $porcentajePorCategoria = [];
        foreach ($categorias as $categoria) {
            $preguntasCategoria = $preguntas->where('fk_categoria', $categoria->id_categoria_preguntas);
            $preguntasCategoriaTotales = $preguntasCategoria->count();

            if ($preguntasCategoriaTotales > 0) {
                $preguntasContestadasCategoria = Registro_pregunta::where('fk_usuario', $userId)
                    ->whereIn('fk_pregunta', $preguntasCategoria->pluck('id_preguntas'))
                    ->count();

                $preguntasCategoriaCorrectas = Registro_pregunta::where('fk_usuario', $userId)
                    ->whereIn('fk_pregunta', $preguntasCategoria->pluck('id_preguntas'))
                    ->where('respuesta', 1)
                    ->count();
                if ($preguntasCategoriaCorrectas == 0 || $preguntasContestadasCategoria == 0) {
                    $porcentaje = 0;
                } else {
                    $porcentaje = round(($preguntasCategoriaCorrectas / $preguntasContestadasCategoria) * 100);
                }

                $porcentajePorCategoria[] = [
                    'categoria' => $categoria->categoria,
                    'porcentaje' => $porcentaje,
                ];
            }
        }

        return view('profile', [
            'preguntas' => $preguntas,
            'categorias' => $categorias,
            'porcentajeContestadas' => $porcentajeContestadas,
            'porcentajePorCategoria' => $porcentajePorCategoria,
            'nivelActual' => $nivelActual
        ]);
    }
}
