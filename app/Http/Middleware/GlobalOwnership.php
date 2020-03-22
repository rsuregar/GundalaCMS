<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class GlobalOwnership
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
            $getRoute = explode('.', \Route::currentRouteName())[0];
            $cek = $request->route($getRoute);
            if($cek->author == Auth::id() || Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
                return $next($request);
            }
        }
        abort(403, 'Anda tidak memiliki akses.');
    }
}
