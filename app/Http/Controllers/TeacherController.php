<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Examen;
use App\Models\Aula;

class TeacherController extends Controller
{
    public function index()
    {
        $profesor = Teacher::find(auth()->user()->id);
        $aulas = $profesor->aulas()->paginate(9);

        return view('teachers.index', compact('aulas', 'profesor'));
    }

    public function aula(Aula $aula)
    {
        $teacher = Teacher::find(auth()->user()->id);
        $students = $aula->students;
        $examenes = $teacher->examenes;
        return view('teachers.aula', compact('aula', 'teacher', 'students', 'examenes'));
    }

    public function activar(Examen $examen, $id = 0)
    {
        $examen->activo = $id;
        $examen->save();
        $profesor = Teacher::find(auth()->user()->id);
        $aulas = $profesor->aulas()->paginate(9);
        flash()->success('Condición de Exámen modificada correctamente!');
        return redirect()->route('teachers.salones', compact('aulas', 'profesor'));

    }

    public function inscribir(Student $student)
    {
        $teacher = Teacher::find(auth()->user()->id);
        $inscritas = $teacher->asignaturas()->pluck('id')->toArray();
        $inscritas = $student->aulas->pluck('id');
        $aulas = DB::table('aulas')
            ->whereNotIn('id', $inscritas)
            ->get();
        return view('teachers.inscribir', compact('aulas', 'student'));
    }

    public function students()
    {
        $teacher = Teacher::find(auth()->user()->id);
        $asignaturas_id = $teacher->asignaturas()->pluck('id')->toArray();
        $asignaturas = $teacher->asignaturas;
        $students = Student::all();

        return view('teachers.students', compact('asignaturas', 'students'));
    }

    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required',
            'aula_id' => 'required',
        ]);

        $student = Student::find($request->input('student_id'));
        $student->aulas()->syncWithoutDetaching($request->input('aula_id'));
        flash()->success('Estudiante inscrito correctamente!');
        return redirect()->route('teachers.students');

    }
}
