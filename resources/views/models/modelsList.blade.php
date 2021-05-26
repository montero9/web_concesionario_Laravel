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
@endsection

@section('content')

    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route("showFormModel") }}'">
            {{ __('Add Model') }}
        </button>
    </div>
    <div container>
        <div class="row justify-content-center">
            <div class="col-md-4" style="padding-top: 20px">

                    {{--Mostramos el mensaje de exito en caso de existir--}}
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ Session::get('success') }}
                        </div>
                    @endif

                <table id="miTabla" class="table table-striped" style="text-align: center">
                    <thead style="background-color: #56c5c9;">
                        <th>{{__('Model Id')}}</th>
                        <th>{{ __('Model Name') }}</th>
                        <th>{{ __('Registration Date') }}</th>
                        <th>{{ __('Model Details') }}</th>
                        </thead>
                    <tbody>
                    @foreach($modelos as $modelo)
                        <tr>
                            <td>{{ $modelo->id_modelo }}</td>
                            <td> {{ $modelo->nombre_modelo }}</td>
                            <td> {{ $modelo->fecha_modelo }}</td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-{{ $modelo->id_modelo }}">
                                    {{ __('See Details') }}
                                </button></td>
                        </tr>
                        <div class="modal fade" id="modal-{{ $modelo->id_modelo }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">{{__('Model Details')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <strong class="text-primary">{{__('Id')}}:</strong> {{ $modelo->id_modelo }}<br>
                                        <strong class="text-primary">{{__('Model Name')}}:</strong> {{ $modelo->nombre_modelo }}<br>
                                        <strong class="text-primary">{{__('Observations')}}:</strong> {{ $modelo->observaciones }}<br>
                                        <strong class="text-primary">{{__('Model Date')}}:</strong> {{ $modelo->fecha_modelo }}<br>
                                        <a data-fancybox="" href="https://serviauto.s3.eu-west-3.amazonaws.com/images/{{ $modelo->image }}"><img src="https://serviauto.s3.eu-west-3.amazonaws.com/images/{{ $modelo->image }}" width="398px" height="241px"></a>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location='{{ route("deleteModel", $modelo->id_modelo) }}'">{{ __('Delete') }}</button>
                                        <button type="button" class="btn btn-info" onclick="window.location='{{ route("showUpdateModel", $modelo->id_modelo) }}'" >{{ __('Update') }}</button>
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
