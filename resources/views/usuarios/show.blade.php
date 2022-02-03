@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container row justify-content-md-center ">
            <div class="col-md-4" align="center">
                <img src={{ asset('dist/img/user.png') }} style="width: 200px;" alt="" class="img-rounded img-responsive mx-auto d-block" />
            </div>
            <div class="col-md-8 d-none d-sm-block">
                <h1 class="display-4">{{ $user->name }} {{ $user->lastname }}</h1>
                <p class="lead">Codigo Universitario: {{ $user->code }}</p>
                <p class="lead">Area:</p>
                <p class="lead">{{ $user->email }}</p>
            </div>
            
        </div>
    </div>
@endsection
