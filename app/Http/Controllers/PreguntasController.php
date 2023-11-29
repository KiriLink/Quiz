<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\preguntas;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria_pregunta;
use App\Models\Registro_Pregunta;

class PreguntasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit_state($id)
    {
        // Buscar la pregunta por su ID
        $pregunta = Preguntas::find($id);

        // Verificar si la pregunta existe
        if (!$pregunta) {
            // Manejar el caso en que la pregunta no existe
            return redirect()->route('gestionar_pregunta')->with('error', 'La pregunta no existe.');
        }

        // Realiza la edición del estado
        $pregunta->estado = 2; // Cambia el estado según tus necesidades
        $pregunta->save();

        // Redirige de vuelta a la vista de gestión de preguntas
        return redirect()->route('gestionar_pregunta')->with('success', 'Estado de la pregunta actualizado.');
    }
    public function approve_question($id)
    {
        // Buscar la pregunta por su ID
        $pregunta = Preguntas::find($id);

        // Verificar si la pregunta existe
        if (!$pregunta) {
            // Manejar el caso en que la pregunta no existe
            return redirect()->route('pendientes')->with('error', 'La pregunta no existe.');
        }

        // Realiza la edición del estado
        $pregunta->estado = 1; // Cambia el estado según tus necesidades
        $pregunta->save();

        // Redirige de vuelta a la vista de gestión de preguntas
        return redirect()->route('pendientes')->with('success', 'Estado de la pregunta actualizado.');
    }
    public function disapprove_question($id)
    {
        // Buscar la pregunta por su ID
        $pregunta = Preguntas::find($id);

        // Verificar si la pregunta existe
        if (!$pregunta) {
            // Manejar el caso en que la pregunta no existe
            return redirect()->route('pendientes')->with('error', 'La pregunta no existe.');
        }

        // Realiza la edición del estado
        $pregunta->estado = 2; // Cambia el estado según tus necesidades
        $pregunta->save();

        // Redirige de vuelta a la vista de gestión de preguntas
        return redirect()->route('pendientes')->with('success', 'Estado de la pregunta actualizado.');
    }
    public function agregar_pregunta(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'fk_categoria' => 'required',
            'fk_usuario' => 'required',
            'pregunta' => 'required|string|max:10000',
            'respuesta_correcta' => 'required|string|max:255',
            'respuesta_2' => 'required|string|max:255',
            'respuesta_3' => 'required|string|max:255',
            'respuesta_4' => 'required|string|max:255',
            'retroalimentacion_positiva' => 'required|string|max:10000',
            'retroalimentacion_negativa' => 'required|string|max:10000',
        ], [
            'fk_categoria.required' => 'El campo Categoría es obligatorio.',
            'fk_usuario.required' => 'El campo Usuario es obligatorio.',
            'pregunta.required' => 'El campo Pregunta es obligatorio.',
            'pregunta.max' => 'El campo Pregunta no puede tener más de :max caracteres.',
            'respuesta_correcta.required' => 'El campo Respuesta Correcta es obligatorio.',
            'respuesta_correcta.max' => 'El campo Respuesta Correcta no puede tener más de :max caracteres.',
            'respuesta_2.required' => 'El campo Respuesta 2 es obligatorio.',
            'respuesta_2.max' => 'El campo Respuesta 2 no puede tener más de :max caracteres.',
            'respuesta_3.required' => 'El campo Respuesta 3 es obligatorio.',
            'respuesta_3.max' => 'El campo Respuesta 3 no puede tener más de :max caracteres.',
            'respuesta_4.required' => 'El campo Respuesta 4 es obligatorio.',
            'respuesta_4.max' => 'El campo Respuesta 4 no puede tener más de :max caracteres.',
            'retroalimentacion_positiva.required' => 'El campo Retroalimentación Positiva es obligatorio.',
            'retroalimentacion_positiva.max' => 'El campo Retroalimentación Positiva no puede tener más de :max caracteres.',
            'retroalimentacion_negativa.required' => 'El campo Retroalimentación Negativa es obligatorio.',
            'retroalimentacion_negativa.max' => 'El campo Retroalimentación Negativa no puede tener más de :max caracteres.',
        ]);

        $estado = 0;
        if (auth()->user()->tipo_usu == 1) {
            $estado = 1;
        }
        // Crea una nueva pregunta con los datos del formulario
        $nuevaPregunta = new preguntas([
            'fk_categoria' => $request->input('fk_categoria'),
            'pregunta' => $request->input('pregunta'),
            'respuesta_correcta' => $request->input('respuesta_correcta'),
            'respuesta_2' => $request->input('respuesta_2'),
            'respuesta_3' => $request->input('respuesta_3'),
            'respuesta_4' => $request->input('respuesta_4'),
            'retroalimentacion_positiva' => $request->input('retroalimentacion_positiva'),
            'retroalimentacion_negativa' => $request->input('retroalimentacion_negativa'),
            'estado' => $estado,
            'dificultad' => $request->input('dificultad'),
            'fk_usuario' => $request->input('fk_usuario'),
        ]);

        // Guarda la nueva pregunta en la base de datos
        $nuevaPregunta->save();

        // Redirige a la vista de gestión de preguntas con un mensaje de éxito
        return redirect()->route('gestionar_pregunta')->with('success', 'Pregunta creada exitosamente.');
    }

   public function update(Request $request, $id)
{
    // Validar que al menos uno de los campos tenga datos
    if (
        !$request->filled('fk_categoria') &&
        !$request->filled('pregunta') &&
        !$request->filled('respuesta_correcta') &&
        !$request->filled('respuesta_2') &&
        !$request->filled('respuesta_3') &&
        !$request->filled('respuesta_4') &&
        !$request->filled('retroalimentacion_positiva') &&
        !$request->filled('retroalimentacion_negativa') &&
        !$request->filled('dificultad')
    ) {
        return redirect()->back()->with('mensaje', 'Al menos un campo debe contener datos para actualizar la pregunta.');
    }

    $request->validate([
        'pregunta' => 'max:10000',
        'respuesta_correcta' => 'max:255',
        'respuesta_2' => 'max:255',
        'respuesta_3' => 'max:255',
        'respuesta_4' => 'max:255',
        'retroalimentacion_positiva' => 'max:10000',
        'retroalimentacion_negativa' => 'max:10000',
    ], [
        'pregunta.max' => 'El campo Pregunta no puede tener más de :max caracteres.',
        'respuesta_correcta.max' => 'El campo Respuesta Correcta no puede tener más de :max caracteres.',
        'respuesta_2.max' => 'El campo Respuesta 2 no puede tener más de :max caracteres.',
        'respuesta_3.max' => 'El campo Respuesta 3 no puede tener más de :max caracteres.',
        'respuesta_4.max' => 'El campo Respuesta 4 no puede tener más de :max caracteres.',
        'retroalimentacion_positiva.max' => 'El campo Retroalimentación Positiva no puede tener más de :max caracteres.',
        'retroalimentacion_negativa.max' => 'El campo Retroalimentación Negativa no puede tener más de :max caracteres.',
    ]);

    // Obtener la pregunta a actualizar por su ID
    $pregunta = preguntas::find($id);

    // Actualizar los campos si contienen datos
    if ($request->filled('fk_categoria')) {
        $pregunta->fk_categoria = $request->input('fk_categoria');
    }

    if ($request->filled('pregunta')) {
        $pregunta->pregunta = $request->input('pregunta');
    }

    if ($request->filled('respuesta_correcta')) {
        $pregunta->respuesta_correcta = $request->input('respuesta_correcta');
    }

    if ($request->filled('respuesta_2')) {
        $pregunta->respuesta_2 = $request->input('respuesta_2');
    }

    if ($request->filled('respuesta_3')) {
        $pregunta->respuesta_3 = $request->input('respuesta_3');
    }

    if ($request->filled('respuesta_4')) {
        $pregunta->respuesta_4 = $request->input('respuesta_4');
    }

    if ($request->filled('retroalimentacion_positiva')) {
        $pregunta->retroalimentacion_positiva = $request->input('retroalimentacion_positiva');
    }

    if ($request->filled('retroalimentacion_negativa')) {
        $pregunta->retroalimentacion_negativa = $request->input('retroalimentacion_negativa');
    }

    if ($request->filled('dificultad')) {
        $pregunta->dificultad = $request->input('dificultad');
    }

    // Guardar los cambios en la base de datos
    $pregunta->estado = 0;
    $saved = $pregunta->save();

    if ($saved) {
        return redirect()->back()->with('mensaje', 'Pregunta actualizada correctamente.');
    } else {
        return redirect()->back()->with('mensaje', 'No se pudo actualizar la pregunta.');
    }
}


    public function obtener_preguntas(Request $request, $dificultad)
    {


        if ($dificultad == 1) {
            // Consulta para dificultad 1
            $preguntas = preguntas::join('categoria_preguntas', 'preguntas.fk_categoria', '=', 'categoria_preguntas.id_categoria_preguntas')
                ->where('preguntas.estado', 1)
                ->where('preguntas.dificultad', 0)  // Ajusta según tus necesidades
                ->inRandomOrder()
                ->limit(10)
                ->get(['preguntas.*', 'categoria_preguntas.area', 'categoria_preguntas.categoria']);
        } elseif ($dificultad == 2) {
            // Consulta para dificultad 2
            $preguntas = preguntas::join('categoria_preguntas', 'preguntas.fk_categoria', '=', 'categoria_preguntas.id_categoria_preguntas')
                ->where('preguntas.estado', 1)
                ->where('preguntas.dificultad', 1)  // Ajusta según tus necesidades
                ->inRandomOrder()
                ->limit(10)
                ->get(['preguntas.*', 'categoria_preguntas.area', 'categoria_preguntas.categoria']);
        } else {
            // Consulta para dificultad desconocida
            $preguntas = preguntas::join('categoria_preguntas', 'preguntas.fk_categoria', '=', 'categoria_preguntas.id_categoria_preguntas')
                ->where('preguntas.estado', 1)
                ->inRandomOrder()
                ->limit(10)
                ->get(['preguntas.*', 'categoria_preguntas.area', 'categoria_preguntas.categoria']);
        }

        return response()->json($preguntas);
    }

    public function registrar_respuesta(Request $request)
    {
        $preguntaId = $request->input('preguntaId');
        $respuesta = $request->input('respuesta');

        // Guardar los datos en la base de datos, por ejemplo, usando Eloquent
        $registro = new registro_pregunta;
        $registro->fk_usuario = auth()->user()->id; // Suponiendo que el usuario está autenticado
        $registro->fk_pregunta = $preguntaId;
        $registro->respuesta = $respuesta;
        $registro->estado = 1; // Puedes establecer el estado según tus necesidades
        $registro->save();

        return response()->json(['mensaje' => 'Respuesta guardada con éxito']);
    }
}
