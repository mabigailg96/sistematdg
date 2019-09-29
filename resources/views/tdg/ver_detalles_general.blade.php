@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ver_detalles_tdg_general.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
					    Detalle del Trabajo de Graduación
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
                            <p id="tdg-id" class="oculto">{{$tdg->id}}</p>
                            <p><strong>Código:</strong> {{$tdg->codigo}}</p>
                            <p><strong>Nombre:</strong> {{$tdg->nombre}}</p>
                            <p><strong>Estado:</strong> <span id="lbl-estado-oficial">{{$tdg->estado_oficial}}</span></p>
                            <p><strong>Fecha de inicio:</strong> {{$tdg->fechaInicio}}</p>
                            <p><strong>Docente director:</strong> {{$tdg->profesor_nombre}} {{$tdg->profesor_apellido}}</p>
                        </div>
                    </div>
                    <br>
                    
                    <!-- Espacio para mostrar los estudiantes -->
                    <h3>Estudiantes</h3>
                    <br>
                    <table id="table-students" class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Carnet</th>
                                <th scope="col">Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{$student->carnet}}</td>
                                <td>{{$student->nombres}} {{$student->apellidos}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>

                    <!-- Espacio para mostrar los asesores internos -->
                    <h3>Asesores internos</h3>
                    <br>
                    <table id="table-advisers-internal" class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($advisers_internal as $adviser_internal)
                            <tr>
                                <td>{{$adviser_internal->nombre}} {{$adviser_internal->apellido}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>

                    <!-- Espacio para mostrar los asesores externos -->
                    <h3>Asesores externos</h3>
                    <br>
                    <table id="table-advisers-external" class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($advisers_external as $adviser_external)
                            <tr>
                                <td>{{$adviser_external->nombre}} {{$adviser_external->apellido}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>

                </div>
                <div class="card-footer text-muted">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection