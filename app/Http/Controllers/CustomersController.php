<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{

    /**
     * Función para validar los campos del formulario
     * @param Request $request
     */
    public function validar_formulario(Request $request){
        //Validamos los diferentes campos del formulario
        $request->validate([
            'dni' => 'required|max:20',
            'nombre' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required',
            'direccion' => 'required',
            'localidad' => 'required',
            'cod_postal' => 'required',
            'provincia' => 'required',
            'pais' => 'required',
            'email' => 'required | email',
            'telefono' => 'required | integer',
            'fecha_registro' => 'required',
            'observaciones' =>'max:200'
        ]);
    }

    /**
     * Función que añade o actualiza los datos de un cliente en la bd
     * @param Request $request
     */
    public function guardarDatos(Request $request){

        //Utilizamos la función para validar los campos del formulario
        $this->validar_formulario($request);

        //Comprobamos si viene añadir un cliente o actualizar
        if(!isset($request->id_cliente) ) {
            //Añadimos un cliente
            DB::table('clientes')
                ->insert(
                    ['dni' => $request->dni,
                        'nombre' => $request->nombre,
                        'apellidos' => $request->apellidos,
                        'fecha_nacimiento' => $request->fecha_nacimiento,
                        'direccion' => $request->direccion,
                        'localidad' => $request->localidad,
                        'cod_postal' => $request->cod_postal,
                        'provincia' => $request->provincia,
                        'pais' => $request->pais,
                        'email' => $request->email,
                        'telefono' => $request->telefono,
                        'fecha_registro' => $request->fecha_registro,
                        'observaciones' => $request->observaciones
                    ]);
        }else{
            //Actualizamos un cliente ya existente
            DB::table('clientes')
                ->where('id_cliente','=',$request->id_cliente)
                ->update(
                    ['dni' => $request->dni,
                        'nombre' => $request->nombre,
                        'apellidos' => $request->apellidos,
                        'fecha_nacimiento' => $request->fecha_nacimiento,
                        'direccion' => $request->direccion,
                        'localidad' => $request->localidad,
                        'cod_postal' => $request->cod_postal,
                        'provincia' => $request->provincia,
                        'pais' => $request->pais,
                        'email' => $request->email,
                        'telefono' => $request->telefono,
                        'fecha_registro' => $request->fecha_registro,
                        'observaciones' => $request->observaciones
                    ]);
        }
    }

    /**
     * Obtiene un listado de todos los paises
     * @return mixed
     */
    public function getCountriesName(){
        //Url y petición de la api rest con los países
        $url_countries="https://serviauto.s3.eu-west-3.amazonaws.com/json_paises";
        $jsonData = file_get_contents($url_countries);

        //Devuleve los datos como un objeto
        return $datos=json_decode($jsonData);
    }

//-----------------------------------------------------------------------------------------------

    /**
     * Obtiene todos los clientes de la bd
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function getCustomers(){
        //Obtenemos los datos de los clientes
        $clientes=DB::select("SELECT * FROM clientes");
        //Cargamos la vista pasandole el listado de clientes.
        return view('customers.customersList', compact('clientes'));
    }

    /**
     * Muestra el formulario para añdir un nuevo cliente
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFormCustomer(){

        //Obtenemos los datos de los paises
        $datos = $this->getCountriesName();

        return view('customers.showFormCustomer', compact('datos'));
    }

    /**
     * Recoge los datos el formulario y añade al nuevo cliente
     * @param Request $request
     * @return mixed
     */
    public function addCustomer(Request $request){


        //Validamos y guardamos los datos en la bd
        $this->guardarDatos($request);

        //Volvemos a la anterior página con el mesanje de confirmación
        return back()->withSuccess(__('Customer Added Successfully'));
    }


    public function showUpdateCustomer($id_cliente){

        //Obtenemos los datos de los paises
        $datos = $this->getCountriesName();

        //Obtenemos la ruta para eliminar la imagen del almacenamiento AWS S3
        $datos_cliente= DB::table('clientes')
            ->select('*')
            ->where('id_cliente','=',$id_cliente)
            ->get();

        return view('customers.showFormCustomer',compact('datos_cliente','datos'));

    }

    /**
     * Recoge los datos de un formulario, los valida y los guarda en la bd
     * @param Request $request
     * @return mixed
     */
    public function updateCustomer(Request $request){

        //Validamos y guardamos los datos en la bd
        $this->guardarDatos($request);

        //Retornamos un mensaje de éxito
        return back()->withSuccess(__('Customer Update Successfully'));

    }

    /**
     * Elimina de la bd el usuario pasado por parámetro
     * @param $id_modelo
     * @return mixed
     */
    public function deleteCustomer($id_modelo){
        //Eliminamos el registro de la bd
        DB::table('clientes')
            ->where('id_cliente', '=', $id_modelo)
            ->delete();

        //Si ha ido bien, devolvemos a la página anterior junto con un mensaje para mostrar
        return back()->withSuccess(__('Customer Delete Successfully'));
    }


}
