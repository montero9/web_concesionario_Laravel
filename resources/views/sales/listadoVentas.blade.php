@extends('layouts.app')

@section('specific_js_css_code')
    <script>
        $(document).ready(function() {
            $('#miTabla').DataTable({
                "pageLength": 10,
                "lengthMenu": [10, 20, 50, 100],
                "responsive": true,
                "order": [ [0, 'desc'] ],
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
        <button type="button" class="btn btn-primary" onclick="window.location='{{ route("showFormSale") }}'">
            {{ __('Create Sale') }}
        </button>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6" style="padding-top: 20px">
            <table id="miTabla" class="table table-striped table-hover" style="text-align: center">
                <thead style="background-color: #56c5c9;">
                    <th>{{__('Sale Id')}}</th>
                    @if( Auth::user()->role == "admin" )
                        <th>{{ __('Seller') }}</th>
                    @endif
                    <th>{{ __('Customer') }}</th>
                    <th>{{ __('Sale Date') }}</th>
                    <th>{{ __('Total Price') }}</th>
                <th>Detalles</th>
                </thead>
                <tbody>
                @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id_venta }}</td>
                        @if(Auth::user()->role == "admin")
                            <td><a href="{{ Route('auth.userDetails',$venta->user_id) }}"> {{ $venta->vendedor_name }}</a></td>
                        @endif
                        <td><a href="{{ route('showUpdateCustomer', $venta->cliente_id) }}">{{ $venta->cliente_nombre }}&nbsp;{{ $venta->cliente_apellidos }}</a></td>
                        <td>{{ Carbon\Carbon::parse($venta->fecha_venta)->format('d-m-Y') }}</td>
                        <td> {{ $venta->precio_total }} €</td>
                        <td><a href="{{ Route('getSaleDetails',$venta->id_venta) }}"><img src="https://img.icons8.com/color/48/000000/search-more.png" width="25px" height="25px">{{ __('See Details') }}</a></td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection()
