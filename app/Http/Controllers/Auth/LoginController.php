<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
            'estado' => 1,
            'email_verified_at'=> 1
        ];
    }

    protected function attemptLogin(Request $request)
{
    // Verifica el estado antes de intentar autenticar
    $credentials = $this->credentials($request);

    $user = \App\Models\User::where('email', $request->email)->first();

    // Verifica si el usuario está verificado
    if ($user && $user->email_verified_at == null) {
        throw ValidationException::withMessages([
            $this->username() => ['Tu cuenta aún no ha sido verificada.']
        ]);
    }

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        return $this->sendLoginResponse($request);
    }

    // Si la autenticación falla, incrementa el contador de intentos
    $this->incrementLoginAttempts($request);

    // Lanza una excepción de autenticación fallida
    throw ValidationException::withMessages([
        $this->username() => [trans('auth.failed')],
    ]);
}

    public function logout(Request $request, Redirector $redirect)
    {
        // Extrae el mensaje de la sesión
        $verificationMessage = session('verification-message');
    
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // Redirige al usuario a la página de login con el mensaje
        return $redirect->route('login')->with('verification-message', $verificationMessage);
    }
    
}
