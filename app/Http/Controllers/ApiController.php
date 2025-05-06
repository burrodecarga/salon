<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Question;
use App\Services\ExamenService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Providers\ExamenServiceProvider;
use App\Models\User;
use App\Models\Aula;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Examen;
use App\Models\Asignatura;
use App\Http\Resources\ExamenResource;
use App\Filters\ExamenFilter;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'cedula' => 'required',
            'phone' => 'required',
            'email' => 'required|email|string|unique:users,id',
            'password' => 'required'
        ]);

        $user = User::create($fields);
        $user->roles()->sync('3');
        //$token = $user->createToken($request->name)->plainTextToken;
        return response()->json([
            'user' => ['id' => $user->id, 'name' => $user->name, 'email' => $user->email],
        ], 200);
    }

    public function login(Request $request)
    {
        $credentials = Validator::make($request->all(), $request->validate([
            'email' => 'required|email|string',
            'password' => 'required'
        ]));


        $ok = Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);
        if (!$ok) {
            return response()->json([
                "message" => "error en credenciales",
                "status" => 401
            ], 401);
        }
        $user = User::where('email', $request->input('email'))->first();
        $token = $user->createToken('edwin')->plainTextToken;

        return response()->json([
            'user' => ['id' => $user->id, 'name' => $user->name, 'email' => $user->email],
            'token' => $token
        ], 200);
    }

    public function aulas(Request $request)
    {


        $student = Student::find($request->input('id'));
        if (!$student) {
            return response()->json([
                "message" => "registro no encontrado",
                "status" => 404
            ], 404);
        }
        $aulas = $student->aulas;
        return new ExamenResource($aulas);
    }

    public function aula(Request $request)
    {

        $aula = Aula::where('id', $request->input('id'))->first();
        if (!$aula) {
            return response()->json([
                "message" => "registro no encontrado",
                "status" => 404
            ], 404);
        }
        return new ExamenResource($aula);
    }

    public function asignatura(Request $request)
    {

        $asignatura = Asignatura::find($request->input('id'));
        if (!$asignatura) {
            return response()->json([
                "message" => "registro no encontrado",
                "status" => 404
            ], 404);
        }
        $modulos = $asignatura->modulos;
        return new ExamenResource($modulos);
    }




    public function get_preguntas_por_examen(ExamenService $examenService, Request $request)
    {

        //return response()->json(["a" => $request->input('examen_id')]);
        $result = $examenService->get_preguntas_por_examen($request->input('examen_id'));

        return $result;


    }

    public function get_preguntas_por_asignatura(ExamenService $examenService, Request $request)
    {
        $result = $examenService->get_preguntas_por_asignatura($request->input('asignatura_id'), $request->input('teacher_id'));

        return $result;
    }

    public function lecciones(Request $request)
    {
        $lecciones = Lesson::where('modulo_id', $request->input('id'))->get();
        if (!$lecciones) {
            return response()->json([
                "message" => "registro no encontrado",
                "status" => 404
            ], 404);
        }
        return new ExamenResource($lecciones);
    }

    public function evaluacion(Request $request)
    {

        $examen = Examen::where('teacher_id', $request->input('id'))
            ->where('asignatura_id', $request->input('jd'))
            ->where('activo', 1)->get()->first();
        return new ExamenResource($examen);
    }

    public function preguntas(Request $request)
    {
        $examen = Examen::find($request->id);
        $model = $examen->questions;
        return new ExamenResource($model);
    }

    public function respuestas(Request $request)
    {
        $question = Question::find($request->id);
        $model = $question->options;
        return new ExamenResource($model);
    }


    public function get_preguntas_por_block(ExamenService $examenService, Request $request)
    {
        //return response()->json(["a" => $request->input('asignatura_id'), "b" => $request->input('teacher_id')]);
        $result = $examenService->get_preguntas_por_block($request->input('asignatura_id'), $request->input('teacher_id'));

        return $result;
    }


    public function set_examen(ExamenService $examenService, Request $request)
    {
        $result = $examenService->parametro($request->param['preguntas'], $request->param['respuestas'], $request->param['examen_id'], $request->param['student_id']);
        //return $result;

    }

}
