<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;
use App\Http\Middleware\LoadUserPermissions;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TipoCasoController;
use App\Http\Controllers\TipoProcesalController;
use App\Http\Controllers\MontoHoraController;
use App\Http\Controllers\TribunalController;
use App\Http\Controllers\TipoActividadController;
use App\Http\Controllers\AbogadoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DemandanteController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\SubCasoController;
use App\Http\Controllers\DocumentController;
use App\Models\Demandante;

// Ruta principal
Route::get('/', function () {
    return redirect()->route('login'); // Cambia 'login' por el nombre de tu ruta de login
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    LoadUserPermissions::class,
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('usergroups', UserGroupController::class);
    Route::get('usergroups/create', [UserGroupController::class, 'create'])->name('usergroups.create');
    Route::get('usergroups/edit/{id}', [UserGroupController::class, 'edit'])->name('usergroups.edit');
    Route::get('usergroups/edit2/{id}', [UserGroupController::class, 'edit2'])->name('usergroups.ver');
    Route::resource('usuario', UserController::class);
    Route::get('usuario/create', [UserController::class, 'create'])->name('usuario.create');
    Route::get('usuario/edit/{id}', [UserController::class, 'edit'])->name('usuario.edit');
    Route::put('usuario/update/{id}', [UserController::class, 'update'])->name('usuario.update');
    Route::post('/usuario/update-status', [UserController::class, 'updateStatus'])->name('usuario.updateStatus');
    Route::resource('abogados', AbogadoController::class);
    Route::get('abogados/create', [AbogadoController::class, 'create'])->name('abogados.create');
    Route::get('abogados/edit/{id}', [AbogadoController::class, 'edit'])->name('abogados.edit');
    Route::put('abogados/update/{id}', [AbogadoController::class, 'update'])->name('abogados.update');
    Route::post('/abogados/update-status', [AbogadoController::class, 'updateStatus'])->name('abogados.updateStatus');
    Route::resource('clientes', ClienteController::class);
    Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::get('clientes/edit/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('clientes/update/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::post('/clientes/update-status', [ClienteController::class, 'updateStatus'])->name('clientes.updateStatus');
    Route::get('/clientes/ciudades/{paisId}', [ClienteController::class, 'obtenerCiudades']);
    Route::resource('demandantes', DemandanteController::class);
    Route::get('demandantes/create', [DemandanteController::class, 'create'])->name('demandantes.create');
    Route::get('demandantes/edit/{id}', [DemandanteController::class, 'edit'])->name('demandantes.edit');
    Route::put('demandantes/update/{id}', [DemandanteController::class, 'update'])->name('demandantes.update');
    Route::resource('casos', CasoController::class);
    Route::get('casos/create', [CasoController::class, 'create'])->name('casos.create');
    Route::get('casos/edit/{id}', [CasoController::class, 'edit'])->name('casos.edit');
    Route::get('casos/edit2/{id}', [CasoController::class, 'edit2'])->name('casos.ver');
    Route::put('casos/update/{id}', [CasoController::class, 'update'])->name('casos.update');
    Route::post('/casos/update-status', [CasoController::class, 'updateStatus'])->name('casos.updateStatus');
    Route::get('/casos/ciudades/{paisId}', [CasoController::class, 'obtenerCiudades']);
    Route::get('/casos/clientes/{id}', [CasoController::class, 'obtenerCliente'])->name('casos.obtener');
    Route::get('/casos/demandante/{id}', [CasoController::class, 'obtenerDemandante'])->name('casos.obtener');
    Route::resource('tipocaso', TipoCasoController::class);
    Route::get('tipocaso/create', [TipoCasoController::class, 'create'])->name('tipocaso.create');
    Route::get('tipocaso/edit/{id}', [TipoCasoController::class, 'edit'])->name('tipocaso.edit');
    Route::resource('tipoprocesal', TipoProcesalController::class);
    Route::get('tipoprocesal/create', [TipoProcesalController::class, 'create'])->name('tipoprocesal.create');
    Route::get('tipoprocesal/edit/{id}', [TipoProcesalController::class, 'edit'])->name('tipoprocesal.edit');
    Route::resource('montohora', MontoHoraController::class);
    Route::get('montohora/create', [MontoHoraController::class, 'create'])->name('montohora.create');
    Route::get('montohora/edit/{id}', [MontoHoraController::class, 'edit'])->name('montohora.edit');
    Route::resource('tribunal', TribunalController::class);
    Route::get('tribunal/create', [TribunalController::class, 'create'])->name('tribunal.create');
    Route::get('tribunal/edit/{id}', [TribunalController::class, 'edit'])->name('tribunal.edit');
    Route::resource('tipoactividad', TipoActividadController::class);
    Route::get('tipoactividad/create', [TipoActividadController::class, 'create'])->name('tipoactividad.create');
    Route::get('tipoactividad/edit/{id}', [TipoActividadController::class, 'edit'])->name('tipoactividad.edit');
    Route::post('/casos/update-documento', [DocumentController::class, 'subirArchivo']);
    Route::post('/casos/crear-carpeta', [DocumentController::class, 'createFolder']);
    Route::post('/casos/eliminar-documento', [DocumentController::class, 'eliminarArchivo']);
    Route::resource('subcasos', SubCasoController::class);
    Route::get('subcasos/create', [SubCasoController::class, 'create'])->name('subcasos.create');
    Route::get('subcasos/create2/{id}', [SubCasoController::class, 'create2'])->name('subcasos.create2');
    Route::get('subcasos/edit/{id}', [SubCasoController::class, 'edit'])->name('subcasos.edit');
    Route::get('subcasos/edit2/{id}', [SubCasoController::class, 'edit2'])->name('subcasos.ver');
    Route::put('subcasos/update/{id}', [SubCasoController::class, 'update'])->name('subcasos.update');
    Route::post('/subcasos/update-status', [SubCasoController::class, 'updateStatus'])->name('subcasos.updateStatus');
    Route::get('/subcasos/ciudades/{paisId}', [SubCasoController::class, 'obtenerCiudades']);
    Route::get('/subcasos/clientes/{id}', [SubCasoController::class, 'obtenerCliente'])->name('subcasos.obtener');
    Route::get('/subcasos/demandante/{id}', [SubCasoController::class, 'obtenerDemandante'])->name('subcasos.obtener');
    Route::post('/subcasos/update-documento', [DocumentController::class, 'subirArchivo']);
    Route::post('/subcasos/eliminar-documento', [DocumentController::class, 'eliminarArchivo']);
    Route::post('/subcasos/crear-carpeta', [DocumentController::class, 'createFolder']);
});
Route::get('forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
