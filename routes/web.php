<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/',['uses'=>'PeticionesController@index','as'=>'index']);
Route::get('/formulario',['uses'=>'PeticionesController@formulario1','as'=>'formulario']);
Route::post('/formulario',['uses'=>'PeticionesController@procesarFormulario1','as'=>'formulario.procesar']);
/** Graficas */
Route::get('/grfica/{name}',['uses'=>'PeticionesController@cargarGrafica','as'=>'grafica']);
