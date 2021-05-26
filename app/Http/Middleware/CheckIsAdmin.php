<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{
    /**
     * Permite acceso a register solo administradores
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        //Comprobamos que el usuario está logeado y es administrador
        if(Auth::check()){
            if(Auth::user()->role == "admin"){
                return $next($request);
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/login');
        }
    }
}
