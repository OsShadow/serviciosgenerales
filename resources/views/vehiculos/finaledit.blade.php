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
                    <div class="card-header">
                        <img src={{ asset('dist/img/udg/udg.png') }} style="height: 40px; margin-right:10px" alt="UDG">
                        <i class="nav-icon fas fa-car-side" style="font-size:20px"></i>
                        {{ __('Reporte vehicular - completar registro') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('vehiculos.completereport' ,  $vehiclereport->id) }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="form-group ">
                                        <label for="date_start">Fecha de salida</label>
                                        <input class="form-control" type="date"  name="date_start"
                                        value="{{ $vehiclereport->date_start }}"  id="date_start">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="hour_start">Hora de salida</label>
                                        <input class="form-control" type="time"  id="hour_start"
                                        value="{{ $vehiclereport->hour_start }}"  name="hour_start">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="km_start">KM de salida</label>
                                        <input type="number" class="form-control" id="km_start" name="km_start"
                                            value="{{ $vehiclereport->km_start }}" placeholder="Medida de lectura ">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="driver">Nombre del Chofer</label>
                                        <input type="text" class="form-control" id="driver" name="driver"
                                        value="{{ $vehiclereport->driver }}" placeholder="Nombre completo">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                <div class=" col-md-4">
                                    <label for="vehicle">Vehiculo</label>
                                    <select class="custom-select" id="vehicle" name="vehicle" required >
                                    
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->code_car }} - ({{ $vehicle->model }} {{ $vehicle->year }})</option>
                                     
                                      {{-- @foreach ($vehicle as $v)
                                      <option selected value="{{ $v->id }}">{{ $v->code_car }} - ({{ $v->model }} {{ $v->year }})</option>
                                      @endforeach --}}
                                    </select>
                                </div>



                            </div>

                                <div class="form-group col-md-6">
                                    <div class="form-group ">
                                        <label for="date">Fecha de llegada</label>
                                        <input class="form-control" type="date" name="date_end" value="{{ $date }}" 
                                            id="date_end">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="hour">Hora de llegada</label>
                                        <input class="form-control" type="time" value="{{ $hour }}" id="hour_end"
                                            name="hour_end">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="Lectura_inicial">KM de llegada</label>
                                        <input type="number" class="form-control" id="km_end" name="km_end"
                                            placeholder="Medida de lectura ">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label for="Lectura_inicial">Recarga de gasolina</label>
                                        <input type="number" class="form-control" id="gas_recharge" name="gas_recharge"
                                            placeholder="Recarga de litros para el viaje">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="Observaciones">Observaciones</label>
                                    <textarea class="form-control" id="observations" name="observations" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Finalizar Reporte') }}
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


 
@endsection
