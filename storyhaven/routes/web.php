<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIRelatoController;

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
Route::get('/relatos/all', [RelatoController::class, 'getAll'])->name('relatos.all'); // Todos

/**
 * Solo usuarios autenticados pueden acceder a estas rutas.
 */
Route::middleware('auth')->group(function () {
    // Ruta para obtener los relatos del usuario autenticado.
    Route::get('/relatos', [RelatoController::class, 'index'])->name('relatos.index');
    // Ruta para almacenar un nuevo relato.
    Route::post('/relatos', [RelatoController::class, 'store'])->name('relatos.store');
    // Ruta para crear un nuevo relato.
    Route::get('/relatos/create', [RelatoController::class, 'create'])->name('relatos.create');
    // Ruta para obtener un relato en específico.
    Route::get('/relatos/{relato}', [RelatoController::class, 'show'])->name('relatos.show');
    // Ruta para descargar un relato.
    Route::get('/relatos/{relato}/descargar', [RelatoController::class, 'download'])->name('relatos.download');

    /**
     * Rutas para editar, actualizar y eliminar un relato.
     * Solo el autor del relato puede realizar estas acciones.
     */
    Route::middleware('isAuthor')->group(function () {
        // Ruta para actualizar un relato.
        Route::put('/relatos/{relato}', [RelatoController::class, 'update'])->name('relatos.update');
        // Ruta para eliminar un relato.
        Route::delete('/relatos/{relato}', [RelatoController::class, 'destroy'])->name('relatos.destroy');
        // Ruta para editar un relato.
        Route::get('/relatos/{relato}/edit', [RelatoController::class, 'edit'])->name('relatos.edit');
    });

    /**
     * Rutas para administradores.
     * Solo los administradores pueden acceder a estas rutas.
     */
    Route::middleware('isAdmin')->group(function () {
        // Ruta para obtener todos los usuarios.
        Route::get('/admin/usuarios', function () {
            return view('admin.usuarios');
        })->name('admin.usuarios');
        // Ruta para obtener todos los relatos.
        Route::get('/admin/relatos', function () {
            return view('admin.relatos');
        })->name('admin.relatos');
    });
});



require __DIR__.'/auth.php';
