<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Registro_pregunta;
use App\Models\Preguntas;
use App\Models\Categoria_pregunta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BrevoController;
use Illuminate\Support\Str;

class GestionUsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'max:43',
            'regap' => 'max:35',
            'regam' => 'max:35',
            'email' => 'email|max:200',
            'password_actual' => 'required',
            'password' => 'max:200|confirmed',
        ], [
            'name.max' => 'El campo Nombre no puede tener más de :max caracteres.',
            'regap.max' => 'El campo Apellido Paterno no puede tener más de :max caracteres.',
            'regam.max' => 'El campo Apellido Materno no puede tener más de :max caracteres.',
            'email.email' => 'El campo Correo Electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El campo Correo Electrónico no puede tener más de :max caracteres.',
            'password_actual.required' => 'El campo Contraseña anterior es obligatorio.',
            'password.max' => 'El campo Nueva contraseña no puede tener más de :max caracteres.',
            'password.confirmed' => 'Las contraseñas deben coincidir',
        ]);
    }
    public function gestionar_usuarios()
    {
        $userId = Auth::id();

        $usuarios = User::where('id', '!=', $userId)
            ->where('estado', 1)
            ->get();

        $porcentajes = [];
        $niveles = [];

        foreach ($usuarios as $usuario) {
            $id = $usuario->id;
            $preguntasContestadasCorrectas = Registro_pregunta::where('fk_usuario', $usuario->id)
                ->where('respuesta', 1) // Considera que 1 es la respuesta correcta
                ->count();

            $preguntasContestadas = Registro_pregunta::where('fk_usuario', $usuario->id)
                ->count();

            // Calcula el porcentaje de preguntas contestadas correctamente y redondéalo
            if ($preguntasContestadas == 0) {
                $porcentajeContestadas = 0;
            } else {
                $porcentajeContestadas = round(($preguntasContestadasCorrectas / $preguntasContestadas) * 100);
            }

            $porcentajes[$usuario->id] = $porcentajeContestadas;

            $preguntasCount = preguntas::join('categoria_preguntas', 'preguntas.fk_categoria', '=', 'categoria_preguntas.id_categoria_preguntas')
                ->join('registro_preguntas', function ($join) use ($id) {
                    $join->on('preguntas.id_preguntas', '=', 'registro_preguntas.fk_pregunta')
                        ->where('registro_preguntas.fk_usuario', '=', $id)
                        ->where('registro_preguntas.desafio', '=', 1)
                        ->where('preguntas.estado', '=', 1);
                })
                ->get(['preguntas.*', 'categoria_preguntas.area', 'categoria_preguntas.categoria'])
                ->count();

            // Calcula el nivel actual basándote en cada 3 preguntas contestadas
            $nivelActual = ceil($preguntasCount / 3);
            $niveles[$usuario->id] = $nivelActual;
        }

        return view('gestionar_usuarios', compact('usuarios', 'porcentajes', 'niveles'));
    }


    public function eliminar_usuario($id)
    {
        if (is_numeric($id)) {
            $usuario = User::find($id);
            // Verificar si la pregunta existe
            if (!$usuario) {
                // Manejar el caso en que la pregunta no existe
                return redirect()->route('gestionar_usuarios')->with('error', 'El usuario no existe');
            }

            // Realiza la edición del estado
            $usuario->estado = 2; // Cambia el estado según tus necesidades
            $usuario->save();

            // Redirige de vuelta a la vista de gestión de preguntas
            return redirect()->route('gestionar_usuarios')->with('success', 'Usuario eliminado');
        } else {
            return redirect()->route('gestionar_usuarios')->with('success', 'Error');
        }
    }
    public function ver_usuario_id($id)
    {
        if (is_numeric($id)) {
            $usuarios = User::where('id', $id)->get();

            $preguntasCount = preguntas::join('categoria_preguntas', 'preguntas.fk_categoria', '=', 'categoria_preguntas.id_categoria_preguntas')
                ->join('registro_preguntas', function ($join) use ($id) {
                    $join->on('preguntas.id_preguntas', '=', 'registro_preguntas.fk_pregunta')
                        ->where('registro_preguntas.fk_usuario', '=', $id)
                        ->where('registro_preguntas.desafio', '=', 1)
                        ->where('preguntas.estado', '=', 1);
                })
                ->get(['preguntas.*', 'categoria_preguntas.area', 'categoria_preguntas.categoria'])
                ->count();

            // Calcula el nivel actual basándote en cada 3 preguntas contestadas
            $nivelActual = (ceil($preguntasCount / 3));
            // Realiza la consulta para obtener el porcentaje de preguntas contestadas correctamente por el usuario
            $preguntasContestadasCorrectas = Registro_pregunta::where('fk_usuario', $id)
                ->where('respuesta', 1) // Considera que 1 es la respuesta correcta
                ->count();
            $preguntasContestadas = Registro_pregunta::where('fk_usuario', $id)
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
                    $preguntasContestadasCategoria = Registro_pregunta::where('fk_usuario', $id)
                        ->whereIn('fk_pregunta', $preguntasCategoria->pluck('id_preguntas'))
                        ->count();

                    $preguntasCategoriaCorrectas = Registro_pregunta::where('fk_usuario', $id)
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
            return view('ver_usuarios_admin', [
                'usuarios' => $usuarios,
                'porcentajeContestadas' => $porcentajeContestadas,
                'porcentajePorCategoria' => $porcentajePorCategoria,
                'nivelActual' => $nivelActual
            ]);
        } else {
            return redirect()->route('gestionar_usuarios')->with('success', 'Error');
        }
    }
    public function editar_usuario(Request $request)
    {
        $user = Auth::user();
        $userPassword = $user->password;
        $id = $request->input('id');
        $updateData = [];

        if ($user->tipo_usu != 1) {
            // Puedes personalizar el manejo de acceso no autorizado según tus requisitos
            abort(403, 'No tienes permisos para realizar esta acción.');
        }
        // Verificar si se proporcionó un nuevo correo electrónico
        if ($request->email != null && strtolower($request->email) != strtolower($user->email)) {
            // Verificar si el nuevo correo ya existe en la base de datos
            $existingUser = User::where('email', strtolower($request->email))->first();
            if ($existingUser) {
                // El correo ya está registrado, muestra un mensaje de error
                return redirect()->back()->with('updatePerfil', 'El correo electrónico ya está registrado.');
            } else {
                $updateData['email'] = $request->email;
            }
        }

        if ($request->name != null && $request->name != $user->name) {
            $updateData['name'] = $request->name;
        }

        if ($request->regap != null && $request->regap != $user->apellido_paterno) {
            $updateData['apellido_paterno'] = $request->regap;
        }

        if ($request->regam != null && $request->regam != $user->apellido_materno) {
            $updateData['apellido_materno'] = $request->regam;
        }

        if ($request->hasFile('imgperfil')) {
            $image = $request->file('imgperfil');
            $imageName = 'profile_' . $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $ruta_destino = 'profile_image';
            $upload = $image->move($ruta_destino, $imageName);
            $updateData['ruta_foto'] = 'profile_image/' . $imageName;
        }

        if ($request->password_actual != "" && $request->password != "") {
            if (Hash::check($request->password_actual, $userPassword)) {
                if ($request->password == $request->confirm_password) {
                    if (strlen($request->password) >= 6) {
                        $user->password = Hash::make($request->password);
                        $updateData['password'] = $user->password;
                    } else {
                        return redirect()->back()->with('updatePerfil', 'La clave debe tener al menos 6 caracteres.');
                    }
                } else {
                    return redirect()->back()->with('updatePerfil', 'Las claves no coinciden.');
                }
            } else {
                return redirect()->back()->with('updatePerfil', 'La clave actual no coincide.');
            }
        }

        if (!empty($updateData)) {
            DB::table('users')
                ->where('id', $id)
                ->update($updateData);

            return redirect()->back()->with('updatePerfil', 'Datos del perfil actualizados correctamente.');
        } else {
            return redirect()->back()->with('updatePerfil', 'No se realizaron actualizaciones.');
        }
    }

    public function restaurar_contrasena($id)
    {
        if (is_numeric($id)) {
            // Generar una contraseña predeterminada (puedes cambiar 'password_predeterminada' por la contraseña que desees)
            $n_pass = str::random(8);
            $nuevaContraseña = Hash::make($n_pass);

            // Actualizar la contraseña y vidas del usuario
            $updateData = [
                'password' => $nuevaContraseña,
            ];

            DB::table('users')
                ->where('id', $id)
                ->update($updateData);

            // Obtener el correo electrónico, nombre, apellido paterno y apellido materno del usuario
            $usuario = DB::table('users')
                ->where('id', $id)
                ->first();

            // Notificar por correo electrónico del cambio de contraseña
            $brevoController = new BrevoController();
            $asunto = 'Cambio de contraseña exitoso';
            $mensaje = 'Tu contraseña ha sido cambiada exitosamente. Si no realizaste este cambio, contacta al soporte. Cambiela lo antes posible';
            $brevoController->enviarCorreoPassword($usuario->email,$n_pass, $asunto, $mensaje, $usuario->name, $usuario->apellido_paterno, $usuario->apellido_materno);

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function buscar_usuarios()
    {
        $userId = Auth::id();

        $usuarios = User::where('id', '!=', $userId)
            ->where('estado', 1)
            ->get();

        return response()->json($usuarios);
    }
}
