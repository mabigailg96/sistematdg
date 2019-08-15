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
Route::get('/ingresar/acuerdos', 'AgreementController@create')->name('agreement.ingresar')->middleware('can:agreement.ingresar');
Route::post('/guardar/acuerdos', 'AgreementController@store')->name('agreement.guardar')->middleware('can:agreement.guardar');

//Rutas para trabajos de graduacion
Route::get('/ingresar/tdg', 'TdgController@create')->name('tdg.ingresar')->middleware('can:tdg.ingresar');
Route::post('/guardar/tdg', 'TdgController@store')->name('tdg.guardar')->middleware('can:tdg.guardar');

});
