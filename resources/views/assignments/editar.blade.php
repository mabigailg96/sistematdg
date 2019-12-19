@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/editar_asignaciones.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
					Editar grupo de Trabajo de Graduación
				</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
					@endif
                    
                    <!-- Mostrar datos generales del TDG -->
                    <div class="card">
                        <div class="card-body bg-light">

                            <!-- Id del docente director -->
                            <p id="id_docente_director" class="oculto">{{ $docenteDirector->id }}</p>

                            <!-- Id de los estudiantes -->
                            @foreach ($estudiantes as $estudiante)
                                <p class="id_estudiante oculto">{{ $estudiante->id }}</p>
                            @endforeach

                            <!-- Id del ciclo para estudiantes nuevos -->
                            <p id="ciclo_id" class="oculto">{{ $estudiantes[0]->ciclo_id }}</p>

                            <!-- Id de los asesores internos -->
                            @foreach ($asesoresInternos as $asesorInterno)
                                <p class="id_asesor_interno oculto">{{ $asesorInterno->id }}</p>
                            @endforeach

                            <!-- Id de los asesores externos -->
                            @foreach ($asesoresExternos as $asesorExterno)
                                <p class="id_asesor_externo oculto">{{ $asesorExterno->id }}</p>
                            @endforeach

                            <p id="estudiantes_length" class="oculto">{{ count($estudiantes) }}</p>
                            <p id="asesores_internos_length" class="oculto">{{ count($asesoresInternos) }}</p>
                            <p id="asesores_externos_length" class="oculto">{{ count($asesoresExternos) }}</p>
                            <p id="lbl-docente_director_concatenar" class="oculto">{{ $docenteDirector->codigo }}, {{ $docenteDirector->nombre }} {{ $docenteDirector->apellido }}</p>

                            <p id="escuela-id" class="oculto">{{$tdg->escuela_id}}</p>
                            <p id="tdg-id" class="oculto">{{$tdg->id}}</p>
                            <p><strong>Código:</strong> {{$tdg->codigo}}</p>
                            <p><strong>Nombre:</strong> {{$tdg->nombre}}</p>
                        </div>
                    </div>
                    <br>
                    <!-- Espacio para buscar Docente Director -->
                    <h3>Docente asesor</h3>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Docente</span>
                                </div>
                                <input type="text" id="txt-buscar-docente_director" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" id="btn-agregar-docente_director" class="btn btn-success">Agregar</button>
                        </div>
                    </div>
                    <br>

                    <!-- Espacio para buscar Estudiante -->
                    <h3>Integrantes</h3>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Integrante</span>
                                </div>
                                <input type="text" id="txt-buscar-estudiante" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" id="btn-agregar-estudiante" class="btn btn-success">Agregar</button>
                        </div>
                    </div>
                    <br>

                    <!-- Espacio para buscar Asesores internos -->
                    <h3>Docentes Asesores Internos</h3>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Asesor interno</span>
                                </div>
                                <input type="text" id="txt-buscar-asesor_interno" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" id="btn-agregar-asesor_interno" class="btn btn-success">Agregar</button>
                        </div>
                    </div>
                    <br>

                    <!-- Espacio para buscar Asesores externos -->
                    <h3>Asesores Especialistas Externos</h3>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Nombre</span>
                                </div>
                                <input type="text" id="txt-nombre-asesor_externo" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Apellido</span>
                                </div>
                                <input type="text" id="txt-apellido-asesor_externo" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" id="btn-agregar-asesor_externo" class="btn btn-success">Agregar</button>
                        </div>
                    </div>
                    <br>

                    <!-- Mostrar resumen de los datos a ingresar a asignaciones TDG -->
                    <div class="card">
                        <div class="card-body bg-light">
                            <h3>Resumen del grupo asignado:</h3>
                            <br>
                            <p><strong>Docente asesor:</strong>
                                <span id="lbl-docente_director" value="{{ $docenteDirector->id }}">
                                <br>
                                • {{ $docenteDirector->codigo }}, {{ $docenteDirector->nombre }} {{ $docenteDirector->apellido }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="btn-quitar-docente_director" class="close float-none"><span class="oi oi-circle-x" title="Quitar docente director" aria-hidden="true" style="color:red"></span></button>
                                </span>
                            </p>
                            <p><strong>Integrantes:</strong></p>
                            <p id="lbl-estudiantes">
                                @foreach ($estudiantes as $estudiante)
                                    <p class="lbl-estudiante" value="{{ $estudiante->id }}">• {{ $estudiante->carnet }}, {{ $estudiante->nombres }} {{ $estudiante->apellidos }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" value="{{ $estudiante->id }}" class="close float-none btn-quitar-estudiante"><span class="oi oi-circle-x" title="Quitar integrante" aria-hidden="true" style="color:red"></span></button></p>
                                @endforeach
                            </p>
                            <p><strong>Docentes Asesores Internos:</strong></p>
                            <p id="lbl-asesores_internos">
                                @foreach ($asesoresInternos as $asesorInterno)
                                    <p class="lbl-asesor_interno" value="{{ $asesorInterno->id }}">• {{ $asesorInterno->codigo }}, {{ $asesorInterno->nombre }} {{ $asesorInterno->apellido }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type="button" value="{{ $asesorInterno->id }}" class="close float-none btn-quitar-asesor_interno"><span class="oi oi-circle-x" title="Quitar asesor interno" aria-hidden="true" style="color:red"></span></button></p>
                                @endforeach
                            </p>
                            <p><strong>Asesores Especialistas Externos:</strong></p>
                            <p id="lbl-asesores_externos">
                                @foreach ($asesoresExternos as $asesorExterno)
                                    <p class="lbl-asesor_externo" value="{{ $asesorExterno->id }}">• <span class="nombre">{{ $asesorExterno->nombre }}</span>&nbsp;<span class="apellido">{{ $asesorExterno->apellido }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" value="{{ $asesorExterno->id }}" class="close float-none btn-quitar-asesor_externo"><span class="oi oi-circle-x" title="Quitar asesor interno" aria-hidden="true" style="color:red"></span></button></p>
                                @endforeach
                            </p>
                        </div>
                    </div>

                    <!-- Botones para guardar o cancelar la asignacion de grupo de TDG -->
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            <button type="button" id="btn-guardar-asignacion" class="btn btn-primary btn-color">Guardar cambios de grupo</button>
                        </div>
                        <div class="p-2 bd-highlight">
                            <button type="button" id="btn-cancelar-asignacion" class="btn btn-danger">Cancelar</button>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer text-muted">
                    Todos los campos marcados con <span style="color:red">*</span> son obligatorios y deben ser llenados.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection