@extends('layouts.app')

@section('javascript')
<script src="{{ asset('js/ver_detalles_tdg_escuela.js') }}" defer></script>
<script src="{{ asset('js/jquery.PrintArea.js') }}" defer></script>
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
                            <a class="btn  btn-primary btn-color" href="/listar/tdg/gestionar/escuela" role="button"><span class="oi oi-arrow-circle-left"></span> Regresar</a>
                            &nbsp;
                            <button type="button" id="printButton" class="btn btn-primary btn-color" ><span class="oi oi-print"></span>&nbsp;Imprimir</button>
                        </div>
                    </div>

                    <!-- Mostrar datos generales del TDG -->
                    <div class="printableArea">
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
                                        @if ($ciclo == '')
                                        <p><strong>Fecha de inicio:</strong> Aún no se ha inscrito este trabajo de graduación.</p>
                                        @else
                                        <p><strong>Fecha de inicio:</strong> {{$ciclo->fechaInicio}}</p>
                                        @endif
                                        @if ($tdg->profesor_nombre == '')
                                        <p><strong>Docente asesor:</strong> No se ha asignado aún.</p>
                                        @else
                                            <p><strong>Docente asesor:</strong> {{$tdg->profesor_nombre}} {{$tdg->profesor_apellido}}</p>
                                        @endif
                                    </div>
                                </div>
                                <br>

                                <!-- Espacio para mostrar los estudiantes -->
                                <h3>Estudiantes</h3>
                                <br>
                                <table id="table-students" class="table table-striped" width="100%">
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
                                
                                <div class="row">
                                    <div class="col-6"> <!-- Primera Columna -->
                                        <!-- Espacio para mostrar los asesores internos -->
                                        <h3>Docentes Asesores Internos</h3>
                                        <br>
                                        <table id="table-advisers-internal" class="table table-striped" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombres</th>
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
                                    </div>

                                    <div class="col-6"> <!-- Segunda Columna -->
                                        <!-- Espacio para mostrar los asesores externos -->
                                        <h3>Asesores Especialistas Externos</h3>
                                        <br>
                                        <table id="table-advisers-external" class="table table-striped"  width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombres</th>
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
                                </div>

                                <!-- Espacio para mostrar el historial de las solicitudes y el estado en que se encuentran -->
                                <h3>Historial</h3>
                                <br>
                                <table id="table-historial" class="table table-striped"  width="100%">
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
 
                    </div>


                    <!-- Botones para abandonar el tdg -->
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight">
                            @if ($tdg->estado_oficial == 'Oficializado' || $tdg->estado_oficial == 'Prórroga' || $tdg->estado_oficial == 'Extensión de prórroga' || $tdg->estado_oficial == 'Prórroga especial')
                                <button type="button" id="btn-abandonar-tdg" class="btn btn-danger">Abandonar TDG</button>
                            @elseif ($tdg->estado_oficial == NULL || $tdg->estado_oficial == 'Aprobado' || $tdg->estado_oficial == 'Finalizado' || $tdg->estado_oficial == 'Abandonado')
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
