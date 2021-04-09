@extends('layouts.app')

@section('content')

    <div class="container col-md-12">
        <h2> Reportes de agua </h2>

        <div class="card">

            {{-- <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Buscar por fecha</h5>
                    </div>
                    <div class="col-md-6"></div>

                </div>
                <div class="row">
                    <div class="col-md-8">

                        <form class="form-inline" method="POST" action="{{ route('agua.exportpdf') }}">
                            @csrf
                            <div class="input-group-prepend">

                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rangos</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Últimos 15 días</a>
                                    <a class="dropdown-item" href="#">Último mes</a>
                                    <a class="dropdown-item" href="#">Último Bimestre</a>
                                    <a class="dropdown-item" href="#">Último Trimestre</a>
                                    <a class="dropdown-item" href="#">Último Semestre</a>
                                    <a class="dropdown-item" href="#">Último Año</a>
                                </div>
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text">De:</span>
                            </div>
                            <input type="date" aria-label="First name" class="form-control" name="PDF_fecha_inicio"
                                id="PDF_fecha_inicio">
                            <div class="input-group-prepend">
                                <span class="input-group-text">a:</span>
                            </div>
                            <input type="date" aria-label="Last name" class="form-control" name="PDF_fecha_fin"
                                id="PDF_fecha_fin">
                            <div class="input-group-append">

                                <button class="btn btn-outline-secondary" style="margin-left: 5px" type="submit"
                                    id="button-addon2"><i class="fa fa-sync"></i></button>
                            </div>
                            <div class="">
                                <button class="btn btn-warning" style="margin-left: 5px" type="submit" id="button-addon2">
                                    {{ __(' Exportar Seleccion ') }}<i class="fas fa-print"></i></button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div> --}}


            <!-- /.card-header -->


            {{-- Rangos fecha --}}

            <div class="card-body">


                @if ($blnactualreport == false && count($actualreport) == 0)
                    <div class="col-md-12">
                        @can('agua.create')
                            <a href="{{ url('reportes/agua/create') }}"> <button type="button" style="margin: 5px;"
                                    class="btn btn-success float-right">Crear nuevo
                                </button> </a>
                        @endcan
                    </div>
                @endif

                <div class="card-title">Filtrar por fecha</div>

                <div class="card-text">
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

            {{-- Rangos fecha --}}

            @can('agua.edit')

                @if ($blnactualreport != false || count($actualreport) > 0)
                    <div class="card-body">
                        <h3>En progreso: </h3>
                        <table class="table table-striped table-bordered table-hover ">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col-xs-1">ID</th>
                                    <th scope="col">Fecha </th>
                                    <th scope="col">Lectura</th>
                                    <th scope="col">Cloracion</th>
                                    <th data-card-footer scope="col-xs-1">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{ $actualreport[count($actualreport)-1]->id }}
                        {{ $actualreport[0]->id }} --}}
                                @foreach ($actualreport as $areport)

                                    <tr>
                                        <td scope="row">{{ $areport->id }}</td>
                                        <td>{{ $areport->date }}</td>
                                        <td>{{ $areport->read }}</td>
                                        <td>{{ $areport->cloration }}</td>
                                        <td>

                                            <form action="{{ route('agua.destroy', $areport->id) }}" method="POST">
                                                <a href="{{ route('agua.edit', $areport->id) }}"><button type="button"
                                                        class="btn btn-info"> <i class="far fa-eye" style="color: white"
                                                            alt="Submit"> </i> Editar </button></a>
                                                @csrf
                                                @method('DELETE')
                                                @can('agua.destroy')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('¿Seguro que desea Eliminar el reporte?')"> <i
                                                            class="far fa-trash-alt"></i> Eliminar registro </button></button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <div>
                                @if ($blnactualreport != false || count($actualreport) > 0)
                                    <a
                                        href="{{ route('agua.complete', [$actualreport[count($actualreport) - 1]->id, $actualreport[0]->id]) }}">
                                        <button type="button" style="margin: 5px;" class="btn btn-success float-right">Finalizar
                                            reporte
                                        </button> </a>
                                @endif
                                @can('agua.create')
                                    <a href="{{ url('reportes/agua/create') }}"> <button type="button" style="margin: 5px;"
                                            class="btn btn-info float-right">Agregar subregistro
                                        </button> </a>
                                @endcan
                            </div>
                        </table>

                    </div>
                @endif

            @endcan

            @if (count($wreports) > 0)

                <div class="card-body">

                    <h3>Finalizados: </h3>
                    <table class="table table-striped table-bordered table-hover ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col-xs-1">ID</th>
                                <th scope="col">Fecha Inicio</th>
                                <th scope="col">Fecha Fin</th>
                                <th scope="col">Consumo Total</th>
                                <th data-card-footer scope="col-xs-1">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($wreports as $wreport)

                                <tr>
                                    <td scope="row">{{ $wreport->id }}</td>
                                    <td>{{ $wreport->date_start }}</td>
                                    <td>{{ $wreport->date_end }}</td>
                                    <td>{{ $wreport->consumption }}</td>
                                    <td>

                                        <form action="{{ route('agua.destroy', $wreport->id) }}" method="POST">
                                            @can('agua.pdf')
                                                <a href="{{ route('agua.pdf', $wreport->id) }}"><button type="button"
                                                        class="btn btn-warning"><i class="fas fa-print"></i> Exportar registro
                                                    </button></a>
                                            @endcan
                                            <a href="{{ route('agua.show', $wreport->id) }}"><button type="button"
                                                    class="btn btn-info"> <i class="far fa-eye" style="color: white"
                                                        alt="Submit"> </i> Ver subregistros </button></a>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @endif
            @if (count($wreports) == 0)
                <h5 class="col-md-12 text-center">No hay registros finalizados</h5>
            @endif

            <!-- /.card-body -->
            <div class="card-footer clearfix">
            </div>
        </div>
    </div>

@endsection
