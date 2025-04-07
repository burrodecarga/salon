<?php

use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\BaseController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\Asignatura;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/asignaturas', [AsignaturaController::class, 'index'])->name('asignaturas.index');
    Route::get('/asignaturas/create', [AsignaturaController::class, 'create'])->name('asignaturas.create');

    Route::post('/asignaturas/store', [AsignaturaController::class, 'store'])->name('asignaturas.store');



    Route::get('/asignaturas/{asignatura}', [AsignaturaController::class, 'show'])->name('asignaturas.show');

    Route::get('/modulos/{modulo}/lessons/{lesson}', [BaseController::class, 'index'])->name('base.index');

    Route::get('preguntas/modulos/{modulo}/lessons/{lesson}', [BaseController::class, 'preguntas'])->name('base.preguntas');


    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
