<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIRelatoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Rutas de la API para los relatos.
Route::apiResource('relatos', APIRelatoController::class);

// Route::apiResource('relatos', APIRelatoController::class)
//     ->middleware('auth:basic'); // Protegemos las rutas con autenticación HTTP Basic.
