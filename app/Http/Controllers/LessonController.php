<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Lesson;
use App\Models\Asignatura;
use App\Http\Requests\UpdateLessonRequest;
use App\Http\Requests\StoreLessonRequest;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Asignatura $asignatura, Modulo $modulo)
    {
        $lessons = $modulo->lessons()->paginate(9);
        return view('lessons.index', compact('lessons', 'modulo', 'asignatura'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Asignatura $asignatura, Modulo $modulo)
    {
        $lesson = new Lesson();
        $title = "create lesson";
        $btn = "create lesson";
        return view('lessons.create', compact('asignatura', 'modulo', 'lesson', 'btn', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request, Asignatura $asignatura, Modulo $modulo)
    {
        Lesson::create([
            'name' => mb_strtolower($request->input('name')),
            'description' => mb_strtolower($request->input('description')),
            'modulo_id' => $modulo->id
        ]);

        flash()->success('Lección creada correctamente!');
        return redirect()->route('lessons.index', [$asignatura, $modulo]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Asignatura $asignatura, Modulo $modulo,Lesson $lesson)
    {
        $questions = $lesson->questions()->paginate(9);
        return view('lessons.show', compact('asignatura','modulo','lesson',  'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignatura $asignatura, Modulo $modulo, Lesson $lesson)
    {

        $title = "edit lesson";
        $btn = "edit";
        return view('lessons.edit', compact('asignatura', 'modulo', 'lesson', 'btn', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, Asignatura $asignatura, Modulo $modulo, Lesson $lesson)
    {

        $lesson->name = mb_strtolower($request->input('name'));
        $lesson->description = mb_strtolower($request->input('description'));
        $lesson->save();


        flash()->success('Lección modificada correctamente!');
        return redirect()->route('lessons.index', [$asignatura, $modulo, $lesson]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
