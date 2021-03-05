@extends('layouts.app')

@section('content')

    <div class="">
        <a href="{{ route('desechos.create') }}"> <button type="button" class="btn btn-success float-right">Crear nuevo
            </button> </a>
        <h2> Reportes de desechos </h2>

          {{-- Rangos fecha --}}
          

          <div class="card">
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

         

        @if (isset($seleccion))
        <div class="row">
            <div class="col-md-6">
                Resultados de tu búsqueda entre rangos <span style="font-weight: bold">{{ $DateIni }}</span> y
                <span style="font-weight: bold">{{ $DateEnd }}</span>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('desechos.pdfgeneral', [$DateIni, $DateEnd]) }}" class="btn btn-warning mb-2"> <i
                        class="fas fa-print"></i> Exportar selección</a>
            </div>
        </div>
    @endif

    {{-- Rangos fecha --}}

        <table class="table table-striped table-hover ">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Area</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Usuario</th>

                    <th data-card-footer scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($treports as $treport)
                    <tr>

                        <td scope="row">{{ $treport->id }}</td>
                        <td>{{ $treport->date }}</td>
                        <td>{{ $treport->label }}</td>
                        <td>{{ $treport->type }}</td>
                        <td>{{ $treport->quantity }}</td>
                        <td>{{ $treport->user_report }}</td>

                        <td>
                            <form action="{{ route('desechos.destroy', $treport->id) }}" method="POST">
                                <a href="{{ route('desechos.pdf', $treport->id) }}"><button type="button" class="btn btn-warning"><i
                                            class="fas fa-print"></i></button></a>
                                <a href="{{ route('desechos.show', $treport->id) }}"><button type="button"
                                        class="btn btn-info"><i class="far fa-eye" alt="Submit"></i></button></a>
                                <a href="{{ route('desechos.edit', $treport->id) }}"><button type="button"
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
