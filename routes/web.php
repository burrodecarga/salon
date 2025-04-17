<?php

use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\AulaController;
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

    Route::get('/teachers/salones', [TeacherController::class, 'index'])->name('teachers.salones');
    Route::get('/teachers/salon/{aula}', [TeacherController::class, 'aula'])->name('teachers.salon');
    Route::get('/teachers/students', [TeacherController::class, 'students'])->name('teachers.students');
    Route::post('/teachers/store_student', [TeacherController::class, 'storeStudent'])->name('teachers.storeStudent');
    Route::get('/teachers/salon/examen/{examen}/{id}', [TeacherController::class, 'activar'])->name('teachers.activar');

    Route::resource('/examenes', ExamenController::class)->names('examenes');
    Route::resource('/aulas', AulaController::class)->names('aulas');
    Route::get('/teachers/{student}/inscribir', [TeacherController::class, 'inscribir'])->name('teachers.inscribir');
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');


});
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/students/inscribir', [StudentController::class, 'inscribir'])->name('students.inscribir');
    Route::get('/students/aula/{aula}', [StudentController::class, 'aula'])->name('students.aula');
    Route::get('/students/examen/{examen}', [StudentController::class, 'evaluar'])->name('students.evaluar');

    Route::post('/students/examen/evaluacion', [StudentController::class, 'evaluacion'])->name('students.evaluacion');

    Route::post('/students/store_student', [StudentController::class, 'storeStudent'])->name('students.storeStudent');
    Route::resource('/students', StudentController::class)->names('students');
});

require __DIR__ . '/auth.php';
