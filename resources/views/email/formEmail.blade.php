@extends('layouts.app')

@section('specific_js_css_code')

    <!-- Awesomplete -->
    <link rel="stylesheet" href="css/awesomplete.css" />
    <script src="css/awesomplete.js" async></script>

    <!-- NicEdit -->
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            nicEditors.allTextAreas()
        });
    </script>

@endsection

@section('content')

    {{-- Lista oculta con todos los emails de los clientes--}}
    <ul id="mylist" style="display: none">
        @foreach($emails as $email)
            <li>{{ $email->email }}</li>
         @endforeach
    </ul>

    <div class="container">
        <div class="row justify-content-center">
            <div  class="col-md-8">
                {{--Mostramos el mensaje de exito en caso de existir--}}
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ Session::get('success') }}
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-left">
                        {{ __('Contact Form') }}
                    </div>
                    <div class="card-body" id="formAddModel">
                        <form method="post" action="{{ route('sendEmail') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"  for="addressee">{{ __('Email') }}:</label>
                                <div class="col-md-6">
                                    <input class="form-control @error('addressee') is-invalid @enderror awesomplete" data-list="#mylist" type="text" name="addressee" id="addressee" {{isset($email_cliente) ?  'readonly' : null}} value="{{ isset($email_cliente) ? $email_cliente : null }}">
                                    @if ($errors->has('addressee'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('addressee') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                    <textarea class="form-control  @error('message') is-invalid @enderror" style="height: 150px;" name="message" id="message" placeholder="{{ __('Message') }}"></textarea>
                                <div></div>
                                    @if ($errors->has('message'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('message') }}</strong>
                                         </span>
                                    @endif

                            </div>
                            <div class="form-group row" style="text-align: center">
                                <div class="col-md-12">
                                    <button class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
