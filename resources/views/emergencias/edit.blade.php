@extends('layouts.app')

@section('content')
    <div class="row  border-bottom bg-light dashboard-header " style="padding:0; margin-left: -7px !important; margin-bottom: 10px">
        <div class="col-lg-6" style="margin-left:15px; padding:0;">
            <h2> Editar reportes de emergencia </h2>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="container">
                <form method="POST" action="{{ route('emergencias.update', $ereport->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Fecha</div>
                                </div>
                                <input class="form-control" type="date" value="{{ $ereport->date }}" name="date" id="date">

                            </div>
    
                        </div>
                        
                        <div class="col-sm-12" style="padding-top: 10px">
                            <div class="form-group">
                                <label for="head">Encabezado</label>
                                <textarea class="form-control" id="head" name="head"
                            rows="3">{{ $ereport->head }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea class="form-control" id="description" name="description"
                                    rows="3">{{ $ereport->description }}</textarea>
                            </div>
                
                            <div class="form-group">
                                <label for="observations">Observaciones</label>
                                <textarea class="form-control" id="observations" name="observations"
                                    rows="3">{{ $ereport->observations }}</textarea>
                            </div>
                            
                        </div>
                    </div>

                    
        
                   
        
                    
                    <button type="submit" class="btn btn-primary btn">
                        {{ __('Editar Reporte') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
