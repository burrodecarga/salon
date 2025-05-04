<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Teacher;
use App\Models\Aula;
use App\Models\Asignatura;
use App\Http\Requests\UpdateAulaRequest;
use App\Http\Requests\StoreAulaRequest;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('super-admin')) {

            $aulas = Aula::orderBy('asignatura')->paginate(9);
        } else {
            $profesor = Teacher::find(auth()->user()->id);
            $aulas = $profesor->aulas()->paginate(9);
            //$asignaturas = $profesor->asignaturas;

        }

        // dd($asignaturas);
        return view('aulas.index', compact('aulas', 'profesor'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aula = new Aula();
        $profesor = Teacher::find(auth()->user()->id);
        $asignaturas = $profesor->asignaturas;
        //dd($asignaturas, $profesor);
        $title = "create aula";
        $btn = "create aula";
        return view('aulas.create', compact('aula', 'profesor', 'title', 'btn', 'asignaturas'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAulaRequest $request)
    {

        $asignatura = Asignatura::find($request->input('asignatura'));

        //dd($request->input('inicio'));
        $date = $request->input('inicio');
        //dd($date);
        $inicio = Carbon::create($date);
        $date1 = $request->input('fin');
        $fin = Carbon::create($date1);
        //dd($inicio);
        $perido = 'período desde el ' . $inicio->format('d-m-Y') . ' hasta el ' . $fin->format('d-m-Y');
        Aula::create([
            'asignatura' => $asignatura->name,
            'asignatura_id' => $asignatura->id,
            'name' => $request->input('name'),
            'inicio' => $inicio->format('Y-m-d'),
            'fin' => $fin->format('Y-m-d'),
            'periodo' => $perido,
            'slug' => Str::slug($perido),
            'teacher' => auth()->user()->name,
            'teacher_id' => auth()->user()->id,
            'status' => 1
        ]);

        flash()->success('Aula o sección creada correctamente!');
        return redirect()->route('aulas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aula $aula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aula $aula)
    {
        $profesor = Teacher::find(auth()->user()->id);
        $asignaturas = $profesor->asignaturas;
        $title = "edit aula";
        $btn = "edit aula";
        return view('aulas.edit', compact('aula', 'profesor', 'title', 'btn', 'asignaturas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAulaRequest $request, Aula $aula)
    {
        $asignatura = Asignatura::find($request->input('asignatura'));
        $date = $request->input('inicio');
        $inicio = Carbon::create($date);
        $date1 = $request->input('fin');
        $fin = Carbon::create($date1);
        $perido = 'período desde el ' . $inicio->format('d-m-Y') . ' hasta el ' . $fin->format('d-m-Y');
        $aula->asignatura = $asignatura->name;
        $aula->asignatura_id = $asignatura->id;
        $aula->name = $request->input('name');
        $aula->inicio = $inicio->format('Y-m-d');
        $aula->fin = $fin->format('Y-m-d');
        $aula->periodo = $perido;
        $aula->slug = Str::slug($perido);
        //$aula->teacher_id = auth()->user()->id;
        $aula->save();
        flash()->success('Aula o sección actualizada correctamente!');
        return redirect()->route('aulas.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aula $aula)
    {
        //
    }
}
