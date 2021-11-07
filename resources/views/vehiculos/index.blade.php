@extends('layouts.app')

@section('content')
    <div class="row  border-bottom bg-light dashboard-header " style="padding:0; margin-left: -7px !important; margin-bottom: 10px">
        <div class="col-lg-6" style="margin-left:15px; padding:0;">
            <h2> Reportes de préstamo vehicular - {{ $finalizados ? 'Finalizados' : 'En proceso' }}</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card-title">Filtrar por fecha</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6"> 
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
                <div class="col-sm-12 col-md-6">
                    
                    @can('vehiculos.create')
                    <a href="{{ route('vehiculos.create') }}"> <button type="button" class="btn btn-success float-right"
                            style="margin-bottom: 10px">Crear nuevo
                        </button> </a>
                    @endcan
                    @if ($finalizados)
                    <a href="{{ url('vehiculos') }}"> <button type="button" style="margin-right: 5px"
                            class="btn btn-primary float-right" style="margin-bottom: 10px">Ver reportes en proceso
                        </button> </a>
                @else
                    <a href="{{ url('vehiculos/finalizados') }}"> <button type="button" style="margin-right: 5px"
                            class="btn btn-primary float-right" style="margin-bottom: 10px">Ver reportes finalizados
                        </button> </a>
                @endif
                </div>
            </div>
                {{-- Si se realizo busqueda y esta en vista de finalizados --}}
                @if (isset($seleccion))
                    <div class="row">
                        <div class="col-md-6">
                            Resultados de tu búsqueda entre rangos <span
                                style="font-weight: bold">{{ $DateIni }}</span> y
                            <span style="font-weight: bold">{{ $DateEnd }}</span>
                        </div>
                        @can('vehiculos.pdfgeneral')
                            @if ($finalizados)
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('vehiculos.pdfgeneral', [$DateIni, $DateEnd]) }}"
                                        class="btn btn-warning mb-2"> <i class="fas fa-print"></i> Exportar selección</a>
                                </div>
                            @endif
                        @endcan
                    </div>
                @endif

                {{-- Rangos fecha --}}
                @if (!$finalizados)
                    @if (count($vehiclesunfinished) > 0)

                        <table class="table table-hover  " id="TableVeiculosIncompletosReports" style="border: solid 1px black">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"  class="text-center" style="width: 120px">Fecha Salida</th>
                                    <th scope="col">Chofer</th>
                                    <th scope="col">Vehiculo</th>
                                    <th style="width: 200px" class="text-center" data-card-footer scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($vehiclesunfinished as $vehicle)
                                    @if (auth()->id() == $vehicle->id_user)

                                        <tr>
                                            {{-- <td scope="row">{{ $vehicle->id }}</td> --}}
                                            <td class="text-secondary text-center">{{ $vehicle->date_start }}</td>
                                            <td class="text-secondary">{{ $vehicle->driver }}</td>
                                            <td class="text-secondary">{{ $vehicle->code_car }} - {{ $vehicle->model }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('vehiculos.destroy', $vehicle->id) }}"
                                                    method="POST">
                                                    <a href="{{ route('vehiculos.finaledit', $vehicle->id) }}"><button
                                                            type="button" class="btn btn-success">Finalizar <i
                                                                class="fas fa-clipboard-list"></i></button></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('vehiculos.destroy')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('¿Seguro que desea Eliminar el reporte?')"><i
                                                                class="far fa-trash-alt"></i></button></button>
                                                    @endcan
                                                </form>
                                            </td>
                                        </tr>
                                    @else
                                        @can('vehiculos.indexadmin')
                                            <tr>
                                                {{-- <td scope="row">{{ $vehicle->id }}</td> --}}
                                                <td class="text-secondary text-center">{{ $vehicle->date_start }}</td>
                                                <td class="text-secondary">{{ $vehicle->driver }}</td>
                                                <td class="text-secondary">{{ $vehicle->code_car }} - {{ $vehicle->model }}</td>
                                                <td>
                                                    <form action="{{ route('vehiculos.destroy', $vehicle->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('vehiculos.finaledit', $vehicle->id) }}"><button
                                                                type="button" class="btn btn-success">Finalizar <i
                                                                    class="fas fa-clipboard-list"></i></button></a>
                                                        @csrf
                                                        @method('DELETE')
                                                        @can('vehiculos.destroy')
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('¿Seguro que desea Eliminar el reporte?')"><i
                                                                    class="far fa-trash-alt"></i></button></button>
                                                        @endcan
                                                    </form>
                                                </td>
                                            </tr>
                                        @endcan
                                    @endif
                                @endforeach



                            </tbody>
                        </table>
                        <div class="row d-sm-block">
                            <div class="col-sm-12">
                                {{ $vehiclesunfinished->links() }}
            
                            </div>
            
                        </div>

                        <br>
                    @else
                        <div class="row border" style="margin: 5px; ">
                            <div class="col-xs-12 text-center mx-auto" style="width: 400px; padding:15px;" >
                                <h5 style="margin: 0" >No hay reportes para mostrar</h5>
                                
                            </div>
                        </div>
                    @endif
                

                @else 
                    @if (count($vehiclesfinished) > 0)
                        <table class="table  table-hover  " id="TableVeiculosReports"  style="border: solid 1px black">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 120px">Fecha Salida</th>
                                    <th scope="col">Chofer</th>
                                    <th scope="col">Vehiculo</th>

                                    <th scope="col">Gasolina</th>
                                    <th style="width: 200px" class="text-center" data-card-footer scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($vehiclesfinished as $vehicle)
                                    @if (auth()->id() == $vehicle->id_user)
                                        <tr>
                                            <td class="text-secondary text-center">{{ $vehicle->date_start }}</td>
                                            <td class="text-secondary">{{ $vehicle->driver }}</td>
                                            <td class="text-secondary">{{ $vehicle->code_car }} - {{ $vehicle->model }}</td>
                                            <td class="text-secondary">{{ $vehicle->gas_recharge }}</td>

                                            <td>
                                                <form action="{{ route('vehiculos.destroy', $vehicle->id) }}"
                                                    method="POST">

                                                    @can('vehiculos.edit')


                                                        <a href="{{ route('vehiculos.edit', $vehicle->id) }}"><button
                                                                type="button" class="btn btn-success"><i
                                                                    class="far fa-edit"></i></button></a>

                                                    @endcan

                                                    @csrf
                                                    @method('DELETE')

                                                    @can('vehiculos.pdf')
                                                        <a href="{{ route('vehiculos.pdf', $vehicle->id) }}"><button
                                                                type="button" class="btn btn-warning"><i
                                                                    class="fas fa-print"></i></button></a>
                                                    @endcan
                                                    @can('vehiculos.destroy')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('¿Seguro que desea Eliminar el reporte?')"><i
                                                                class="far fa-trash-alt"></i></button>
                                                    @endcan
                                                </form>
                                            </td>
                                        </tr>
                                    @else
                                        @can('vehiculos.indexadmin')
                                            <tr>
                                                {{-- <td scope="row">{{ $vehicle->id }}</td> --}}
                                                <td class="text-secondary text-center">{{ $vehicle->date_start }}</td>
                                                <td class="text-secondary">{{ $vehicle->driver }}</td>
                                                <td class="text-secondary">{{ $vehicle->code_car }} - {{ $vehicle->model }}</td>
                                                <td class="text-secondary">{{ $vehicle->gas_recharge }}</td>

                                                <td class="text-center">
                                                    <form action="{{ route('vehiculos.destroy', $vehicle->id) }}"
                                                        method="POST">
                                                        @can('vehiculos.edit')

                                                            <a href="{{ route('vehiculos.edit', $vehicle->id) }}"><button
                                                                    type="button" class="btn btn-success"><i
                                                                        class="far fa-edit"></i></button></a>
                                                        @endcan
                                                        @csrf
                                                        @method('DELETE')

                                                        @can('vehiculos.pdf')
                                                            <a href="{{ route('vehiculos.pdf', $vehicle->id) }}"><button
                                                                    type="button" class="btn btn-warning"><i
                                                                        class="fas fa-print"></i></button></a>
                                                        @endcan
                                                        @can('vehiculos.destroy')
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('¿Seguro que desea Eliminar el reporte?')"><i
                                                                    class="far fa-trash-alt"></i></button>
                                                        @endcan
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endcan
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row d-sm-block">
                            <div class="col-sm-12">
                                {{ $vehiclesfinished->links() }}
            
                            </div>
            
                        </div>
                    @else
                        <div class="row border" style="margin: 5px; ">
                            <div class="col-xs-12 text-center mx-auto" style="width: 400px; padding:15px;" >
                                <h5 style="margin: 0" >No hay reportes para mostrar</h5>
                                
                            </div>
                        </div>
                    @endif
                @endif
        </div>
    </div>
@endsection
