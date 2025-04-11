<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Modulo;
use App\Models\Lesson;
use App\Models\Asignatura;

class BaseController extends Controller
{
    public function index(Modulo $modulo, Lesson $lesson)
    {
        return view('base.index', compact('modulo', 'lesson'));
    }

    public function preguntas(Modulo $modulo, Lesson $lesson)
    {
        $questions = Question::where('lesson_id', $lesson->id)->paginate(10);

        return view('base.preguntas', compact('modulo', 'lesson', 'questions'));
    }


    public function pregunta(Modulo $modulo, Lesson $lesson)
    {
        $questions = $lesson->questions;
        return view('base.pregunta', compact('modulo', 'lesson', 'questions'));
    }

    public function crear(Modulo $modulo, Lesson $lesson)
    {
        $question = new Question();
        $questions = $lesson->questions;
        $title = "create question";
        $btn = "create question";
        return view('base.crear', compact('modulo', 'lesson', 'questions', 'question', 'btn', 'title'));
    }

    public function almacenar(StoreQuestionRequest $request)
    {
        $question = Question::create([
            'question' => mb_strtolower($request->input('question')),
            'level' => mb_strtolower($request->input('level')),
            'lesson_id' => mb_strtolower($request->input('lesson_id')),
            'type' => mb_strtolower($request->input('type')),
        ]);
        flash()->success('Pregunta creada correctamente!');
        return redirect()->route('base.crearopciones', compact('question'));
    }

    public function crearopciones(Question $question)
    {
        if ($question->type == 'simple') {
            return view('base.crearsimple', compact('question'));
        } else {

            return view('base.crearopciones', compact('question'));
        }
    }




    public function opciones(Modulo $modulo, Lesson $lesson, Question $question)
    {
        $options = $question->options;
        return view('base.opciones', compact('modulo', 'lesson', 'question', 'options'));
    }


}
