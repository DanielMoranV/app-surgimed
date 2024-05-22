<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function show($dni)
    {
        $user = User::findOrFail($dni);
        return response()->json($user);
    }

    public function update(Request $request, $dni)
    {
        $user = User::findOrFail($dni);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($dni)
    {
        $user = User::findOrFail($dni);
        $user->delete();
        return response()->json(null, 204);
    }

    // Otras funciones del controlador...

    /**
     * Mostrar a todos los usuarios con sus roles asignados.
     *
     * @return \Illuminate\Http\Response
     */

    public function getUsersWithRoles()
    {
        $usersWithRoles = User::with('roles')->get();
        return response()->json($usersWithRoles);
    }

    /**
     * Mostrar los roles asignados a un usuario específico por su ID.
     *
     * @param  int  $dni
     * @return \Illuminate\Http\Response
     */
    public function getUserRoles($dni)
    {
        $user = User::findOrFail($dni);
        $userRoles = $user->roles;
        return response()->json(['user' => $user, 'roles' => $userRoles]);
    }
}