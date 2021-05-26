<?php

namespace App\Http\Controllers;


use App\User;
use App\Venta;
use Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class IndexController extends Controller
{
    /**
     * Comprobamos si el usuario está logeado para redirigir a index o al login
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        //Comprobamos si el usuario está logeado
        if(Auth::check()){
            //Obtenemos las ventas para el gráfico
            $meses = DB::select(DB::raw("
                                           SELECT COUNT(fecha_venta) AS 'totalventas', MONTHNAME(fecha_venta) AS 'mes',
                                           MONTH(fecha_venta) AS 'mes_numero'
                                           FROM ventas
                                           GROUP BY MONTHNAME(fecha_venta), MONTH(fecha_venta)
                                           ORDER BY 3
                                           LIMIT 12;
                                        "));

            //Cargamos la vista y le pasamos las ventas
            return view('home',compact('meses'));
        }else{
            //Redirigimos al login
            return view('auth.login');
        }

    }
}
