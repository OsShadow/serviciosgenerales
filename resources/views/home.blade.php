@extends('layouts.app')
{{--  @dd($treports)  --}}
@section('content')

         {{-- <div class="row justify-content-center">
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
        <div class="row justify-content-center" >
            <div class="col-sm-12 col-md-10 col-lg-6 ">
                <div class="card">
                    <div class="card-body" style="overflow: auto;">
                        <div class="mx-auto" id="water_chart" style="width: 100%; height: 300px"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-10 col-lg-6 ">
                <div class="card">
                    <div class="card-body" style="overflow: auto;">
                        <div class="mx-auto" id="trash_chart" style="width: 100%; height: 300px"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-10 col-lg-6 ">
                <div class="card">
                    <div class="card-body" style="overflow: auto;">
                        <div class="mx-auto" id="compresor_chart" style="width: 100%; height: 350px"></div>
                    </div>
                </div>
            </div>
        </div>    

    <script type="application/javascript">
        
        google.charts.load('current', {callback: function () {
            drawChart();
            $(window).resize(drawChart);
        },'packages':['corechart', 'line']});
        
        google.charts.setOnLoadCallback(drawChart); 
        function drawChart() {

            // DATOS GRAFICA COMPRESOR
            
            var crep = @json($creports);
            var array1 = crep.map(({date, oil_level, temperature}) => ([date, Number(oil_level), Number(temperature)]));
            var data_compresor = new google.visualization.DataTable();
            data_compresor.addColumn('string','Fecha');
            data_compresor.addColumn('number', 'Nivel de Aceite');
            data_compresor.addColumn('number', 'Temperatura');
            data_compresor.addRows(array1);
            var options_compresor = {
                chart: {
                    title: 'COMPRESOR',
                    // subtitle: ''
                },
                title: 'COMPRESOR',
                height: 350,
                hAxis: {
                    title: 'Fecha'
                },
                vAxis: {
                    title: 'Reporte'
                }
            };

            var compresor_chart = new  google.charts.Line(document.getElementById('compresor_chart'));
            compresor_chart.draw(data_compresor, google.charts.Line.convertOptions(options_compresor));

            // var compresor_chart = new google.visualization.LineChart(document.getElementById('compresor_chart'));
            // compresor_chart.draw(data_compresor, google.charts.Line.convertOptions(options_compresor));

            // DATOS GRAFICA DESECHOS
            var trep = @json($treports);
            var array2 = trep.map(({date, quantity}) => ([date, Number(quantity)]));
            var data_trash = new google.visualization.DataTable();
            data_trash.addColumn('string','Fecha');
            data_trash.addColumn('number', 'Desechos');
            data_trash.addRows(array2);
            var options_trash = {
                chart: {
                    title: 'DESECHOS',
                //subtitle: 'Resumen Trimestral'
                },
                width: '100%',
                height: 300,
                legend: { position: 'none' },
                hAxis: {
                    title: 'Fecha'
                },
                vAxis: {
                    title: 'Reporte'
                },
                series: {
                    1: {curveType: 'function'}
                }
            };

            var trash_chart = new  google.charts.Line(document.getElementById('trash_chart'));
            trash_chart.draw(data_trash, google.charts.Line.convertOptions(options_trash));

            // DATOS GRAFICA AGUA

            var wrep = @json($wreports);
            var array3 = wrep.map( (itemData, index) => {
                const {date, read}= itemData;
                if(index === 0){
                    return ([date, Number('0.00')]);
                } else{
                    const newRead = (Number(wrep[index-1].read)-Number(wrep[index].read)).toFixed(2);
                    return ([date, Number(newRead)]);
                }
            });
            var data_water = new google.visualization.DataTable();
            data_water.addColumn('string','Fecha');
            data_water.addColumn('number', 'Lectura');
            data_water.addRows(array3);

            var options_water = {
                chart: {
                    title: 'AGUA',
                // subtitle: 'Resumen General'
                },
                width: '100%',
                height: 300,
                legend: { position: 'none' },
                hAxis: {
                    title: 'Fecha'
                },
                vAxis: {
                    title: 'Lectura'
                },
                series: {
                    1: {curveType: 'function'}
                }
                
            };
            var water_chart = new  google.charts.Line(document.getElementById('water_chart'));
            // var water_chart = new google.charts.Line(document.getElementById('water_chart'));
            water_chart.draw(data_water, google.charts.Line.convertOptions(options_water));
        }
        

    </script>
@endsection
