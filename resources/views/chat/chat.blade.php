@extends('layouts.app')

    @section('specific_js_css_code')
        <style>
            .chat {
                list-style: none;
                margin: 0;
                padding: 0;

            }

            .chat li {
                margin-bottom: 10px;
                padding-bottom: 5px;
                border-bottom: 1px dotted #B3A9A9;
            }

            .chat li .chat-body p {
                margin: 0;
                color: #777777;
            }

            .panel-body {
                overflow-y: scroll;
                height: 350px;
            }

            ::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                background-color: #F5F5F5;
            }

            ::-webkit-scrollbar {
                width: 12px;
                background-color: #F5F5F5;
            }

            ::-webkit-scrollbar-thumb {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
                background-color: #555;
            }
        </style>
        <script>

            // Función que permite bajar el scroll cuando se carga la página
            setTimeout( function(){
                $(document).ready(function() {
                    $('#lista_mensajes').animate({
                        scrollTop: $('#lista_mensajes').get(0).scrollHeight
                    }, 100);
                });
            },500 );


            //Función que baja el scroll cuando se hace click en el botón de enviar un mensaje
            $(function() {
                $("#btn-chat").click( function(){
                        $('#lista_mensajes').animate({
                            scrollTop: $('#lista_mensajes').get(0).scrollHeight
                        }, 500);
                    }
                );
            });

            //Functión que se ejcuta cuando se pulsa una tecla en el campo mensaje del formulario
            $(function(){
                $("#btn-input").keypress( function(){
                        $('#lista_mensajes').animate({
                            scrollTop: $('#lista_mensajes').get(0).scrollHeight
                        }, 500);
                    }
                );

            });


            //Comprobamos que el campos del chat está relleno para no enviar mensajes vacios
            function checkEmptyField() {
                if ($("#btn-input").val().length == 0) {
                    $("#btn-chat").attr("disabled", true);
                } else {
                    $("#btn-chat").removeAttr("disabled");
                }
            }
        </script>

    @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Canal Interno</h3></div>
                    <div class="panel-body" id="lista_mensajes">
                        <chat-messages :messages="messages"></chat-messages>
                    </div>
                    <div class="panel-footer mt-3">
                        <chat-form
                            v-on:messagesent="addMessage"
                            :user="{{ Auth::user() }}"
                        ></chat-form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
