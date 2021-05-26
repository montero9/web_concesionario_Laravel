@extends('layouts.app')

@section('content')
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
                        {{ __('Car Details') }}
                    </div>
                    <div class="card-body" id="formAddModel">
                        <form action="{{ isset($datos_vehiculo) ? route('updateCar') : route('addCar') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <!-- Mostramos el id si venimos a actualizar un vehículo -->
                            @if(isset($datos_vehiculo))
                                @method('patch')
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="car_id">{{ __('Car Id') }} *</label>

                                    <div class="col-md-6">
                                        <input id="car_id" class="form-control" type="text" name="car_id" readonly value="{{ isset($datos_vehiculo) ? $datos_vehiculo[0]->id_vehiculo : old('car_id')  }}">
                                    </div>
                                </div>
                            @endif


                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="model_id">{{ __('Model') }} *</label>

                                <div class="col-md-6">
                                    <select id="model_id" class="form-control" name="model_id">
                                        <!-- Mostramos los modelos de la bd en un combobox -->
                                        @foreach( $modelos as $modelo)
                                                @if(isset($datos_vehiculo) && $modelo->id_modelo == $datos_vehiculo[0]->modelo_id)
                                                    <option selected value="{{ $modelo->id_modelo }}">{{ $modelo->nombre_modelo }}</option>
                                                @else
                                                    <option value="{{ $modelo->id_modelo }}">{{ $modelo->nombre_modelo }}</option>
                                                @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="licencese_plate ">{{ __('Licence Plate') }} *</label>

                                <div class="col-md-6">
                                    <input id="licencese_plate" class="form-control @error('licencese_plate') is-invalid @enderror"  value="{{   isset($datos_vehiculo) ? $datos_vehiculo[0]->matricula : old('licencese_plate')  }}" type="text" name="licencese_plate">
                                    @if ($errors->has('licencese_plate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('licencese_plate') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="model_name"> {{ __('Horsepower') }} *</label>

                                <div class="col-md-6">
                                    <input id="horsepower" class="form-control @error('horsepower') is-invalid @enderror"  value="{{   isset($datos_vehiculo) ? $datos_vehiculo[0]->caballos : old('horsepower')  }}" type="text" name="horsepower">
                                    @if ($errors->has('horsepower'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('horsepower') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="observations1">{{ __('Doors') }} *</label>

                                <div class="col-md-6">
                                    <select name="doors" id="doors" class="form-control">
                                            @if(isset($datos_vehiculo))
                                                @if($datos_vehiculo[0]->puertas == 3)
                                                        <option value="3" selected>3</option>
                                                        <option value="5">5</option>
                                                @elseif($datos_vehiculo[0]->puertas == 5)
                                                        <option value="3">3</option>
                                                        <option value="5" selected>5</option>
                                                @endif
                                            @else
                                                        <option value="3">3</option>
                                                        <option value="5">5</option>
                                            @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="model_date">{{ __('Transmission') }} *</label>

                                <div class="col-md-6">
                                    <div class="form-check-inline" style="padding-top: 10px">
                                        <label class="form-check-label">

                                            @if(isset($datos_vehiculo))
                                                @if($datos_vehiculo[0]->tipo_cambio == 'Manual')
                                                    <input type="radio" class="form-check-input" name="transmission" value="Manual" checked>Manual
                                                    &nbsp;<input type="radio" class="form-check-input" name="transmission" value="Automático">Automático
                                                @else
                                                    <input type="radio" class="form-check-input" name="transmission" value="Manual">Manual
                                                    &nbsp;<input type="radio" class="form-check-input" name="transmission" value="Automático" checked>Automático
                                                @endif
                                            @elseif(!isset($datos_vehiculo))
                                                <input type="radio" class="form-check-input" name="transmission" value="Manual" checked>Manual
                                                &nbsp;<input type="radio" class="form-check-input" name="transmission" value="Automático">Automático
                                            @endif
                                        </label>
                                    </div>
                                 </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="model_date">{{ __('Fuel') }} *</label>

                                <div class="col-md-6">

                                    <select name="fuel" id="fuel" class="form-control">

                                        @if(isset($datos_vehiculo))
                                            <option value="Gasolina" {{ ($datos_vehiculo[0]->combustible == 'Gasolina') ? 'selected' : null }}>Gasolina</option>
                                            <option value="Gasoleo" {{ ($datos_vehiculo[0]->combustible == 'Gasoleo') ? 'selected' : null }}>Gasoleo</option>
                                            <option value="Gas Licuado" {{ ($datos_vehiculo[0]->combustible == 'Gas Licuado') ? 'selected' : null }}>Gas Licuado</option>
                                            <option value="Gas natural comprimido" {{ ($datos_vehiculo[0]->combustible == 'Gas natural comprimido') ? 'selected' : null }}>Gas natural comprimido</option>
                                            <option value="Híbrido" {{ ($datos_vehiculo[0]->combustible == 'Híbrido') ? 'selected' : null }}>Híbrido</option>
                                            <option value="Híbrido enchufable" {{ ($datos_vehiculo[0]->combustible == 'Híbrido enchufable') ? 'selected' : null }}>Híbrido enchufable</option>
                                            <option value="Elétrico" {{ ($datos_vehiculo[0]->combustible == 'Eléctrico') ? 'selected' : null }}>Eléctrico</option>
                                        @else
                                            <option value="Gasolina">Gasolina</option>
                                            <option value="Gasoleo">Gasoleo</option>
                                            <option value="Gal Licuado">Gas Licuado</option>
                                            <option value="Gas natural comprimido">Gas natural comprimido</option>
                                            <option value="Híbrido">Híbrido</option>
                                            <option value="Híbrido enchufable">Híbrido enchufable</option>
                                            <option value="Elétrico">Eléctrico</option>
                                        @endif
                                    </select>
                                    @if ($errors->has('fuel'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fuel') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="model_date">{{ __('Colour') }} *</label>

                                <div class="col-md-6">
                                    <input id="colour" class="form-control @error('colour') is-invalid @enderror" value="{{   isset($datos_vehiculo) ? $datos_vehiculo[0]->color : old('colour')  }}" type="text" name="colour">
                                    @if ($errors->has('colour'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('colour') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="model_date">{{ __('Price') }} *</label>

                                <div class="col-md-6">
                                    <input id="price" class="form-control @error('price') is-invalid @enderror" value="{{   isset($datos_vehiculo) ? $datos_vehiculo[0]->precio : old('price')  }}" type="text" name="price">
                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }} </strong>
                                         </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    {{--Comprobamos si queremos añadir un modelo nuevo o actualizarlo--}}
                                    @if ( isset($datos_vehiculo) )
                                        <button class="btn btn-primary">{{ __('Update Car') }}</button>
                                    @else
                                        <button class="btn btn-primary">{{ __('Add Car') }}</button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
