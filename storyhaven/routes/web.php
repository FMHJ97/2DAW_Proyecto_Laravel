<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Ruta para obtener todos los relatos.
 */
Route::get('/relatos/all', [RelatoController::class, 'getAll'])->name('relatos.all');

/**
 * Ruta para descargar un relato.
 * Se requiere autenticación para acceder a esta ruta.
 */
Route::get('/relatos/{relato}/descargar', [RelatoController::class, 'download'])
    ->name('relatos.download')->middleware('auth');

/**
 * Rutas para el recurso 'relatos'.
 * Solo crea las rutas para los métodos index, create, store, show, edit, update y destroy.
 * Se requiere autenticación para acceder a estas rutas.
 */
Route::resource('relatos', RelatoController::class)->middleware('auth');

require __DIR__.'/auth.php';
