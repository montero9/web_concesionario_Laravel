@extends('layouts.app')

@section('specific_js_css_code')
    <!-- Se encarga de dar estilo a las tablas mediante el plugin Datatables -->
    <script>
        $(document).ready(function() {
            $('#miTabla').DataTable({
                "pageLength": 6,
                "lengthMenu": [6, 10, 20, 50, 100],
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
            <button type="button" class="btn btn-secondary" onclick="window.location='{{ route("showFormCustomer") }}'">
                {{ __('Add Customer') }}
            </button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5" style="padding-top: 20px">

                {{--Mostramos el mensaje de exito en caso de existir--}}
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ Session::get('success') }}
                    </div>
                @endif

                <table id="miTabla" class="table table-striped" style="text-align: center">
                    <thead style="background-color: #56c5c9;">
                    <th>{{__('Id Card')}}</th>
                    <th>{{ __('Customer Name') }}</th>
                    <th>{{ __('City') }}</th>
                    <th>{{ __('Customer Details') }}</th>
                    <th>{{ __('Delete Customer') }}</th>
                    </thead>
                    <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->dni }}</td>
                            <td> {{ $cliente->nombre }} {{ $cliente->apellidos }}</td>
                            <td> {{ $cliente->localidad }}</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-{{ $cliente->id_cliente }}">
                                    {{ __('See Details') }}
                                </button></td>
                            <td>
                                <form method="POST" action="{{route('deleteCustomer', $cliente->id_cliente) }}" style="display: inline;">
                                    @CSRF @method('DELETE')
                                    <button class="btn btn-danger">{{__('Delete')}}</button>
                                </form>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal-{{ $cliente->id_cliente }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <button type="button" class="close bg-primary" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-content">
                                    <div class="modal-header bg-primary justify-content-center">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">
                                            <img style="width: 100px;height: 100px" src="https://serviauto.s3.eu-west-3.amazonaws.com/images_static/edit_user.png"> <br>
                                            {{__('Customer Details')}}
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        <strong class="text-primary">{{__('Id')}}:</strong> {{ $cliente->id_cliente }}<br>
                                        <strong class="text-primary">{{__('Id Card')}}:</strong> {{ $cliente->dni }}<br>
                                        <strong class="text-primary">{{__('Customer Name')}}:</strong> {{ $cliente->nombre}} {{$cliente->apellidos}}<br>
                                        <strong class="text-primary">{{__('Birth Date')}}:</strong> {{ Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d-m-Y') }}<br>
                                        <strong class="text-primary">{{__('Address')}}:</strong> {{ $cliente->direccion}}, {{$cliente->localidad}}, {{$cliente->cod_postal}}, {{$cliente->provincia}}, {{$cliente->pais }}<br>
                                        <strong class="text-primary">{{__('E-Mail Address')}}:</strong> {{ $cliente->email }}<br>
                                        <strong class="text-primary">{{__('Phone Number')}}:</strong> {{ $cliente->telefono }}<br>
                                        <strong class="text-primary">{{__('Registration Date')}}:</strong> {{ Carbon\Carbon::parse($cliente->fecha_registro)->format('d-m-Y') }}<br>
                                        <strong class="text-primary">{{__('Observations')}}:</strong> {{ $cliente->observaciones }}<br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" onclick="window.location='{{ route("showFormEmailCustomer", $cliente->email ) }}'" >{{ __('Contact') }}</button>
                                        <button type="button" class="btn btn-info" onclick="window.location='{{ route("showUpdateCustomer", $cliente->id_cliente) }}'" >{{ __('Update') }}</button>
                                    </div>
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
