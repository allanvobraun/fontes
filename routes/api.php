<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FontesController;
use App\Http\Controllers\ReparosController;
use App\Http\Controllers\UserController;


Auth::routes(['register' => false]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'get']);

    // fontes
    Route::get('/fontes', [FontesController::class, 'getFontes']);
    Route::post('/fontes', [FontesController::class, 'newFonte']);
    Route::get('/fontes/search', [FontesController::class, 'searchFonte']);
    Route::get('/fontes/{id}', [FontesController::class, 'getFonte']);

    // reparos
    Route::post('/fontes/{id}/reparos', [ReparosController::class, 'newReparo']);
    Route::get('/fontes/{id}/reparos', [ReparosController::class, 'getReparos']);
    Route::get('/fontes/reparos/valorReparosAnual', [ReparosController::class, 'getValorReparosAno']);
    Route::get('/fontes/reparos/valorSemanas', [ReparosController::class, 'getValoresReparosUltimasSemanas']);
});
