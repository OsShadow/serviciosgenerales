@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                Reporte de Ticket
            </div>
            <div class="card-body">
                <h4 class=" d-flex justify-content-center">Estado de Ticket</h4>
                <p class="card-text">{{ $treports->type }}</p>
                <h4 class=" d-flex justify-content-center">Asignado a</h4>
                <p class="card-text">{{ $treports->employer }}</p>
                <h4 class=" d-flex justify-content-center">Descripción del Reporte</h4>
                <p class="card-text">{{ $treports->ticket_report }}</p>
                <h4 class=" d-flex justify-content-center">Fecha límite de Finalización</h4>
                <p class="card-text">{{ $treports->date_finish }}</p>
                <h4 class=" d-flex justify-content-center">Hora límite de Finalización</h4>
                <p class="card-text">{{ $treports->hour_finish }}</p>

                <h4 class=" d-flex justify-content-center">Evidencias</h4>
                    <div>
                        <img src="{{ $treports->file }}" alt="" width="200px">
                    </div>
    
            </div>
            <div class="card-footer text-muted">
                Fecha de reporte: {{ $treports->date }}
            </div>
        </div>
    </div>

@endsection