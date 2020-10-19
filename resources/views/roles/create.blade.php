@extends('layouts.app')
@section('content')
    <div class="container ">
        <div class="row justify-content-center ">
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Crear Nuevo Rol</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="/roles" method="POST">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nombre del Rol</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Introduzca el nombre que tendra el rol">
                            </div>
                            <div class="form-group">
                                <label for="description">Descripcion</label>
                                <textarea class="form-control" name="description"
                                    placeholder="Introduzca la descripcion que tendra el rol" rows="3"></textarea>
                            </div>
                            <div class="row">
                                {{ $cate = '' }}
                                @foreach ($permisos as $permiso)
                                    <div class="col-xs-6 col-md-12">
                                        @if ($cate != $permiso->category)
                                            <div class="form-group">
                                                {{ Form::label('categoria', $cate = $permiso->category) }}
                                            </div>
                                        @endif
                                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-danger">
                                        <label>
                                            {{ Form::checkbox('permisos[]', $permiso->id) }}
                                            {{-- {{ Form::checkbox('permisos[]', $permiso->id) }} --}}
                                            {{ $permiso->display }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                            <button type="reset" class="btn btn-danger float-right">Cancelar</button>

                        </div>


                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
    </div>



@endsection
