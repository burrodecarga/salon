<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Http\Requests\StoreExamenRequest;
use App\Http\Requests\UpdateExamenRequest;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaturas_id = auth()->user()->asignaturas()->pluck('id')->toArray();
        $asignaturas = auth()->user()->asignaturas;
        $examenes = auth()->user()->examenes;
        return view('examenes.index', compact('asignaturas', 'examenes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $title = 'create examen';
        $btn = 'create examen';
        $asignaturas = auth()->user()->asignaturas;
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
    public function show(Examen $examen)
    {
        $questions = $examen->questios()->inRandomOrder()->get();
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
}
