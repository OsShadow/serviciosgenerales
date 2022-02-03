@extends('layouts.app')

@section('content')

@foreach ($treport as $trep)

<div class="row">

    <div class="col-sm-6 mx-auto">

        <div class="card text-center">
            <div class="card-header">
                <div class="row">
                <h5 class="col-sm-6 text-left">Codigo Usuario: {{$trep->user_report}}</h5>
                    <div class="col-sm-6 text-right">
                        <a href="{{url('reportes/desechos')}}" class="btn btn-secondary">Volver</a>
                        <a href="{{route('desechos.edit', $trep->id)}}" class="btn btn-primary">Editar</a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="font-weight-bold">Area: </p>
                        <p>{{$trep->label}}</p></div>
                        <div class="col-sm-6">
                            <p class="font-weight-bold">Tipo de basura: </p>
                            <p>{{$trep->type}}</p></div>
                    <div class="col-sm-6">
                        <p class="font-weight-bold">Cantidad: </p>
                        <p>{{$trep->quantity}}</p></div>
                </div>
            </div>
            <div class="card-footer text-muted">
            <p class="text-left">Reporte de: {{$trep->date}}</p>
            </div>
          </div>

    </div>
  </div>

  @endforeach
@endsection
