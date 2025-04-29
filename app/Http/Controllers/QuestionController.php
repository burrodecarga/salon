<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Question;
use App\Models\Modulo;
use App\Models\Lesson;
use App\Models\Asignatura;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Requests\StoreQuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Asignatura $asignatura, Modulo $modulo, Lesson $lesson)
    {
        $questions = $lesson->questions()->paginate(9);
        return view('questions.index', compact('questions', 'lesson', 'modulo', 'asignatura'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Asignatura $asignatura, Modulo $modulo, Lesson $lesson)
    {
        // $question = new Question();
        // $title="create question";
        // $btn="create question";
        // return view('questions.create',compact('asignatura','modulo','lesson','question','title','btn'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }

    public function create_pregunta(Examen $examen)
    {
        $question = new Question();
        $asignatura = Asignatura::find($examen->asignatura_id);
        $modulos = $asignatura->modulos;
        $lessons = $asignatura->lessons;
        $title = "create question";
        $btn = "create question";
        return view('questions.create_pregunta', compact('asignatura', 'modulos', 'lessons', 'question', 'examen', 'title', 'btn'));
    }
}
