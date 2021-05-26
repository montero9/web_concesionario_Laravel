<?php

namespace App\Http\Controllers;

use App\User;
use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Alert;
use PDF;

class VentasController extends Controller
{

    /**
     * Obtiene el cliente y los coches de una venta que recibe como parámetro
     * @param $id_venta
     * @return array
     */
        public function getCustomerSaleCars($id_venta){

            //Obtengo los detalles de la venta
            $detalles_venta = DB::table('ventas as vent')
                ->select('vent.id AS id_venta', 'vend.name AS vendedor_name', 'vend.email AS vendedor_email', 'vent.cliente_id AS cliente_id','cli.nombre AS cliente_nombre','cli.apellidos AS cliente_apellidos',
                    'vent.fecha_venta As fecha_venta', 'vend.id AS user_id', 'cli.direccion AS cliente_direccion',
                    'cli.localidad AS cliente_localidad', 'cli.provincia AS cliente_provincia', 'cli.cod_postal AS cliente_cod_postal', 'cli.pais AS cliente_pais',
                    'cli.telefono AS cliente_telefono', 'vent.precio_total AS precio_total')
                ->join('users as vend','vent.user_id','=','vend.id')
                ->join('clientes as cli','vent.cliente_id','=','cli.id_cliente')
                ->where('vent.id','=',$id_venta)
                ->get();

            //Obtengo los datos del vehículo/s que pertenecen a la venta
            $detalles_vehiculos = DB::table('vehiculos')
                ->join('modelos','vehiculos.modelo_id','=','modelos.id_modelo')
                ->where('vehiculos.venta_id','=',$id_venta)
                ->get();

            return [$detalles_vehiculos,$detalles_venta];

        }

    /**
     * Permite obtener las ventas del usuario actual
     * @param $id_user identificador del usuario
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getVentasUser(){

        //Obtengo el id del usuario que está logeado
        $id = Auth::user()->id;
        //Realizo una consulta para obtener sus ventas
        $ventas = DB::table('ventas as vent')
            ->select('vent.id AS id_venta','vend.name AS vendedor_name','vent.fecha_venta AS fecha_venta','vend.id AS user_id','vent.precio_total AS precio_total','cli.nombre AS cliente_nombre','cli.apellidos AS cliente_apellidos','cli.id_cliente AS cliente_id')
            ->join('users as vend','vent.user_id','=','vend.id')
            ->join('clientes as cli','vent.cliente_id','=','cli.id_cliente')
            ->where('vend.id','=',$id)
            ->get();

        //Cargo la vista con los datos obtenidos
        return view('sales.listadoVentas',compact('ventas'));
    }

    /**
     * Permite obtener todas las ventas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllVentas(){

        //Consulta para obtener todas las ventas
        $ventas = DB::table('ventas as vent')
            ->select('vent.id AS id_venta', 'vend.name AS vendedor_name', 'vent.fecha_venta AS fecha_venta','vend.id AS user_id','vent.precio_total AS precio_total', 'cli.nombre AS cliente_nombre','cli.apellidos AS cliente_apellidos', 'cli.id_cliente AS cliente_id')
            ->join('users as vend','vent.user_id','=','vend.id')
            ->join('clientes as cli','vent.cliente_id','=','cli.id_cliente')
            ->get();

        //Cargamos la vista y le pasamos los datos
        return view('sales.listadoVentas',compact('ventas'));
    }

    /**
     * Obtiene los datos de una venta concreta
     * @param $id_venta
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSaleDetails($id_venta){

        //Obtenemos los datos de la venta (cliente y coches)
        $detalles_vehiculos = $this->getCustomerSaleCars($id_venta)[0];
        $detalles_venta = $this->getCustomerSaleCars($id_venta)[1];

       //Cargo la vista y le paso los detalles de la venta y los vehiculos de dicha venta
        return view('sales.saleDetails', compact('detalles_venta','detalles_vehiculos'));
    }

    /**
     * Carga la vista del formulario y le pasa datos de los clientes y vehículos
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFormSale(){

        //Obtenemos los datos de los cliente
        $clientes = DB::table('clientes')
                    ->select('*')
                    ->get();


        //Obtenemos los datos de los vehiculos que no están vendidos
        $vehiculos=DB::table('vehiculos')
            ->join('modelos','vehiculos.modelo_id','=','modelos.id_modelo')
            ->where('vehiculos.venta_id','=',NULL)
            ->get();

        //Retornamos la vista del formulario con los datos de los clientes y los vehículo
        return view('sales.showFormSaleBudge',compact('clientes','vehiculos'));
    }

    /**
     * Permite guardar los datos de una venta y sus vehiculos
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addSale(Request $request){

        //Comprobamos que se ha seleccionado un cliente y al menos un vehiculo
        if($_GET['oculto_id_vehiculo'] != '' && $_GET['oculto_user_id'] !='') {
            //Registramos la venta en su tabla y cogemos el id que se define
            $id_venta = DB::table('ventas')
                ->insertGetId(
                    ['user_id' => auth()->user()->id,
                        'cliente_id' => $request->oculto_user_id,
                        'precio_total' => $request->oculto_precio_total,
                        'fecha_venta' => date('Y-m-d')
                    ]);

            //Recogemos como cadena los id de todos los vehículos y los separamos en un array
            $id_vehiculos = explode(" ", $request->oculto_id_vehiculo);

            //Añadimos en cada vehículo la venta a la que pertence
            foreach ($id_vehiculos as $id_vehiculo) {
                //Guardamos en el vehículo correspondiente el id de la venta a la que pertenece
                DB::table('vehiculos')
                    ->where('id_vehiculo', $id_vehiculo)
                    ->update(['venta_id' => $id_venta]);
            }

            //Mostramos un sweet alert con la confirmación
            Alert::success(__('Successful Operation'), __('Sale Registered Correctly'))->autoclose(2000);

            //Se redirecciona a la página anterior
            return redirect('venta/' . $id_venta);
        }
        //En caso de error mostramos el error
        Alert::error(__('You must add a customer and at least one vehicle'), __('Something went wrong!'))->persistent('OK');
        return back();
    }

    /**
     * Genera el pdf de una factura de venta
     * @param $id_venta
     * @return mixed
     */
    public function printPDF($id_venta){

        //Obtenemos los datos de la venta (cliente y coches)
        $detalles_vehiculos = $this->getCustomerSaleCars($id_venta)[0];
        $detalles_venta = $this->getCustomerSaleCars($id_venta)[1];

        //Creamos un elemento PDF y le pasamos lo datos y la vista
        $pdf = PDF::loadView('pdf_template/pdf_view', compact('detalles_vehiculos','detalles_venta'));
        //Descargamos la factura automaticamente
        return $pdf->download('factura-serviauto-#'.$id_venta.'.pdf');
    }

}
