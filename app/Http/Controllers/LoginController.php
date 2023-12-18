<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('identification', 'password', 'type');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            $userData = [
                'id' => $user->id,
                'identification' => $user->identification,
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'type' => $user->type,
                'firstLogin' => $user->firstLogin,
            ];

            return response()->json(['message' => 'Inicio de sesión exitoso', 'user' => $userData]);
        } else {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }
    }
}
