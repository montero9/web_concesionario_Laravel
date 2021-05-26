<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Alert;

class deleteUser extends Controller
{

    /**
     * Permite eliminar de la bd el usuario que recibe como parámetro
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @author Antonio Montero
     */
    public function delete(User $user){

        //Creamos la consulta de eliminación
        $resultado = DB::table('users')
            ->where('id',$user->id)
            ->delete();

        //Mostramos mensaje de exito
        Alert::success('Operación exitosa', 'Usuario eliminado correctamente')->autoclose(2000);
        //Redirigimos a la vista
        return redirect()->route('register');
    }
}
