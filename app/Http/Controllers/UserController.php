<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'identification' => 'required|unique:users',
            'name' => 'required',
            'surname' => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['identification']);
        $validatedData['email'] = $request->input('email', 'email');
        $validatedData['phone'] = $request->input('phone', 'phone');
        $validatedData['address'] = $request->input('address', 'address');
        $validatedData['type'] = $request->input('type', 'type');
        $validatedData['firstLogin'] = true;
        $user = User::create($validatedData);

        return response()->json(['message' => 'Usuario creado de manera exitosa', 'user' => $user]);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable',
            'surname' => 'nullable',
            'email' => 'nullable',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->surname = $validatedData['surname'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->address = $validatedData['address'];
        $user->save();

        return response()->json(['message' => 'Usuario actualizado de manera exitosa', 'user' => $user]);
    }


    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required',
        ]);

        $user = User::findOrFail($id);

        if (!Hash::check($request->currentPassword, $user->password)) {
            return response()->json(['error' => 'La contraseña actual no es válida'], 422);
        }

        $user->password = Hash::make($request->newPassword);
        $user->firstLogin = false;
        $user->save();

        return response()->json(['message' => 'Contraseña actualizada exitosamente']);
    }
}
