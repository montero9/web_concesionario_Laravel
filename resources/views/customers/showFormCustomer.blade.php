@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                {{--Mostramos el mensaje de exito en caso de existir--}}
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ Session::get('success') }}
                    </div>
                @endif
            </div>
            <div class="col-md-9" style="padding-top: 20px">
                <form action="{{ isset($datos_cliente) ? route('updateCustomer') : route('addCustomer') }}" method="post" >
                    @csrf
                    <fieldset class="form-group">
                        <legend style="background-color: #EFF5F5; padding-left: 15px" >
                            {{ __('Customer Details') }}
                        </legend>
                        <div class="row" style="padding-left: 10px;padding-right: 10px">
                            <div class="col-md-2">
                                <!-- Mostramos el id si venimos a actualizar un modelo -->
                                @if(isset($datos_cliente))
                                     @method('patch')
                                @endif
                                <label class="col-form-label text-md-right form-inline" for="id_cliente">{{ __('Customer Id') }} *</label>
                                <input id="id_cliente" class="form-control" type="text" name="id_cliente" readonly value="{{ isset($datos_cliente) ? $datos_cliente[0]->id_cliente : old('id_cliente')  }}">
                            </div>
                            <div class="col-md-2">
                                <label class="col-form-label text-md-right form-inline" for="dni">{{ __('Id Card') }} *</label>
                                <input id="dni" class="form-control  @error('dni') is-invalid @enderror" type="text" name="dni" value="{{ isset($datos_cliente) ? $datos_cliente[0]->dni : old('dni')  }}">
                                @if ($errors->has('dni'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('dni') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label class=" col-form-label text-md-right form-inline" for="nombre"> {{ __('Customer Name') }} *</label>
                                <input id="nombre" class="form-control @error('nombre') is-invalid @enderror"  value="{{ isset($datos_cliente) ? $datos_cliente[0]->nombre : old('nombre')  }}" type="text" name="nombre">
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nombre') }}</strong>
                                             </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label text-md-right form-inline" for="apellidos">{{ __('Surnames') }} *</label>
                                <input id="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ isset($datos_cliente) ? $datos_cliente[0]->apellidos : old('apellidos')  }}" type="text" name="apellidos">
                                @if ($errors->has('apellidos'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('apellidos') }}</strong>
                                             </span>
                                @endif
                            </div>
                        </div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px; padding-top: 10px">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right form-inline" for="fecha_nacimiento">{{ __('Birth Date') }} *</label>
                                <input id="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ isset($datos_cliente) ? $datos_cliente[0]->fecha_nacimiento : old('fecha_nacimiento')  }}" type="date" name="fecha_nacimiento">
                                @if ($errors->has('fecha_nacimiento'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                             </span>
                                @endif
                            </div>
                            <div class="col-md-5">
                                <label class="form-inline col-form-label text-md-right" for="direccion">{{ __('Address') }} *</label>
                                <input id="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ isset($datos_cliente) ? $datos_cliente[0]->direccion : old('direccion')  }}" type="text" name="direccion">
                                @if ($errors->has('direccion'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('direccion') }}</strong>
                                             </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label class="form-inline col-form-label text-md-right" for="localidad">{{ __('City') }} *</label>
                                <input id="localidad" class="form-control @error('localidad') is-invalid @enderror" value="{{ isset($datos_cliente) ? $datos_cliente[0]->localidad : old('localidad')  }}" type="text" name="localidad">
                                @if ($errors->has('localidad'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('localidad') }}</strong>
                                             </span>
                                @endif
                            </div>
                        </div>
                        <div class="row" style="padding-left: 10px;padding-right: 10px; padding-top: 10px">
                            <div class="col-md-3">
                                <label class="form-inline col-form-label text-md-right" for="cod_postal">{{ __('Postal Code') }} *</label>
                                <input id="cod_postal" class="form-control @error('cod_postal') is-invalid @enderror" value="{{ isset($datos_cliente) ? $datos_cliente[0]->cod_postal : old('cod_postal')  }}" type="text" name="cod_postal">
                                @if ($errors->has('cod_postal'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cod_postal') }}</strong>
                                             </span>
                                @endif
                            </div>
                            <div class="col-md-5">
                                <label class="form-inline col-form-label text-md-right" for="provincia">{{ __('Province') }} *</label>
                                <input id="provincia" class="form-control @error('provincia') is-invalid @enderror" value="{{ isset($datos_cliente) ? $datos_cliente[0]->provincia : old('provincia')  }}" type="text" name="provincia">
                                @if ($errors->has('provincia'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('provincia') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label class="form-inline col-form-label text-md-right" for="pais">{{ __('Country') }} *</label>
                                <select name="pais" id="pais" class="form-control">
                                    @foreach($datos as $dato)
                                        @if(isset($datos_cliente) && $datos_cliente[0]->pais == $dato->name)
                                            <option selected value="{{ $dato->name }}">{{$dato->name}}</option>
                                        @else
                                            <option value="{{ $dato->name }}">{{$dato->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" style="padding-left: 10px;padding-right: 10px; padding-top: 10px">
                            <div class="col-md-4">
                                <label class="form-inline col-form-label text-md-right" for="email">{{ __('E-Mail Address') }} *</label>
                                <input id="email" class="form-control @error('email') is-invalid @enderror" value="{{ isset($datos_cliente) ? $datos_cliente[0]->email : old('email')  }}" type="text" name="email">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                             </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label class="form-inline col-form-label text-md-right" for="telefono">{{ __('Phone Number') }} *</label>
                                <input id="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ isset($datos_cliente) ? $datos_cliente[0]->telefono : old('telefono')  }}" type="text" name="telefono">
                                @if ($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('telefono') }}</strong>
                                             </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label class="form-inline col-form-label text-md-right" for="fecha_registro">{{ __('Registration Date') }} *</label>
                                <input id="fecha_registro" class="form-control @error('fecha_registro') is-invalid @enderror" value="{{ isset($datos_cliente) ? $datos_cliente[0]->fecha_registro : old('fecha_registro')  }}" type="date" name="fecha_registro">
                                @if ($errors->has('fecha_registro'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('fecha_registro') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row" style="padding-left: 10px;padding-right: 10px; padding-top: 10px">
                            <div class="col-md-12">
                                <label class="form-inline col-form-label text-md-right" for="observaciones">{{ __('Observations') }} </label>
                                <textarea id="observaciones" class="form-control" maxlength="200" name="observaciones">{{ isset($datos_cliente) ? $datos_cliente[0]->observaciones : old('observaciones')  }}</textarea>
                                @if ($errors->has('observaciones'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('observaciones') }}</strong>
                                             </span>
                                @endif
                            </div>
                        </div>
                        <div class="row" style="padding-left: 10px;padding-right: 10px; padding-top: 10px">
                            <div class="col-md-12 text-center pt-2">
                                @if ( isset($datos_cliente) )
                                    <button class="btn btn-primary">{{ __('Update Customer') }}</button>
                                @else
                                    <button class="btn btn-primary">{{ __('Add Customer') }}</button>
                                @endif
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection()
