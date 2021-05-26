<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Alert;

class UserDetailsController extends Controller
{
    /**
     * Obtiene de la bd los datos de un usuario
     * @param id string identificador del usuario
     * @return array datos del usuario
     * @author Antonio Montero Pérez
     */
    public function details($id){

        //Obtenemos los dato de un usuario
        $user = User::findOrFail($id);
        //Cargo la vista con los datos obtenidos
        return view('auth.detailsUser',[
            'user'=>$user
        ]);
    }

    /**
     * Permiter actulizar un usuario
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($user){

        //Creamos la consulta de actualización
        $filas_modificadas = DB::table('users')
            ->where('id',$user)
            ->update([
                'name'=> request('name'),
                'email'=> request('email'),
                'role' => request('role'),
            ]);

        /*Comprobamos que el usuario ha sido actualizado correcatemente
        y muestro un alert en consecuencia */
       if($filas_modificadas==1 || $filas_modificadas==0){
           Alert::success('Operación exitosa', 'Usuario actualizado correctamente')->autoclose(2000);
       }else{
           Alert::error('Operación erronea', 'El usuarios no ha podido ser actulizado')->autoclose(2000);
       }

       return redirect('register');
    }
}
