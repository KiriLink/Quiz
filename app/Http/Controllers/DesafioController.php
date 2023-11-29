<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preguntas;
use App\Models\Registro_pregunta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DesafioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function desafio()
    {
        $preguntas = preguntas::join('categoria_preguntas', 'preguntas.fk_categoria', '=', 'categoria_preguntas.id_categoria_preguntas')
            ->where('preguntas.estado', 1)
            ->get(['preguntas.*', 'categoria_preguntas.categoria']);

        $preguntasChunks = $preguntas->chunk(3);

        $id_usuario = Auth::id();

        $preguntasCount = preguntas::join('categoria_preguntas', 'preguntas.fk_categoria', '=', 'categoria_preguntas.id_categoria_preguntas')
            ->join('registro_preguntas', function ($join) use ($id_usuario) {
                $join->on('preguntas.id_preguntas', '=', 'registro_preguntas.fk_pregunta')
                    ->where('registro_preguntas.fk_usuario', '=', $id_usuario)
                    ->where('registro_preguntas.desafio', '=', 1)
                    ->where('preguntas.estado', '=', 1);
            })
            ->get(['preguntas.*', 'categoria_preguntas.area', 'categoria_preguntas.categoria'])
            ->count();

        // Calcula el nivel actual basándote en cada 3 preguntas contestadas
        $nivelActual = (ceil($preguntasCount / 3)) + 1;
        
        $top3Usuarios = DB::table('registro_preguntas')
            ->select('users.name', 'users.apellido_paterno', 'users.apellido_materno', 'users.ruta_foto', 'registro_preguntas.fk_usuario', DB::raw('ROUND(SUM(CASE WHEN registro_preguntas.desafio = 1 AND registro_preguntas.estado = 1 THEN 1 ELSE 0 END)/3) as totalDesafio'))
            ->join('users', 'registro_preguntas.fk_usuario', '=', 'users.id')
            ->groupBy('registro_preguntas.fk_usuario', 'users.name', 'users.apellido_paterno', 'users.apellido_materno', 'users.ruta_foto')
            ->orderByDesc('totalDesafio')
            ->limit(3)
            ->get();


        return view('desafio', compact('preguntas', 'preguntasChunks', 'preguntasCount', 'nivelActual', 'top3Usuarios'));
    }


    public function entrar_desafio()
    {
        return view('quiz_desafio');
    }

    public function obtener_pregunta_desafio()
    {

        $id_usuario = Auth::id();

        $preguntas = preguntas::join('categoria_preguntas', 'preguntas.fk_categoria', '=', 'categoria_preguntas.id_categoria_preguntas')
            ->leftJoin('registro_preguntas', function ($join) use ($id_usuario) {
                $join->on('preguntas.id_preguntas', '=', 'registro_preguntas.fk_pregunta')
                    ->where('registro_preguntas.fk_usuario', '=', $id_usuario)
                    ->where('registro_preguntas.desafio', '=', 1);
            })
            ->where('preguntas.estado', 1)
            ->whereNull('registro_preguntas.id_registro_preguntas')
            ->inRandomOrder()
            ->limit(3)
            ->get(['preguntas.*', 'categoria_preguntas.area', 'categoria_preguntas.categoria']);

        return response()->json($preguntas);
    }

    public function registrar_respuesta_desafio(Request $request)
    {
        $respuestas = $request->input('respuestas');
        $desafio = 1; // Valor predeterminado

        foreach ($respuestas as $respuesta) {
            $opcionSeleccionada = $respuesta['respuesta'];
            if ($opcionSeleccionada != 1) {
                $desafio = 2;
            }
        }
        // Iterar sobre las respuestas
        foreach ($respuestas as $respuesta) {
            $preguntaId = $respuesta['preguntaId'];
            $opcionSeleccionada = $respuesta['respuesta'];

            $registro = new registro_pregunta;
            $registro->fk_usuario = auth()->user()->id;
            $registro->fk_pregunta = $preguntaId;
            $registro->respuesta = $opcionSeleccionada;
            $registro->estado = 1;

            // Verificar si la respuesta es diferente de 1


            $registro->desafio = $desafio;
            $registro->save();
        }

        return response()->json(['mensaje' => 'Respuestas guardadas con éxito']);
    }
    public function reiniciar_desafio()
    {
        $id_usuario = Auth::id();

        $updateData['desafio'] = 2;

        DB::table('registro_preguntas')
            ->where('fk_usuario', $id_usuario)
            ->where('desafio', 1)
            ->update($updateData);

        return redirect()->back();
    }
}
