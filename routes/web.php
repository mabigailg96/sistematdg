<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function(){
//Rutas para acuerdos
Route::get('/ratificar/solicitud/{tipo_solicitud}/{id?}', 'AgreementController@create')->name('agreement.ingresar')->middleware('can:agreement.ingresar');
Route::post('/guardar/acuerdos', 'AgreementController@store')->name('agreement.guardar')->middleware('can:agreement.guardar');

//Rutas para trabajos de graduacion
Route::get('/ingresar/tdg', 'TdgController@create')->name('tdg.ingresar')->middleware('can:tdg.ingresar');
Route::post('/guardar/tdg', 'TdgController@store')->name('tdg.guardar')->middleware('can:tdg.guardar');

// Ruta para traer todos los docentes para asignación de tribunal
Route::get('/todos/profesores/nombramiento/tribunal', 'ProfessorController@allProfessorNombramientoTribunal')->name('professor.todosProfesoresNombramientoTribunal');

// Ruta para para enviar todos los datos del TDG para filtro de solicitudes
Route::get('/todos/tdg/solicitudes', 'TdgController@allTdgSolicitudes')->name('tdg.todosTdgSolicitudes');

// Ruta para para enviar todos los datos del TDG para filtro de asignaciones de docente, estudiantes y asesores
Route::get('/todos/tdg/asignaciones', 'TdgController@allTdgAsignaciones')->name('tdg.todosTdgAsignaciones');

// Pantalla para guardar las asignaciones respectivas de docentes, estudiantes y asesores de TDG
Route::get('/ingresar/tdg/asignacion/{id}', 'TdgController@createAsignaciones')->name('tdg.ingresarTdgAsignaciones');
Route::get('/guardar/tdg/asignacion', 'TdgController@storeAsignaciones')->name('tdg.guardarTdgAsignaciones');

// Ruta para para enviar todos los datos de los docentes p
Route::get('/todos/profesores/asignaciones', 'ProfessorController@allProfessorAsignaciones')->name('professor.todosProfesoresAsignaciones');
Route::get('/todos/estudiantes/asignaciones', 'StudentController@allStudentAsignaciones')->name('student.todosStudentAsignaciones');

// Ruta para para enviar todos los datos del TDG para filtro de gestionar para la escuela
Route::get('/todos/tdg/gestionar/escuela', 'TdgController@allTdgGestionarEscuela')->name('tdg.todosTdgGestionarEscuela')->middleware('can:tdg.todosTdgGestionarEscuela');
// Ruta para para enviar todos los datos del TDG para filtro de gestionar para el coordinador general
Route::get('/todos/tdg/gestionar/general', 'TdgController@allTdgGestionarGeneral')->name('tdg.todosTdgGestionarGeneral')->middleware('can:tdg.todosTdgGestionarGeneral');

// Ruta para mostrar detalle de tdg coordinador de escuela
Route::get('/ver/detalle/tdg/escuela/{id}', 'TdgController@createDetalleTdgEscuela')->name('tdg.verDetalleTdgEscuela')->middleware('can:tdg.verDetalleTdgEscuela');

// Ruta para imprimir ver detalles para coordinador de escuela
Route::get('/imprimir/detalle/tdg/{id}','TdgController@generatePdfDetallesTdg')->name('tdg.generatePdfDetallesTdg');

// Ruta para mostrar detalle de tdg coordinador general
Route::get('/ver/detalle/tdg/general/{id}', 'TdgController@createDetalleTdgGeneral')->name('tdg.verDetalleTdgGeneral')->middleware('can:tdg.verDetalleTdgGeneral');

//Ruta para la creacion del ciclo
Route::get('/ingresar/ciclo', 'SemesterController@create')->name('semester.ingresar')->middleware('can:semester.ingresar');
Route::post('/guardar/ciclo', 'SemesterController@store')->name('semester.guardar')->middleware('can:semester.guardar');

//Rutas para importar los estudiantes por medio de un excel
Route::get('/ingresar/estudiantes', 'StudentController@create')->name('student.ingresar')->middleware('can:student.ingresar');
Route::post('/guardar/estudiantes', 'StudentController@store')->name('student.guardar')->middleware('can:student.guardar');


// Pantalla mostrar filtros de TDG para solicitudes
Route::get('/listar/tdg/solicitudes', function () {
return view('requests.filtro');
})->name('solicitudes.listar')->middleware('can:solicitudes.listar');

//Rutas para las solicitudes
Route::get('/ingresar/solicitud/nombre/{id}', 'RequestNameController@create')->name('request_name.ingresar')->middleware('can:request_name.ingresar');
Route::post('/guardar/solicitud/nombre', 'RequestNameController@store')->name('name.guardar')->middleware('can:name.guardar');

Route::get('/ingresar/solicitud/tribunal/{id}', 'RequestTribunalController@create')->name('request_tribunal.ingresar')->middleware('can:request_tribunal.ingresar');
Route::get('/guardar/solicitud/tribunal', 'RequestTribunalController@store')->name('request_tribunal.guardar')->middleware('can:request_tribunal.guardar');
Route::get('/guardar/tribunal/profesor', 'RequestTribunalController@storeRequestTribunalProfessor')->name('request_tribunal.guardarRequestTribunalProfessor')->middleware('can:request_tribunal.guardarRequestTribunalProfessor');

Route::get('/ingresar/solicitud/{tipo_solicitud}/{id}', 'RequestExtensionController@create')->name('request_extension.ingresar')->middleware('can:request_extension.ingresar');
Route::post('/guardar/solicitud/prorroga', 'RequestExtensionController@store')->name('request_extension.guardar')->middleware('can:request_extension.guardar');

Route::get('/ingresar/solicitud/{id}', 'RequestResultController@create')->name('request_result.ingresar')->middleware('can:request_result.ingresar');
Route::post('/guardar/solicitud/', 'RequestResultController@store')->name('request_result.guardar')->middleware('can:request_result.guardar');

// Pantalla mostrar filtros de TDG para solicitudes
Route::get('/listar/tdg/asignar', function () {
    return view('assignments.filtro');
})->name('assignments.filtro')->middleware('can:assignments.filtro');

// Pantalla mostrar filtros de TDG para gestionar coordinador de escuela
Route::get('/listar/tdg/gestionar/escuela', function () {
    return view('tdg.filtro_gestionar_escuela');
})->name('tdg.filtroGestionarEscuela');

// Ruta para abandonar el TDG
Route::get('/abandonar/student/tdg', 'TdgController@abandonarTdg')->name('tdg.abandonarTdg');

// Pantalla mostrar filtros de TDG para gestionar coordinador general
Route::get('/listar/tdg/gestionar/general', function () {
    return view('tdg.filtro_gestionar_general');
})->name('tdg.filtroGestionarGeneral');

// Ruta para todos los nombres de las escuelas
Route::get('/todos/colleges', 'CollegeController@allNameColleges')->name('colllege.todos');

// Pantalla para mostrar los filtros y mostrar los acuerdos de JD
Route::get('/listar/acuerdos/jd', function(){
    return view('agreement.listar_acuerdos');
})->middleware('can:agreement.listar_acuerdos');

Route::get('/todos/acuerdos/ver/jd', 'AgreementController@allJdAcuerdos')->name('agreement.show');

//Pantalla para mostrar las tdg, para el administrador
Route::get('/listar/tdg/ratificacion', function(){
    return view('tdg.listar_tdg');
})->name('ratificar.listar')->middleware('can:ratificar.listar');

Route::get('/todos/tdg/ver/ratificacion', 'TdgController@allTdgRatificacion')->name('tdg.showtdgRatificacion');

//Rutas para el modulo de usuarios del sistema
/*Mostrar los Usuarios en el sistema*/
Route::get('/todos/usuarios/sistema', 'UserController@index')->name('user.index')->middleware('can:user.index');

/*Nos lleva a la pantalla de ingresar nuevo usuario */
Route::get('/ingresar/usuario/sistema', 'UserController@create')->name('ingresar.usuario')->middleware('can:ingresar.usuario');

/* Ruta que nos permite guardar un nuevo usuario*/
Route::post('/guardar/usuario', 'UserController@store')->name('user.guardar')->middleware('can:ingresar.usuario');

/* Ruta para editar los usuarios*/
Route::get('users/{user}/edit', 'UserController@edit')->name('user.edit')->middleware('can:user.edit');

/*Actualiza y guarda la informacion */
Route::post('users/{user}', 'UserController@update')->name('user.update')->middleware('can:user.update');
/*Carga los datos de la busqueda */
Route::get('/todos/users/ver', 'UserController@allUsers')->name('user.show')->middleware('can:user.show');

//Rutas para manejar la tabla de parametros de las prorrogas

Route::get('/listar/prorroga', 'TypeExtensionController@allExtension')->name('month.show')->middleware('can:month.show');

Route::get('/actualizar/prorroga/{id}', 'TypeExtensionController@edit')->name('month.edit')->middleware('can:month.edit');

Route::post('/guardar/prorroga/{id}', 'TypeExtensionController@update')->name('month.update')->middleware('can:month.update');

//Rutas para el crud de profesores
//Rutas para importar los maestros y el formulario de profesores.accordion
Route::get('/ingresar/profesores', 'ProfessorController@create')->name('professor.ingresar')->middleware('can:professor.ingresar');
Route::post('/guardar/profesores', 'ProfessorController@store')->name('professor.guardar')->middleware('can:professor.guardar');
Route::post('/guardar/excel/profesores', 'ProfessorController@storexls')->name('professor.guardarexcel')->middleware('can:professor.guardarexcel');
Route::get('/todos/profesores/sistema', 'ProfessorController@index')->name('professor.index')->middleware('can:professor.index');
Route::get('/todos/profesores/ver', 'ProfessorController@allProfesores')->name('professor.show')->middleware('can:professor.show');
Route::get('/profesores/{professor}/edit', 'ProfessorController@edit')->name('professor.edit')->middleware('can:professor.edit');
Route::post('/profesores/{professor}', 'ProfessorController@update')->name('professor.update')->middleware('can:professor.update');

//Rutas para mostrar estudiantes.
Route::get('/todos/estudiantes/sistema', 'StudentController@index')->name('student.index')->middleware('can:student.index');
Route::get('/todos/estudiantes/ver', 'StudentController@allEstudiantes')->name('student.show')->middleware('can:student.show');

// Rutas para ver una solicitud
Route::get('ver/solicitud/{tipo_solicitud}/{id}', 'RequestController@show')->name('request.show')->middleware('can:request.show');

// Pantalla para listar y filtrar las solicitudes realizadas para coordinador general
Route::get('/listar/ver/solicitudes/general', function () {
    return view('requests.filtro_ver_solicitudes_general');
})->name('request.filtroVerSolicitudesGeneral')->middleware('can:request.filtroVerSolicitudesGeneral');

// Pantalla para listar y filtrar las solicitudes realizadas para coordinador de escuela
Route::get('/listar/ver/solicitudes/escuela', function () {
    return view('requests.filtro_ver_solicitudes_escuela');
})->name('request.filtroVerSolicitudesEscuela')->middleware('can:request.filtroVerSolicitudesEscuela');

// Ruta para para enviar datos para filtro de ver solicitudes
Route::get('/todos/ver/solicitudes/general', 'RequestController@allVerSolicitudesGeneral')->name('request.todosVerSolicitudesGeneral');

// Rutas para ver el detalle de una solicitud
Route::get('/ver/detalle/solicitud/{tipo_solicitud}/{id}', 'RequestController@showVerSolicitud')->name('request.showVerSolicitud');

// Pantalla mostrar filtros de TDG para el modulo de edición
Route::get('/listar/tdg/editar', function () {
    return view('tdg.filtro_editar');
})->name('tdg.filtroTdgEditar')->middleware('can:tdg.filtroTdgEditar');

// Ruta para para enviar todos los datos del TDG para filtro de editar
Route::get('/todos/tdg/editar', 'TdgController@allTdgEditar')->name('tdg.todosTdgEditar')->middleware('can:tdg.todosTdgEditar');

// Rutas para editar nombre del TDG
Route::get('/editar/nombre/{id}', 'RequestNameController@editarNombre')->name('tdg.editarNombre')->middleware('can:tdg.editarNombre');
Route::post('/editar/nombre/tdg', 'RequestNameController@guardarNombre')->name('tdg.guardarNombre')->middleware('can:tdg.guardarNombre');

//Rutas para deshabilitar el TDG
Route::get('/deshabilitar/tdg/{id}', 'TdgController@deshabilitarTdg')->name('tdg.deshabilitar')->middleware('can:tdg.deshabilitar');

// Ruta para mostrar pantalla de editar grupo de TDG
Route::get('/editar/grupo/tdg/{id}', 'TdgController@editarGrupoTdg')->name('tdg.editarGrupoTdg')->middleware('can:tdg.editarGrupoTdg');

//Rutas para los reportes
Route::get('/reporte/principal', 'ReportController@principal_estados')->name('reporte.principal');
Route::get('/reporte/principal/escuela', 'ReportController@principal_estados_escuela')->name('reporte.principal_escuela');
Route::get('/reporte/generar/estados', 'ReportController@generar_reporteEstados')->name('reporte.estados');
Route::get('/reporte/generar/estadosPdf', 'ReportController@pdfEstados')->name('reporte.estadosPdf');
Route::get('/reporte/generar/escuela', 'ReportController@pdfEstadoEscuela')->name('reporte.escuela');


// Ruta para actualizar el grupo
Route::get('/update/tdg/asignacion', 'TdgController@updateAsignaciones')->name('tdg.updateTdgAsignaciones')->middleware('can:tdg.updateTdgAsignaciones');

//Rutas para los correos
Route::get('/correo/crear', 'MailController@createMail')->name('mail.create')->middleware('can:mail.create');
Route::post('/correo/enviar', 'MailController@mandarCorreoEscuela')->name('mail.send')->middleware('can:mail.send');

// Ruta para actualizar el estado activo en student_tdg y notificar abandonó de estudiante
Route::get('/update/activo/student/tdg', 'TdgController@updateActivoStudentTdg')->name('tdg.updateActivoStudentTdg');
Route::get('/ayuda', function () {
    return view('tdg.recursos_de_ayuda');
})->name('tdg.ayuda');
});
