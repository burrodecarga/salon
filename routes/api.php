<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\ApiController;


Route::prefix('v1')->group(function () {
    Route::get('/test', function (Request $request) {

        $users = User::all();
        return response()->json($users);
    });



    Route::post('/register', [ApiController::class, 'register']);
    Route::post('/login', [ApiController::class, 'login']);
    Route::post('/logout', [ApiController::class, 'logout']);

    Route::get('check', [ApiController::class, 'check']);
    Route::get('/aulas', [ApiController::class, 'aulas']);
    Route::get('/aula', [ApiController::class, 'aula']);
    Route::get('/asignatura', [ApiController::class, 'asignatura']);

    Route::get('/lecciones', [ApiController::class, 'lecciones']);
    Route::get('/leccion', [ApiController::class, 'leccion']);
    Route::get('/evaluacion', [ApiController::class, 'evaluacion']);
    Route::get('/preguntas', [ApiController::class, 'preguntas']);
    Route::get('/getExamen', [ApiController::class, 'getExamen']);
    Route::get('/get_preguntas_por_asignatura', [ApiController::class, 'get_preguntas_por_asignatura']);
    Route::get('/respuestas', [ApiController::class, 'respuestas']);
    Route::get('/get_preguntas_por_examen', [ApiController::class, 'get_preguntas_por_examen']);
    Route::post('/examenes', [ApiController::class, 'examenes'])->middleware('auth:sanctum');
    Route::get('/get_preguntas_por_block', [ApiController::class, 'get_preguntas_por_block']);
});
