@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Mensaje del servidor</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        ¡Has iniciado sesión!

                        <div id="linechart_material" style="width: 900px; height: 500px"></div>

                        <script type="text/javascript">
                        google.charts.load('current', {'packages':['line']});
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
                            var data = new google.visualization.DataTable();
                            data.addColumn('number', 'Day');
                            data.addColumn('number', 'Guardians of the Galaxy');
                            data.addColumn('number', 'The Avengers');
                            data.addColumn('number', 'Transformers: Age of Extinction');

                            data.addRows([
                                [1,  37.8, 80.8, 41.8],
                                [2,  30.9, 69.5, 32.4],
                                [3,  25.4,   57, 25.7],
                                [4,  11.7, 18.8, 10.5],
                                [5,  11.9, 17.6, 10.4],
                                [6,   8.8, 13.6,  7.7],
                                [7,   7.6, 12.3,  9.6],
                                [8,  12.3, 29.2, 10.6],
                                [9,  16.9, 42.9, 14.8],
                                [10, 12.8, 30.9, 11.6],
                                [11,  5.3,  7.9,  4.7],
                                [12,  6.6,  8.4,  5.2],
                                [13,  4.8,  6.3,  3.6],
                                [14,  4.2,  6.2,  3.4]
                            ]);

                            var options = {
                                chart: {
                                title: 'Box Office Earnings in First Two Weeks of Opening',
                                subtitle: 'in millions of dollars (USD)'
                                },
                                width: 900,
                                height: 500
                            };

                            var chart = new google.charts.Line(document.getElementById('linechart_material'));

                            chart.draw(data, google.charts.Line.convertOptions(options));
                        }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
