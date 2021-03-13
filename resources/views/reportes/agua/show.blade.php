@extends('layouts.app')

@section('content')

<div class="card-body">

    <div style="margin-bottom: 10px">
        @can('agua.pdf')
    <a href="{{ route('agua.pdf', $id) }}"><button type="button"
        class="btn btn-warning"><i class="fas fa-print"></i> Imprimir reporte</button></a>
        @endcan
    </div>
              
    <table class="table table-striped table-bordered table-hover ">
      <thead class="thead-dark">
          <tr>
              <th scope="col">ID</th>
              <th scope="col">Fecha</th>
              <th scope="col">Hora</th>
              <th scope="col">Lectura</th>
              <th scope="col">Cloracion</th>
              <th scope="col">Opciones</th>
          </tr>
      </thead>
      <tbody>

         @foreach ($wreports as $wreport)
    
              <tr scope="row">
                  <td>{{ $wreport->id }}</td>
                  <td>{{ $wreport->date }}</td>
                  <td>{{ $wreport->hour }}</td>
                  <td>{{ $wreport->read }}</td>
                  <td>{{ $wreport->cloration }}</td>
                  <td>
                    
                      <form action="{{ route('agua.destroy', $wreport->id) }}" method="POST">
                          <a href="{{ route('agua.showreport', $wreport->id) }}"><button type="button"
                                  class="btn btn-info"><i class="far fa-eye" style="color: white"
                                      alt="Submit"></i></button></a>
                          <a href="{{ route('agua.edit', $wreport->id) }}"><button type="button"
                                        class="btn btn-primary"><i class="far fa-edit" style="color: white"
                                            alt="Submit"></i></button></a>
                      </form>
                  </td>
              </tr>
           @endforeach
      </tbody>
  </table>
  <br>
  <h4 class="text-right">Consumo total: {{ $consumption }} lt</h3>

  </div>

@endsection
