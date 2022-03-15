@extends('layouts.app')

@section('content')
<div class="row  border-bottom bg-light dashboard-header " style="padding:0; margin-left: -7px !important; margin-bottom: 10px">
    <div class="col-lg-6" style="margin-left:15px; padding:0;">
        <h2>Lista de Tickets </h2>
    </div>
</div>

    <!----Start---->
    <div class="card" style="padding: 5px">
        <div class="card-body" style="padding: 5px !important">

            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card-title">Filtrar por fecha</div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-10">
                    <div class="card-text">

                        <form>
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <div class="input-group mb-2">
                                    <!---INPUT DATE INI---->    
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
                                       <!---INPUT DATE END---->
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-sync"></i>  Filtrar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    
                    <a href="{{ url('tickets/create') }}">
                        <button type="button" class="btn btn-success float-right">Crear nuevo</button>
                    </a>
                                        
                </div>
            </div>
            @if (isset($selection))
                <div class="row col-sm-12">
                    <div class="col-md-6">
                        Resultados de tu búsqueda entre rangos <span style="font-weight: bold">{{ $DateIni }}</span> y
                        <span style="font-weight: bold">{{ $DateEnd }}</span>
                    </div>

                    @if (count($treports) > 0)

                        @can('compresor.pdfgeneral')
                            <div class="col-md-6 text-right">
                                <a href="{{ route('tickets.pdfgeneral', [$DateIni, $DateEnd]) }}" class="btn btn-warning mb-2">
                                    <i class="fas fa-print"></i> Exportar selección</a>
                            </div>
                        @endcan
                    @endif
                    
                </div>
            @endif
            <table class="table table-hover" style="border: solid 1px black">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center" style="width: 120px">Fecha de Creación</th>
                        <th scope="col" class="text-center" style="width: 120px">Fecha de Expiración</th>
                        <th scope="col" class="text-center" style="width: 70px">Hora de Expiración</th>
                        <th scope="col" class="text-center" style="width: 150px">Asignado a</th>
                        <th scope="col" class="text-center" style="width: 200px">Descripción del Reporte</th>
                        <th scope="col" class="text-center"> Estado de Ticket</th>
                        <th scope="col" class="text-center" style="width: 70px">ID</th>
                        <th scope="col" class="text-center" style="width: 210px" data-card-footer scope="col-xs-2">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($treports as $treport)
                   <tr>
                   {{-- <th scope="row">{{ $treport->id }}</th> --}}
                   <td class="text-center text-secondary">{{ $treport->date }}</td>
                   <td class="text-center text-secondary">{{ $treport->date_finish }}</td>
                   <td class="text-center text-secondary">{{ $treport->hour_finish }}</td>
                   <td class="text-center text-secondary">{{ $treport->employer }}</td>
                   <td class="text-center text-secondary">{{ $treport->ticket_report }}</td>
                   <td class="text-center text-secondary">{{ $treport->type }}</td>
                   <td class="text-center text-secondary">{{ $treport->id }}</td>
                   <td>
                        <form action="{{ route('tickets.destroy', $treport->id) }}" method="POST">
                            
                            <a href="{{ route('tickets.pdf', $treport->id) }}">
                           <button type="button" class="btn btn-warning"><i class="fas fa-print"></i></button></a>

                           <a href="{{ route('tickets.show', $treport->id) }}">
                           <button type="button" class="btn btn-info"><i style="color: white" class=" far fa-eye" alt="submit"></i></button></a>

                           <a href="{{ route('tickets.edit', $treport->id) }}">
                           <button type="button" class="btn btn-success"><i class="far fa-edit"></i></button></a>

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
    <!---End--->
@endsection