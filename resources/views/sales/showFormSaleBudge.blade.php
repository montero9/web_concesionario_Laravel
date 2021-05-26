@extends('layouts.app')

@section('specific_js_css_code')
    <!-- Se encarga de dar estilo a las tablas mediante el plugin Datatables -->
    <script>
        $(document).ready(function() {
            $('#miTabla').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 20, 50, 100],
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
    <script>
        $(document).ready(function() {
            $('.miTabla2').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 20, 50, 100],
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10" style="padding-top: 20px">
                <form>
                    <fieldset class="form-group">
                        <legend style="background-color: #EFF5F5; padding-left: 15px" >{{ __('Customer') }}
                            <button type="button" class="btn btn-primary" style="float: right" data-toggle="modal" data-target="#modal">
                                {{ __('Search Customer') }}
                            </button>
                        </legend>
                        <div class="row" style="padding-left: 10px;padding-right: 10px">
                            <div class="col-md-2">
                                <label class="col-form-label text-md-right form-inline" for="id_customer">{{__('Id')}}</label>
                                <input type="text" id="id_customer" name="id_customer" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right form-inline" for="id_card">{{__('Id Card')}}</label>
                                <input type="text" id="id_card" name="customer_name" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" for="customer_name">{{__('Name')}}</label>
                                <input type="text" id="customer_name" name="customer_name" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label text-md-right form-inline" for="customer_surnames">{{__('Surnames')}}</label>
                                <input type="text" id="customer_surnames" name="customer_name" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px; padding-top: 10px">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right form-inline" for="phone_number">{{__('Phone Number')}}</label>
                                <input type="text" id="phone_number" name="id_customer" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label text-md-right form-inline" for="email">{{__('Email')}}</label>
                                <input type="text" id="email" name="customer_name" class="form-control" readonly>
                            </div>
                            <div class="col-md-5">
                                <label class="col-form-label text-md-right form-inline" for="address">{{__('Address')}}</label>
                                <input type="text" id="address" name="customer_name" class="form-control" readonly>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="col-md-10" style="padding-top: 20px">
                <form action="{{route('registerSale') }}" method="get">
                    <fieldset class="form-group">
                        <legend style="background-color: #EFF5F5; padding-left: 15px" >{{ __('Cars') }}
                            <button type="button" class="btn btn-primary" style="float: right" data-toggle="modal" data-target="#modal_car">
                                {{ __('Search Car') }}
                            </button>
                        </legend>
                        <br>

                            <table id="tablaVehiculos" class="table-striped table-hover" style="width: 100%" border="1px">
                                <thead style="text-align: center">
                                    <th>{{ __('Id') }}</th>
                                    <th>{{ __('Licence Plate') }}</th>
                                    <th>{{ __('Model') }}</th>
                                    <th>{{ __('Price') }} €</th>
                                </thead>
                                <tbody style="text-align: center">
                                    <tr style="background-color: #98dfb6">
                                        <td colspan="3" style="text-align: right"><b>{{ __('Total Price') }}&nbsp;</b></td>
                                        <td id="precio_total" style="font-weight: bolder">0</td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" id="oculto_id_vehiculo" name="oculto_id_vehiculo" >
                            <input type="hidden" id="oculto_precio_total" name="oculto_precio_total" value="0">
                            <input type="hidden" id="oculto_user_id" name="oculto_user_id" value="">
                            <br>
                            <div style="text-align: right">
                                <button id="confirmar_venta" class="btn btn-success" >{{ __('Confirm Sale') }}</button>
                            </div>
                    </fieldset>
                </form>
            </div>

                {{--  Modal Clientes--}}
                <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('Search Customer') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table id="miTabla" class="table table-striped table-hover" style="text-align: center">
                                    <thead style="background-color: #56c5c9;">
                                        <th>{{__('Id Card')}}</th>
                                        <th>{{ __('Customer Name') }}</th>
                                        <th>{{ __('City') }}</th>
                                        <th>{{ __('Customer Details') }}</th>
                                        <th>{{__('Select Customer')}}</th>
                                    </thead>
                                    <tbody>
                                    @foreach($clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente->dni }}</td>
                                            <td> {{ $cliente->nombre }} {{ $cliente->apellidos }}</td>
                                            <td> {{ $cliente->localidad }}</td>
                                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal3-{{ $cliente->id_cliente }}">
                                                    {{ __('See Details') }}
                                                </button></td>
                                            <td>

                                                    @CSRF
                                                    <button class="btn btn-success" data-dismiss="modal" id="setCustomer-{{$cliente->id_cliente}}"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                                                         width="18" height="18"
                                                                                         viewBox="0 0 172 172"
                                                                                         style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                                                                                                   stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                                                                                                                   font-family="none" font-size="none"  style="mix-blend-mode: normal">
                                                                                                                    <path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><g id="surface1"><path d="M86,16.125c-38.52783,0 -69.875,31.34717
                                                                                                                    -69.875,69.875c0,38.52783 31.34717,69.875 69.875,69.875c38.52783,0 69.875,-31.34717 69.875,-69.875c0,-38.52783 -31.34717,-69.875 -69.875,
                                                                                                                    -69.875zM86,26.875c32.71192,0 59.125,26.41309 59.125,59.125c0,32.71192 -26.41308,59.125 -59.125,59.125c-32.71191,
                                                                                                                    0 -59.125,-26.41308 -59.125,-59.125c0,-32.71191 26.41309,-59.125 59.125,-59.125zM80.625,59.125v21.5h-21.5v10.75h21.5v21.5h10.75v-21.5h21.5v-10.75h-21.5v-21.5z">
                                                                                                                </path></g></g></g></svg> &nbsp;
                                                        {{__('Select Customer')}}</button>
                                            </td>
                                            <div class="modal fade" id="modal3-{{ $cliente->id_cliente }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{__('Customer Details')}}</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <strong>{{__('Id')}}:</strong> {{ $cliente->id_cliente }}<br>
                                                            <strong>{{__('Id Card')}}:</strong> {{ $cliente->dni }}<br>
                                                            <strong>{{__('Customer Name')}}:</strong> {{ $cliente->nombre}} {{$cliente->apellidos}}<br>
                                                            <strong>{{__('Birth Date')}}:</strong> {{ Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d-m-Y') }}<br>
                                                            <strong>{{__('Address')}}:</strong> {{ $cliente->direccion}}, {{$cliente->localidad}}, {{$cliente->cod_postal}}, {{$cliente->provincia}}, {{$cliente->pais }}<br>
                                                            <strong>{{__('E-Mail Address')}}:</strong> {{ $cliente->email }}<br>
                                                            <strong>{{__('Phone Number')}}:</strong> {{ $cliente->telefono }}<br>
                                                            <strong>{{__('Registration Date')}}:</strong> {{ Carbon\Carbon::parse($cliente->fecha_registro)->format('d-m-Y') }}<br>
                                                            <strong>{{__('Observations Date')}}:</strong> {{ $cliente->observaciones }}<br>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success" onclick="window.location='{{ route("showUpdateModel", $cliente->id_cliente) }}'" >{{ __('List Purchases') }}</button>
                                                            <button type="button" class="btn btn-warning" onclick="window.location='{{ route("showUpdateModel", $cliente->id_cliente) }}'" >{{ __('Contact') }}</button>
                                                            <button type="button" class="btn btn-info" onclick="window.location='{{ route("showUpdateCustomer", $cliente->id_cliente) }}'" >{{ __('Update') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--Permite añadir un cliente buscado en el modal al formulario--}}
                                            <script>
                                                $(document).ready(function(){
                                                    $("#setCustomer-{{$cliente->id_cliente}}").click(function(){
                                                        $("#id_customer").val('{{ $cliente->id_cliente }}');
                                                        $("#id_card").val('{{ $cliente->dni }}');
                                                        $("#customer_name").val('{{ $cliente->nombre }}');
                                                        $("#customer_surnames").val('{{ $cliente->apellidos }}');
                                                        $("#phone_number").val('{{ $cliente->telefono }}');
                                                        $("#email").val('{{ $cliente->email }}');
                                                        $("#address").val('{{ $cliente->direccion}}, {{$cliente->localidad}}, {{$cliente->cod_postal}}, {{$cliente->provincia}}, {{$cliente->pais }}');

                                                        //Guardamos en el campo oculto el id del cliente
                                                        $('#oculto_user_id').val({{ $cliente->id_cliente }})
                                                    });
                                                });
                                            </script>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-dark" onclick="window.location='{{ route("showFormCustomer") }}'">
                                        {{ __('Add Customer') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            {{--  Modal Vehiculos--}}
            <div class="modal fade bd-example-modal-xl" id="modal_car" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Search Customer') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="miTabla2 table table-striped" style="text-align: center">
                                <thead style="background-color: #56c5c9;">
                                <th>{{__('Car Id')}}</th>
                                <th>{{ __('Model Id') }}</th>
                                <th>{{ __('Horsepower') }}</th>
                                <th>{{ __('Transmission') }}</th>
                                <th>{{ __('Fuel') }}</th>
                                <th>{{ __('Colour') }}</th>
                                <th>{{ __('Price') }} €</th>
                                <th>{{ __('Vehicle Details') }}</th>
                                <th>{{ __('Add') }}</th>
                                </thead>
                                <tbody>
                                @foreach($vehiculos as $vehiculo)
                                    <tr>
                                        <td> {{ $vehiculo->id_vehiculo }}</td>
                                        <td> <a href="{{ route('showUpdateModel',$vehiculo->modelo_id) }}">{{ $vehiculo->nombre_modelo }}</a></td>
                                        <td> {{ $vehiculo->caballos }}</td>
                                        <td> {{ $vehiculo->tipo_cambio }}</td>
                                        <td> {{ $vehiculo->combustible }}</td>
                                        <td> {{ $vehiculo->color }}</td>
                                        <td> {{ $vehiculo->precio }}</td>
                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1-{{ $vehiculo->id_vehiculo }}">
                                                {{ __('Details') }}
                                            </button></td>
                                        <td><button type="button" id="setCar-{{$vehiculo->id_vehiculo}}" class="btn btn-success">
                                                {{ __('Add') }}
                                            </button></td>
                                    </tr>
                                    <div class="modal fade" id="modal1-{{ $vehiculo->id_vehiculo }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{__('Car Details')}}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <a data-fancybox=""  href="https://serviauto.s3.eu-west-3.amazonaws.com/images/{{ $vehiculo->image }}"><img src="https://serviauto.s3.eu-west-3.amazonaws.com/images/{{ $vehiculo->image }}" width="398px" height="241px"></a><br>

                                                    <strong>{{__('Id')}}:</strong> {{ $vehiculo->id_vehiculo}}<br>
                                                    <strong>{{__('Model')}}:</strong><a href="{{ route('showUpdateModel',$vehiculo->modelo_id) }}"> {{ $vehiculo->nombre_modelo }}</a><br>
                                                    {{-- Si un vehiculo ha sido vendido muestre el id de la venta --}}
                                                    @if( isset($vehiculo->venta_id) )
                                                        <strong>{{__('Sale Id')}}:</strong> <a href="{{ route('getSaleDetails',$vehiculo->venta_id) }}"> {{ $vehiculo->venta_id}} - {{__('See Details')}}</a> <br>
                                                    @endif
                                                    <strong>{{__('Licence Plate')}}:</strong>{{ $vehiculo->matricula}}<br>
                                                    <strong>{{__('Horsepower')}}:</strong> {{ $vehiculo->caballos}}<br>
                                                    <strong>{{__('Doors')}}:</strong> {{ $vehiculo->puertas }}<br>
                                                    <strong>{{__('Transmission')}}:</strong> {{ $vehiculo->tipo_cambio }}<br>
                                                    <strong>{{__('Fuel')}}:</strong> {{ $vehiculo->combustible }}<br>
                                                    <strong>{{__('Colour')}}:</strong> {{ $vehiculo->color }}<br>
                                                    <strong>{{__('Price')}}:</strong> {{ $vehiculo->precio }} €<br>
                                                    <strong>{{__('Registration Date') }}</strong> {{ Carbon\Carbon::parse($vehiculo->fecha_registro)->format('d-m-Y') }}<br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Permite añadir un vehículo buscado en el modal a la tabla resumen--}}
                                    <script>
                                        $(document).ready(function(){
                                            // Evento que se ejecutal al hacer click sobre el boton añadir
                                            $("#setCar-{{$vehiculo->id_vehiculo}}").click(function(){

                                                //Desabilita el botón de un vehículo cuando ya ha sido añadido a la tabla resumen
                                                $("#{{'setCar-'.$vehiculo->id_vehiculo}}").attr("disabled", true);

                                                //Añade una fila más a la tabla
                                                $('#tablaVehiculos tr:first').after(
                                                    '<tr>' +
                                                        '<td>{{ $vehiculo->id_vehiculo }}</td>' +
                                                        '<td>{{ $vehiculo->matricula }}</td>' +
                                                        '<td>{{ $vehiculo->nombre_modelo }}</td>' +
                                                        '<td>{{ $vehiculo->precio }} </td>' +
                                                    '</tr>');

                                                //Suma el total del precio y guarda valores en variable ocultas
                                                $('#precio_total').val(function() {
                                                   var total =$(this).html();
                                                    total=parseInt(total)+parseInt({{$vehiculo->precio}});
                                                    $(this).html(total);

                                                    //Guardamos precio total y id de los vehiculos
                                                    $('#oculto_precio_total').val(total);
                                                    $('#oculto_id_vehiculo').val($('#oculto_id_vehiculo').val()+' '+{{$vehiculo->id_vehiculo}});
                                                });
                                            });
                                        });
                                    </script>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
