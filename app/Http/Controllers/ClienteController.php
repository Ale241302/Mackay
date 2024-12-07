<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Password;
use App\Models\Cliente;
use App\Models\Caso;
use App\Models\Ciudad;

class ClienteController extends Controller
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
        $usersQuery = Cliente::query(); // Excluye usuarios con tipo_usuario igual a 5

        if (!empty($search)) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        $usersQuery->withCount([
            'casos as casos_count' => function ($query) {
                $query->where('estado_caso', '!=', 'Finalizado');
            },
            'casos as casos_count2' => function ($query) {
                $query->where('estado_caso', '=', 'Finalizado');
            }
        ]);



        $clientes = $usersQuery->get();

        return view('clientes.index', [
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
        return view('clientes.create');
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
            'empresa' => 'required|string|max:255',
            'rut' => 'required|valid_rut',
            'domicilio' => 'required|string|max:255',
            'postal' => 'required|string|max:255',
            'sitio' => 'nullable|string|max:255',
            'pais' => 'nullable|integer',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|integer',
            'representante' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:15',
            'ejecutivo' => 'nullable|string|max:255',
            'email2' => 'nullable|email|max:255',
            'telefono2' => 'nullable|string|max:15',

        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('clientes.create', true);
        }
        // Crear el nuevo cliente con los datos validados
        $cliente = Cliente::create([
            'empresa' => $request->empresa,
            'rut' => $request->rut,
            'domicilio' => $request->domicilio,
            'sitio' => $request->sitio,
            'pais' => $request->pais,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'representante' => $request->representante,
            'email' => $request->email,
            'postal' => $request->postal,
            'telefono' => $request->telefono,
            'ejecutivo' => $request->ejecutivo,
            'email2' => $request->email2,
            'telefono2' => $request->telefono2,

        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    public function getClienteData($id)
    {
        $cliente = Cliente::find($id);

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
        $cliente = Cliente::findOrFail($id);
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

        return view('clientes.edit', compact('cliente', 'casosConAbogados', 'casos'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        // Encontrar el cliente por su ID
        $cliente = Cliente::findOrFail($id);
        Validator::extend('valid_rut', function ($attribute, $value, $parameters, $validator) {
            return $this->validateRut($value);
        });
        $messages = [
            'valid_rut' => 'El :attribute no es un RUT válido.', // Mensaje de error personalizado
        ];
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'empresa' => 'required|string|max:255',
            'rut' => 'required|valid_rut',
            'domicilio' => 'required|string|max:255',
            'sitio' => 'nullable|string|max:255',
            'postal' => 'nullable|string|max:255',
            'pais' => 'nullable|integer',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|integer',
            'representante' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:15',
            'ejecutivo' => 'nullable|string|max:255',
            'email2' => 'nullable|email|max:255',
            'telefono2' => 'nullable|string|max:15',

        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('clientes.edit', true);
        }

        // Actualizar los datos del cliente
        $cliente->empresa = $request->empresa;
        $cliente->postal = $request->postal;
        $cliente->rut = $request->rut;
        $cliente->domicilio = $request->domicilio;
        $cliente->sitio = $request->sitio;


        $cliente->pais = $request->pais;
        $cliente->direccion = $request->direccion;
        $cliente->ciudad = $request->ciudad;
        $cliente->representante = $request->representante;
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->ejecutivo = $request->ejecutivo;
        $cliente->email2 = $request->email2;
        $cliente->telefono2 = $request->telefono2;



        // Guardar los cambios en la base de datos
        $cliente->save();

        return redirect('/clientes')->with('success', 'Cliente ha sido actualizado exitosamente.');
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect('/clientes')->with('success', 'User has been deleted');
    }
    public function updateStatus(Request $request)
    {
        $cliente = Cliente::findOrFail($request->input('id'));
        $cliente->estado = $request->input('estado');
        $cliente->save();

        return response()->json(['success' => true]);
    }
}
