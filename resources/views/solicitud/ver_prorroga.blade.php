@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
					    Detalle de Solicitud
                </div>
                
                <!-- Card Body -->
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="card">
                        <div class="card-body bg-light">
                            <p><strong>Código del TDG: </strong>{{ $tdg->codigo }}</p>
                            <p><strong>Nombre del TDG: </strong>{{ $tdg->nombre }}</p>
                            <p><strong>Tipo de solicitud: </strong>Solicitud de nombramiento de tribunal</p>
                            <p><strong>Fecha de solicitud: </strong>{{ $solicitud->fecha }}</p>
                            <p><strong>Fecha de inicio: </strong>{{ $solicitud->fecha_inicio }}</p>
                            <p><strong>Fecha de fin: </strong>{{ $solicitud->fecha_fin }}</p>
                            <p><strong>Justificación: </strong>{{ $solicitud->justificacion }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="card-footer text-muted">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
