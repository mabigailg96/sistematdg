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
                            <p><strong>Nombre: </strong>{{ $solicitud->nombre }}</p>
                            <p><strong>Tipo de solicitud: </strong>{{ $tipoProrroga }}</p>
                            <p><strong>Fecha de solicitud: </strong>{{ date("d/m/Y", strtotime($solicitud->fecha)) }}</p>
                            <p><strong>Fecha de inicio: </strong>{{ date("d/m/Y", strtotime($solicitud->fecha_inicio)) }}</p>
                            <p><strong>Fecha de fin: </strong>{{ date("d/m/Y", strtotime($solicitud->fecha_fin)) }}</p>
                            <p><strong>Justificación: </strong>{{ $solicitud->justificacion }}</p>
                            @if ($tipoSolicitud == 'prorroga')
                                <p><strong>Documento anexo: </strong><a href="/prorroga/normal/{{ $solicitud->url_documento_solicitud }}">Ver documento</a></p>
                            @endif
                            @if ($tipoSolicitud == 'extension_de_prorroga')
                                <p><strong>Documento anexo: </strong><a href="/prorroga/extension/{{ $solicitud->url_documento_solicitud }}">Ver documento</a></p>
                            @endif

                            @if ($tipoSolicitud == 'prorroga_especial')
                                <p><strong>Documento anexo: </strong><a href="/prorroga/especial/{{ $solicitud->url_documento_solicitud }}">Ver documento</a></p>
                            @endif
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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
