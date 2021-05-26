@extends('layouts.app')

@section('specific_js_css_code')
    <!-- Se encarga de dar estilo a las tablas mediante el plugin Datatables -->
    <script>
        $(document).ready(function() {
            $('#miTabla').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 20, 50, 100],
                "order": [ [0, 'desc'] ],
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
            <button type="button" class="btn btn-primary" onclick="window.location='{{ route("showFormNewBudget") }}'">
                {{ __('Create Budget') }}
            </button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6" style="padding-top: 20px">
            <table id="miTabla" class="table table-striped table-hover" style="text-align: center">
                <thead style="background-color: #56c5c9;">
                    <th>{{__('Id')}}</th>
                    <th>{{ __('Adviser') }}</th>
                    <th>{{ __('Customer') }}</th>
                    <th>{{ __('Budget Date') }}</th>
                    <th>{{ __('Total Price') }}</th>
                    <th>Detalles</th>
                </thead>
                <tbody>
                @foreach($budgets as $budget)
                    <tr>
                        <td>{{ $budget->budget_id }}</td>
                        <td><a href="{{ route('auth.userDetails',$budget->id_vendedor) }}">{{ $budget->nombre_vendedor }}</a></td>
                        <td><a href="{{ route('showUpdateCustomer',$budget->id_cliente ) }}">{{ $budget->cliente_nombre }}&nbsp;{{ $budget->cliente_apellidos }}</td>
                        <td>{{ Carbon\Carbon::parse($budget->fecha_presupuesto)->format('d-m-Y') }}</td>
                        <td> {{ $budget->precio_total }} €</td>
                        <td><a href="{{ route('getbudgetDetails',$budget->budget_id) }}"><img src="https://img.icons8.com/color/48/000000/search-more.png" width="25px" height="25px">{{ __('See Details') }}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
       </div>
    </div>
@endsection
