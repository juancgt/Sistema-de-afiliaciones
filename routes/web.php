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





//Auth::routes();
Auth::routes(['register' => false]);



Route::get('detalle_actividad/{id}','ActividadController@actividad');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', function () {
        return view('welcome');
    });


    Route::resource('user','UserController');
    Route::resource('role','RoleController');
    Route::resource('permission','PermissionController');
    Route::resource('institucion','InstitucionController');
    Route::resource('especialidad','AreaController');
    Route::resource('afiliado','AfiliadoController');
    Route::post('afiliado_institucion','AfiliadoController@afiliado_institucion');
    Route::post('afiliado_especialidad','AfiliadoController@afiliado_especialidad');
    Route::get('credencial/{id}','AfiliadoController@credencial');
    Route::get('recibo/{id1}/{id2}','AfiliadoController@recibo');
    Route::get('detalle/{id1}/{id2}','AfiliadoController@detalle');

    Route::get('pdf/{id}','AfiliadoController@pdf');

    Route::get('foto/{id}','AfiliadoController@foto');
    Route::resource('actividad','ActividadController');
    Route::resource('area_actividad','Area_ActividadController');
    Route::resource('aporte','AporteController');
    Route::get('reporte','AporteController@reporte');
    Route::post('reporte_pdf','AporteController@reporte_pdf');
    Route::resource('area_aporte','Area_AporteController');
    Route::resource('saldo','SaldoController');
});








