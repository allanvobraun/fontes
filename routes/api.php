<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FontesController;
use App\Http\Controllers\ReparosController;

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
Auth::routes(['register' => false]);


Route::middleware('auth:sanctum')->get('/user', fn(Request $request) => $request->user());

// fontes
Route::get('/fontes', [FontesController::class, 'getFontes']);
Route::post('/fontes', [FontesController::class, 'newFonte']);
Route::get('/fontes/search', [FontesController::class, 'searchFonte']);
Route::get('/fontes/{cod_interno}', [FontesController::class, 'getFonte']);

// reparos
Route::post('/fontes/{cod_interno}/reparos', [ReparosController::class, 'newReparo']);
Route::get('/fontes/{cod_interno}/reparos', [ReparosController::class, 'getReparos']);
Route::get('/fontes/reparos', [ReparosController::class, 'getAllReparos']);
Route::get('/fontes/reparos/valorSum', [ReparosController::class, 'getAllReparosSum']);
Route::get('/fontes/reparos/valorReparosAnual', [ReparosController::class, 'getValorReparosAno']);
Route::get('/fontes/reparos/valorSemanas', [ReparosController::class, 'getValoresReparosUltimasSemanas']);

