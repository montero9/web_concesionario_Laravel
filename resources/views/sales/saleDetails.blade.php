@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-left">
                        {{ __('Sale Details') }}
                        </div>
                            <div class="card-body" id="formAddUser">
                                    <div class="row">
                                             <div class="card border-dark mb-3" style="width: 46%; margin-left:auto; margin-right: 10px">
                                                <div class="card-header border-dark h5 text-center bg-primary text-white"><strong>@lang('Commercial')</strong></div>
                                                <div class="card-body text">
                                                    <h5 class="card-title">{{ $detalles_venta[0]->vendedor_name }}</h5>
                                                    <p class="card-text">
                                                        <strong> @lang('Sale'): #{{ $detalles_venta[0]->id_venta }} </strong><br>
                                                        <strong> @lang('Sale Date'): {{Carbon\Carbon::parse($detalles_venta[0]->fecha_venta)->format('d-m-Y') }}</strong> <br>
                                                        <strong> Email: {{ $detalles_venta[0]->vendedor_email }}</strong>
                                                    </p>
                                                </div>
                                             </div>

                                            <div class="card border-dark mb-3 " style="width: 46%; margin-left:auto; margin-right: 10px">
                                                <div class="card-header border-dark h5 text-center bg-primary text-white" ><strong>@lang('Customer')</strong></div>
                                                <div class="card-body text">
                                                    <h5 class="card-title">{{ $detalles_venta[0]->cliente_nombre }}&nbsp;{{ $detalles_venta[0]->cliente_apellidos }}</h5>
                                                    <p class="card-text"><strong>{{ $detalles_venta[0]->cliente_direccion }} <br>
                                                        {{ $detalles_venta[0]->cliente_cod_postal }}  - {{ $detalles_venta[0]->cliente_localidad }} <br>
                                                        {{ $detalles_venta[0]->cliente_provincia }} ( {{ $detalles_venta[0]->cliente_pais }} )<br>
                                                            {{ $detalles_venta[0]->cliente_telefono }}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                    </div>

                                    <table class="table table-hover mt-4">
                                        <thead class="text-center">
                                            <th>@lang('Vehicle Image')</th>
                                            <th>@lang('Model')</th>
                                            <th>@lang('Licence Plate')</th>
                                            <th>@lang('Horsepower')</th>
                                            <th>@lang('Transmission')</th>
                                            <th>@lang('Fuel')</th>
                                            <th>@lang('Colour')</th>
                                            <th>@lang('Price')</th>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($detalles_vehiculos as $detalle)
                                                <tr>
                                                    <td><a data-fancybox="" href="https://serviauto.s3.eu-west-3.amazonaws.com/images/{{ $detalle->image }}"><img class="img-thumbnail"  width="100" height="100" src="https://serviauto.s3.eu-west-3.amazonaws.com/images/{{ $detalle->image }}"></a></td>
                                                    <td>{{ $detalle-> nombre_modelo }}</td>
                                                    <td>{{ $detalle-> matricula }}</td>
                                                    <td>{{ $detalle-> caballos }}</td>
                                                    <td>{{ $detalle-> tipo_cambio  }}</td>
                                                    <td>{{ $detalle-> combustible  }}</td>
                                                    <td>{{ $detalle-> color  }}</td>
                                                    <td>{{ $detalle-> precio }} €</td>
                                                </tr>
                                            @endforeach
                                                <tr style="background-color: #E2E5E5">
                                                    <td class="text-right " colspan="7"><strong>@lang('Total Price'): </strong></td>
                                                    <td><strong>{{ $detalles_venta[0]->precio_total }} €</strong></td>
                                                </tr>
                                        </tbody>
                                    </table>
                                        <div class="form-group row mt-2">
                                            <div class="col-md-12 offset-md-5">
                                                <button id="addButton" type="submit" class="btn btn-primary" onclick="window.location='{{ route('printSale',$detalles_venta[0]->id_venta )}}'">
                                                    @lang('Print Invoce')
                                                </button>
                                            </div>
                                        </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
