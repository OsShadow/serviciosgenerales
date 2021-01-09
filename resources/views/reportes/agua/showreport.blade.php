@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-6 mx-auto">
            <div class="card text-center">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <a href="{{ route('agua.show', $id) }}" class="btn btn-secondary">Volver</a>
                            <a href="{{ route('agua.edit', $wreport->id) }}" class="btn btn-primary">Editar</a>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="font-weight-bold">Fecha de reporte: </p>
                            <p>{{ $wreport->date }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="font-weight-bold">Hora de reporte: </p>
                            <p>{{ $wreport->hour }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="font-weight-bold">Lectura : </p>
                            <p>{{ $wreport->read }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="font-weight-bold">Cloracion : </p>
                            <p>{{ $wreport->cloration }}</p>
                        </div>
                        @if ($wreport->Observations != '')
                        <div class="col-sm-12">
                            <p class="font-weight-bold">Observaciones : </p>
                            <p>{{ $wreport->Observations }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
