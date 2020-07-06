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
                                <div class="form-group">
                                    <label for="nivel">Nivel de aceite</label>
                                    <input type="text" class="form-control" id="nivel" placeholder="">
                                  </div>

                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="Temperatura">Temperatura</label>
                                    <input type="text" class="form-control" id="Temperatura" placeholder="Cantidad por litro">
                                  </div>

                            </div>

                            


                        </div>



                          <div class="form-group">
                            <label for="Observaciones">Observaciones</label>
                            <textarea class="form-control" id="Observaciones" rows="3"></textarea>
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
