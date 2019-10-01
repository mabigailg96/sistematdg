<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    

    <title>Detalle de Trabajo de Graduación</title>
  </head>
  <body>
                    
                    <!-- Mostrar datos generales del TDG -->
                            <p><strong>Código:</strong> {{$tdg->codigo}}</p>
                            <p><strong>Nombre:</strong> {{$tdg->nombre}}</p>
                            @if ($tdg->estado_oficial == null)
                                <p><strong>Estado:</strong> <span id="lbl-estado-oficial">Recien ingresado</span></p>
                            @else
                                <p><strong>Estado:</strong> <span id="lbl-estado-oficial">{{$tdg->estado_oficial}}</span></p>
                            @endif
                            <p><strong>Fecha de inicio:</strong> {{$tdg->fechaInicio}}</p>
                            <p><strong>Docente director:</strong> {{$tdg->profesor_nombre}} {{$tdg->profesor_apellido}}</p>
                    <br>
                    
                    <!-- Espacio para mostrar los estudiantes -->
                    <h3>Estudiantes</h3>
                    <br>
                    <table>
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
                    <table>
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
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
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


  </body>
</html>