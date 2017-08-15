<?php

namespace App\Http\Middleware;

use Closure;

class MDPurchaseUser
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

        
        if (($user->role_id == 3) && ($user->role_id == 4)){
          flash("No tiene autorización para acceder a esta sección." , 'danger')->important();
          return redirect()->route('noAutorizhed');
        }
     

        return $next($request);
      
    }
}
