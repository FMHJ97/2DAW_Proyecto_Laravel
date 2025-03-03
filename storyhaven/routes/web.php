<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIRelatoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->name('inicio');

/**
 * Ruta para obtener todos los relatos.
 * Puede ser accedida por cualquier usuario.
 */
Route::get('/relatos/all', [RelatoController::class, 'getAll'])->name('relatos.all');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Solo usuarios autenticados pueden acceder a estas rutas.
 */
Route::middleware('auth')->group(function () {
    // Ruta para obtener los relatos del usuario autenticado.
    Route::get('/relatos', [RelatoController::class, 'index'])->name('relatos.index');
    // Ruta para almacenar un nuevo relato.
    Route::post('/relatos', [RelatoController::class, 'store'])->name('relatos.store');
    // Ruta para crear un nuevo relato.
    Route::get('/relatos/create', [RelatoController::class, 'create'])->name('relatos.create')->middleware('verified'); // Solo usuarios verificados pueden crear relatos.
    // Ruta para obtener un relato en específico.
    Route::get('/relatos/{relato}', [RelatoController::class, 'show'])->name('relatos.show');
    // Ruta para descargar un relato.
    Route::get('/relatos/{relato}/descargar', [RelatoController::class, 'download'])->name('relatos.download');

    /**
     * Rutas para editar, actualizar y eliminar un relato.
     * Solo el autor del relato puede realizar estas acciones.
     */
    Route::middleware('isAuthor', 'verified')->group(function () {
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
    Route::middleware('isAdmin', 'verified')->group(function () {
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

/*
Rutas para recuperar la contraseña.
*/

// Ruta para solicitar un enlace para restablecer la contraseña.
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

// Ruta para enviar el enlace para restablecer la contraseña.
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::ResetLinkSent
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

// Ruta para restablecer la contraseña.
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

// Ruta para actualizar la contraseña.
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PasswordReset
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

require __DIR__.'/auth.php';
