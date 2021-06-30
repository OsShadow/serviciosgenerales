@extends('layouts.app')

@section('content')

    <h2> Reportes de Compresor </h2>

    <div class="card">
        <div class="card-body">
            @can('compresor.create')
                <a href="{{ url('reportes/compresor/create') }}"> <button type="button"
                        class="btn btn-success float-right">Crear
                        nuevo </button> </a>
            @endcan
            {{-- Rangos fecha --}}

            <div class="card-body">

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
                <div class="row">
                    <div class="col-md-6">
                        Resultados de tu búsqueda entre rangos <span style="font-weight: bold">{{ $DateIni }}</span> y
                        <span style="font-weight: bold">{{ $DateEnd }}</span>
                    </div>
                    @can('compresor.pdfgeneral')
                        <div class="col-md-6 text-right">
                            <a href="{{ route('compresor.pdfgeneral', [$DateIni, $DateEnd]) }}" class="btn btn-warning mb-2">
                                <i class="fas fa-print"></i> Exportar selección</a>
                        </div>
                    @endcan
                </div>
            @endif

            {{-- Rangos fecha --}}

            <table class="table table-striped table-hover " id="myTable">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Nivel de aceite</th>
                        <th scope="col">Temperatura</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Usuario</th>
                        <th data-card-footer scope="col">Opciones</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($creports as $creport)

                        <tr>
                            <td scope="row">{{ $creport->id }}</td>
                            <td>{{ $creport->date }}</td>
                            <td>{{ $creport->oil_level }} %</td>
                            <td>{{ $creport->temperature }} °C</td>
                            <td>{{ $creport->observations }}</td>
                            <td>{{ $creport->user_report }}</td>

                            <td>
                                <form action="{{ route('compresor.destroy', $creport->id) }}" method="POST">

                                    @can('compresor.pdf')
                                    <a href="{{ route('compresor.pdf', $creport->id) }}"><button type="button"
                                            class="btn btn-warning"><i class="fas fa-print"></i></button></a>
                                    @endcan
                                    <a href="{{ route('compresor.show', $creport->id) }}"><button type="button"
                                            class="btn btn-info"><i class="far fa-eye" alt="Submit"
                                                style="color: white"></i></button></a>
                                    @can('compresor.edit')
                                        <a href="{{ route('compresor.edit', $creport->id) }}"><button type="button"
                                                class="btn btn-success"><i class="far fa-edit"></i></button></a>
                                    @endcan

                                    @csrf
                                    @method('DELETE')
                                    @can('compresor.destroy')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Seguro que desea Eliminar el reporte?')"><i
                                                class="far fa-trash-alt"></i></button></button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


@endsection
