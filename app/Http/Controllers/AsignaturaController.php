<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Modulo;
use App\Models\Teacher;
use App\Models\Asignatura;
use App\Http\Requests\UpdateAsignaturaRequest;
use App\Http\Requests\StoreAsignaturaRequest;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('super-admin')) {

            $asignaturas = Asignatura::orderBy('name')->paginate(9);
        } else {
            $profesor = Teacher::find(auth()->user()->id);
            $asignaturas = $profesor->asignaturas()->paginate(9);

        }

        return view('asignaturas.index', compact('asignaturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('asignaturas.create'); //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAsignaturaRequest $request)
    {
        $asignatura = Asignatura::create([
            'name' => mb_strtolower($request->input('name')),
            'description' => mb_strtolower($request->input('description')),
            'teacher_id' => auth()->user()->id
        ]);
        //$asignaturas = Asignatura::orderBy('name')->paginate(9);
        $modulo = Modulo::create([
            'name' => 'módulo 1 creado por defecto',
            'description' => 'Módulo que se crea al crear asignatura',
            'asignatura_id' => $asignatura->id
        ]);

        Lesson::create([
            'name' => 'Lección 1 creado por defecto',
            'description' => 'Lección que se crea al crear asignatura',
            'modulo_id' => $modulo->id
        ]);


        flash()->success('Asignatura creada correctamente!');

        return redirect()->route('asignaturas.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Asignatura $asignatura)
    {
        $modulos = $asignatura->modulos;//
        return view('asignaturas.show', compact('asignatura', 'modulos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignatura $asignatura)
    {
        return view('asignaturas.edit', compact('asignatura'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAsignaturaRequest $request, Asignatura $asignatura)
    {

        $asignatura->name = mb_strtolower($request->input('name'));
        $asignatura->description = mb_strtolower($request->input('description'));
        $asignatura->save();
        flash()->success('Asignatura modificada correctamente!');
        return redirect()->route('asignaturas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asignatura $asignatura)
    {
        //
    }

    public function listado()
    {

        $profesor = Teacher::find(auth()->user()->id);
        $asignaturas = $profesor->asignaturas;

        return view('asignaturas.listado', compact('asignaturas'));
    }


}
