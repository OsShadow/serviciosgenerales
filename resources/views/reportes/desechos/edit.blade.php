@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Editar reporte Reporte') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('desechos.update', $treports->id) }}">
                        
                        @csrf

                        <div class="form-row">


                            <div class="form-group col-md-4">
                                <label for="area">Area</label>
                                <select class="custom-select" id="area" name="area" required>
                                <option selected >{{$treports->area_report}}</option>
                                  <option >1</option>
                                </select>

                            </div>

                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="quantity">Cantidad</label>
                                <input type="text" class="form-control" value="{{$treports->quantity}}" id="quantity" name="quantity" placeholder="Cantidad por litro">
                                  </div>

                            </div>

                        </div>







                        <div class="form-group col-md-6">

                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Crear Reporte') }}
                                </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
