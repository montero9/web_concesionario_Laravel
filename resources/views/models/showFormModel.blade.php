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
                        {{ __('Model Details') }}
                    </div>
                    <div class="card-body" id="formAddModel">
                        <form action="{{ isset($datos_modelo) ? route('updateModel') : route('uploadModel') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- Mostramos el id si venimos a actualizar un modelo -->
                            @if(isset($datos_modelo))
                                @method('patch')
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="model_id">{{ __('Model Id') }} *</label>

                                    <div class="col-md-6">
                                        <input id="model_id" class="form-control" type="text" name="model_id" readonly value="{{ isset($datos_modelo[0]->id_modelo) ? $datos_modelo[0]->id_modelo : old('model_name')  }}">
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="model_image">{{ __('Model Image') }} *</label>

                                <div class="col-md-6">
                                    <input id="model_image" class="form-control @error('model_image') is-invalid @enderror" type="file" name="model_image">
                                    @error('model_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __('The model image field is required.') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="model_name"> {{ __('Model Name') }} *</label>

                                <div class="col-md-6">
                                    <input id="model_name" class="form-control @error('model_name') is-invalid @enderror"  value="{{   isset($datos_modelo[0]->nombre_modelo) ? $datos_modelo[0]->nombre_modelo : old('model_name')  }}" type="text" name="model_name">
                                    @error('model_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __('The model name field is required.') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="observations1">{{ __('Observations') }} *</label>

                                <div class="col-md-6">
                                    <input id="observations" class="form-control @error('observations') is-invalid @enderror" value="{{ isset($datos_modelo[0]->observaciones) ? $datos_modelo[0]->observaciones : old('model_name')  }}" type="text" name="observations">
                                    @error('observations')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__('The observations field is required.')}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="model_date">{{ __('Model Date') }} *</label>

                                <div class="col-md-6">
                                    <input id="model_date" class="form-control @error('model_date') is-invalid @enderror" value="{{ isset($datos_modelo[0]->fecha_modelo) ? $datos_modelo[0]->fecha_modelo : old('model_name')  }}" type="date" name="model_date">
                                    @error('model_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __('The model date field is required.') }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    {{--Comprobamos si queremos añadir un modelo nuevo o actualizarlo--}}
                                    @if ( isset($datos_modelo) )
                                        <button class="btn btn-primary">{{ __('Update Model') }}</button>
                                    @else
                                        <button class="btn btn-primary">{{ __('Add Model') }}</button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection()
