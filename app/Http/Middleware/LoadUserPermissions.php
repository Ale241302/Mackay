<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\UserGroup;

class LoadUserPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Verificar si el usuario tiene el estado 'Activo'
            if ($user->estado !== 'Activo') {
                // Usar el guard web para cerrar la sesión correctamente
                Auth::guard('web')->logout();

                return redirect('/login')->withErrors([
                    'estado' => 'Tu cuenta no está activa. Por favor, contacta al administrador.',
                ]);
            }

            // Cargar los permisos basados en el grupo de usuarios
            $userGroup = UserGroup::find($user->tipo_usuario);

            if ($userGroup) {
                $permisosUsuario = $userGroup->permisos ? json_decode($userGroup->permisos, true) : [];
            } else {
                $permisosUsuario = [];
            }

            // Compartir los permisos con las vistas
            View::share('permisosUsuario', $permisosUsuario);
        }

        return $next($request);
    }
}
