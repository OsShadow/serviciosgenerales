@extends('layouts.app')

@section('content')
    
      <!-- /.row -->
      <div class="row justify-content-center">
        <div class="col-10 justify-content-center">
            <h1 class="display-4">Roles</h1>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Lista de roles del sistema</h3>
              <a href="roles/create"> <button type="button" class="btn btn-success float-right"> Agregar Rol </button> </a>

              {{-- <div class="card-tools">
                <div class="input-group input-group-sm" >
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div> --}}

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            <th scope="row">{{ $rol->id }}</th>
                            <td>{{ $rol->name }}</td>
                            <td>{{ $rol->description }}</td>
                            <td>
                                <form action="{{ route('roles.destroy', $rol->id) }}" method="POST">
                                    @can('roles.show')
                                        <a href="{{ route('roles.show', $rol->id) }}"><button type="button"
                                                class="btn btn-secondary">Ver</button></a>
                                    @endcan
                                    @can('roles.edit')
                                        <a href="{{ route('roles.edit', $rol->id) }}"><button type="button"
                                                class="btn btn-primary">Editar</button></a>
                                    @endcan
                                    @can('roles.destroy')
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Seguro que desea Eliminar el rol?')"><i
                                                class="far fa-trash-alt"></i></button></button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              {{ $roles->links() }}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
@endsection
