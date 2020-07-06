@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Reporte de Compresor') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('reportes/compresor') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="form-group ">
                                    <label for="example-date-input" >Fecha de generación</label>
                                      <input class="form-control" type="date" value="2011-08-19" name="date" id="example-date-input">
                                  </div>
                            </div>

                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="nivel">Nivel de aceite</label>
                                    <input type="text" class="form-control" id="nivel" name="level" placeholder="">
                                  </div>

                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="Temperatura">Temperatura</label>
                                    <input type="text" class="form-control" id="Temperatura" name="temperature" placeholder="">
                                  </div>

                            </div>

                        </div>

                          <div class="form-group">
                            <label for="Observaciones">Observaciones</label>
                            <textarea class="form-control" id="Observaciones" name="observations" rows="3"></textarea>
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
