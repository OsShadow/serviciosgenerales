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
                    <div class="card-header">{{ __('Reporte vehicular') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('vehiculos') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="form-group ">
                                        <label for="date_start">Fecha de salida</label>
                                        <input class="form-control" type="date" value="{{ $date }}" name="date_start"
                                            id="date_start">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="hour_start">Hora de salida</label>
                                        <input class="form-control" type="time" value="{{ $hour }}" id="hour_start"
                                            name="hour_start">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="km_start">KM de salida</label>
                                        <input type="number" class="form-control" id="km_start" name="km_start"
                                            placeholder="Medida de lectura ">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="driver">Nombre del Chofer</label>
                                        <input type="text" class="form-control" id="driver" name="driver"
                                            placeholder="Nombre completo">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="vehicle">Vehiculo</label>
                                    <select class="custom-select" id="vehicle" name="vehicle" required>
                                      <option selected disabled value="">Elige código de vehiculo...</option>
                                      
                                      @foreach ($vehicles as $vehicle)
                                      <option value="{{ $vehicle->id }}">{{ $vehicle->code_car }} - ({{ $vehicle->model }} {{ $vehicle->year }})</option>
                                      @endforeach
                                      
                                    </select>
                                </div>
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
