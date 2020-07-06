@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h3>Editar Usuario: {{$user->name}}</h3>
        <form action="{{route('usuarios.update',$user->id)}}" method="POST">
            @method('PATCH')
    @csrf
    <div class="form-group">
      <label for="name">Nombre</label>
    <input type="text" class="form-control" name="name" value="{{$user->name }}" placeholder="Escribe tu nombre">
    </div>
    <div class="form-group">
        <label for="email">Email </label>
    <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="Escribe tu email">
       
      </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <button type="reset" class="btn btn-danger float-right">Cancelar</button>
  </form>

</div>
</div>
</div>
@endsection