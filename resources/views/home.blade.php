@extends('layouts.app')
{{--  @dd($treports)  --}}
@section('content')
    <div class="container">
        {{--  <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Mensaje del servidor</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        ¡Has iniciado sesión!

                    </div>
                </div>
            </div>
        </div>  --}}
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div id="water_chart" style="width: 400px; height: 250px"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div id="trash_chart" style="width: 400px; height: 250px"></div>
                    </div>
                </div>
            </div>
        </div>    
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div id="compresor_chart" style="width: 600px; height: 300px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart', 'line']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            //var data = google.visualization.arrayToDataTable([
            //    ['Order Id', 'Price', 'Product Name'],

            //    @php
            //    foreach($orders as $order) {
            //        echo "['".$order->id."', ".$order->price.", ".$order->Product_name."],";
            //    }
            //    @endphp
            //]);
            var data_compresor = google.visualization.arrayToDataTable([
                ['Fecha', 'Nivel de Aceite', 'Temperatura'],
                @php
                foreach($creports as $creport){
                    echo "['".$creport->date."', ".$creport->oil_level.", ".$creport->temperature."],";
                }                
                @endphp
            ]);

            var data_trash = google.visualization.arrayToDataTable([
                ['Fecha', 'Desechos'],
                @php
                foreach($treports as $treport){
                    echo "['".$treport->date."', ".$treport->quantity."],";
                }                
                @endphp
            ]);

            var data_water = google.visualization.arrayToDataTable([
                ['Fecha', 'Lectura'],
                @php
                foreach($wreports as $wreport){
                    echo "['".$wreport->date."', ".$wreport->read."],";
                }                
                @endphp
            ]);

            var options_compresor = {
                chart: {
                title: 'Compresor',
                //subtitle: 'Resumen Trimestral'
                },
                width: 600,
                height: 300,
                hAxis: {
                    title: 'Reporte'
                },
                vAxis: {
                    title: 'Fecha'
                },
                series: {
                    1: {curveType: 'function'}
                }
            };

            var options_trash = {
                chart: {
                title: 'Desechos',
                //subtitle: 'Resumen Trimestral'
                },
                width: 450,
                height: 250,
                legend: { position: 'none' },
                hAxis: {
                    title: 'Reporte'
                },
                vAxis: {
                    title: 'Fecha'
                },
                series: {
                    1: {curveType: 'function'}
                }
            };

            var options_water = {
                chart: {
                title: 'Agua',
                //subtitle: 'Resumen General'
                },
                width: 450,
                height: 250,
                legend: { position: 'none' },
                hAxis: {
                    title: 'Lectura'
                },
                vAxis: {
                    title: 'Fecha'
                },
                series: {
                    1: {curveType: 'function'}
                }
            };

            var compresor_chart = new google.charts.Line(document.getElementById('compresor_chart'));
            compresor_chart.draw(data_compresor, google.charts.Line.convertOptions(options_compresor));

            var trash_chart = new google.charts.Line(document.getElementById('trash_chart'));
            trash_chart.draw(data_trash, google.charts.Line.convertOptions(options_trash));

            var water_chart = new google.charts.Line(document.getElementById('water_chart'));
            water_chart.draw(data_water, google.charts.Line.convertOptions(options_water));
        }
    </script>
@endsection
