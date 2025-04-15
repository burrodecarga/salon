<?php

use App\Http\Controllers\ExamenController;
use App\Http\Controllers\OptionController;
use Illuminate\Support\Facades\Route;
use App\Models\Asignatura;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use App\Http\Controllers\QuestionController;
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

Route::middleware(['auth', 'role:teacher|super-admin'])->group(function () {
    Route::resource('/asignaturas', AsignaturaController::class)->names('asignaturas');

    Route::get('/listado/asignaturas', [AsignaturaController::class, 'listado'])->name('listado');


    Route::resource('asignatura/{asignatura}/modulos', ModuloController::class)->names('modulos');

    Route::resource('asignatura/{asignatura}/modulo/{modulo}/lessons', LessonController::class)->names('lessons');

    Route::resource('asignatura/{asignatura}/modulos/{modulo}/lessons/{lesson}/questions', QuestionController::class)->names('questions');

    Route::resource('/options', OptionController::class)->names('options');
    Route::get('/modificar/options/{option}', [OptionController::class, 'modificar'])->name('modificar');

    Route::get('/modulos/{modulo}/lessons/{lesson}', [BaseController::class, 'index'])->name('base.index');

    Route::get('preguntas/modulos/{modulo}/lessons/{lesson}', [BaseController::class, 'preguntas'])->name('base.preguntas');

    Route::get('crear/preguntas/modulos/{modulo}/lessons/{lesson}', [BaseController::class, 'pregunta'])->name('base.pregunta');

    Route::get('add/preguntas/asignaturas/{asignatura}/modulos/{modulo}/lessons/{lesson}', [BaseController::class, 'crear'])->name('base.crear');

    Route::post('base/almacenar', [BaseController::class, 'almacenar'])->name('base.almacenar');

    Route::get('base/crearopciones/{question}', [BaseController::class, 'crearopciones'])->name('base.crearopciones');

    Route::get('opciones/modulos/{modulo}/lessons/{lesson}/questions/{question}', [BaseController::class, 'opciones'])->name('base.opciones');

    Route::resource('/examens', ExamenController::class)->names('examenes');


    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');


});

require __DIR__ . '/auth.php';
