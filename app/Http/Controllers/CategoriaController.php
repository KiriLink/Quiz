<?php

namespace App\Http\Controllers;

use App\Models\Categoria_pregunta;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function categoria()
    {
        $categorias = Categoria_pregunta::join('users', 'categoria_preguntas.fk_usuario', '=', 'users.id')
            ->where('categoria_preguntas.estado', 1) // Agrega esta condición para filtrar por estado 1
            ->select('categoria_preguntas.*', 'users.name as nombre_usuario', 'users.apellido_paterno', 'users.apellido_materno')
            ->get();

        return view('categorias', compact('categorias'));
    }

    public function crear_categoria(Request $request)
    {
        $request->validate([
            'nueva_categoria' => [
                'required',
                'max:50',
                'unique:categoria_preguntas,categoria'
            ]
        ], [
            'nueva_categoria.max' => 'El campo Categoría no puede tener más de :max caracteres.',
            'nueva_categoria.required' => 'El campo categoria es obligatorio.',
            'nueva_categoria.unique' => 'Esa categoria ya está existe',
        ]);

        $nuevaCategoria = new Categoria_pregunta([
            'area' => 'vacio',
            'categoria' => $request->input('nueva_categoria'),
            'estado' => 1,
            'fk_usuario' =>  auth()->user()->id,
        ]);
        $nuevaCategoria->save();

        // Redirige a la vista de gestión de preguntas con un mensaje de éxito
        return redirect()->route('gestionar_pregunta')->with('success', 'Pregunta creada exitosamente.');
    }
    public function editar_categoria(Request $request)
    {
        //dd($request->all());
        $id = $request->input('id_categoria');

        $request->validate([
            'categoria' => [
                'required',
                'max:50',
                'unique:categoria_preguntas,categoria'
            ]
        ], [
            'categoria.max' => 'El campo Categoría no puede tener más de :max caracteres.',
            'categoria.required' => 'El campo categoria es obligatorio.',
            'categoria.unique' => 'Esa categoria ya está existe',
        ]);

        // Obtiene la pregunta a actualizar por su ID
        $categorias = Categoria_pregunta::find($id);

        // Verifica si se proporcionó la nueva categoría
        if ($request->filled('categoria')) {
            $categorias->categoria = $request->input('categoria');
        }

        // Establece el campo estado en 0
        $categorias->estado = 0;

        // Guarda los cambios en la base de datos
        $saved = $categorias->save();

        if ($saved) {
            return redirect()->route('categorias')->with('success', 'Pregunta agregada exitosamente');
        } else {
            return redirect()->route('categorias')->with('error', 'No se pudo agregar');
        }
    }

    public function borrar_categoria($id)
    {
        // Buscar la pregunta por su ID
        $categorias = Categoria_pregunta::find($id);

        // Verificar si la pregunta existe
        if (!$categorias) {
            // Manejar el caso en que la pregunta no existe
            return redirect()->route('categorias')->with('error', 'La categoria no existe.');
        }

        // Realiza la edición del estado
        $categorias->estado = 2; // Cambia el estado según tus necesidades
        $categorias->save();

        // Redirige de vuelta a la vista de gestión de preguntas
        return redirect()->route('categorias')->with('success', 'Estado de la categoria actualizado.');
    }
}
