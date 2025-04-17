<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Prueba;
use App\Models\Examen;
use App\Models\Aula;

class StudentController extends Controller
{
    public function index()
    {

        $student = Student::find(auth()->user()->id);
        //$asignaturas_id = $student->asignaturas()->pluck('id')->toArray();
        $asignaturas = $student->aulas;
        $teachers = $student->teachers;

        return view('students.index', compact('asignaturas', 'student', 'teachers'));
    }//

    public function show()
    {

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

    public function inscribir()
    {

        $student = Student::find(auth()->user()->id);
        $inscritas = $student->aulas->pluck('id');
        $aulas = DB::table('aulas')
            ->whereNotIn('id', $inscritas)
            ->get();
        return view('students.inscribir', compact('student', 'aulas'));
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
        return redirect()->route('students.index');
    }

    public function aula(Aula $aula)
    {
        $examenes = Examen::where('asignatura_id', $aula->asignatura_id)->where('teacher_id', $aula->teacher_id)->where('activo', 1)->get();
        return view('students.aula', compact('aula', 'examenes'));
    }

    public function evaluar(Examen $examen)
    {
        $perPage = 50;
        $student = Student::find(auth()->user()->id);
        $questions = $examen->questions()->inRandomOrder()->get();
        return view('students.evaluar', compact('student', 'examen', 'questions', 'perPage'));
    }

    public function evaluacion(Request $request)
    {
        $array = $request->all();

        $mapped = Arr::where($array, function (string $value, string $key) {
            if (Str::contains($key, 'p-')) {
                return $value;
            };
        });


        $array=[];
        foreach($mapped as $key=>$item){
            $k = explode("p-", $key);
            $r = explode("r-", $item);
            $array[$k[1]] = $r[1];
        }

        //dd($array);

     $respuestas_correctas = DB::table('questions')
    ->join('options', 'questions.id', '=', 'options.question_id')
    // ->where('question.examen_id',$request->input('examen_id'))
    ->where('options.is_true','1')
    ->select('questions.id', 'options.id','options.question_id')
    ->get()->toArray();



    $respuestas_array=[];
        foreach($respuestas_correctas as $key=>$item){
             $respuestas_array[$item->question_id] = $item->id;
        }

        $sorted_examen = Arr::sort($array);
        $sorted_correctas = Arr::sort($respuestas_array);


        $respuestas_de_examen_correctas = Arr::where($sorted_examen, function (string|int $value, int $key) use($sorted_correctas) {

            if (in_array($value, $sorted_correctas)) {
               return $value;
            }
        });

    //dd($respuestas_de_examen_correctas,$sorted_examen,$sorted_correctas);
    //   $prueba = json_encode($sorted_correctas);
//dd($prueba);
$examen = Examen::find($request->examen_id);
$cant_preguntas_examen =$examen->questions->count();
$base =20;
$cant_respuestas_correctas = count($sorted_correctas);
if($respuestas_de_examen_correctas<>0 && $cant_preguntas_examen<>0){
    $nota=($base/$cant_preguntas_examen)*count($respuestas_de_examen_correctas);
}else{
    $nota=1;
}

$prueba = Prueba::create([
'fecha'=>now(),
'correct_answers'=>json_encode($sorted_correctas),
'student_answers'=>json_encode($sorted_examen),
'student_correct'=>json_encode($respuestas_de_examen_correctas),
'questions'=>$cant_preguntas_examen,
'correct'=>count($respuestas_de_examen_correctas),
'base'=>$base,
'nota'=>$nota,
'examen_id'=>$examen->id,
'teacher_id'=>$examen->teacher_id,
'student_id'=>auth()->user()->id,
]);

dd($prueba);

    }



}
