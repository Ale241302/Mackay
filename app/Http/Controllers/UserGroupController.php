<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Permiso;

use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Obtén el usuario autenticado y su grupo de usuarios
        $user = auth()->user();
        $userGroup = UserGroup::find($user->tipo_usuario);

        // Si no hay grupo de usuarios asignado, redirige o muestra un mensaje de error
        if (!$userGroup) {
            return redirect()->route('dashboard')->with('error', 'No se ha asignado un grupo de usuario.');
        }

        // Decodifica los permisos del grupo de usuarios
        $permisosUsuario = !empty($userGroup->permisos) ? json_decode($userGroup->permisos, true) : [];

        // Consulta los grupos de usuario con el filtro de búsqueda
        $userGroupsQuery = UserGroup::query();

        if (!empty($search)) {
            $userGroupsQuery->where('nombre', 'like', '%' . $search . '%');
        }

        $userGroups = $userGroupsQuery->get()->map(function ($group) {
            $group->permisos = !empty($group->permisos) ? json_decode($group->permisos, true) : [];

            // Verificar si el grupo está en uso
            $group->en_uso = User::where('tipo_usuario', $group->id)->exists(); // True si hay usuarios con este tipo de grupo

            return $group;
        });

        // Obtener todos los permisos de la base de datos
        $permisos = Permiso::all()->keyBy('id');

        return view('usergroups.index', compact('userGroups', 'search', 'permisos', 'permisosUsuario'));
    }

    public function create()
    {
        $tipospermisos = Permiso::all(); // Obtener todos los permisos
        return view('usergroups.create', compact('tipospermisos')); // Pasar a la vista
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'permissions' => 'array',
            'permissions.*' => 'exists:permisos,id'
        ]);

        $userGroup = UserGroup::create([
            'nombre' => $request->name,
            'permisos' => json_encode($request->permissions ?? [])
        ]);

        return redirect()->route('usergroups.index')->with('success', 'Grupo creado exitosamente.');
    }




    public function show(UserGroup $userGroup)
    {
        return view('usergroups.show', compact('userGroup'));
    }

    public function edit($id)
    {
        $userGroup = UserGroup::find($id);
        $userGroupall = UserGroup::all();
        $tipospermisos = Permiso::all();
        $selectedPermissions = is_array($userGroup->permisos) ? $userGroup->permisos : json_decode($userGroup->permisos, true);
        return view('usergroups.edit', compact('userGroup', 'userGroupall', 'tipospermisos', 'selectedPermissions'));
    }
    public function edit2($id)
    {
        $userGroup = UserGroup::find($id);
        $userGroupall = UserGroup::all();
        $tipospermisos = Permiso::all();
        $selectedPermissions = is_array($userGroup->permisos) ? $userGroup->permisos : json_decode($userGroup->permisos, true);
        return view('usergroups.ver', compact('userGroup', 'userGroupall', 'tipospermisos', 'selectedPermissions'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'exists:permisos,id',
        ]);

        $userGroup = UserGroup::findOrFail($id);
        $userGroup->update([
            'nombre' => $request->name,
            'permisos' => json_encode($request->permissions ?? [])
        ]);

        return redirect()->route('usergroups.index')->with('success', 'Grupo actualizado exitosamente.');
    }


    public function destroy($id)
    {
        $userGroup = UserGroup::find($id); // Buscar el grupo por ID

        if (!$userGroup) {
            return redirect()->route('usergroups.index')->with('error', 'Grupo no encontrado.');
        }

        $userGroup->delete();
        return redirect()->route('usergroups.index')->with('success', 'Grupo eliminado exitosamente.');
    }
}
