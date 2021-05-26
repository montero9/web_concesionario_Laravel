<?php

namespace App\Http\Middleware;

use Closure;

class Localization
{
    /**
     * Recoge de una variable de sessión 'locale' el idioma
     * y se lo aplica a la aplicación
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Session::has('locale')){
            \App::setlocale(\Session::get('locale'));
        }
        return $next($request);
    }
}
