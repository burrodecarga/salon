<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Examen;
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
            'user' => ['name' => $user->name, 'email' => $user->email],
            'token' => $token
        ], 200);
    }


    public function examenes(Request $request)
    {
        $filter = new ExamenFilter();
        $queryItems = $filter->transform($request);
        $examenes = Examen::where($queryItems);
        return new ExamenResource($examenes->paginate()->appends($request->query()));

    }
}
