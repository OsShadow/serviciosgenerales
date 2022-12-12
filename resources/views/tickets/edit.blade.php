@extends('layouts.app')

@section('content')

@if (count($errors) > 0)

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="text-center">
                    <strong>¡Parece que algunos campos estan vacios o no tienen los datos correctos!</strong>
                </div>
                <ul>
                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach
                </ul>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>

@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Editar Ticket') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('tickets.update', $treports->id) }}" enctype="multipart/form-data">

                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="area">Fecha de expiración</label>
                                <input type="date" class="form-control" value="{{ $treports->date_finish }}" name="date_finish" id="date_finish">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="area">Hora de expiración</label>
                                <input type="time" class="form-control" value="{{ $treports->hour_finish }}" name="hour_finish" id="hour_finish">
                            </div>

                            <div class="form-group col-md-4">
                                <label class="text-white bg-red">SI NO SE ELIGE EL ESTADO DEL TICKET QUEDARÁ AUTOMÁTICAMENTE POR DEFECTO COMO ABIERTO</label>
                                <label for="type">Estado actual de Ticket:</label>
                                <label for="type" class="text-white bg-green">{{ $treports->type }}</label>
                                <select class="custom-select" id="type" name="type">
                                    <option {{ $treports->id == "Abierto" ? "selected" : "" }} value="Abierto">Abierto</option>
                                    <option {{ $treports->id == "Ejecutando" ? "selected" : "" }}value="Ejecutando">Ejecutando</option>
                                    <option {{ $treports->id == "Cerrado" ? "selected" : "" }} value="Cerrado">Cerrado</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Asignar a</label>
                                <textarea class="form-control" id="employer" name="employer" rows="3">{{ $treports->employer }}</textarea>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Reporte</label>
                                <textarea class="form-control" id="ticket_report" name="ticket_report" rows="3">{{ $treports->ticket_report }}</textarea>
                            </div>




                        </div>

                        <div class="form-group col-md-6">

                            <button type="submit" class="btn btn-primary">
                                {{ __('Confirmar Edición') }}
                            </button>

                        </div>
                    </form>

                    <div>
                        <label>Evidencias</label>
                        <div class="card-body">
                            <div class="row">
                                @foreach($timages as $timage)
                                <div class="col-sm-2">
                                    <a href={{asset('/uploads/'.$timage->ticket_id.'/'.$timage->file)}} target="_blank" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">

                                        <img src={{asset('/uploads/'.$timage->ticket_id.'/'.$timage->file)}} class="img-fluid mb-2" alt="white sample" />
                                    </a>
                                </div>
                                <form method="POST" action="{{route('tickets.deleteimage', [$treports->id, $timage->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que desea eliminar el reporte?')"><i class="far fa-trash-alt"></i></button>
                                </form>
                                @endforeach
                                <form method="POST" action="{{route('tickets.addimage', $treports->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file[]" id="file" multiple class="form-control">
                                    <br>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Agregar evidencias') }}
                                    </button>
                                </form>

                            </div>

                        </div>
                        <a href="http://serviciosgenerales.test/tickets">
                            <button class="btn btn-danger float-right">Regresar</button>
                        </a>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>

@endsection