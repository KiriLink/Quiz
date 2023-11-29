<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

class UserSettingsController extends Controller
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
            'password' => 'max:200|confirmed', // La regla 'confirmed' verifica que 'password' coincida con 'password_confirmation'
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


    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $userPassword = $user->password;

        $updateData = [];

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
                ->where('id', $user->id)
                ->update($updateData);

            return redirect()->back()->with('updatePerfil', 'Datos del perfil actualizados correctamente.');
        } else {
            return redirect()->back()->with('updatePerfil', 'No se realizaron actualizaciones.');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserSettings $userSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserSettings $userSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserSettings $userSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserSettings $userSettings)
    {
        //
    }
}
