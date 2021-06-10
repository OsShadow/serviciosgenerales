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
              
                <div class="card-body" style="background-color:white">
                <h3>Editar Usuario: {{ $user->name }}</h3>
                <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                            placeholder="Escribe tu nombre">
                    </div>
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                            placeholder="Escribe tu email">
                    </div>
                    {{-- <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" placeholder="Introduzca la contraseña">
                    </div>
                    <div class="form-group">
                        <label for="password2">Repetir Contraseña</label>
                        <input type="password2" class="form-control" name="password2" placeholder="Vuelva a introducir la contraseña">
                    </div> --}}
                    <div class="form-group">
                        {{-- {{ dd($roles) }} --}}
                        <label for="Asignación de rol">Asignación de rol</label>
                        <select class="form-control" id="rol" name='roles' placeholder="Asignación de Rol">
                            @foreach ($roles as $rol)
                                @if($rol->name === $user_rol[0])
                                    <option selected>{{ $rol->name }}</option>
                                @else
                                    <option>{{ $rol->name }}</option>
                                @endif
                                
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="cancel" class="btn btn-danger float-right">Regresar</button>
                </form>
            </div>
            <br>
            <div class="card-body" style="background-color:white">
                <h4>Cambiar contraseña</h4>
                <form action="{{ route('usuarios.changepass', $user->id) }}" method="POST">
                    @csrf
                   
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" placeholder="Introduzca la contraseña">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Repetir Contraseña</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Vuelva a introducir la contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="cancel" class="btn btn-danger float-right">Regresar</button>
                </form>
            </div>

            </div>
        </div>
    </div>
@endsection
