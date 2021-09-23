@extends('layouts.app')

@section('content')

    <div class="row  border-bottom bg-light dashboard-header " style="padding:0; margin-left: -7px !important; margin-bottom: 10px">
        <div class="col-lg-6" style="margin-left:15px; padding:0;">
            <h2> Reportes de emergencias ambientales </h2>
        </div>
    </div>
    <div class="card" style="padding: 5px">
        <div class="card-body" style="padding: 5px !important">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card-title">Filtrar por fecha</div>
                </div>
            </div>

                {{-- Rango fecha --}}
            <div class="row">
                <div class="col-sm-12 col-md-10"> 
                    <div  class="card-text">
                        <form>
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Inicio</div>
                                        </div>
                                        <input type="date" name="DateIni" value="{{ $DateIni }}" class="form-control"
                                            id="DateInitial">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Fin</div>
                                        </div>
                                        <input type="date" name="DateEnd" value="{{ $DateEnd }}" class="form-control"
                                            id="DateEnding">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-sync"></i>
                                        Actualizar</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">   
                    @can('roles.create')
                        <a href="{{ url('emergencias/create') }}"> <button type="button" style="margin-bottom: 10px"
                            class="btn btn-success float-right">Crear nuevo
                            reporte </button> 
                        </a> <br>   
                    @endcan
                </div>
            </div>


                {{-- Rango fecha --}}

                @if (isset($seleccion))
                <div class="row">
                    <div class="col-md-6">
                        Resultados de tu búsqueda entre rangos <span style="font-weight: bold">{{ $DateIni }}</span> y
                        <span style="font-weight: bold">{{ $DateEnd }}</span>
                    </div>
                    
                    @if (count($ereports) > 0)

                        @can('compresor.pdfgeneral')
                            <div class="col-md-6 text-right">
                                <a href="{{ route('emergencias.pdfgeneral', [$DateIni, $DateEnd]) }}" class="btn btn-warning mb-2">
                                    <i class="fas fa-print"></i> Exportar selección</a>
                            </div>
                        @endcan
                    @endif
                </div>
            @endif

            @if (count($ereports) > 0)


                <table class="table table-striped table-hover " id="TableEmergensiesReports">
                    <thead class="thead-dark">
                        <tr>
                            {{-- <th scope="col">ID</th> --}}
                            <th scope="col">Fecha</th>
                            <th scope="col">Encabezado</th>
                            <th class="text-center" style="width: 250px" data-card-footer scope="col-xs-2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($ereports as $ereport)
                            <tr>
                                {{-- <th scope="row">{{ $ereport->id }}</th> --}}
                                <td>{{ $ereport->date }}</td>
                                <td>{{ $ereport->head }}</td>

                                <td>
                                    <form action="{{ route('emergencias.destroy', $ereport->id) }}" method="POST">

                                        <a href="{{ route('emergencias.pdf', $ereport->id) }}"><button type="button"
                                                class="btn btn-warning"><i class="fas fa-print"></i></button></a>
                                        <a href="{{ route('emergencias.show', $ereport->id) }}"><button type="button"
                                                class="btn btn-info"><i style="color: white" class="far fa-eye"
                                                    alt="Submit"></i></button></a>
                                        <a href="{{ route('emergencias.edit', $ereport->id) }}"><button type="button"
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
                <div class="row d-sm-block">
                    <div class="col-sm-12">
                        {{ $ereports->links() }}
    
                    </div>
    
                </div>
                @else
                <div class="row border" style="margin: 5px; ">
                    <div class="col-xs-12 text-center mx-auto" style="width: 400px; padding:15px;" >
                        <h5 style="margin: 0" >No hay reportes para mostrar</h5>
                        
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
