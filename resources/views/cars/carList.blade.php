@extends('layouts.app')
@section('specific_js_css_code')
    <!-- Se encarga de dar estilo a las tablas mediante el plugin Datatables -->
    <script>
        $(document).ready(function() {
            $('#miTabla').DataTable({
                "pageLength": 6,
                "lengthMenu": [6, 10, 20, 50, 100],
                "order": [ [9, 'desc'] ],
                "responsive": true,
                "language": {
                    "sProcessing":     "{{__('Processing')}}...",
                    "sLengthMenu":     "{{ __('Showing') }} _MENU_",
                    "sZeroRecords":    "{{ __('No Results Found') }}",
                    "sEmptyTable":     "{{ __('No data available in this table') }}",
                    "sInfo":           "{{ __('Number of records') }}: _TOTAL_",
                    "sInfoEmpty":      "{{__('Number of records') }}: 0",
                    "sInfoFiltered":   "({{ __('Filtering a total of') }} _MAX_ {{ __('records') }})",
                    "sInfoPostFix":    "",
                    "sSearch":         "{{__('Search')}}:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "{{ __('Loading') }}...",
                    "oPaginate": {
                        "sFirst":    "{{ __('First') }}",
                        "sLast":     "{{ __('Last') }}",
                        "sNext":     "{{ __('Next') }}",
                        "sPrevious": "{{ __('Previous') }}"
                    },
                    "oAria": {
                        "sSortAscending":  ": {{ __('Activate to sort the column in ascending order') }}",
                        "sSortDescending": ": {{ __('Activate to sort the column in descending order') }}"
                    }
                },
            });
        } );
    </script>
    @endsection

@section('content')
    <div container>
        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-secondary" onclick="window.location='{{ route("showFormCar") }}'">
                {{ __('Add Car') }}
            </button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7" style="padding-top: 20px">

                {{--Mostramos el mensaje de exito en caso de existir--}}
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ Session::get('success') }}
                    </div>
                @endif
                <table id="miTabla" class="table table-striped" style="text-align: center">
                    <thead style="background-color: #56c5c9;">
                        <th>{{__('Car Id')}}</th>
                        <th>{{ __('Model') }}</th>
                        <th>{{ __('Horsepower') }}</th>
                        <th>{{ __('Transmission') }}</th>
                        <th>{{ __('Fuel') }}</th>
                        <th>{{ __('Colour') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Sale Details') }}</th>
                        <th>{{ __('Vehicle Details') }}</th>
                        <th>{{ __('Delete Vehicle')}}</th>
                    </thead>
                    <tbody>
                    @foreach($vehiculos as $vehiculo)
                        <tr>
                            <td> {{ $vehiculo->id_vehiculo }}</td>
                            <td> <a href="{{ route('showUpdateModel',$vehiculo->id_modelo) }}">{{ $vehiculo->nombre_modelo }}</a></td>
                            <td> {{ $vehiculo->caballos }}</td>

                            <td> {{ $vehiculo->tipo_cambio }}</td>
                            <td> {{ $vehiculo->combustible }}</td>
                            <td> {{ $vehiculo->color }}</td>
                            <td> {{ $vehiculo->precio }} €</td>
                            {{-- Si un vehículo ha sido vendido muestro un botón para ver los detalles de la venta--}}
                            @if(isset($vehiculo->venta_id))
                                <td>
                                <button type="button" class="btn btn-success" onclick="window.location='{{ route('getSaleDetails',$vehiculo->venta_id) }}'">
                                    {{ __('Sale') }}
                                </button>
                                </td>
                            @else
                                <td></td>
                            @endif
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-{{ $vehiculo->id_vehiculo }}">
                                    {{ __('Details') }}
                                </button></td>
                            @if( !isset($vehiculo->venta_id))
                            <td>
                                <form method="POST" action="{{route('deleteCar', $vehiculo->id_vehiculo) }}" style="display: inline;">
                                    @CSRF @method('DELETE')
                                    <button class="btn btn-danger">{{__('Delete')}}</button>
                                </form>
                            </td>
                                @else
                                <td></td>
                                @endif
                        </tr>
                        <div class="modal fade" id="modal-{{ $vehiculo->id_vehiculo }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">{{__('Car Details')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <a data-fancybox=""  href="https://serviauto.s3.eu-west-3.amazonaws.com/images/{{ $vehiculo->image }}"><img src="https://serviauto.s3.eu-west-3.amazonaws.com/images/{{ $vehiculo->image }}" width="398px" height="241px"></a><br>

                                        <strong class="text-primary">{{__('Id')}}:</strong> {{ $vehiculo->id_vehiculo}}<br>
                                        <strong class="text-primary">{{__('Model')}}:</strong><a href="{{ route('showUpdateModel',$vehiculo->id_modelo) }}" class="text-info"> {{ $vehiculo->nombre_modelo }}</a><br>
                                        {{-- Si un vehiculo ha sido vendido muestre el id de la venta --}}
                                        @if( isset($vehiculo->venta_id) )
                                            <strong class="text-primary">{{__('Sale Id')}}:</strong> <a href="{{ route('getSaleDetails',$vehiculo->venta_id) }}" class="text-info"> {{__('See Details')}} - #{{ $vehiculo->venta_id}}</a> <br>
                                        @endif
                                        <strong class="text-primary">{{__('Licence Plate')}}:</strong>{{ $vehiculo->matricula}}<br>
                                        <strong class="text-primary">{{__('Horsepower')}}:</strong> {{ $vehiculo->caballos}}<br>
                                        <strong class="text-primary">{{__('Doors')}}:</strong> {{ $vehiculo->puertas }}<br>
                                        <strong class="text-primary">{{__('Transmission')}}:</strong> {{ $vehiculo->tipo_cambio }}<br>
                                        <strong class="text-primary">{{__('Fuel')}}:</strong> {{ $vehiculo->combustible }}<br>
                                        <strong class="text-primary">{{__('Colour')}}:</strong> {{ $vehiculo->color }}<br>
                                        <strong class="text-primary">{{__('Doors')}}:</strong> {{ $vehiculo->puertas }}<br>
                                        <strong class="text-primary">{{__('Registration Date') }}</strong> {{ Carbon\Carbon::parse($vehiculo->fecha_registro)->format('d-m-Y') }}<br>
                                        <strong class="text-primary">{{__('Price')}}:</strong> {{ $vehiculo->precio }} €<br>
                                    </div>
                                    {{--  Si un vehiculo ya ha sido vendido no permite que se modifique o se añada a una venta--}}
                                    @if( !isset($vehiculo->venta_id) )
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" onclick="window.location='{{ route("showUpdateModel", $vehiculo->id_vehiculo) }}'" >{{ __('Create Sale') }}</button>
                                            <button type="button" class="btn btn-info" onclick="window.location='{{ route("showUpdateCar", $vehiculo->id_vehiculo) }}'" >{{ __('Change Vehicle') }}</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection()
