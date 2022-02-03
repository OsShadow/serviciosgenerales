@extends('layouts.app')

@section('content')
<div class="row  border-bottom bg-light dashboard-header " style="padding:0; margin-left: -7px !important; margin-bottom: 10px">
    <div class="col-lg-6" style="margin-left:15px; padding:0;">
        <h2> Crear usuario </h2>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header ">Nuevo Usuario</div>

                <div class="card-body">
                    <form action="/usuarios" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="code">Código</label>
                            <input type="text" class="form-control" name="code" placeholder="Introduzca el código de usuario">
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" placeholder="Escribe el nombre">
                        </div>
                        <div class="form-group">
                            <label for="lname">Apellido(s)</label>
                            <input type="text" class="form-control" name="lname" placeholder="Introduzca apellido(s)">
                        </div>
                        <div class="form-group">
                            <label for="email">Email </label>
                            <input type="email" class="form-control" name="email" placeholder="Escribe el correo electrónico">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Introduzca la contraseña">
                        </div>
                        <div class="form-group">
                            {{-- {{ dd($roles) }} --}}
                            <label for="Asignación de rol">Asignación de rol</label>
                            <select class="form-control" id="rol" name='rol' placeholder="Asignación de Rol">
                                @foreach ($roles as $rol)
                                    <option>{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="reset" class="btn btn-danger ">Cancelar</button>
                        <button type="submit" class="btn btn-primary float-right">Registrar</button>
                       
                    </form> 
                    
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection
