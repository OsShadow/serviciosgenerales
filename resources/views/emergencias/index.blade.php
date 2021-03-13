@extends('layouts.app')

@section('content')

    <div class="container">


        <h2> Reportes de emergencias ambientales </h2>

        <div class="card">
            <div class="card-body">

                <a href="{{ url('emergencias/create') }}"> <button type="button" style="margin-bottom: 10px"
                        class="btn btn-success float-right">Crear nuevo
                        reporte </button> </a> <br>

                {{-- Rango fecha --}}

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

                {{-- Rango fecha --}}

                @if (isset($seleccion))
                <div class="row">
                    <div class="col-md-6">
                        Resultados de tu búsqueda entre rangos <span style="font-weight: bold">{{ $DateIni }}</span> y
                        <span style="font-weight: bold">{{ $DateEnd }}</span>
                    </div>
                    @can('compresor.pdfgeneral')
                        <div class="col-md-6 text-right">
                            <a href="{{ route('emergencias.pdfgeneral', [$DateIni, $DateEnd]) }}" class="btn btn-warning mb-2">
                                <i class="fas fa-print"></i> Exportar selección</a>
                        </div>
                    @endcan
                </div>
            @endif

                <table class="table table-striped table-hover ">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Encabezado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($ereports as $ereport)
                            <tr>
                                <th scope="row">{{ $ereport->id }}</th>
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
            </div>
        </div>
    </div>

@endsection
