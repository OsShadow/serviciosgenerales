@extends('layouts.app')

@section('content')

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
                <div class="card-header">{{ __('Reporte de Compresor') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('compresor.update', $creport->id) }}">
                        
                        @csrf
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="nivel">Nivel de aceite</label>
                                <input type="text" class="form-control" id="nivel" name="level" value="{{$creport->oil_level}}" placeholder="">
                                  </div>

                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="Temperatura">Temperatura</label>
                                <input type="text" class="form-control" value="{{$creport->temperature}}" id="Temperatura" name="temperature" placeholder="">
                                  </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="Observaciones">Observaciones</label>
                          <textarea class="form-control" id="Observaciones"  name="observations" rows="3">{{$creport->observations}}</textarea>
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
