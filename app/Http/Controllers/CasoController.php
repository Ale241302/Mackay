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
use App\Models\Demandante;
use App\Models\Caso;
use App\Models\Tribunal;
use App\Models\SubCaso;
use App\Models\Ciudad;
use App\Models\Tipoprocesal;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

Carbon::setLocale('es');

class CasoController extends Controller
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

        // Obtener todos los tribunales
        $tribunales = Tribunal::all()->keyBy('id');

        // Consulta los casos aplicando filtro de búsqueda
        $usersQuery = Caso::query();

        if (!empty($search)) {
            $usersQuery->where(function ($query) use ($search, $tribunales) {
                // Buscar en campos de caso directamente
                $query->where('etapa_procesal', 'like', '%' . $search . '%')
                    ->orWhere('referencia_caso', 'like', '%' . $search . '%')
                    ->orWhere('descripcion_caso', 'like', '%' . $search . '%')
                    ->orWhere('rol_caso', 'like', '%' . $search . '%')
                    ->orWhereHas('empresa', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%'); // Buscar por nombre de empresa
                    });

                // Búsqueda en los nombres de los tribunales
                foreach ($tribunales as $tribunal) {
                    if (stripos($tribunal->nombre, $search) !== false) {
                        $query->orWhere('tribunal', 'like', '%"' . $tribunal->id . '"%');
                    }
                }
            });
        }

        $usersQuery->withCount(['subcasos' => function ($query) {
            $query->where('estado', 'Activo');
        }]);

        $clientes = $usersQuery->get();
        $empresa = User::all()->keyBy('id');
        $procesal = Tipoprocesal::all()->keyBy('id');
        $cliente2 = Cliente::all()->keyBy('id');
        return view('casos.index', [
            'clientes' => $clientes,
            'cliente2' => $cliente2,
            'tribunal' => $tribunales,
            'empresa' => $empresa,
            'procesal' => $procesal,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario, // Pasa los permisos a la vista
        ]);
    }




    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Obtén el usuario autenticado y su grupo de usuarios
        $user = auth()->user();
        $userGroup = UserGroup::find($user->tipo_usuario);

        // Si no hay grupo de usuarios asignado, redirige o muestra un mensaje de error
        if (!$userGroup) {
            return redirect()->route('dashboard')->with('error', 'No se ha asignado un grupo de usuario.');
        }

        // Decodifica los permisos del grupo de usuarios
        $permisosUsuario = !empty($userGroup->permisos) ? json_decode($userGroup->permisos, true) : [];

        return view('casos.create', [
            'permisosUsuario' => $permisosUsuario, // Pasa los permisos a la vista
        ]);
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

        // Extender el validador para RUT válido
        Validator::extend('valid_rut', function ($attribute, $value, $parameters, $validator) {
            return $this->validateRut($value);
        });

        // Mensajes de error personalizados
        $messages = [
            'valid_rut' => 'El :attribute no es un RUT válido.',
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'email' => 'El campo :attribute debe ser una dirección de correo válida.',
        ];

        // Validación de todos los campos del formulario
        $validator = Validator::make($request->all(), [
            'empresa' => 'required|integer',
            'empresa_demandante' => 'nullable|string|max:255',
            'rut_demandante' => 'required|valid_rut',
            'domicilio_demandante' => 'required|string|max:255',
            'email_demandante' => 'nullable|email|max:255',
            'telefono_demandante' => 'nullable|string|max:15',
            'representante_demandante' => 'required|string|max:255',
            'referencia_caso' => 'nullable|string|max:255',
            'descripcion_caso' => 'nullable|string|max:255',
            'asunto_caso' => 'nullable|string|max:255',
            'fechai' => 'nullable|date',

            'tipo_caso' => 'nullable|integer',
            'cobrofijo' => 'nullable|integer',
            'cobrohora' => 'nullable|integer',
            'cobroporciento' => 'nullable|integer',

            'nombre_juicio' => 'nullable|string|max:255',
            'fechait' => 'nullable|date',
            'juez_civil' => 'nullable|string|max:255',
            'juez_arbitro' => 'nullable|string|max:255',

            'tipo_moneda' => 'nullable|string|max:3',

            'estado_caso' => 'nullable|string|max:255',
            'etapa_procesal' => 'nullable|string|max:255',
        ], $messages);

        // Si la validación falla, redirigir con los errores
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('casos.create', true);
        }
        // Verificar si existe un cliente con el mismo RUT
        $DeExistente = \App\Models\Demandante::where('rut_demandante', $request->rut_demandante)->first();

        if ($DeExistente) {
            // Actualizar el cliente con la nueva información
            $DeExistente->update([
                'rut_demandante' => $request->rut_demandante,
                'empresa_demandante' => $request->empresa_demandante,
                'domicilio_demandante' => $request->domicilio_demandante,
                'email_demandante' => $request->email_demandante,
                'telefono_demandante' => $request->telefono_demandante,
                'representante_demandante' => $request->representante_demandante,
            ]);
        } else {
            \App\Models\Demandante::create([
                'rut_demandante' => $request->rut_demandante,
                'empresa_demandante' => $request->empresa_demandante,
                'domicilio_demandante' => $request->domicilio_demandante,
                'email_demandante' => $request->email_demandante,
                'telefono_demandante' => $request->telefono_demandante,
                'representante_demandante' => $request->representante_demandante,
            ]);
        }
        // Verificar si existe un cliente con el mismo RUT
        $clienteExistente = \App\Models\Cliente::where('rut', $request->rut)->first();

        if ($clienteExistente) {
            // Actualizar el cliente con la nueva información
            $clienteExistente->update([
                'domicilio' => $request->domicilio,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'representante' => $request->representante,
            ]);
        }

        $usuario = auth()->id();
        $cuantia = $request->cuantia ? str_replace(',', '.', $request->cuantia) : null;
        // Crear el nuevo caso con los datos validados
        $caso = Caso::create([
            'empresa' => $request->empresa,
            'demandante' => $request->demandante,
            'bill' =>  json_encode($request->bill ?? []),
            'empresa_demandante' => $request->empresa_demandante,
            'rut_demandante' => $request->rut_demandante,
            'email_demandante' => $request->email_demandante,
            'telefono_demandante' => $request->telefono_demandante,
            'representante_demandante' => $request->representante_demandante,
            'domicilio_demandante' => $request->domicilio_demandante,
            'referencia_caso' => $request->referencia_caso,
            'referencia_demandante' => $request->referencia_demandante,
            'descripcion_caso' => $request->descripcion_caso,
            'asunto_caso' => $request->asunto_caso,
            'fechai' => $request->fechai,
            'abogados' =>  json_encode($request->abogados ?? []),
            'tipo_caso' => $request->tipo_caso,
            'cobrofijo' => $request->cobrofijo,
            'cobrohora' => $request->cobrohora,
            'cobroporciento' => $request->cobroporciento,
            'rol_caso' =>  json_encode($request->rol_caso ?? []),
            'nombre_juicio' => $request->nombre_juicio,
            'tribunal' => json_encode($request->tribunal ?? []),
            'fechait' => $request->fechait,
            'juez_civil' => $request->juez_civil,
            'juez_arbitro' => $request->juez_arbitro,
            'rol_arbitral' =>  json_encode($request->rol_arbitral ?? []),
            'tipo_moneda' => $request->tipo_moneda,
            'cuantia' => $cuantia,

            'actividadesData' => json_encode($request->actividadesData ?? []),
            'documentosData' => json_encode($request->documentosData ?? []),
            'estado_caso' => $request->estado_caso,
            'estado_casoi' => $request->estado_casoi,
            'etapa_procesal' => $request->etapa_procesal,
            'usuario' => $usuario,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('casos.index')->with('success', 'Caso creado exitosamente.');
    }


    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $caso = Caso::findOrFail($id);
        return view('casos.show', compact('caso'));
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
        $user = auth()->user();
        $userGroup = UserGroup::find($user->tipo_usuario);

        // Si no hay grupo de usuarios asignado, redirige o muestra un mensaje de error
        if (!$userGroup) {
            return redirect()->route('dashboard')->with('error', 'No se ha asignado un grupo de usuario.');
        }

        // Decodifica los permisos del grupo de usuarios
        $permisosUsuario = !empty($userGroup->permisos) ? json_decode($userGroup->permisos, true) : [];

        // Obtener el caso y contar los subcasos activos
        $caso = Caso::findOrFail($id);
        $subcasosCount = SubCaso::where('caso', $id)
            ->where('estado', 'Activo')
            ->count();

        // Verificar si tiene subcasos activos
        $tieneSubcasos = $subcasosCount > 0 ? 'Sí' : 'No';

        // Obtener todos los subcasos relacionados con el caso
        $subcasos = SubCaso::where('caso', $caso->id)->get();

        // Crear un array para almacenar los nombres de los abogados
        $subcasosConAbogados = [];

        foreach ($subcasos as $subcaso) {
            // Decodificar el campo 'abogados' del subcaso, que contiene los IDs de los abogados
            $abogadosIds = json_decode($subcaso->abogados, true) ?? [];

            // Buscar los abogados por sus IDs
            $abogadosNombres = User::whereIn('id', $abogadosIds)->pluck('name')->toArray();

            // Guardar los nombres de los abogados en el subcaso
            $subcaso->abogadosNombres = $abogadosNombres;

            // Agregar el subcaso al array de subcasos con abogados
            $subcasosConAbogados[] = $subcaso;
        }

        // Pasar $permisosUsuario, $subcasosCount y $tieneSubcasos a la vista junto con $caso y subcasos con nombres de abogados
        return view('casos.edit', compact('caso', 'permisosUsuario', 'subcasosCount', 'tieneSubcasos', 'subcasosConAbogados', 'subcasos'));
    }


    public function edit2($id)
    {
        $user = auth()->user();
        $userGroup = UserGroup::find($user->tipo_usuario);

        // Si no hay grupo de usuarios asignado, redirige o muestra un mensaje de error
        if (!$userGroup) {
            return redirect()->route('dashboard')->with('error', 'No se ha asignado un grupo de usuario.');
        }

        // Decodifica los permisos del grupo de usuarios
        $permisosUsuario = !empty($userGroup->permisos) ? json_decode($userGroup->permisos, true) : [];

        // Obtener el caso y contar los subcasos activos
        $caso = Caso::findOrFail($id);
        $subcasosCount = SubCaso::where('caso', $id)
            ->where('estado', 'Activo')
            ->count();

        // Verificar si tiene subcasos activos
        $tieneSubcasos = $subcasosCount > 0 ? 'Sí' : 'No';

        // Obtener todos los subcasos relacionados con el caso
        $subcasos = SubCaso::where('caso', $caso->id)->get();

        // Crear un array para almacenar los nombres de los abogados
        $subcasosConAbogados = [];

        foreach ($subcasos as $subcaso) {
            // Decodificar el campo 'abogados' del subcaso, que contiene los IDs de los abogados
            $abogadosIds = json_decode($subcaso->abogados, true) ?? [];

            // Buscar los abogados por sus IDs
            $abogadosNombres = User::whereIn('id', $abogadosIds)->pluck('name')->toArray();

            // Guardar los nombres de los abogados en el subcaso
            $subcaso->abogadosNombres = $abogadosNombres;

            // Agregar el subcaso al array de subcasos con abogados
            $subcasosConAbogados[] = $subcaso;
        }

        // Pasar $permisosUsuario, $subcasosCount y $tieneSubcasos a la vista junto con $caso y subcasos con nombres de abogados
        return view('casos.ver', compact('caso', 'permisosUsuario', 'subcasosCount', 'tieneSubcasos', 'subcasosConAbogados', 'subcasos'));
    }


    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        // Encontrar el caso por su ID
        $caso = Caso::findOrFail($id);

        // Extender el validador para RUT válido
        Validator::extend('valid_rut', function ($attribute, $value, $parameters, $validator) {
            return $this->validateRut($value);
        });

        // Mensajes de error personalizados
        $messages = [
            'valid_rut' => 'El :attribute no es un RUT válido.',
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'email' => 'El campo :attribute debe ser una dirección de correo válida.',
        ];

        // Validación de todos los campos del formulario
        $validator = Validator::make($request->all(), [
            'empresa' => 'required|integer',
            'empresa_demandante' => 'nullable|string|max:255',
            'rut_demandante' => 'required|valid_rut',
            'domicilio_demandante' => 'required|string|max:255',
            'email_demandante' => 'nullable|email|max:255',
            'telefono_demandante' => 'nullable|string|max:15',
            'representante_demandante' => 'required|string|max:255',
            'referencia_caso' => 'nullable|string|max:255',
            'descripcion_caso' => 'nullable|string|max:255',
            'asunto_caso' => 'nullable|string|max:255',
            'fechai' => 'nullable|date',

            'tipo_caso' => 'nullable|integer',
            'cobrofijo' => 'nullable|integer',
            'cobrohora' => 'nullable|integer',
            'cobroporciento' => 'nullable|integer',

            'nombre_juicio' => 'nullable|string|max:255',
            'fechait' => 'nullable|date',
            'juez_civil' => 'nullable|string|max:255',
            'juez_arbitro' => 'nullable|string|max:255',

            'tipo_moneda' => 'nullable|string|max:3',

            'estado_caso' => 'nullable|string|max:255',
            'etapa_procesal' => 'nullable|string|max:255',
        ], $messages);

        // Si la validación falla, redirigir con los errores
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('casos.edit', true);
        }
        // Verificar si existe un cliente con el mismo RUT
        $DeExistente = \App\Models\Demandante::where('rut_demandante', $request->rut_demandante)->first();

        if ($DeExistente) {
            // Actualizar el cliente con la nueva información
            $DeExistente->update([
                'rut_demandante' => $request->rut_demandante,
                'empresa_demandante' => $request->empresa_demandante,
                'domicilio_demandante' => $request->domicilio_demandante,
                'email_demandante' => $request->email_demandante,
                'telefono_demandante' => $request->telefono_demandante,
                'representante_demandante' => $request->representante_demandante,
            ]);
        } else {
            \App\Models\Demandante::create([
                'rut_demandante' => $request->rut_demandante,
                'empresa_demandante' => $request->empresa_demandante,
                'domicilio_demandante' => $request->domicilio_demandante,
                'email_demandante' => $request->email_demandante,
                'telefono_demandante' => $request->telefono_demandante,
                'representante_demandante' => $request->representante_demandante,
            ]);
        }
        // Verificar si existe un cliente con el mismo RUT
        $clienteExistente = \App\Models\Cliente::where('rut', $request->rut)->first();

        if ($clienteExistente) {
            // Actualizar el cliente con la nueva información
            $clienteExistente->update([
                'domicilio' => $request->domicilio,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'representante' => $request->representante,
            ]);
        }
        $usuario = auth()->id();

        // Obtener el valor de cuantía y reemplazar las comas por puntos
        $cuantia = $request->cuantia ? str_replace(',', '.', $request->cuantia) : null;

        // Actualizar los datos del caso con los datos validados
        $caso->update([
            'empresa' => $request->empresa,
            'demandante' => $request->demandante,
            'bill' =>  json_encode($request->bill ?? []),
            'empresa_demandante' => $request->empresa_demandante,
            'rut_demandante' => $request->rut_demandante,
            'email_demandante' => $request->email_demandante,
            'telefono_demandante' => $request->telefono_demandante,
            'representante_demandante' => $request->representante_demandante,
            'domicilio_demandante' => $request->domicilio_demandante,
            'referencia_caso' => $request->referencia_caso,
            'referencia_demandante' => $request->referencia_demandante,
            'descripcion_caso' => $request->descripcion_caso,
            'asunto_caso' => $request->asunto_caso,
            'fechai' => $request->fechai,
            'abogados' => json_encode($request->abogados ?? []),
            'tipo_caso' => $request->tipo_caso,
            'cobrofijo' => $request->cobrofijo,
            'cobrohora' => $request->cobrohora,
            'cobroporciento' => $request->cobroporciento,
            'rol_caso' => json_encode($request->rol_caso ?? []),
            'nombre_juicio' => $request->nombre_juicio,
            'tribunal' => json_encode($request->tribunal ?? []),
            'fechait' => $request->fechait,
            'juez_civil' => $request->juez_civil,
            'juez_arbitro' => $request->juez_arbitro,
            'rol_arbitral' => json_encode($request->rol_arbitral ?? []),
            'tipo_moneda' => $request->tipo_moneda,
            'cuantia' => $cuantia,

            'actividadesData' => $request->actividadesData,
            'documentosData' => $request->documentosData,
            'estado_caso' => $request->estado_caso,
            'estado_casoi' => $request->estado_casoi,
            'etapa_procesal' => $request->etapa_procesal,
            'fecha_fin' => $request->fecha_fin,
            'usuario' => $usuario,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('casos.index')->with('success', 'Caso actualizado exitosamente.');
    }



    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $cliente = Caso::findOrFail($id);
        $cliente->delete();

        return redirect('/casos')->with('success', 'User has been deleted');
    }
    public function updateStatus(Request $request)
    {
        $cliente = Caso::findOrFail($request->input('id'));
        $cliente->estado = $request->input('estado');
        $cliente->save();

        return response()->json(['success' => true]);
    }
    public function obtenerCliente($id)
    {
        $cliente = \App\Models\Cliente::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        return response()->json([
            'rut' => $cliente->rut,
            'email' => $cliente->email,
            'telefono' => $cliente->telefono,
            'representante' => $cliente->representante,
            'domicilio' => $cliente->domicilio,
        ]);
    }
    public function obtenerDemandante($id)
    {
        $cliente = \App\Models\Demandante::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        return response()->json([
            'empresa_demandante' => $cliente->empresa_demandante,
            'rut_demandante' => $cliente->rut_demandante,
            'email_demandante' => $cliente->email_demandante,
            'telefono_demandante' => $cliente->telefono_demandante,
            'representante_demandante' => $cliente->representante_demandante,
            'domicilio_demandante' => $cliente->domicilio_demandante,
        ]);
    }
}
