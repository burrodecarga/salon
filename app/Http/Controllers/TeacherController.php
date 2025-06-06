<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Prototipo;
use App\Models\Pregunta;
use App\Models\Option;
use App\Models\Examen;
use App\Models\Block;
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
        $examenes = $teacher->examens;
        //dd('Aqui', $teacher, $students, $examenes);
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

    public function movil(Examen $examen)
    {
        $questions = $examen->questions;//
        if ($questions->count() == 0) {
            flash()->error('El Exámen no tiene preguntas, debe EDITAR EXÁMEN y crear preguntas...!');
            return redirect()->route('examenes.index');

        }
        $opciones = [];
        $message = '';
        Prototipo::where('examen_id', $examen->id)->delete();
        foreach ($questions as $question) {
            $prototipo_pregunta = Prototipo::where('examen_id', $examen->id)
                ->where('asignatura_id', $examen->asignatura_id)
                ->where('teacher_id', $examen->teacher_id)
                ->where('question_id', $question->id)
                ->first();

            $optionOk = null;
            foreach ($question->options as $key => $option) {

                if ($option->is_true) {
                    $optionOk = $option->id;
                }
                $temp = $question->id . '-' . $option->id . '-' . $option->is_true . '-' . $option->answer;
                array_push($opciones, $temp);
            }

            $op0 = $opciones[0];
            $op1 = $opciones[1];
            $op2 = isset($opciones, $opciones[2]) ? $opciones[2] : '';
            $op3 = isset($opciones[3]) ? $opciones[3] : '';
            $op4 = isset($opciones[4]) ? $opciones[4] : '';

            Block::updateOrCreate([
                'question_id' => $option->question_id,
                'examen_id' => $examen->id
            ], [

                'question' => $question->question,
                'option_0' => $op0,
                'option_1' => $op1,
                'option_2' => $op2,
                'option_3' => $op3,
                'option_4' => $op4,
                'option_ok' => $optionOk,
            ]);

            if ($examen->activo == 1) {
                $examen->activo = 0;
                $message = ('El Exámen está desactivado...!');
            } else {
                $examen->activo = 1;
                $message = ('El Exámen está activado...!');
            }
            $examen->save();
            if (is_null($prototipo_pregunta)) {
                //crear pregunta
                Prototipo::create([
                    'examen_id' => $examen->id,
                    'asignatura_id' => $examen->asignatura_id,
                    'teacher_id' => $examen->teacher_id,
                    'question_id' => $question->id,
                    'question' => $question->question,
                    'option_0' => $examen->block->option_0,
                    'option_1' => $examen->block->option_1,
                    'option_2' => $examen->block->option_2,
                    'option_3' => $examen->block->option_3,
                ]);
            } else {

                $prototipo_pregunta->update([
                    'question_id' => $question->id,
                    'question' => $question->question,
                    'option_0' => $examen->block->option_0,
                    'option_1' => $examen->block->option_1,
                    'option_2' => $examen->block->option_2,
                    'option_3' => $examen->block->option_3,
                ]);
                $prototipo_pregunta->save();
            }
            ;

        }
        flash()->success($message);
        return redirect()->route('examenes.index');
    }

    public function prepare_examen(Examen $examen)
    {

        ///obtenemos preguntas del examen
        $questions = $examen->questions;
        if ($questions->count() == 0) {
            flash()->error('El Exámen no tiene preguntas, debe EDITAR EXÁMEN y crear preguntas...!');
            return redirect()->route('examenes.index');
        }

        Prototipo::where('examen_id', $examen->id)->delete();
        //borramos preguntas anteriores de examen para movil
        foreach ($questions as $question) {
            $true = 0;
            $opciones = $question->options()->where('is_true', '0')->inRandomOrder()->take(5)->get();
            $correcta = $question->options()->where('is_true', '1')->first();
            //dd($opciones, $correcta);
            if (!$correcta) {
                flash()->error('El Exámen no tiene preguntas, debe EDITAR EXÁMEN y crear preguntas...!');
                return redirect()->route('examenes.index');
            }
            //dd('XX');
            $array = [];
            $opcion_is_true = Option::where('question_id', $question->id)->where('is_true', 1)->first(); //dd($opcion);
            $opciones = Option::where('question_id', $question->id)->get();
            // array_push($array, $question->option_id . '-' . $correcta->answer);
            foreach ($opciones as $o) {
                array_push($array, $o->id . '-' . $o->answer);
            }

            $array_opt = Arr::shuffle($array);
            //dd($array_opt);
            $a0 = explode('-', $array_opt[0]);
            $a1 = explode('-', $array_opt[1]);
            $a2 = count($array_opt) > 2 ? explode('-', $array_opt[2]) : 0;
            $a3 = count($array_opt) > 3 ? explode('-', $array_opt[3]) : 0;
            $a4 = count($array_opt) > 4 ? explode('-', $array_opt[4]) : 0;
            //dd($array_opt);

            $prototipo = Prototipo::create([
                'examen_id' => $examen->id,
                'asignatura_id' => $question->asignatura_id,
                'question_id' => $question->id,
                'option_id' => $opcion_is_true->id,
                'true' => $opcion_is_true->id,
                'selected' => 0,
                'question' => $question->question,
                'answer' => $correcta->answer,
                'teacher_id' => $examen->teacher_id,
                'option_0' => $array_opt[0],
                'option_1' => $array_opt[1],
                'option_2' => count($array_opt) > 2 ? $array_opt[2] : 'N/A',
                'option_3' => count($array_opt) > 3 ? $array_opt[3] : 'N/A',
                'option_4' => count($array_opt) > 4 ? $array_opt[4] : 'N/A',
                'option_0_value' => intval($a0[0]),
                'option_1_value' => intval($a1[0]),
                'option_2_value' => count($array_opt) > 2 ? intval($a2[0]) : 0,
                'option_3_value' => count($array_opt) > 3 ? intval($a3[0]) : 0,
                'option_4_value' => count($array_opt) > 4 ? intval($a4[0]) : 0,

            ]);

            $true = 0;

            ///dd($prototipo);

        }

        //Prototipo::where('true', 0)->delete();

        flash()->success('Examen Preparado para aplicar');
        return redirect()->route('examenes.index');
    }
}
