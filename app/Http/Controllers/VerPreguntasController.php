<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\preguntas;
use App\Models\Categoria_pregunta;

class VerPreguntasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ver_pregunta($id)
    {
        $preguntas = preguntas::join('categoria_preguntas', 'preguntas.fk_categoria', '=', 'categoria_preguntas.id_categoria_preguntas')
            ->join('users', 'preguntas.fk_usuario', '=', 'users.id')
            ->where('preguntas.id_preguntas', $id) // Filtra por el ID proporcionado
            ->first(['preguntas.*', 'categoria_preguntas.area', 'categoria_preguntas.categoria', 'users.id', 'users.name', 'users.apellido_paterno']);

        $categorias = categoria_pregunta::where('estado', 1)->get(); // Filtra las categorías por estado 1

        return view('ver_pregunta', compact('preguntas', 'categorias'));
    }

    public function ver_usuario()
    {
        return view('ver_usuario');
    }}
