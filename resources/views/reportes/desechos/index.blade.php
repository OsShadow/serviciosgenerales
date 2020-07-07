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
              <th scope="col">Area</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Usuario</th>

              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>

            @foreach($treports as $treport)
                <tr>

                <th scope="row">{{$treport->id}}</th>
                <th></th>
                <td>{{$treport->area_report}}</td>
                <td>{{$treport->quantity}}</td>
                <td>{{$treport->user_report}}</td>


                    <td>
                      <form action="" method="POST">
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
