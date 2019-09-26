@extends('layouts.app')

@section('javascript')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
					Asignar grupo a Trabajo de Graduación
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
                            <p><strong>Estado:</strong> {{$tdg->estado_oficial}}</p>
                            <p><strong>Fecha de inicio:</strong> {{$tdg->fechaInicio}}</p>
                            <p><strong>Docente director:</strong> {{$tdg->profesor_nombre}} {{$tdg->profesor_apellido}}</p>
                        </div>
                    </div>
                    <br>
                    
                    <!-- Espacio para buscar Asesores externos -->

                    <h3>Estudiantes</h3>
                    <br>
                    <table id="table-students" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Carnet</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{$student->carnet}}</td>
                                <td>{{$student->nombres}} {{$student->apellidos}}</td>
                                @if ($student->activo)
                                    <td>Activo</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm">Inhabilitar</button>
                                    </td>
                                @else
                                    <td>Abandono</td>
                                    <td></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                            
                    <h3>Asesores internos</h3>
                    <br>
                    <table id="table-students" class="table table-striped">
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

                    <h3>Asesores externos</h3>
                    <br>
                    <table id="table-students" class="table table-striped">
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
                </div>
                <div class="card-footer text-muted">
                    Todos los campos marcados con <span style="color:red">*</span> son obligatorios y deben ser llenados.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection