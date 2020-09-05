<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mockery\Generator\Generator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// fontes
Route::get('/fontes', 'FontesController@getFontes');
Route::post('/fontes', 'FontesController@newFonte');
Route::get('/fontes/search', 'FontesController@searchFonte');
Route::get('/fontes/{cod_interno}', 'FontesController@getFonte');

// reparos
Route::post('/fontes/{cod_interno}/reparos', 'ReparosController@newReparo');
Route::get('/fontes/{cod_interno}/reparos', 'ReparosController@getReparos');
Route::get('/fontes/reparos', 'ReparosController@getAllReparos');
Route::get('/fontes/reparos/valorSum', 'ReparosController@getAllReparosSum');
Route::get('/fontes/reparos/valorSemanas', 'ReparosController@getValoresReparosUltimasSemanas');

