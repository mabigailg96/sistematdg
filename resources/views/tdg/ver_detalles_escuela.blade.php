@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ver_detalles_tdg_escuela.js') }}" defer></script>
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
                    
                    <!-- Boton para generar el pdf a imprimir del tdg -->
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            <button type="button" id="btn-imprimir-tdg" class="btn btn-primary btn-color" value="{{$tdg->id}}"><span class="oi oi-print"></span>&nbsp;Imprimir</button>
                        </div>
                    </div>

                    <!-- Mostrar datos generales del TDG -->
                    <div class="card">
                        <div class="card-body bg-light">
                            <p id="tdg-id" class="oculto">{{$tdg->id}}</p>
                            <p><strong>Código:</strong> {{$tdg->codigo}}</p>
                            <p><strong>Nombre:</strong> {{$tdg->nombre}}</p>
                            @if ($tdg->estado_oficial == null)
                                <p><strong>Estado:</strong> <span id="lbl-estado-oficial">Recien ingresado</span></p>
                            @else
                                <p><strong>Estado:</strong> <span id="lbl-estado-oficial">{{$tdg->estado_oficial}}</span></p>
                            @endif
                            <p><strong>Fecha de inicio:</strong> {{$tdg->fechaInicio}}</p>
                            <p><strong>Docente asesor:</strong> {{$tdg->profesor_nombre}} {{$tdg->profesor_apellido}}</p>
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

                    <!-- Espacio para mostrar el historial de las solicitudes y el estado en que se encuentran -->
                    <h3>Historial</h3>
                    <br>
                    <table id="table-historial" class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Tipo de solicitud</th>
                                <th scope="col">Resolución</th>
                                <th scope="col">Acuerdo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historial as $historial_especifico)
                            <tr>
                                <td>{{$historial_especifico['tipo_solicitud']}}</td>
                                <td>{{$historial_especifico['resolucion']}}</td>
                                @if ($historial_especifico['acuerdo_texto'] == 'Acuerdo')
                                    <td><a href="/acuerdos/{{$historial_especifico['url']}}">{{$historial_especifico['acuerdo_texto']}}</a></td>
                                @else
                                    <td>{{$historial_especifico['acuerdo_texto']}}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>

                    <!-- Botones para abandonar el tdg -->
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            @if ($tdg->estado_oficial != 'Abandonado')
                                <button type="button" id="btn-abandonar-tdg" class="btn btn-danger">Abandonar TDG</button>
                            @else
                                <button type="button" id="btn-abandonar-tdg" class="btn btn-secundary" disabled>Abandonar TDG</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection