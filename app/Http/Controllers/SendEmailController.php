<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{

    /**
     * Muestra el formulario de clientes
     * @param string $email_cliente
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForm($email_cliente=''){

        //Obtenemos los emails de los clientes para mostrarlos en el desplegable
        $emails =   DB::table('clientes as cli')
                    ->select('cli.email as email')
                    ->get();

        //Comprobamos si viene desde contactar o desde conctactar desde un cliente concreto
        if($email_cliente !=''){
            return view('email.formEmail',compact('email_cliente','emails'));
        }else{
            return view('email.formEmail',compact('emails'));
        }
    }

    /**
     * Permite enviar el email
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function send(Request $request){

        //Validamos los campos del formulario
        $this->validate($request, [
            'addressee'     =>  'required|email',
            'message'  =>  'required'
        ]);

        //Almacenamos los datos del formulario
        $data = array(
            'email'      =>  $request->addressee,
            'message'   =>   $request->message
        );

        //Creamos una instacia del Mailable y le pasamos los datos
        Mail::to($data['email'])
            ->send(new SendMail($data));

        //Cargo la vista pasandole los datos que hay en la bd del modelo
        return back()->withSuccess(__('Message Sent Successfully'));
    }

}
