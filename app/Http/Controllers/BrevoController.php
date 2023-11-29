<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class BrevoController extends Controller
{

    public function validar_correo($rut)
    {

        $updateData['email_verified_at'] = 1;

        DB::table('users')
            ->where('rut', $rut)
            ->update($updateData);

        return redirect()->back();
    }

    public function nuevaCuenta($correo, $asunto, $mensaje, $name, $apellido_paterno, $apellido_materno)
    {
        $data = [
            'title' => $asunto,
            'content' => $mensaje,
            'correo' => $correo
        ];

        Mail::send('mail/verificar_correo', $data, function ($message) use ($correo, $name, $apellido_paterno, $apellido_materno) {
            $message->to($correo, $name . ' ' . $apellido_paterno . ' ' . $apellido_materno)
                ->subject('Verifique su correo electronico');
        });

        return "Correo enviado correctamente.";
    }
    public function enviarCorreoPassword($correo, $pass, $asunto, $mensaje, $name, $apellido_paterno, $apellido_materno)
    {
        $data = [
            'title' => $asunto,
            'content' => $mensaje,
            'pass' => $pass,
        ];

        Mail::send('mail/restaurar_pass', $data, function ($message) use ($correo, $name, $apellido_paterno, $apellido_materno) {
            $message->to($correo, $name . ' ' . $apellido_paterno . ' ' . $apellido_materno)
                ->subject('Contraseña restablecida ST CFT QUIZ');
        });

        return "Correo enviado correctamente.";
    }
}
