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
                            <p><strong>Tipo de solicitud: </strong>Ratificación de resultados</p>

                            @if (is_null($solicitud->aprobado))
                            <p><strong>Estado: </strong>En trámite</p>
                            @elseif ($solicitud->aprobado == 0)
                            <p><strong>Estado: </strong>Rechazado</p>
                            @elseif ($solicitud->aprobado == 1)
                            <p><strong>Estado: </strong>Aprobado</p>
                            @endif
                            
                            <p><strong>Fecha de solicitud: </strong>{{ date("d/m/Y", strtotime($solicitud->fecha)) }}</p>
                            <p><strong>Resultados: </strong></p>
                            {{-- {{dd($resultados)}} --}}

                            <div class="row">
                                <div class="col-10 offset-1">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Carnet</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col" style="text-align:center;">Resultado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($resultados as $resultado)
                                                <tr>
                                                    <td> {{ $resultado->carnet }} </td>
                                                    <td> {{ $resultado->nombres }} {{ $resultado->apellidos }} </td>
                                                    <td style="text-align:center;"> {{ $resultado->nota }} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
