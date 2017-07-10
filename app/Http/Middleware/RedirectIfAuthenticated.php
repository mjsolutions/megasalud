<?php

namespace MegaSalud\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(\Auth::user()->tipo_usuario == 'Administrador'){
                return redirect('/admin');                
            }elseif(\Auth::user()->tipo_usuario == 'Medico'){
                return redirect('/medico');                
            }
            return redirect('/sucursal');
        }

        return $next($request);
    }
}
