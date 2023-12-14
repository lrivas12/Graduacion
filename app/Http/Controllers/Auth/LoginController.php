<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $email = 'email';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function email()
    {
        return 'email';
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        if ($this->guard()->attempt($credentials + ['estado' => 1], $request->filled('remember'))) {
            return true;
        }
    
        // Verifica si las credenciales son incorrectas
        if (!$this->guard()->validate($credentials)) {
            throw ValidationException::withMessages([
                $this->email() => [trans('auth.failed')],
            ]);
        }
    
        // Verifica si el usuario está inactivo
        if ($this->guard()->validate(['email' => $request->email, 'password' => $request->password])) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.inactive')],
            ]);
        }
    
        // En este punto, las credenciales son correctas, pero el usuario está inactivo
        // Podrías lanzar una excepción específica si deseas manejar esto de manera diferente.
    
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
}
