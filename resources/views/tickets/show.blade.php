@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                Reporte de Ticket
            </div>
            <div class="card-body">
                <h4 class=" d-flex justify-content-center">Estado de Ticket</h4>
                <p class="card-text">{{ $treports->type }}</p>
                <h4 class=" d-flex justify-content-center">Asignado a</h4>
                <p class="card-text">{{ $treports->employer }}</p>
                <h4 class=" d-flex justify-content-center">Descripción del Reporte</h4>
                <p class="card-text">{{ $treports->ticket_report }}</p>
                <h4 class=" d-flex justify-content-center">Fecha límite de Finalización</h4>
                <p class="card-text">{{ $treports->date_finish }}</p>
                <h4 class=" d-flex justify-content-center">Hora límite de Finalización</h4>
                <p class="card-text">{{ $treports->hour_finish }}</p>

                <h4 class=" d-flex justify-content-center">Evidencias</h4>

                <section class="content">
                    <div class="container-fluid">
                      <div class="row">

                <div class="col-12">
                    <div class="card card-primary">
                      <div class="card-header">
                        <h4 class="card-title">Imágenes de Evidencia</h4>
                      </div>
                      <div class="card-body">
                        <div class="row">
                            @foreach($timages as $timage)
                                <div class="col-sm-2">
                                    <a href={{asset('/uploads/'.$timage->ticket_id.'/'.$timage->file)}} target="_blank" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">

                                      <img src={{asset('/uploads/'.$timage->ticket_id.'/'.$timage->file)}} class="img-fluid mb-2" alt="white sample"/>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                      </div>
                    </div>
                </div>
                       </div>    
                    </div>

                </section>

            </div>
            <div class="card-footer text-muted">
                Fecha de reporte: {{ $treports->date }}
            </div>
        </div>
    </div>

@endsection
