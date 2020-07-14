@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-sm-6 mx-auto">

        <div class="card text-center">
            <div class="card-header">
                <div class="row">
                <h5 class="col-sm-6 text-left">Codigo Usuario: {{$treports->user_report}}</h5>
                    <div class="col-sm-6 text-right">
                        <a href="{{url('reportes/desechos')}}" class="btn btn-secondary">Volver</a>
                        <a href="{{route('desechos.edit', $treports->id)}}" class="btn btn-primary">Editar</a>
                    </div>

                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="font-weight-bold">Area: </p>
                        <p>{{$treports->area_report}}</p></div>
                    <div class="col-sm-6">
                        <p class="font-weight-bold">Cantidad: </p>
                        <p>{{$treports->quantity}}</p></div>

                </div>



            </div>
            <div class="card-footer text-muted">
            <p class="text-left">Reporte de: {{$treports->date}}</p>
            </div>
          </div>

    </div>
  </div>
@endsection
