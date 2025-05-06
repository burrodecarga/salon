<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOptionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {

        $title = "edit option";
        $btn = "edit option";
        return view('options.edit', compact('option', 'title', 'btn')); //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOptionRequest $request, Option $option)
    {
        $valor = 0;

        if ($request->input('istrue') == 'on') {
            $valor = 1;
        }

        $option->update([
            'answer' => $request->input('answer'),
            'is_true' => $valor
        ]);

        $option->save();
        $question = $option->question;
        $lesson = $question->lesson;
        $modulo = $lesson->modulo;
        return redirect()->route('base.opciones', [$modulo, $lesson, $question]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        $option->delete();
        $question = $option->question;
        $lesson = $question->lesson;
        $modulo = $lesson->modulo;
        return redirect()->route('base.opciones', [$modulo, $lesson, $question]);
    }

    public function modificar(Option $option)
    {
        Option::where('question_id', $option->question_id)->update(['is_true' => 0]);
        $question = $option->question;
        $lesson = $question->lesson;
        $modulo = $lesson->modulo;
        $option->is_true = 1;
        $option->save();
        return redirect()->route('base.opciones', [$modulo, $lesson, $question]);
    }



    public function modify(Option $option)
    {

        $title = "edit option";
        $btn = "edit option";
        $question = $option->question;
        $lesson = $question->lesson()->first();
        $modulo = $lesson->modulo;
        $asignatura = $modulo->asignatura;
        //dd($lesson, $modulo);
        return view('options.modify', compact('option', 'title', 'btn', 'lesson', 'modulo', 'asignatura'));
    }

    public function actualiza(Request $request, Option $option)
    {

        $validated = $request->validate([
            'answer' => 'required',
        ]);
        $option->update([
            'answer' => $request->input('answer'),
        ]);

        $option->save();
        $question = $option->question;
        $lesson = $question->lesson()->first();

        //dd($lesson);
        $modulo_id = $lesson->modulo_id;

        flash()->success('Pregunta Modificada correctamente!');
        //return redirect()->back();
        return redirect()->route('asignaturas.leccion', [$modulo_id, $lesson->id]);

    }


}
