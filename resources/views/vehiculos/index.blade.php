@extends('layouts.app')

@section('content')

    <div class="">



        <h2> Reportes de préstamo vehicular </h2>

        {{-- Rangos fecha --}}

        <div class="card">
            <div class="card-body">

                <a href="{{ route('vehiculos.create') }}"> <button type="button" class="btn btn-success float-right"
                        style="margin-bottom: 10px">Crear nuevo
                    </button> </a>

                {{-- <div class="card-title">Filtrar por fecha</div> --}}

                {{-- <div class="card-text">
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
                </div> --}}


                {{-- @if (isset($seleccion))
                    <div class="row">
                        <div class="col-md-6">
                            Resultados de tu búsqueda entre rangos <span
                                style="font-weight: bold">{{ $DateIni }}</span> y
                            <span style="font-weight: bold">{{ $DateEnd }}</span>
                        </div>
                        @can('desechos.pdfgeneral')
                            <div class="col-md-6 text-right">
                                <a href="{{ route('desechos.pdfgeneral', [$DateIni, $DateEnd]) }}"
                                    class="btn btn-warning mb-2"> <i class="fas fa-print"></i> Exportar selección</a>
                            </div>

                        @endcan
                    </div>
                @endif --}}

                {{-- Rangos fecha --}}
                <h3>En proceso: </h3>
                <table class="table table-striped table-hover ">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Fecha Salida</th>
                            <th scope="col">Chofer</th>
                            <th scope="col">Vehiculo</th>
                            <th data-card-footer scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($vehiclesunfinished as $vehicle)
                            <tr>

                                <td scope="row">{{ $vehicle->id }}</td>
                                <td>{{ $vehicle->date_start }}</td>
                                <td>{{ $vehicle->driver }}</td>
                                <td>{{ $vehicle->code_car }} - {{ $vehicle->model }}</td>
                                

                                <td>
                                    <form action="{{ route('vehiculos.destroy', $vehicle->id) }}" method="POST">

                                        <a href="{{ route('vehiculos.finaledit', $vehicle->id) }}"><button type="button"
                                                class="btn btn-success">Finalizar <i class="fas fa-clipboard-list"></i></button></a>
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
                <br>
                <h3>Finalizados: </h3>
                <table class="table table-striped table-hover ">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Fecha Salida</th>
                            <th scope="col">Chofer</th>
                            <th scope="col">Vehiculo</th>
                            
                            <th scope="col">Gasolina</th>
                            <th data-card-footer scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($vehiclesfinished as $vehicle)
                            <tr>

                                <td scope="row">{{ $vehicle->id }}</td>
                                <td>{{ $vehicle->date_start }}</td>
                                <td>{{ $vehicle->driver }}</td>
                                <td>{{ $vehicle->code_car }} - {{ $vehicle->model }}</td>
                                <td>{{ $vehicle->gas_recharge }}</td>

                                <td>
                                    <form action="{{ route('vehiculos.destroy', $vehicle->id) }}" method="POST">

                                        <a href="{{ route('vehiculos.edit', $vehicle->id) }}"><button type="button"
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
        </div>
    </div>



@endsection
