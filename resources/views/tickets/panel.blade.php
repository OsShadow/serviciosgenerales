@extends('layouts.app')

@section('content')
<div class="row  border-bottom bg-light dashboard-header " style="padding:0; margin-left: -7px !important; margin-bottom: 10px">
    <div class="col-lg-6" style="margin-left:15px; padding:0;">
        <h2>Panel Estadístico</h2>
    </div>
</div>

<div>
    <div class="col-sm-12 col-md-10 col-lg-6 ">
        <div class="card">
            <div class="card-body" style="overflow: auto;">
                <div class="mx-auto" id="ticket_chart" style="width: 100%; height: 300px"></div>
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

        // DATOS GRAFICA TICKETS

        var ttrep = @json($ttreports);
        
            var array1 = ttrep.map(({date, hour_finish, Abierto, Cerrado}) => ([date, Abierto, Cerrado, Number(hour_finish)]));
            var data_ticket = new google.visualization.DataTable();
            data_ticket.addColumn('string','Fecha');
            data_ticket.addColumn('string', 'Abierto');
            data_ticket.addColumn('string', 'Cerrado');
            data_ticket.addRows(array1);
            var options_ticket = {
                chart: {
                    title: 'TICKETS',
                //subtitle: 'Resumen Trimestral'
                },
                width: '100%',
                height: 300,
                legend: { position: 'none' },
                hAxis: {
                    title: 'Fecha'
                },
                vAxis: {
                    title: 'Hora'
                },
                series: {
                    1: {curveType: 'function'}
                }
            };
        var ticket_chart = new  google.charts.Line(document.getElementById('ticket_chart'));
        ticket_chart.draw(data_ticket, google.charts.Line.convertOptions(options_ticket));
    }

</script>
@endsection