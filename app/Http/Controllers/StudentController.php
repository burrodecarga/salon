<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $teacher = Teacher::find(auth()->user()->id);
        $asignaturas_id = $teacher->asignaturas()->pluck('id')->toArray();
        $asignaturas = $teacher->asignaturas;
        $students = Student::all();

        return view('students.index', compact('asignaturas', 'students'));
    }//

    public function inscribir(Student $student)
    {
        $teacher = Teacher::find(auth()->user()->id);
        $asignaturas_id = $teacher->asignaturas()->pluck('id')->toArray();
        $aulas = $teacher->aulas;

        return view('students.inscribir', compact('aulas', 'student'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required',
            'aula_id' => 'required',
        ]);

        $student = Student::find($request->input('student_id'));
        $student->aulas()->syncWithoutDetaching($request->input('aula_id'));
        flash()->success('Estudiante inscrito correctamente!');
        return redirect()->route('students.index');

    }
}
