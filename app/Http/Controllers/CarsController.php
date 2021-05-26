<?php

namespace App\Http\Controllers;

use App\Modelo;
use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarsController extends Controller
{

    /**
     * Función para validar los campos del formulario
     * @param Request $request
     */
    public function validar_formulario(Request $request){
        //Validamos los diferentes campos del formulario
        $request->validate([
            'model_id' => 'required',
            'licencese_plate' => 'required',
            'horsepower' => 'required | integer',
            'doors' => 'required | integer',
            'transmission' => 'required',
            'fuel' => 'required',
            'colour' => 'required',
            'price' => 'required'
        ]);
    }

    /**
     * Función que añade o actualiza los datos de un vehiculo en la bd
     * @param Request $request
     */
    public function guardarDatos(Request $request){

        //Utilizamos la función para validar los campos del formulario
        $this->validar_formulario($request);

        if(!isset($request->car_id)){
            //Añadimos un vehículo
            DB::table('vehiculos')
                ->insert(
                    ['modelo_id'=>$request->model_id,
                        'matricula'=>$request->licencese_plate,
                        'caballos'=>$request->horsepower,
                        'puertas'=>$request->doors,
                        'tipo_cambio'=>$request->transmission,
                        'combustible'=>$request->fuel,
                        'color'=>$request->colour,
                        'fecha_registro'=>date('Y-m-d'),
                        'precio'=>$request->price
                    ]);
        }else{
            //Actualizamos un vehículo
            DB::table('vehiculos')
                ->where('id_vehiculo','=',$request->car_id)
                ->update(
                    ['modelo_id'=>$request->model_id,
                        'matricula'=>$request->licencese_plate,
                        'caballos'=>$request->horsepower,
                        'puertas'=>$request->doors,
                        'tipo_cambio'=>$request->transmission,
                        'combustible'=>$request->fuel,
                        'color'=>$request->colour,
                        'fecha_registro'=>date('Y-m-d'),
                        'precio'=>$request->price
                    ]);
        }


    }

    /**
     * Permite obtener el listado de modelos
     * @return \Illuminate\Support\Collection
     */
    public function getModelos(){

        //Obtenemos de la bd los modelos ya registrados
        return DB::table('modelos')
            ->select('id_modelo','nombre_modelo')->get();
    }

//-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------

    /**
     * Obtiene el listado de vehiculo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCars(){

        //Obtenemos los datos de los vehiculos
        $vehiculos=DB::table('vehiculos as ve')
            ->join('modelos as mo','ve.modelo_id','=','mo.id_modelo')
            ->get();

        //Cargamos la vista y le devolvemos los datos obtenidos
        return view('cars.carList', compact('vehiculos'));
    }

    /**
     * Muestra el formulario para añadir/actualizar vehículo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFormCar(){

        //Obtenemos el listado de modelos
        $modelos= $this->getModelos();

        //Cargamos la vista pasandole los modelos que hay en la bd
        return view('cars.showFormCar',compact('modelos'));
    }


    /**
     * Guarda un nuevo vehículo en la bd
     * @param Request $request
     * @return mixed
     */
    public function addCar(Request $request){

        //Llama al método que inserta los datos en la bd
        $this->guardarDatos($request);

        //Volvemos a la anterior página con el mesanje de confirmación
        return back()->withSuccess(__('Car Added Successfully'));

    }

    /**
     * Permite mostrar el formulario para actualizar un vehículo
     * @param $id_vehiculo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUpdateCar($id_vehiculo){

        //Obtenemos el listado de modelos
        $modelos= $this->getModelos();

        //Obtengo del vehículo recibido como parámetro
        $datos_vehiculo= DB::table('vehiculos')
            ->select('*')
            ->where('id_vehiculo','=',$id_vehiculo)
            ->get();

        //Devolvemos a la vista los datos.
        return view('cars.showFormCar',compact('datos_vehiculo','modelos'));
    }


    /**
     * Permite actualizar un coche
     * @param Request $request
     * @return mixed
     */
    public function updateCustomer(Request $request){

        //Validamos y guardamos los datos en la bd
        $this->guardarDatos($request);

        //Retornamos un mensaje de éxito
        return back()->withSuccess(__('Car Update Successfully'));

    }

    /**
     * @param $id_vehiculo
     * @return mixed
     */
    public function deleteCustomer($id_vehiculo){
        //Eliminamos el registro de la bd
        DB::table('vehiculos')
            ->where('id_vehiculo', '=', $id_vehiculo)
            ->delete();

        //Si ha ido bien, devolvemos a la página anterior junto con un mensaje para mostrar
        return back()->withSuccess(__('Car Delete Successfully'));
    }

    /**
     * Recurso para obtener el listado de los vehiculos disponibles
     * @return \Illuminate\Support\Collection
     */
    public function index(){

        //Obtenemos todos los vehículos excepto los vendidos
        $vehiculos=DB::table('vehiculos as ve')
            ->where('venta_id','=',NULL)
            ->join('modelos as mo','ve.modelo_id','=','mo.id_modelo')
            ->get();

        //Devolvemos los datos
        return $vehiculos;
    }

}
