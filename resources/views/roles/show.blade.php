@extends('layouts.app')

@section('content')

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">{{ $rol->name }}</h1>
            <p class="lead">{{ $rol->description }}</p>
            @foreach ($rol->permissions as $permiso)
                <div>
                    <label>
                        {{ $permiso->display }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

@endsection
