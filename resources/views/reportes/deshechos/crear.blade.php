@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Reporte de Compresor') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="form-group ">
                                    <label for="example-date-input" >Fecha de generación</label>
                                      <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                                  </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="validationDefault04">Area</label>
                                <select class="custom-select" id="validationDefault04" required>
                                  <option selected disabled value="">Elige area...</option>
                                  <option>...</option>
                                </select>

                            </div>





                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="Temperatura">Cantidad</label>
                                    <input type="text" class="form-control" id="Temperatura" placeholder="Cantidad por litro">
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
