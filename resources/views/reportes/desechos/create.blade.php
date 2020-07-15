@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Reporte de desechos') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('reportes/desechos') }}">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="form-group ">
                                    <label for="date" >Fecha de generación</label>
                                      <input class="form-control" type="date" value="2011-08-19" id="date" name="date">
                                  </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="area">Area</label>
                                <select class="custom-select" id="area" name="area" required>
                                  <option selected disabled value="">Elige area...</option>
                                  <option>1</option>
                                </select>

                            </div>

                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="quantity">Cantidad</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Cantidad por litro">
                                  </div>

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
