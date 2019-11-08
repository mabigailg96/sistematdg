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
                            <p><strong>Código: </strong>{{ $tdg->codigo }}</p>
                            <p><strong>Nombre: </strong>{{ $tdg->nombre }}</p>
                            <p><strong>Tipo de solicitud: </strong>Oficialización</p>
                            <p><strong>Fecha de solicitud: </strong>{{ date("d/m/Y", strtotime($solicitud->fecha)) }}</p>
                            <p><strong>Docente asesor: </strong>{{ $docenteDirector }}</p>
                            <p><strong>Estudiantes: </strong></p>
                            <div class="row"> <!-- Tabla de alumnos del tdg-->
                                <div class="col-8 offset-2">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                    <th scope="col">Carnet</td>
                                                    <th scope="col">Nombre</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($estudiantes as $estudiante)
                                                <tr>
                                                    <td>{{ $estudiante->carnet }}</td>
                                                    <td>{{ $estudiante->nombre }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                                </div>
                            </div>
                            <p><strong>Docentes Asesores Internos: </strong></p>
                            <div class="row"> <!-- Asesores Internos -->
                                <div class="col-8 offset-2">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Código</th>
                                                <th scope="col">Nombre</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($asesoresInternos as $asesor)
                                                <tr>
                                                    <td> {{ $asesor->codigo }} </td>
                                                    <td> {{ $asesor->nombre }} </td>
                                                </tr>      
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                                </div>
                            </div>
                            <p><strong>Asesores Especialistas Externos: </strong></p>
                            <div class="row"> <!-- Asesores externos -->
                                @if (empty($asesoresExternos))
                                    <div class="col-6 offset-2">
                                        <h5>No existen asesores especialistas externos</h5>
                                    </div>
                                @else
                                    <div class="col-8 offset-2">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($asesoresExternos as $asesor)
                                                    <tr>
                                                        <td> {{ $asesor }} </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

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
                        <a class="btn btn-primary btn-color" href="/ratificar/solicitud/{{ $tipoSolicitud . '/' . $tdg->id }}" role="button">
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
