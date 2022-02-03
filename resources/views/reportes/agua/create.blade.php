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
                        <form method="POST" action="{{ url('reportes/agua') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="form-group ">
                                        <label for="date">Fecha</label>
                                        <input class="form-control" type="date" name="date" value="{{ $date }}" name="date"
                                            id="date">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="hour">Hora de reporte</label>
                                        <input class="form-control" type="time" value="{{ $hour }}" id="hour"
                                            name="hour">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="Lectura_inicial">Lectura</label>
                                        <input type="number" class="form-control" id="initial_read" name="read"
                                            placeholder="Medida de lectura ">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="cloration">Cloración</label>
                                        <input type="number" class="form-control" id="cloration" name="cloration"
                                            placeholder="Cantidad por litro">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Observaciones">Observaciones</label>
                                <textarea class="form-control" id="observations" name="observations" rows="3"></textarea>
                            </div>

                            <div class="form-group col-md-6">

                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Crear Reporte') }}
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
