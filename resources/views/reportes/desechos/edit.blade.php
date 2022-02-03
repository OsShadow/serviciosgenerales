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
                <div class="card-header">{{ __('Editar reporte Reporte') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('desechos.update', $treports->id) }}">
                        
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="area">Area</label>
                                <select class="custom-select" id="area" name="area" value="{{$area->id}}"  required> 
                                  @foreach ($areports as $areport)
                                  <option {{ $areport->id == $area->id ? "selected" : "" }} value="{{ $areport->id }}">{{ $areport->label }}</option>
                                  @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="type">Tipo de basura</label>
                                <select class="custom-select" id="type" name="type" required>
                                  <option {{ $treports->id == "Sanitario" ? "selected" : "" }} value="Sanitario">Sanitario</option>
                                  <option {{ $treports->id == "General" ? "selected" : "" }}value="General">General</option>
                                  <option {{ $treports->id == "RPBI" ? "selected" : "" }} value="RPBI">RPBI</option>
                                  <option {{ $treports->id == "Cartón" ? "selected" : "" }}value="Cartón">Cartón</option>
                                  <option {{ $treports->id == "Aluminio" ? "selected" : "" }} value="Aluminio">Aluminio</option>
                                  <option {{ $treports->id == "PET" ? "selected" : "" }}value="PET">PET</option>

                                  
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="quantity">Cantidad</label>
                                <input type="number" class="form-control" value="{{$treports->quantity}}" id="quantity" name="quantity" placeholder="Cantidad por kilo">
                                  </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">

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

@endsection
