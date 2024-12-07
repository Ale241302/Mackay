<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use App\Models\Cliente;
use App\Models\Caso;
use App\Models\TipoCaso;
use App\Models\User;
use App\Models\Permiso;

use Illuminate\Http\Request;

class TipoCasoController extends Controller
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
        $userGroups = TipoCaso::query();

        if (!empty($search)) {
            $userGroups->where('nombre', 'like', '%' . $search . '%');
        }

        // Ejecuta la consulta para obtener los resultados
        $userGroups = $userGroups->get();

        // Obtener todos los permisos de la base de datos
        $permisos = Permiso::all()->keyBy('id');

        return view('tipocaso.index', compact('userGroups', 'search', 'permisos', 'permisosUsuario'));
    }


    public function create()
    {
        $tipocaso = Permiso::all(); // Obtener todos los permisos
        return view('tipocaso.create', compact('tipocaso')); // Pasar a la vista
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30'
        ]);

        $userGroup = TipoCaso::create([
            'nombre' => $request->name
        ]);

        return redirect()->route('tipocaso.index')->with('success', 'Grupo creado exitosamente.');
    }




    public function show(TipoCaso $userGroup)
    {
        return view('tipocaso.show', compact('tipocaso'));
    }

    public function edit($id)
    {
        $userGroup = TipoCaso::find($id);
        $userGroupall = TipoCaso::all();
        return view('tipocaso.edit', compact('userGroup', 'userGroupall'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'

        ]);

        $userGroup = TipoCaso::findOrFail($id);
        $userGroup->update([
            'nombre' => $request->name
        ]);

        return redirect()->route('tipocaso.index')->with('success', 'Grupo actualizado exitosamente.');
    }


    public function destroy($id)
    {
        $userGroup = TipoCaso::find($id); // Buscar el grupo por ID

        if (!$userGroup) {
            return redirect()->route('tipocaso.index')->with('error', 'Grupo no encontrado.');
        }

        $userGroup->delete();
        return redirect()->route('tipocaso.index')->with('success', 'Grupo eliminado exitosamente.');
    }
}
