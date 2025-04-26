<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Pregunta;
use App\Models\Prototipo;
use App\Models\Teacher;
use App\Models\Examen;
use App\Http\Requests\UpdateExamenRequest;
use App\Http\Requests\StoreExamenRequest;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = Teacher::find(auth()->user()->id);
        $asignaturas_id = $teacher->asignaturas()->pluck('id')->toArray();
        $asignaturas = $teacher->asignaturas;
        $examenes = $teacher->examens;

        return view('examenes.index', compact('asignaturas', 'examenes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $title = 'create examen';
        $btn = 'create examen';
        $teacher = Teacher::find(auth()->user()->id);
        $asignaturas = $teacher->asignaturas;
        $examen = new Examen();
        return view('examenes.create', compact('asignaturas', 'examen', 'title', 'btn'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($examen)
    {
        $examen = Examen::find($examen);
        $questions = $examen->questions()->inRandomOrder()->get();
        //dd($examen);
        return view('examenes.show', compact('examen', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Examen $examen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamenRequest $request, Examen $examen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Examen $examen)
    {
        //
    }

    public function activar(Examen $examen)
    {
        $questions = $examen->questions;//
        if ($questions->count() == 0) {
            flash()->error('El Exámen no tiene preguntas, debe EDITAR EXÁMEN y crear preguntas...!');
            return redirect()->route('examenes.index');

        }
        ;
        foreach ($questions as $question) {
            foreach ($question->options as $option) {
                $pregunta = Pregunta::where('examen_id', $examen->id)
                    ->where('asignatura_id', $examen->asignatura_id)
                    ->where('teacher_id', $examen->teacher_id)
                    ->where('question_id', $question->id)
                    ->where('option_id', $option->id)
                    ->first();
                if ($pregunta) {
                    $pregunta->update([

                        'answer' => $option->answer,
                        'question' => $question->question,
                        'is_true' => $option->is_true,
                    ]);
                    $pregunta->save();
                    //dd($pregunta->question_id, 'PREGUNTA', $question->question, $pregunta->question);
                } else {
                    Pregunta::create([
                        'answer' => $option->answer,
                        'question' => $question->question,
                        'is_true' => $option->is_true,
                        'examen_id' => $examen->id,
                        'asignatura_id' => $examen->asignatura_id,
                        'teacher_id' => $examen->teacher_id,
                        'question_id' => $option->question_id,
                        'option_id' => $option->id,
                    ]);
                    //dd('NO EXISTE y SE CREÓ');
                }
            }
        }
        if ($examen->activo == 1) {
            $examen->activo = 0;
            flash()->warning('El Exámen está desactivado...!');
        } else {
            $examen->activo = 1;
            flash()->success('El Exámen está activado...!');
        }
        $examen->save();
        return redirect()->route('examenes.index');
    }



}


