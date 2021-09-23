@extends('layouts.app')

@section('content')

        <div class="row  border-bottom bg-light dashboard-header " style="padding:0; margin-left: -7px !important; margin-bottom: 10px">
            <div class="col-lg-6" style="margin-left:15px; padding:0;">
                <h2>Reportes de agua </h2>
            </div>
        </div>

        <div class="card">

            <div class="card-body" style="padding: 5px !important">
                
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div style="margin-left: 5px" class="card-title">Filtrar por fecha</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-10"> 
                        <div style="margin-left: 5px"  class="card-text">
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
                        
                        @can('agua.create')
                        <a href="{{ url('reportes/agua/create') }}"> <button type="button" style="margin: 5px;"
                                class="btn btn-success float-right">Crear nuevo
                            </button> </a>
                        @endcan
                    </div>
                </div>

            </div>

            @if (isset($seleccion))
                <div class="row" style="margin-left: 20px; margin-right: 20px">
                    <div class="col-md-6">
                        Resultados de tu búsqueda entre rangos <span style="font-weight: bold">{{ $DateIni }}</span> y
                        <span style="font-weight: bold">{{ $DateEnd }}</span>
                    </div>
                    @can('agua.pdfgeneral')
                        <div class="col-md-6 text-right">
                            <a href="{{ route('agua.pdfgeneral', [$DateIni, $DateEnd]) }}" class="btn btn-warning mb-2">
                                <i class="fas fa-print"></i> Exportar selección</a>
                        </div>
                    @endcan
                </div>
            @endif

            @if (count($wreports) > 0)

                <div class="card-body" style="padding: 10px">

                    {{-- <h3>Finalizados: </h3> --}}
                    <table class="table table-striped table-bordered table-hover " id="TableWaterReports">
                        <thead class="thead-dark">
                            <tr>
                                {{-- <th scope="col-xs-1">ID</th> --}}
                                <th scope="col">Fecha </th>
                                <th scope="col">Lectura (m³)</th>
                                <th scope="col">Consumo (m³)</th>
                                <th class="text-center" style="width: 200px" data-card-footer scope="col-xs-1">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($wreports as $key => $wreport)

                                <tr>
                                    {{-- <td scope="row">{{ $wreport->id }}</td> --}}
                                    <td>{{ $wreport->date }}</td>
                                    <td>{{ $wreport->read }}</td>
                                    @if ($key == 0)
                                        <td> 0.00 </td>
                                    @else
                                        <td>{{ number_format($wreports[$key - 1]->read - $wreports[$key]->read, 2, '.', '') }}
                                        </td>
                                    @endif
                                    <td class="text-center">
                                        <form action="{{ route('agua.destroy', $wreport->id) }}" method="POST">
                                            @can('agua.edit')

                                                <a href="{{ route('agua.showreport', $wreport->id) }}"><button type="button"
                                                        class="btn btn-info" [$key]><i class="far fa-eye" style="color: white"
                                                            alt="Submit"></i></button></a>

                                                <a href="{{ route('agua.edit', $wreport->id) }}"><button type="button"
                                                        class="btn btn-primary"><i class="far fa-edit" style="color: white"
                                                            alt="Submit"></i></button></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('¿Seguro que desea Eliminar el reporte?')"><i
                                                        class="far fa-trash-alt"></i></button>
                                            @endcan

                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row d-sm-block">
                        <div class="col-sm-12">
                            {{ $wreports->links() }}
    
                        </div>
    
                    </div>
                </div>

                <h4 class="text-right" style="margin-right:1.25em">Consumo total: {{ number_format( $wreports[0]->read - $wreports[count($wreports) - 1]->read, 2, '.', '')  }} m³ </h4>
            @else


                    <div class="row border" style="margin: 5px; ">
                        <div class="col-xs-12 text-center mx-auto" style="width: 400px; padding:15px;" >
                            <h5 style="margin: 0" >No hay reportes para mostrar</h5>
                            
                        </div>
                    </div>
            @endif

        </div>

@endsection
 