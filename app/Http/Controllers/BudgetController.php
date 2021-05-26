<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Cliente;
use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use PDF;

class BudgetController extends Controller
{

    /**
     * Permite obtener los detalles de un presupuesto recibido por parámetros
     * @param $id_budget
     * @return \Illuminate\Support\Collection
     */
    public function getDetailsBudget($id_budget){

        //Consulta para obtener los datos de un presupuesto
        $detalles_presupuesto = DB::table('budgets as bud')
            ->select('bud.precio_total as precio_total','cli.nombre as cliente_nombre','cli.apellidos as cliente_apellidos',
                'cli.direccion as direccion','cli.cod_postal as cliente_cod_postal','cli.localidad as localidad','cli.provincia as provincia','cli.pais as pais',
                'cli.telefono as telefono','us.name as nombre_empleado','bud.id as budget_id','bud.fecha_presupuesto as fecha_presupuesto',
                'us.email as email_empleado')
            ->join('clientes as cli','bud.cliente_id','=','cli.id_cliente')
            ->join('users as us','bud.user_id','=','us.id')
            ->where('bud.id','=',$id_budget)
            ->get();

        //Retornamos los datos de un presupuesto
        return $detalles_presupuesto;
    }

    /**
     * Permite obtener los vehiculos de un presupuesto pasado como parámetro
     * @param $id_budget
     * @return \Illuminate\Support\Collection
     */
    public function getDetailsVehiculos($id_budget){

        //Obtenemos de la bd todos los vehiculos que conforman un presupuesto
        $detalles_vehiculos = DB::table('budget_vehiculo as bv')
            ->select('mo.image', 'mo.nombre_modelo', 'veh.matricula', 'veh.caballos', 'veh.tipo_cambio', 'veh.combustible', 'veh.color', 'veh.precio')
            ->join('vehiculos as veh','veh.id_vehiculo','=','bv.vehiculo_id')
            ->join('modelos as mo','mo.id_modelo','=','veh.modelo_id')
            ->where('bv.budget_id','=',$id_budget)
            ->get();

        //Devolvemos los vehiculos y sus datos
        return $detalles_vehiculos;
    }


    //-----------------------------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------------------------------------------------


    /**
     * Obtiene un listado de todos los presupuestos y se los pasa la vista
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showListBudget(){

        //Mediante query builder creamos una consulta para obtener el listad de presupuestos y sus detalles
       $budgets= DB::table('budgets AS bud')
                ->select('bud.id as budget_id', 'us.name as nombre_vendedor' ,'cli.nombre as cliente_nombre',
                                    'cli.apellidos as cliente_apellidos','bud.fecha_presupuesto as fecha_presupuesto',
                                    'bud.precio_total AS precio_total','us.id AS id_vendedor','cli.id_cliente AS id_cliente')
                ->join('clientes as cli','bud.cliente_id','=','cli.id_cliente')
                ->join('users as us','us.id','=','bud.user_id')
                ->get();

       //Devolvemos los detalles a la vista
        return view('budge.listadoBudget',compact('budgets'));
    }

    /**
     * Carga datos de la bd y muestra el formulario para añadir un nuevo presupuesto
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFormBudget(){

        //Obtenemos los datos de todos los clientes
        $clientes = DB::table('clientes')
            ->select('*')
            ->get();

        //Obtenemos los datos de los vehiculos que no están vendidos
        $vehiculos=DB::table('vehiculos')
            ->join('modelos','vehiculos.modelo_id','=','modelos.id_modelo')
            ->where('vehiculos.venta_id','=',NULL)
            ->get();

        //Cargamos la vista y le pasamos los datos
        return view('budge.showFormBudge',compact('clientes','vehiculos'));
    }

    /**
     * Añade un presupuesto a la tabla budgets y a la tabla budget_vehiculo
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addBudget(Request $request)
    {

        //Comprobamos que se ha seleccionado un cliente y al menos un vehiculo
        if ($_GET['oculto_id_vehiculo'] != '' && $_GET['oculto_user_id'] != '') {
            //Registramos la venta en su tabla y cogemos el id que se define
            $id_budget = DB::table('budgets')
                ->insertGetId(
                    ['user_id' => auth()->user()->id,
                        'cliente_id' => $request->oculto_user_id,
                        'precio_total' => $request->oculto_precio_total,
                        'fecha_presupuesto' => date('Y-m-d')
                    ]);

            //Recogemos como cadena los id de todos los vehículos y los separamos en un array
            $id_vehiculos = explode(" ", $request->oculto_id_vehiculo);

            //Añadimos en cada vehículo la venta a la que pertence
            foreach ($id_vehiculos as $id_vehiculo) {
                //Guardamos en el vehículo correspondiente el id de la venta a la que pertenece
                DB::table('budget_vehiculo')
                    ->insert(['budget_id' => $id_budget,
                        'vehiculo_id' => $id_vehiculo
                    ]);
            }

            //Mostramos un sweet alert con la confirmación
            Alert::success(__('Successful Operation'), __('Budget Registered Correctly'))->autoclose(2000);

            //Se redirecciona a la página con los detalles
            return redirect('presupuesto/' . $id_budget);
        }
    }

    /**
     * Permite mostrar los detalles de un presupuesto
     * @param $id_budget
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getBudgetDetails($id_budget){

        //Obtenemos los datos del presupuesto y los vehículos que lo conforman
        $detalles_presupuesto = $this->getDetailsBudget($id_budget);
        $detalles_vehiculos = $this->getDetailsVehiculos($id_budget);

        //Cargamos la vista y le pasamos los datos
        return view('budge.budgetDetails', compact('detalles_presupuesto','detalles_vehiculos'));
    }

    /**
     * Permite imprimer en pdf el presupuesto
     * @param $id_budget
     * @return mixed
     */
    public function printPDF($id_budget){

        //Obtenemos los datos del presupuesto y los vehículos que lo conforman
        $detalles_presupuesto = $this->getDetailsBudget($id_budget);
        $detalles_vehiculos = $this->getDetailsVehiculos($id_budget);

        //Creamos un elemento PDF y le pasamos lo datos y la vista
        $pdf = PDF::loadView('pdf_template/budgetpdf', compact('detalles_presupuesto','detalles_vehiculos'));
        //Descargamos la factura automaticamente
        return $pdf->download('factura-serviauto-#'.$id_budget.'.pdf');

    }

}
