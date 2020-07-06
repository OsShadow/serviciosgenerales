@extends('layouts.app')

@section('content')
<div class="container" >
<a href="usuarios/create"> <button type="button" class="btn btn-success float-right" > Agregar usuario </button> </a>
<h2> Lista de usuarios </h2>
<h6>
  @if($search)
  <div class="alert alert-primary" role="alert">
  Resultados de tu busqueda {{$search}}
</div>
  @endif
</h6>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
              <form action="{{route('usuarios.destroy', $user->id )}}" method="POST">
              <a href="{{route('usuarios.show', $user->id)}}"><button type="button" class="btn btn-secondary">Ver</button></a>
              <a href="{{route('usuarios.edit', $user->id)}}"><button type="button" class="btn btn-primary">Editar</button></a>
              @csrf
              @method('DELETE')
              
              <button type="submit" class="btn btn-danger" onclick= "return confirm('¿Seguro que desea Eliminar el reporte?')"><i class="far fa-trash-alt"></i></button></button>
            </form>
            </td>
        </tr>
    @endforeach
  </tbody>
</table>
{{$users->links()}}
</div>
@endsection
