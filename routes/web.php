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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('actividades', 'actividadController');
Route::get('categoria/{idCat}', 'actividadController@actividadFkCategoria');
Route::resource('categorias', 'categoriaController');
Route::get('busqueda/{actividad?}/{estado?}', 'categoriaController@busquedaPorActividadEstado');
Route::get('filtrar/{variable}/{id}', 'actividadController@filtroHome');
Route::get('categ/{id}', 'categoriaController@actividadesPorCategoria');
Route::get('gruposPorActividad/{id}', 'actividadController@getGruposPorActividad');
Route::get('imagenes/{id}', 'actividadController@actividadImagenes');
Route::get('ciudades', 'actividadController@ciudades');

Route::resource('usuario', 'usuarioController');

Route::get('user/{id}', 'usuarioController@updateUserStatus');