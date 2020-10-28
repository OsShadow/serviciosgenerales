@extends('layouts.app')

@section('content')

    <div class="container col-md-12">
        <h2> Reportes de agua </h2>

        <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-6"><h5>Buscar por fecha</h5></div>
                <div class="col-md-6"></div>
                
              </div>
              <div class="row">
                <div class="col-md-8">
                  
                  <form  class="form-inline" method="POST" action="{{  route('agua.exportpdf') }}">
                    @csrf
                    <div class="input-group-prepend">
                    
                      <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rangos</button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Ultimos 15 días</a>
                        <a class="dropdown-item" href="#">Ultimo mes</a>
                        <a class="dropdown-item" href="#">Ultimo Bimestre</a>
                        <a class="dropdown-item" href="#">Ultimo Trimestre</a>
                        <a class="dropdown-item" href="#">Ultimo Semestre</a>
                        <a class="dropdown-item" href="#">Ultimo Año</a>
                      </div>
                    </div>
                    <div class="input-group-prepend">
                      <span class="input-group-text">De:</span>
                    </div>
                    
                    <input type="date" aria-label="First name" class="form-control" name="PDF_fecha_inicio" id="PDF_fecha_inicio">
                    <div class="input-group-prepend">
                      <span class="input-group-text">a:</span>
                    </div>
                    <input type="date" aria-label="Last name" class="form-control" name="PDF_fecha_fin" id="PDF_fecha_fin">
                    <div class="input-group-append">
                  
                      <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="" >
                  
                      <button class="btn btn-warning" type="submit" id="button-addon2"> {{ __('Exportar  ') }}<i class="fas fa-print"></i></button>
                    </div>
  
  
                  </form>
                  
                </div>
                <div class="col-md-4">
                  <a href="{{ url('reportes/agua/create') }}"> <button type="button"  style="margin: 5px;" class="btn btn-success float-right">Crear nuevo
                  </button> </a>                

                  
                </div>
                
                

              </div>

                
               
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              <table class="table table-striped table-bordered table-hover ">
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
                    @foreach ($wreports as $wreport)
    
                        <tr>
                            <td scope="row">{{ $wreport->id }}</td>
    
                            <td>{{ $wreport->date }}</td>
                            <td>{{ $wreport->start_hour }}</td>
                            <td>{{ $wreport->final_hour }}</td>
                            <td>{{ $wreport->initial_read }}</td>
    
                            <td>{{ $wreport->cloration }}</td>
                            <td>{{ $wreport->final_read }}</td>
                            <td>{{ $wreport->consumption }}</td>
                            <td>{{ $wreport->consumption_total }}</td>
                            <td>{{ $wreport->Observations }}</td>
                            <td>{{ $wreport->user_report }}</td>
    
                            <td>
    
                                <form action="{{ route('agua.destroy', $wreport->id) }}" method="POST">
                                    <a href="{{ route('agua.pdf', $wreport->id) }}"><button type="button"
                                        class="btn btn-warning"><i class="fas fa-print"></i></button></a>
                                    <a href="{{ route('agua.show', $wreport->id) }}"><button type="button"
                                            class="btn btn-info"><i class="far fa-eye" style="color: white"
                                                alt="Submit"></i></button></a>
                                    <a href="{{ route('agua.edit', $wreport->id) }}"><button type="button"
                                            class="btn btn-success"><i class="far fa-edit"></i></button></a>
    
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('¿Seguro que desea Eliminar el reporte?')"><i
                                            class="far fa-trash-alt"></i></button></button>
    
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              {{-- <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
              </ul> --}}
            </div>
          </div>



        
        
        

    </div>



    

@endsection
