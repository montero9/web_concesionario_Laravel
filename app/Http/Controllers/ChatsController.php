<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;


class ChatsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra el chat
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chat.chat');
    }

    /**
     * Obtiene todos los mensajes
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Guarda los mensajes nuevos en la bd
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

            $message = $user->messages()->create([
                'message' => $request->input('message')
            ]);

        //Lanzamos el evento al canal
        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Mensaje Enviado!'];
    }
}
