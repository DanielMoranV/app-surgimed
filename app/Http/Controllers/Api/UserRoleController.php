<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    /**
     * Asignar un rol a un usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignRole(Request $request)
    {
        $request->validate([
            'dni' => 'required|exists:users,dni',
            'role_name' => 'required|string|exists:roles,name'
        ]);

        $user = User::findOrFail($request->dni);
        $role = Role::where('name', $request->role_name)->firstOrFail();

        $user->assignRole($role);

        return response()->json(['message' => 'Rol asignado correctamente']);
    }

    /**
     * Quitar un rol de un usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeRole(Request $request)
    {
        $request->validate([
            'dni' => 'required|exists:users,dni',
            'role_name' => 'required|string|exists:roles,name'
        ]);

        $user = User::findOrFail($request->dni);
        $role = Role::where('name', $request->role_name)->firstOrFail();

        $user->removeRole($role);

        return response()->json(['message' => 'Rol eliminado correctamente']);
    }

    /**
     * Obtener una lista de roles disponibles.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoles()
    {
        $roles = Role::all();

        return response()->json(['roles' => $roles]);
    }
}
