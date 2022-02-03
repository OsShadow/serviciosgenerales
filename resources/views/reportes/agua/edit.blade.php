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
                <div class="card">
                    <div class="card-header">{{ __('Reporte de Agua') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('agua.update', $wreport->id) }}">

                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="form-group ">
                                        <label for="date">Fecha de generación</label>
                                        <input class="form-control" type="date" name="" value="{{ $wreport->date }}" name="date"
                                            id="date">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="hour">Hora de lectura</label>
                                        <input class="form-control" type="time" value="{{ $wreport->hour }}" id="start_hour"
                                            name="hour">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="cloration">Cloración</label>
                                        <input type="number" class="form-control" id="cloration" name="cloration"
                                            placeholder="Cantidad por litro" value="{{ $wreport->cloration }}">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="read">Lectura </label>
                                        <input type="number" class="form-control" id="final_read" name="read"
                                            placeholder="" value="{{ $wreport->read }}">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="Observaciones">Observaciones</label>
                                    <textarea class="form-control" id="observations" name="Observations"
                                        rows="3">{{ $wreport->Observations }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12 text-right">

                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Editar Reporte') }}
                                </button>
        
                            </div>
                            </form>
                        </div>
                    </div>
                   
            </div>
        </div>
    </div>
    </div>

@endsection
