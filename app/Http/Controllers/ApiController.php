<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
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
            'email' => 'required|email|string|unique:users,id',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($fields);
        $token = $user->createToken($request->name)->plainTextToken;


        return ['user' => $user, 'token' => $token];
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


    public function examenes(Request $request)
    {
        $filter = new ExamenFilter();
        $queryItems = $filter->transform($request);
        $examenes = Examen::where($queryItems);
        return new ExamenResource($examenes->paginate()->appends($request->query()));
    }

    public function check()
    {
        $check = auth('api')->user();
        //var_dump($check);
        return response()->json($check);
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

        $examen = Examen::where('asignatura_id', $request->input('asignatura_id'))
            ->where('activo', '1')
            ->where('teacher_id', $request->input('teacher_id'))
            ->first();
        //return $examen;
        $questions = $examen->questions()->inRandomOrder()->get();
        if (!$questions) {
            return response()->json([
                "message" => "registro no encontrado",
                "status" => 404
            ], 404);
        }
        return new ExamenResource($questions);

    }
}
