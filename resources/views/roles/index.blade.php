@extends('layouts.app')

@section('content')

  <div class="row  border-bottom bg-light dashboard-header " style="padding:0; margin-left: -7px !important; margin-bottom: 10px">
    <div class="col-lg-6" style="margin-left:15px; padding:0;">
        <h2>Roles </h2>
    </div>
  </div>
    
      <!-- /.row -->
          <div class="card" style="padding: 5px">
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
              <table class="table table-striped table-bordered table-hover " id="TableRoles">
                <thead class="thead-dark">
                    <tr>
                        {{-- <th scope="col">ID</th> --}}
                        <th scope="col">Rol</th>
                        <th scope="col">Descripción</th>
                        <th class="text-center" style="width: 200px" data-card-footer scope="col-xs-2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            {{-- <th scope="row">{{ $rol->id }}</th> --}}
                            <td>{{ $rol->name }}</td>
                            <td>{{ $rol->description }}</td>
                            <td>
                                <form action="{{ route('roles.destroy', $rol->id) }}" method="POST">
                                    @can('roles.show')
                                        <a href="{{ route('roles.show', $rol->id) }}" title="Ver"><button type="button"
                                                class="btn btn-info"><i class="fas fa-eye"></i></button></a>
                                    @endcan
                                    @can('roles.edit')
                                        <a href="{{ route('roles.edit', $rol->id) }}" title="Editar"><button type="button"
                                                class="btn btn-primary"><i class="far fa-edit"></i></button></a>
                                    @endcan
                                    @can('roles.destroy')
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"  title="Eliminar"
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
      
@endsection
