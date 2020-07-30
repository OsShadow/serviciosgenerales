@extends('layouts.app')

@section('content')

<div class="" >
<a href=""> <button type="button" class="btn btn-success float-right" >Crear nuevo </button> </a>
    <h2> Reportes de agua </h2>

    <table class="table table-striped table-hover ">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Fecha</th>
          <th scope="col">Hora de inicio</th>
          <th scope="col">Hora de conclusión</th>

          <th scope="col">Lectura inicial</th>

          <th scope="col">Cloración</th>
          <th scope="col">Lectura Final</th>
          <th scope="col">Consumo</th>
          <th scope="col">Consumo Total</th>
          <th scope="col">Observaciones</th>
          <th scope="col">Usuario</th>

          <th data-card-footer scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($wreports as $wreport)

            <tr>
            <td scope="row">{{$wreport->id}}</td>

                <td>{{$wreport->date}}</td>
                <td>{{$wreport->start_hour}}</td>
                <td>{{$wreport->final_hour}}</td>
                <td></td>


                <td>{{$wreport->cloration}}</td>
                <td></td>
                <td>{{$wreport->consumption}}</td>
                <td>{{$wreport->consumption_total}}</td>
                <td>{{$wreport->Observations}}</td>
                <td>{{$wreport->user_report}}</td>


                <td>
                  <form action="" method="POST">
                    <a href="#"><button type="button" class="btn btn-warning"><i class="fas fa-print"></i></button></a>
                  <a href=""><button type="button" class="btn btn-info"><i class="far fa-eye" alt="Submit"></i></button></a>
                  <a href=""><button type="button" class="btn btn-success"><i class="far fa-edit"></i></button></a>
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick= "return confirm('¿Seguro que desea Eliminar el reporte?')"><i class="far fa-trash-alt"></i></button></button>

                </form>
                </td>
            </tr>
            @endforeach
      </tbody>
    </table>

    </div>



@endsection
