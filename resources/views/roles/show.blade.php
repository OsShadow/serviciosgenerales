@extends('layouts.app')

@section('content')

    <!-- /.row -->
    <div class="row justify-content-center">
        <div class="col-6 justify-content-center">
            <h1 class="display-4">{{ $rol->name }}</h1>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{ $rol->description }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    {{-- <th>ID</th>
                    <th>Categoria</th> --}}
                    <th>Descripción</th>
                    <th>Ultima modificacion</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($rol->permissions as $permiso)
                        <tr>
                            {{-- <td>{{  $permiso->id }}</td>
                            <td>{{  $permiso->category }}</td> --}}
                            <td>{{  $permiso->display }}</td>
                            <td>{{  $permiso->updated_at }}</td>
                        </tr>      
                    @endforeach
                  
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

     

@endsection
