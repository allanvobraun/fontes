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

Route::get('/fontes', 'FontesController@getFontes');
Route::post('/fontes', 'FontesController@newFonte');
Route::get('/fontes/search', 'FontesController@searchFonte');
Route::post('/fontes/{cod_interno}/reparos', 'FontesController@newReparo');
Route::get('/fontes/{cod_interno}/reparos', 'FontesController@getReparos');
Route::get('/fontes/reparos', 'FontesController@getAllReparos');
Route::get('/fontes/{cod_interno}', 'FontesController@getFonte');

Route::get('/fontes/reparos/valorSum', 'FontesController@getAllReparosSum');

