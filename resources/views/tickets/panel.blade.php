@extends('layouts.app')
@section('content')
<div class="row  border-bottom bg-light dashboard-header " style="padding:0; margin-left: -7px !important; margin-bottom: 10px">
    <div class="col-lg-6" style="margin-left:15px; padding:0;">
        <h2>Panel Estadístico</h2>
    </div>
</div>



<!----Start---->
    <div class="card" style="padding: 5px">
        <div class="card-body" style="padding: 5px !important">

            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card-title">Filtrar por fecha</div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-10">
                    <div class="card-text">

                        <form>
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <div class="input-group mb-2">
                                    
                                    </div>
                                </div>
                                <!-- <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-sync"></i>  Filtrar</button>
                                </div> -->
                            </div>
                        </form>
                        </div>
                    </div>

                    <!-- @if (isset($selection))
                        <div class="row col-sm-12">
                            <div class="col-md-6">
                                Resultados de tu búsqueda entre rangos <span style="font-weight: bold">{{ $DateIni }}</span> y
                                <span style="font-weight: bold">{{ $DateEnd }}</span>
                            </div>
                        </div>
                    @endif -->

            </div>
            <div class="row">
    <div class="col-sm-12 col-md-10 col-lg-12 ">
        <div class="card">
            <div class="card-body" style="overflow: auto;">
                <div class="mx-auto" id="Tickets" style="width: 100%" height: 300px></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawStuff);
    
      // RECORDATORIO, NO TE ESCAMES
      // Para mostrar las fechas debes cambiar el update_at de algún ticket
      // que sea en el rango en los diez días posteriores al día de hoy
      // por la validación que pusiste en el controlador.
      // FÍJATE en toda la consola, ha de estar escondido porai

    function drawStuff() {

        var f_ticket = @json($fresh_tickets);
        var array_final=[];

        for(let pasada_general of f_ticket){

        var arreglo_interno1 = ['', 0, 0];
        
        switch (pasada_general.type) {
            case 'Abierto':
            arreglo_interno1[0] = pasada_general.updated_at.slice(0,11);
            arreglo_interno1[1] = 1;
            break;
            
            case 'Cerrado':
                arreglo_interno1[0] = pasada_general.updated_at.slice(0,11);
                arreglo_interno1[2] = 1;
                break;
                default:
                console.log('Nothing here')
                }
                array_final.push(arreglo_interno1);
            }

            let resp = [];
            array_final.forEach(el=>{
                let index = resp.findIndex(date=> date[0] == el[0]);
                if(index>=0){
                resp[index] = [el[0], resp[index][1]+el[1], resp[index][2]+el[2]];
                }else{
                resp.push(el);
                }
            });     
            resp.unshift(['Fecha', 'Abierto', 'Cerrado'])
            console.log(resp)


    var data = new google.visualization.arrayToDataTable(resp);

        var options = {
        width: 800,
        chart: {
        title: 'Gráfica de Tickets',
            subtitle: 'Abiertos: Azul | Cerrados: Rojo'
        },
          bars: 'horizontal', // Required for Material Bar Charts.

        hAxis: {format: 'decimal'},
        height: 400,
        colors: ['#2FB0D0', '#D04F2F']
        };

    var chart = new google.charts.Bar(document.getElementById('Tickets'));
    chart.draw(data, options);
            }
    </script>
@endsection