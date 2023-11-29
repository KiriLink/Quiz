<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class VerificarController extends Controller
{
    public function verificar()
    {
        return view('auth/verificar');
    }

    public function reenviar_correo(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:500',
        ], [
            'email.required' => 'El campo email es obligatorio.',
            'email.max' => 'El campo email no puede tener más de :max caracteres.',
        ]);

        $email = $request->input('email');

        // Verificar si el correo existe en la tabla users
        $user = User::where('email', $email)->first();
        if ($user['email_verified_at'] == 1) {
            return redirect()->back()->withErrors(['email' => 'El correo ya esta verificado']);
        } else if ($user) {

            $brevoController = new BrevoController();
            $asunto = $user['rut'];
            $mensaje = 'Confirme su correo';
            $brevoController->nuevaCuenta($user['email'], $asunto, $mensaje, $user['name'], $user['apellido_paterno'], $user['apellido_materno']);

            return Redirect::route('login')->with('success', 'Verificación reenviada');
        } else {
            // El correo no existe en la base de datos, puedes manejar esta situación como desees
            return redirect()->back()->withErrors(['email' => 'El correo no existe se encuentra registrado']);
        }
    }
}
