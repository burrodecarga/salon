<?php

namespace App\Livewire\Examenes;

use App\Models\Examen;
use App\Models\Lesson;
use App\Models\Question;
use Livewire\Component;
use App\Models\Modulo;
use App\Models\Asignatura;

class CreateExamen extends Component
{
    public $examen = '1er parcial';
    public $asignaturas;
    public $modulos = [];
    public $lessons = [];

    public $selectedAsignatura = 0, $selectedModulo = 0, $selectedLesson = 0;
    public $simples = 5, $multiples = 25, $preguntas = 30;

    protected function rules()
    {
        return [
            'selectedAsignatura' => 'required|integer|gt:0'
        ];
    }

    public function save()
    {
        $descripcionExamen = '';
        $modulo = null;
        $leccion = null;
        $moduloID = null;
        $leccionID = null;


        if ($this->selectedAsignatura == 0) {
            return;
        }



        $totalSimples = intval($this->simples);
        $totalMultiples = intval($this->multiples);
        $this->preguntas = $totalSimples + $totalMultiples;

        // if ($totalMultiples < 0) {
        //     $totalSimles = 0;
        //     $totalPreguntas = intval($this->preguntas);
        //     $totalMultiples = $totalPreguntas - $totalSimles;
        // }

        //dd($totalPreguntas, $totalMultiples, $totalSimles);
        $asignatura = Asignatura::find($this->selectedAsignatura);
        $asignaturaId = intval($this->selectedAsignatura);
        $query = '';
        if ($this->selectedModulo == 0) {
            $preguntasMultiples = Question::where('asignatura_id', $asignaturaId)->whereLike('type', '%' . 'multiple' . '%')->take($this->multiples)
                ->inRandomOrder()->get();
            $preguntasSimples = Question::where('asignatura_id', $asignaturaId)->whereLike('type', '%' . 'simple' . '%')->take($this->simples)
                ->inRandomOrder()->get();

            $descripcionExamen = 'Todos los modulos, ' . 'preguntas selección múltiples, ' . $preguntasMultiples->count() . 'preguntas de selección simple ' . $preguntasSimples->count();


        } elseif ($this->selectedModulo != 0 && $this->selectedLesson == 0) {
            $preguntasMultiples = Question::where('asignatura_id', $asignaturaId)
                ->where('modulo_id', $this->selectedModulo)
                ->whereLike('type', '%' . 'multiple' . '%')
                ->take($this->multiples)
                ->get();
            $preguntasSimples = Question::where('asignatura_id', $asignaturaId)
                ->where('modulo_id', $this->selectedModulo)
                ->whereLike('type', '%' . 'simple' . '%')
                ->take($this->simples)
                ->get();

            $descripcionExamen = 'Preguntas de modulo todas las lecciones,  preguntas selección múltiples, ' . $preguntasMultiples->count() . 'preguntas de selección simple ' . $preguntasSimples->count();
            //dd('MODULO y TODAS LAS LECCIONES', $preguntasMultiples, $preguntasSimples);


        } elseif ($this->selectedModulo != 0 && $this->selectedLesson != 0) {
            $preguntasMultiples = Question::where('asignatura_id', $asignaturaId)
                ->where('modulo_id', $this->selectedModulo)
                ->where('lesson_id', $this->selectedLesson)
                ->whereLike('type', '%' . 'multiple' . '%')
                ->take($this->multiples)
                ->inRandomOrder()->get();
            $preguntasSimples = Question::where('asignatura_id', $asignaturaId)
                ->where('modulo_id', $this->selectedModulo)
                ->where('lesson_id', $this->selectedLesson)
                ->whereLike('type', '%' . 'simple' . '%')
                ->take($this->simples)
                ->inRandomOrder()->get();
            //dd('MODULO y LECCION', $preguntasMultiples, $preguntasSimples);

            $descripcionExamen = 'Preguntas de modulo y lección,  preguntas selección múltiples, ' . $preguntasMultiples->count() . 'preguntas de selección simple ' . $preguntasSimples->count();
        }
        $totalPreguntas = $preguntasSimples->merge($preguntasMultiples);
        //dd($totalPreguntas, $preguntasMultiples, $preguntasSimples);
        $data = Examen::create([
            'name' => $this->examen,
            'description' => $descripcionExamen,
            'asignatura' => $asignatura->name,
            'asignatura_id' => $asignatura->id,
            'teacher_id' => auth()->user()->id,
        ]);

        $data->questions()->attach($totalPreguntas);
        //dd($data);

        $res = Question::where('asignatura_id', $data->asignatura_id)->groupBy('level')
            ->selectRaw(' level,count(*) as total')
            ->get();
        //dd($res);
        $str = '';
        foreach ($res as $r) {
            $str = $str . $r->total . ' ' . $r->level . ', ';
        }

        $res1 = Question::where('asignatura_id', $data->asignatura_id)->groupBy('type')
            ->selectRaw(' type,count(*) as total')
            ->get();
        $str1 = '';
        foreach ($res1 as $r) {
            $str1 = $str1 . $r->total . ' ' . $r->type . ', ';
        }

        $data->level = $str;
        $data->type = $str1;
        $data->save();

        return redirect()->route('examenes.index');


    }

    public function mount($asignaturas)
    {
        $this->asignaturas = $asignaturas;
        $this->modulos = collect();
        $this->lessons = collect();
    }


    public function ajustar()
    {
        $this->simples = 5;
        $this->multiples = 15;
        $this->preguntas = 20;

    }
    public function updatedSelectedAsignatura($asignatura)
    {

        $asignatura = Asignatura::find($asignatura);
        if (is_null($asignatura)) {
            $this->selectedAsignatura = 0;
            $this->selectedModulo = 0;
            $this->selectedLesson = 0;
            $this->modulos = collect();
            $this->lessons = collect();
        } else {

            $this->modulos = $asignatura->modulos;
        }

    }

    public function updatedSelectedModulo($modulo)
    {
        $modulo = Modulo::find($modulo);
        if (is_null($modulo)) {
            $this->selectedModulo = 0;
            $this->selectedLesson = 0;
            $this->modulos = collect();
            $this->lessons = collect();
        } else {
            $this->lessons = $modulo->lessons;
        }

    }

    public function updatedSimples($value)
    {
        if (is_null($value))
            return;
        $this->preguntas = $this->multiples + $value;
        $this->preguntas = $this->simples + $this->multiples;
    }

    public function updatedMultiples($value)
    {
        if (is_null($value))
            return;
        $this->preguntas = $this->simples + $value;
        $this->preguntas = $this->simples + $this->multiples;

    }






    public function render()
    {
        return view('livewire.examenes.create-examen');
    }
}
