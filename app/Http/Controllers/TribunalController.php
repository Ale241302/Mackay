<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use App\Models\Cliente;
use App\Models\Caso;
use App\Models\Tribunal;
use App\Models\Ciudad;
use App\Models\User;
use App\Models\Permiso;

use Illuminate\Http\Request;

class TribunalController extends Controller
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
        $userGroups = Tribunal::query();

        if (!empty($search)) {
            $userGroups->where('nombre', 'like', '%' . $search . '%')
                ->orWhereHas('Ciudad', function ($q) use ($search) {
                    $q->where('nombre', 'like', '%' . $search . '%'); // Buscar por el nombre del grupo de usuarios
                });
        }

        // Ejecuta la consulta para obtener los resultados
        $userGroups = $userGroups->get();

        // Obtener todos los permisos de la base de datos
        $permisos = Permiso::all()->keyBy('id');

        return view('tribunal.index', compact('userGroups', 'search', 'permisos', 'permisosUsuario'));
    }


    public function create()
    {
        $tribunal = Permiso::all(); // Obtener todos los permisos
        return view('tribunal.create', compact('tribunal')); // Pasar a la vista
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'ciudad' => 'nullable|integer',
        ]);

        $userGroup = Tribunal::create([
            'nombre' => $request->name,
            'ciudad' => $request->ciudad
        ]);

        return redirect()->route('tribunal.index')->with('success', 'Grupo creado exitosamente.');
    }




    public function show(Tribunal $userGroup)
    {
        return view('tribunal.show', compact('tribunal'));
    }

    public function edit($id)
    {
        $userGroup = Tribunal::find($id);
        $userGroupall = Tribunal::all();
        return view('tribunal.edit', compact('userGroup', 'userGroupall'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ciudad' => 'nullable|integer',

        ]);

        $userGroup = Tribunal::findOrFail($id);
        $userGroup->update([
            'nombre' => $request->name,
            'ciudad' => $request->ciudad
        ]);

        return redirect()->route('tribunal.index')->with('success', 'Grupo actualizado exitosamente.');
    }


    public function destroy($id)
    {
        $userGroup = Tribunal::find($id); // Buscar el grupo por ID

        if (!$userGroup) {
            return redirect()->route('tribunal.index')->with('error', 'Grupo no encontrado.');
        }

        $userGroup->delete();
        return redirect()->route('tribunal.index')->with('success', 'Grupo eliminado exitosamente.');
    }
}
