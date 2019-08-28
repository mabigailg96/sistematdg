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
Route::get('/ingresar/ciclo', 'SemesterController@create')->name('semester.ingresar');
Route::post('/guardar/ciclo', 'SemesterController@store')->name('semester.guardar');

Route::middleware(['auth'])->group(function(){
//Rutas para acuerdos
Route::get('/ingresar/acuerdos', 'AgreementController@create')->name('agreement.ingresar')->middleware('can:agreement.ingresar');
Route::post('/guardar/acuerdos', 'AgreementController@store')->name('agreement.guardar')->middleware('can:agreement.guardar');

//Rutas para trabajos de graduacion
Route::get('/ingresar/tdg', 'TdgController@create')->name('tdg.ingresar')->middleware('can:tdg.ingresar');
Route::post('/guardar/tdg', 'TdgController@store')->name('tdg.guardar')->middleware('can:tdg.guardar');

//Ruta para la creacion del ciclo
Route::get('/ingresar/ciclo', 'SemesterController@create')->name('semester.ingresar')->middleware('can:semester.ingresar');
Route::post('/guardar/ciclo', 'SemesterController@store')->name('semester.guardar')->middleware('can:semester.ingresar');

//Rutas para importar los estudiantes por medio de un excel
Route::get('/ingresar/estudiantes', 'StudentController@create')->name('student.ingresar');
Route::post('/guardar/estudiantes', 'StudentController@store')->name('student.guardar');
});
