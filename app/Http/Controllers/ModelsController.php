<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ModelsController extends Controller
{
    //Método para obtener el listado de todos los modelos
    public function getModels(){

        //Consultamos todos los modelos de la bd
        $modelos=DB::select("SELECT * FROM modelos");

        //Devolvemos la vista y los datos obtenidos
        return view('models.modelsList',compact('modelos'));
    }

    /**
     * Carga la vista para crear un modelo de vehiculo nuevo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFormModel(){
        return view('models.showFormModel');
    }


    /**
     * Permite añadir un nuevo modelo, añadiendo al a tabla modelo un registro
     * y subiendo la imagen a Amazon Web Services S3
     * @param Request $request
     * @return mixed
     */
    public function addModel(Request $request){

        //Validamos los diferentes campos del formulario
        request()->validate([
            'model_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'model_name' => 'required',
            'observations' => 'required',
            'model_date' => 'required'
        ]);

        /*Comprobamos que está el archivo que se ha añadido al formulario y subimos
        la imagen a AWS S3 */
        if ($request->hasFile('model_image')) {
            $file = $request->file('model_image');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'images/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));

            //Guardamos en la base de datos los detalles del modelo y la url de la imagen
            DB::table('modelos')->insert([
                ['nombre_modelo'=>$request->model_name,
                 'observaciones'=>$request->observations,
                 'fecha_modelo'=>$request->model_date,
                 'image'=>$name
                ]
            ]);
        }

        //Volvemos a la anterior página con el mesanje de confirmación
        return back()->withSuccess(__('Model Added Successfully'));

    }

    /**
     * Permite eliminar de la bd un modelo recibido como parármetro y
     * el archivo de la imagen almacenado en amazon web service
     * @param $id_modelo
     * @return mixed
     */
    public function deleteModel($id_modelo){

        //Obtenemos la ruta para eliminar la imagen del almacenamiento AWS S3
        $path= DB::table('modelos')
                                ->select('image')
                                ->where('id_modelo','=',$id_modelo)
                                ->get();

        //Eliminamos la imagen del almacenamiento de amazon
        if(Storage::disk('s3')->exists('images/'.$path[0]->image)) {
            Storage::disk('s3')->delete('images/'.$path[0]->image);
        }

        //Eliminamos el registro de la bd
        DB::table('modelos')->where('id_modelo', '=', $id_modelo)->delete();

        //Si ha ido bien, devolvemos a la página anterior junto con un mensaje para mostrar
        return back()->withSuccess(__('Model Delete Successfully'));
    }

    /**
     * Carga datos de la bd y se lo devuelve a una vista
     * @param $id_modelo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUpdateModel($id_modelo){

        //Cargo los datos del usuario recibido
        $datos_modelo= DB::table('modelos')
            ->select('*')
            ->where('id_modelo','=',$id_modelo)
            ->get();

        //Cargo la vista pasandole los datos que hay en la bd del modelo
        return view('models.showFormModel', compact('datos_modelo'));
    }

    /**
     * Método que permite actualizar un modelo
     * @param Request $request
     * @return mixed
     * @author Antonio Montero Pérez
     */
    public function updateModel(Request $request){

        //Validamos los diferentes campos del formulario
        /*En este caso la imagen no tiene porque ser obligatoria, ya que la hablemos
        subido antes cuando creamos e nuevo modelo, pero lo demás si*/
        request()->validate([
            'model_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'model_name' => 'required',
            'observations' => 'required',
            'model_date' => 'required'
        ]);

        /*Comprobamos si ha puesto un nueva imagen, en caso afirmativo
        eliminamos la antigua del hosting, subimos la nueva y actualizamos la bd*/
        if(isset($request->model_image)) {

            //Obtenemos la ruta de la imagen antigua
            $path = DB::table('modelos')
                ->select('image')
                ->where('id_modelo', '=', $request->model_id)
                ->get();

            //Y si existe la imagen antigua, la eliminamos
            if (Storage::disk('s3')->exists('images/' . $path[0]->image)) {
                Storage::disk('s3')->delete('images/' . $path[0]->image);
            }

            //Comprobamos que existe la imagen en el equipo y la subimos al almacenamiento
            if ($request->hasFile('model_image')) {
                $file = $request->file('model_image');
                $name = time() . $file->getClientOriginalName();
                $filePath = 'images/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($file));


                /*Guardamos en la base de datos los detalles actualizados modelo
                 y la nueva ruta de la nueva imagen */
                DB::table('modelos')
                    ->where('id_modelo', $request->model_id)
                    ->update(['nombre_modelo' => $request->model_name,
                        'observaciones' => $request->observations,
                        'fecha_modelo' => $request->model_date,
                        'image' => $name
                    ]);
            }

            }

             //En caso de no haber añadido una nueva imagen al formulario
            if(!isset($request->model_image)){
                //Actualizamos todos los campos menos el de la imagen
                DB::table('modelos')
                    ->where('id_modelo',$request->model_id)
                    ->update(['nombre_modelo'=>$request->model_name,
                        'observaciones'=>$request->observations,
                        'fecha_modelo'=>$request->model_date,
                    ]);
            }

        //Cargo la vista pasandole los datos que hay en la bd del modelo
        return back()->withSuccess(__('Model Update Successfully'));
    }
}
