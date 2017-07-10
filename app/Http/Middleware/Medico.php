<?php

namespace MegaSalud\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Medico
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::guard($guard)->user()->isMedico()) {
            return $next($request);
        }else{
            return redirect()->back()->withErrors(array('message' => 'No tienes permisos para acceder a esta ruta'));
        }
    }
}