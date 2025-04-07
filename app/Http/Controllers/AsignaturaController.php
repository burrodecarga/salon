<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Http\Requests\StoreAsignaturaRequest;
use App\Http\Requests\UpdateAsignaturaRequest;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaturas = Asignatura::orderBy('name')->paginate(9);
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
       Asignatura::create([
        'name'=>mb_strtolower($request->input('name')),
        'description'=>mb_strtolower($request->input('description')),
        'user_id'=>auth()->user()->id
       ]);
       $asignaturas = Asignatura::orderBy('name')->paginate(9);
       return redirect()->route('asignaturas.index', compact('asignaturas'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Asignatura $asignatura)
    {
        $modulos = $asignatura->modulos;//
        return view('asignaturas.show', compact('asignatura','modulos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignatura $asignatura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAsignaturaRequest $request, Asignatura $asignatura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asignatura $asignatura)
    {
        //
    }
}
