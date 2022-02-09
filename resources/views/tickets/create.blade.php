@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Creación Tickets</div>
                        <div class="card-body">
                            
                        <form method="POST" action="{{ url('tickets') }}" enctype="multipart/form-data">
                            @csrf
                            
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="example-date-input">Fecha de generación</label>
                                    <input type="date" class="form-control" value="{{ $date }}" name="date" id="date">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="example-date-input">Fecha de expiración</label>
                                    <input type="date" class="form-control" id="date_finish" name="date_finish">
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <div class="form-group col-md-9">
                                    <label>Asignar a:</label>
                                    <input type="text" class="form-control" placeholder="Nombre completo del empleado" id="employer" name="employer">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="TicketReporte">Reporte</label>
                                    <textarea class="form-control" rows="3" 
                                    placeholder="Describa su reporte" id="reporte_ticket" name="ticket_report"></textarea>
                                </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label>Evidencia</label>
                                    <input type="file" id="file" name="file" accept="image/*">
                                </div>
                            </div>

                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Crear Reporte') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection