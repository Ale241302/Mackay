<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        \Log::info('Usuario autenticado', ['user' => $user]);

        if ($user->estado !== 'Activo') {
            Auth::logout();
            \Log::info('Usuario desactivado intentó acceder', ['user_id' => $user->id]);
            return redirect('/login')->withErrors([
                'estado' => 'Tu cuenta no está activa. Por favor, contacta al administrador.',
            ]);
        }
    }
}
