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
                            <p><strong>Código: </strong>{{ $tdg->codigo }}</p>
                            <p><strong>Nombre: </strong>{{ $tdg->nombre }}</p>
                            <p><strong>Tipo de solicitud: </strong>Ratificación de resultados</p>
                            <p><strong>Fecha de solicitud: </strong>{{ date("d-m-Y", strtotime($solicitud->fecha)) }}</p>
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
                                                    <td> {{ $resultado->nombre }} </td>
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
                            <a class="btn btn-primary btn-color" href="/listar/tdg/ratificacion" role="button">
                                <span class="oi oi-arrow-circle-left"></span> Regresar
                            </a>
                        </div>
                        <div class="col-2 ">
                        <a class="btn btn-primary btn-color" href="/ratificar/solicitud/{{ $tipoSolicitud . '/' . $solicitud->id }}" role="button">
                                <span class="oi oi-document"></span> Ratificar
                            </a>
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
