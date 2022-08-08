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
                <div class="mx-auto" id="Tickets" style="width: 100%; height: 300px"></div>
            </div>
        </div>
    </div>
  </div>
  
  <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      var f_ticket = @json($fresh_tickets);
      //SI JALA, TIENE QUE HABER TICKETS ABIERTOS Y QUE SEAN NO MÁS DE 10 DÍAS DE ANTIGUEDAD
      //console.log(f_ticket)

      // Primero crea una variable que sea igual a un array que va a ser tu resultado final y le vas a ir metiendo datos conforme avances
      var array_final = [];
      
        var contador_abiertos = 0;
        var contador_cerrados = 0;

        var arreglo_interno1 = f_ticket.date[0];
        var arreglo_interno2 = contador_abiertos;
        var arreglo_interno3 = contador_cerrados;

      console.log(arreglo_interno1[0])
              
        for (let ticket of tickets_open) {

          // ahi crea un nuevo arreglo asi ['',0,0] que vas a tenenr en una variable como auiliar
          let inside_array = array_final[arreglo_interno[0,1,2]];

          if(f_ticket.type == 'Abierto'){
            console.log("Adios")
            let insert = tickets.push('Abierto???');
          }
        }

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Fecha', 'Abierto', 'Cerrado'],
          ['21/10/2021', 8, 23],
          ['22/10/2021', 24, 4],
          ['23/10/2021', 15, 14],
          ['24/10/2021', 12, 9],
          ['25/10/2021', 17, 13]
        ]);

        var options = {
          width: 800,
          chart: {
            title: 'Gráfica de Tickets',
            subtitle: 'Abiertos: Azul | Cerrados: Rojo'
          },
          bars: 'horizontal', // Required for Material Bar Charts.
          series: {
            0: { axis: 'Abiertos' }, // Bind series 0 to an axis named 'Abiertos'.
            1: { axis: 'Cerrados' } // Bind series 1 to an axis named 'Cerrados'.
          },
          axes: {
            x: {
              distance: {label: 'parsecs'}, // Bottom x-axis.
              brightness: {side: 'top', label: 'apparent magnitude'} // Top x-axis.
            }
          }
        };

      var chart = new google.charts.Bar(document.getElementById('Tickets'));
      chart.draw(data, options);
    };
    </script>
@endsection