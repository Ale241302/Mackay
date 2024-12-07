<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use App\Models\Cliente;
use App\Models\Caso;
use App\Models\TipoProcesal;
use App\Models\User;
use App\Models\Permiso;

use Illuminate\Http\Request;

class TipoProcesalController extends Controller
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
        $userGroups = TipoProcesal::query();

        if (!empty($search)) {
            $userGroups->where('nombre', 'like', '%' . $search . '%');
        }

        // Ejecuta la consulta para obtener los resultados
        $userGroups = $userGroups->get();

        // Obtener todos los permisos de la base de datos
        $permisos = Permiso::all()->keyBy('id');

        return view('tipoprocesal.index', compact('userGroups', 'search', 'permisos', 'permisosUsuario'));
    }


    public function create()
    {
        $tipoprocesal = Permiso::all(); // Obtener todos los permisos
        return view('tipoprocesal.create', compact('tipoprocesal')); // Pasar a la vista
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30'
        ]);

        $userGroup = TipoProcesal::create([
            'nombre' => $request->name
        ]);

        return redirect()->route('tipoprocesal.index')->with('success', 'Grupo creado exitosamente.');
    }




    public function show(TipoProcesal $userGroup)
    {
        return view('tipoprocesal.show', compact('tipoprocesal'));
    }

    public function edit($id)
    {
        $userGroup = TipoProcesal::find($id);
        $userGroupall = TipoProcesal::all();
        return view('tipoprocesal.edit', compact('userGroup', 'userGroupall'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'

        ]);

        $userGroup = TipoProcesal::findOrFail($id);
        $userGroup->update([
            'nombre' => $request->name
        ]);

        return redirect()->route('tipoprocesal.index')->with('success', 'Grupo actualizado exitosamente.');
    }


    public function destroy($id)
    {
        $userGroup = TipoProcesal::find($id); // Buscar el grupo por ID

        if (!$userGroup) {
            return redirect()->route('tipoprocesal.index')->with('error', 'Grupo no encontrado.');
        }

        $userGroup->delete();
        return redirect()->route('tipoprocesal.index')->with('success', 'Grupo eliminado exitosamente.');
    }
}
