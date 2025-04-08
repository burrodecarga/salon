<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Modulo;
use App\Http\Requests\StoreModuloRequest;
use App\Http\Requests\UpdateModuloRequest;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Asignatura $asignatura)
    {
       $modulos = $asignatura->modulos()->paginate(9);
       return view('modulos.index',compact('modulos','asignatura'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Asignatura $asignatura)
    {
        $modulo = new Modulo();
        $title="create modulo";
        $btn="create";
        return view('modulos.create',compact('asignatura','modulo','title','btn'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModuloRequest $request,Asignatura $asignatura)
    {

        Modulo::create([
            'name'=>mb_strtolower($request->input('name')),
        'description'=>mb_strtolower($request->input('description')),
        'asignatura_id'=>$asignatura->id
        ]);

        flash()->success('Módulo creado correctamente!');
        return redirect()->route('modulos.index',$asignatura);
    }

    /**
     * Display the specified resource.
     */
    public function show(Asignatura $asignatura,Modulo $modulo)
    {
        $lessons = $modulo->lessons()->paginate(6);
        return view('modulos.show',compact('asignatura','modulo','lessons'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignatura $asignatura, Modulo $modulo)
    {

        $title="edit modulo";
        $btn="edit";
        return view('modulos.edit',compact('asignatura','modulo','title','btn'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModuloRequest $request, Asignatura $asignatura,Modulo $modulo)
    {

            $modulo->name=mb_strtolower($request->input('name'));
        $modulo->description=mb_strtolower($request->input('description'));
        $modulo->save();
        flash()->success('Módulo actualizado correctamente!');
        return redirect()->route('modulos.index',$asignatura);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modulo $modulo)
    {
        //
    }
}
