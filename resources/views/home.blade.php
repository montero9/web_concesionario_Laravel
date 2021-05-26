@extends('layouts.app')

@section('specific_js_css_code')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['{{__('Month')}}', '{{ __('Sales') }}'],
                    @foreach($meses as $mes)
                ['{{$mes->mes}}',{{$mes->totalventas}}],
                @endforeach
            ]);

            var options = {
                curveType: 'function',
                chartArea:{left:20,right:20,top:20,bottom:60},
                legend: { position: 'bottom'},
                series: {
                    0: { color: '#12C8C8' }
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>

    @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @auth
                    <div class="card">
                        <div class="card-header">{{ __('Sales Summary') }}</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                                <div id="curve_chart" style="width: 700px; height:300px"></div>
                        </div>
                     </div>
                 @endauth
                @guest

                @endguest
            </div>
        </div>
    </div>
@endsection
