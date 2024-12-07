<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use App\Models\Cliente;
use App\Models\Caso;
use App\Models\MontoHora;
use App\Models\User;
use App\Models\Permiso;

use Illuminate\Http\Request;

class MontoHoraController extends Controller
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
        $userGroups = MontoHora::query();

        if (!empty($search)) {
            $userGroups->where('nombre', 'like', '%' . $search . '%');
        }

        // Ejecuta la consulta para obtener los resultados
        $userGroups = $userGroups->get();

        // Obtener todos los permisos de la base de datos
        $permisos = Permiso::all()->keyBy('id');

        return view('montohora.index', compact('userGroups', 'search', 'permisos', 'permisosUsuario'));
    }


    public function create()
    {
        $montohora = Permiso::all(); // Obtener todos los permisos
        return view('montohora.create', compact('montohora')); // Pasar a la vista
    }


    public function store(Request $request)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0|max:999999.999'
        ]);

        $userGroup = MontoHora::create([
            'monto' => $request->monto
        ]);

        return redirect()->route('montohora.index')->with('success', 'Grupo creado exitosamente.');
    }




    public function show(MontoHora $userGroup)
    {
        return view('montohora.show', compact('montohora'));
    }

    public function edit($id)
    {
        $userGroup = MontoHora::find($id);
        $userGroupall = MontoHora::all();
        return view('montohora.edit', compact('userGroup', 'userGroupall'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0|max:999999.999'
        ]);

        $userGroup = MontoHora::findOrFail($id);
        $userGroup->update([
            'monto' => $request->monto
        ]);

        return redirect()->route('montohora.index')->with('success', 'Grupo actualizado exitosamente.');
    }


    public function destroy($id)
    {
        $userGroup = MontoHora::find($id); // Buscar el grupo por ID

        if (!$userGroup) {
            return redirect()->route('montohora.index')->with('error', 'Grupo no encontrado.');
        }

        $userGroup->delete();
        return redirect()->route('montohora.index')->with('success', 'Grupo eliminado exitosamente.');
    }
}
