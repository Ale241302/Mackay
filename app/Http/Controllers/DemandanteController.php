<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Password;
use App\Models\Demandante;
use App\Models\Caso;
use App\Models\Ciudad;

class DemandanteController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        // Obtén el usuario autenticado y su grupo de usuarios
        $user = auth()->user();
        $userGroup = UserGroup::find($user->tipo_usuario);

        // Si no hay grupo de usuarios asignado, redirige o muestra un mensaje de error
        if (!$userGroup) {
            return redirect()->route('dashboard')->with('error', 'No se ha asignado un grupo de usuario.');
        }

        // Decodifica los permisos del grupo de usuarios
        $permisosUsuario = !empty($userGroup->permisos) ? json_decode($userGroup->permisos, true) : [];

        // Consulta los usuarios excluyendo los que tienen tipo_usuario igual a 5 y aplicando filtro de búsqueda
        $usersQuery = Demandante::query(); // Excluye usuarios con tipo_usuario igual a 5

        if (!empty($search)) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }


        $clientes = $usersQuery->get();

        return view('demandantes.index', [
            'clientes' => $clientes,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario, // Pasa los permisos a la vista
        ]);
    }



    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('demandantes.create');
    }
    private function validateRut($rut)
    {
        // Elimina caracteres no permitidos
        $rut = preg_replace('/[^0-9kK]/', '', $rut);

        if (strlen($rut) < 2) {
            return false;
        }

        $dv = strtolower(substr($rut, -1)); // Dígito verificador
        $numero = substr($rut, 0, -1); // Número sin el dígito verificador
        $suma = 0;
        $factor = 2;

        for ($i = strlen($numero) - 1; $i >= 0; $i--) {
            $suma += $factor * $numero[$i];
            $factor = $factor == 7 ? 2 : $factor + 1;
        }

        $resto = $suma % 11;
        $dvCalculado = 11 - $resto;

        if ($dvCalculado == 10) {
            $dvCalculado = 'k';
        } elseif ($dvCalculado == 11) {
            $dvCalculado = '0';
        }

        return $dv == $dvCalculado;
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        Validator::extend('valid_rut', function ($attribute, $value, $parameters, $validator) {
            return $this->validateRut($value);
        });
        $messages = [
            'valid_rut' => 'El :attribute no es un RUT válido.', // Mensaje de error personalizado
        ];
        // Validar todos los campos del formulario
        $validator = Validator::make($request->all(), [
            'empresa_demandante' => 'nullable|string|max:255',
            'rut_demandante' => 'nullable|valid_rut',
            'email_demandante' => 'nullable|string|max:255',
            'telefono_demandante' => 'required|string|max:255',
            'representante_demandante' => 'nullable|string|max:255',
            'domicilio_demandante' => 'nullable|string|max:255'


        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('demandantes.create', true);
        }
        // Crear el nuevo cliente con los datos validados
        $cliente = Demandante::create([
            'empresa_demandante' => $request->empresa_demandante,
            'rut_demandante' => $request->rut_demandante,
            'email_demandante' => $request->email_demandante,
            'telefono_demandante' => $request->telefono_demandante,
            'representante_demandante' => $request->representante_demandante,
            'domicilio_demandante' => $request->domicilio_demandante,

        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('demandantes.index')->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $cliente = Demandante::findOrFail($id);
        return view('demandantes.show', compact('cliente'));
    }

    public function getClienteData($id)
    {
        $cliente = Demandante::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'id' => $cliente->id,
            'name' => $cliente->name,
            'apellido' => $cliente->apellido,
            'tipo_documento' => $cliente->tipoDocumento ? $cliente->tipoDocumento->nombre : 'No definido',
            'numero_documento' => $cliente->numero_documento,
            'numero_telefonico' => $cliente->numero_telefonico,
            'email' => $cliente->email,
            'postal' => $cliente->postal,
            'tipo_usuario' => $cliente->userGroup ? $cliente->userGroup->nombre : 'No definido',
            'estado' => $cliente->estado,
        ]);
    }
    public function obtenerCiudades($paisId)
    {
        // Obtén las ciudades que coincidan con el pais_id proporcionado
        $ciudades = Ciudad::where('pais_id', $paisId)->get();

        // Retorna las ciudades en formato JSON
        return response()->json($ciudades);
    }


    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $cliente = Demandante::findOrFail($id);
        // Obtener todos los subcasos relacionados con el caso
        $casos = Caso::where('empresa', $cliente->id)->get();

        // Crear un array para almacenar los nombres de los abogados
        $casosConAbogados = [];

        foreach ($casos as $caso) {
            // Decodificar el campo 'abogados' del subcaso, que contiene los IDs de los abogados
            $abogadosIds = json_decode($caso->abogados, true) ?? [];

            // Buscar los abogados por sus IDs
            $abogadosNombres = User::whereIn('id', $abogadosIds)->pluck('name')->toArray();

            // Guardar los nombres de los abogados en el subcaso
            $caso->abogadosNombres = $abogadosNombres;

            // Agregar el subcaso al array de subcasos con abogados
            $casosConAbogados[] = $caso;
        }

        return view('demandantes.edit', compact('cliente', 'casosConAbogados', 'casos'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        // Encontrar el cliente por su ID
        $cliente = Demandante::findOrFail($id);
        Validator::extend('valid_rut', function ($attribute, $value, $parameters, $validator) {
            return $this->validateRut($value);
        });
        $messages = [
            'valid_rut' => 'El :attribute no es un RUT válido.', // Mensaje de error personalizado
        ];
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'empresa_demandante' => 'nullable|string|max:255',
            'rut_demandante' => 'nullable|valid_rut',
            'email_demandante' => 'nullable|string|max:255',
            'telefono_demandante' => 'required|string|max:255',
            'representante_demandante' => 'nullable|string|max:255',
            'domicilio_demandante' => 'nullable|string|max:255'

        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('demandantes.edit', true);
        }

        // Actualizar los datos del cliente
        $cliente->empresa_demandante = $request->empresa_demandante;
        $cliente->rut_demandante = $request->rut_demandante;
        $cliente->email_demandante = $request->email_demandante;
        $cliente->telefono_demandante = $request->telefono_demandante;
        $cliente->representante_demandante = $request->representante_demandante;
        $cliente->domicilio_demandante = $request->domicilio_demandante;

        // Guardar los cambios en la base de datos
        $cliente->save();

        return redirect('/demandantes')->with('success', 'Cliente ha sido actualizado exitosamente.');
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $cliente = Demandante::findOrFail($id);
        $cliente->delete();

        return redirect('/demandantes')->with('success', 'User has been deleted');
    }
}
