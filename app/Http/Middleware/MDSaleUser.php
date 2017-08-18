<?php

namespace App\Http\Middleware;

use Closure;

class MDSaleUser
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
        
         $user=\Auth::user();

        
        if (($user->role->name=='Encargado de Pedidos') || ($user->role->name == 'Encargado de Compras')){
          flash("No tiene autorización para acceder a esta sección." , 'danger')->important();
          return redirect()->route('noAutorizhed');
        }

        return $next($request);
    }
}
