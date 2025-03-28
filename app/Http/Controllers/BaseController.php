<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modulo;
use App\Models\Lesson;
use App\Models\Asignatura;

class BaseController extends Controller
{
    public function index(Modulo $modulo, Lesson $lesson)
    {
        return view('base.index', compact('modulo','lesson'));
    }
}
