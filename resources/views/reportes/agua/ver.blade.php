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

          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
            <tr>
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

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

      </tbody>
    </table>

    </div>


    
@endsection
