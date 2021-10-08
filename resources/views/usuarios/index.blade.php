@extends('layouts.app')

@section('search')
    <!-- SEARCH FORM -->
    <form class=" col-lg-5">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" name="search" type="search" placeholder="Buscar por nombre o correo"
                aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
@endsection

@section('content')
        <div class="row  border-bottom bg-light dashboard-header " style="padding:0; margin-left: -7px !important; margin-bottom: 10px">
            <div class="col-lg-6" style="padding:0; padding-left:15px; ">
                <h2>Usuarios </h2>
            </div>
            <div class="col-lg-6">
                @can('usuarios.create')
                    <a href="usuarios/create"> 
                        <button type="button" style="margin-left: 10px;" class="btn btn-primary float-right">Agregar usuario </button> </a>
                @endcan
                <a href="roles"> <button type="button" class="btn btn-primary float-right"> Listado de Roles </button> </a>
                
            </div>
        </div>
        <h6>
            @if ($search)
                <div class="alert alert-info" role="alert">
                    Resultados de tu busqueda de {{ $search }}
                </div>
                
            @endif
        </h6>
        <table class="table tabñe-border table-hover " id="TablaUsuarios" style="border: solid 1px black">
            <thead>
                <tr class="thead-dark">
                    <th data-card-title scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Codigo</th>
                    <th class="text-center" style="width: 150px" data-card-footer scope="col-xs-2">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @if (count($users) == 0)
                    <div>
                        <h4>No hay usuarios para listar</h4>
                    </div>
                @endif
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td scope="row">{{ $user->id }}</td>
                        <td>
                            <form action="{{ route('usuarios.destroy', $user->code) }}" method="POST">
                                @can('usuarios.show')
                                    <a href="{{ route('usuarios.show', $user->id) }}"><button type="button"
                                            class="btn btn-secondary">Ver</button></a>
                                @endcan
                                <a href="{{ route('usuarios.edit', $user->id) }}"><button type="button"
                                        class="btn btn-primary">Editar</button></a>
                                @csrf
                                @if ($user->id != '1')
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('¿Seguro que desea Eliminar el reporte?')"><i
                                            class="far fa-trash-alt"></i></button></button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
@endsection
