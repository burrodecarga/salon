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

    Route::get('check-status', [ApiController::class, 'check']);
    Route::get('/aulas', [ApiController::class, 'aulas']);

    Route::post('/examenes', [ApiController::class, 'examenes'])->middleware('auth:sanctum');
});
