@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
					    Detalle de solicitud
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
                            <p><strong>Código: </strong>{{ $solicitud->codigo }}</p>
                            
                            @if (is_null($solicitud->aprobado))
                            <p><strong>Nombre actual: </strong>{{ $solicitud->nombre_anterior }}</p>
                            @elseif ($solicitud->aprobado == 0)
                            <p><strong>Nombre actual: </strong>{{ $solicitud->nombre_anterior }}</p>
                            @elseif ($solicitud->aprobado == 1)
                            <p><strong>Nuevo nombre: </strong>{{ $solicitud->nuevo_nombre }}</p>
                            @endif

                            <p><strong>Tipo de solicitud: </strong>Cambio de nombre</p>

                            @if (is_null($solicitud->aprobado))
                            <p><strong>Estado: </strong>En trámite</p>
                            @elseif ($solicitud->aprobado == 0)
                            <p><strong>Estado: </strong>Rechazado</p>
                            @elseif ($solicitud->aprobado == 1)
                            <p><strong>Estado: </strong>Aprobado</p>
                            @endif

                            <p><strong>Fecha de solicitud: </strong>{{ date("d/m/Y", strtotime($solicitud->fecha)) }}</p>

                            @if (is_null($solicitud->aprobado))
                            <p><strong>Nuevo nombre: </strong>{{ $solicitud->nuevo_nombre }}</p>
                            @elseif ($solicitud->aprobado == 0)
                            <p><strong>Nombre propuesto: </strong>{{ $solicitud->nuevo_nombre }}</p>
                            @elseif ($solicitud->aprobado == 1)
                            <p><strong>Nombre anterior: </strong>{{ $solicitud->nombre_anterior }}</p>
                            @endif
                            
                            <p><strong>Justificación: </strong>{{ $solicitud->justificacion }}</p>
                        </div>
                    </div>

                    <br>
                    
                    <div class="row">
                        <div class="col-2 offset-8">
                            @if ($rol == 'coorgen')
                                <a class="btn btn-primary btn-color" href="/listar/ver/solicitudes/general" role="button">
                                    <span class="oi oi-arrow-circle-left"></span> Regresar
                                </a>
                            @endif

                            @if ($rol == 'cooresc')
                                <a class="btn btn-primary btn-color" href="/listar/ver/solicitudes/escuela" role="button">
                                    <span class="oi oi-arrow-circle-left"></span> Regresar
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="card-footer text-muted">
                    <span style="color:red">*</span> <strong>Nota: </strong> El nombre actual hace referencia al que tenía el Trabajo de graduación al momento de realizar la solicitud.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
