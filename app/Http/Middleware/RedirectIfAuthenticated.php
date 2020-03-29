<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

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

            return redirect(//Si el usuario autenticado es admin redirige al dashboard de admin, de lo contrario al home de postulante
                $request->isAdmin() ? RouteServiceProvider::ADMIN : RouteServiceProvider::HOME
            );
        }

        return $next($request);
    }
}
