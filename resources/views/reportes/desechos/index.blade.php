@extends('layouts.app')

@section('content')
        <div class="row  border-bottom bg-light dashboard-header " style="padding:0; margin-left: -7px !important; margin-bottom: 10px">
            <div class="col-lg-6" style="margin-left:15px; padding:0;">
                <h2>Reportes de desechos </h2>
            </div>
        </div>

        <div class="card" style="padding: 5px">
            <div class="card-body" style="padding: 5px !important">

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="card-title">Filtrar por fecha</div>
                    </div>
                </div>
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
                        
                        @can('desechos.create')
                        <a href="{{ route('desechos.create') }}"> <button type="button" class="btn btn-success float-right">Crear nuevo
                            </button> </a>
                        @endcan
                    </div>
                </div>

                @if (isset($seleccion))
                    <div class="row">
                        <div class="col-md-6">
                            Resultados de tu búsqueda entre rangos <span
                                style="font-weight: bold">{{ $DateIni }}</span> y
                            <span style="font-weight: bold">{{ $DateEnd }}</span>
                        </div>
                        @if (count($treports) > 0)

                            @can('desechos.pdfgeneral')
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('desechos.pdfgeneral', [$DateIni, $DateEnd]) }}"
                                        class="btn btn-warning mb-2"> <i class="fas fa-print"></i> Exportar selección</a>
                                </div>

                            @endcan
                        @endif
                        
                    </div>
                @endif

                @if (count($treports) > 0)
                    <table class="table table-striped table-bordered table-hover " id="TableWasteReports">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Area</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Usuario</th>
                                            <th class="text-center" style="width: 250px" data-card-footer scope="col-xs-2">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                
                
                                        @foreach ($treports as $treport)
                                            <tr>
                                                <td>{{ $treport->date }}</td>
                                                <td>{{ $treport->label }}</td>
                                                <td>{{ $treport->type }}</td>
                                                <td>{{ $treport->quantity }}</td>
                                                <td>{{ $treport->user_report }}</td>
                
                                                <td>
                                                    <form action="{{ route('desechos.destroy', $treport->id) }}" method="POST">
                                                        @can('desechos.pdf')
                                                        <a href="{{ route('desechos.pdf', $treport->id) }}"><button type="button"
                                                                class="btn btn-warning"><i class="fas fa-print"></i></button></a>
                                                        @endcan 
                                                        <a href="{{ route('desechos.show', $treport->id) }}"><button type="button"
                                                                class="btn btn-info"><i class="far fa-eye" alt="Submit"></i></button></a>
                                                        @can('desechos.edit')
                                                            <a href="{{ route('desechos.edit', $treport->id) }}"><button type="button"
                                                                    class="btn btn-success"><i class="far fa-edit"></i></button></a>
                                                        @endcan
                                                        @csrf
                                                        @method('DELETE')
                                                        @can('desechos.destroy')
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
                    <div class="row d-sm-block">
                        <div class="col-sm-12">
                            {{ $treports->links() }}
        
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
