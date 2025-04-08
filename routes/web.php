<?php

use Illuminate\Support\Facades\Route;
use App\Models\Asignatura;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\AsignaturaController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('/asignaturas', AsignaturaController::class)->names('asignaturas');

    Route::resource('asignatura/{asignatura}/modulos', ModuloController::class)->names('modulos');

    Route::resource('asignatura/{asignatura}/modulo/{modulo}/lessons', LessonController::class)->names('lessons');


   //Route::get('/asignaturas/{asignatura}', [AsignaturaController::class, 'show'])->name('asignaturas.show');

    Route::get('/modulos/{modulo}/lessons/{lesson}', [BaseController::class, 'index'])->name('base.index');

    Route::get('preguntas/modulos/{modulo}/lessons/{lesson}', [BaseController::class, 'preguntas'])->name('base.preguntas');


    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
