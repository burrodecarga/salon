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

        // OK dd($this->preguntas, $totalMultiples, $totalSimples);

        $asignatura = Asignatura::find($this->selectedAsignatura);
        $asignaturaId = intval($this->selectedAsignatura);
        $query = '';
        if ($this->selectedModulo == 0) {
            $preguntasMultiples = Question::where('asignatura_id', $asignaturaId)->whereLike('type', '%' . 'multiple' . '%')->take($totalMultiples)
                ->inRandomOrder()->get();
            $preguntasSimples = Question::where('asignatura_id', $asignaturaId)->whereLike('type', '%' . 'simple' . '%')->take($totalSimples)
                ->inRandomOrder()->get();
            $query = 'Todos';

        } elseif ($this->selectedModulo != 0 && $this->selectedLesson == 0) {
            $preguntasMultiples = Question::where('asignatura_id', $asignaturaId)
                ->where('modulo_id', $this->selectedModulo)
                ->whereLike('type', '%' . 'multiple' . '%')
                ->take($totalMultiples)
                ->get();
            $preguntasSimples = Question::where('asignatura_id', $asignaturaId)
                ->where('modulo_id', $this->selectedModulo)
                ->whereLike('type', '%' . 'simple' . '%')
                ->take($totalSimples)
                ->get();

            $query = 'Todos modulos';

        } elseif ($this->selectedModulo != 0 && $this->selectedLesson != 0) {
            $preguntasMultiples = Question::where('asignatura_id', $asignaturaId)
                ->where('modulo_id', $this->selectedModulo)
                ->where('lesson_id', $this->selectedLesson)
                ->whereLike('type', '%' . 'multiple' . '%')
                ->take($totalMultiples)
                ->inRandomOrder()->get();
            $preguntasSimples = Question::where('asignatura_id', $asignaturaId)
                ->where('modulo_id', $this->selectedModulo)
                ->where('lesson_id', $this->selectedLesson)
                ->whereLike('type', '%' . 'simple' . '%')
                ->take($totalSimples)
                ->inRandomOrder()->get();

            $query = 'Modulos y lecciones';
        }

        //dd($query);
        $totalPreguntas = $preguntasSimples->merge($preguntasMultiples);

        if ($preguntasMultiples->count() + $preguntasSimples->count() == 0) {
            flash()->error('Hay un error en la creación del examen');
            return redirect()->route('examenes.index');

        }
        ;

        //dd($totalPreguntas, $preguntasMultiples, $preguntasSimples);
        $data = Examen::create([
            'name' => $this->examen,
            'description' => $descripcionExamen,
            'asignatura' => $asignatura->name,
            'asignatura_id' => $asignatura->id,
            'teacher_id' => auth()->user()->id,
        ]);

        $data->questions()->attach($totalPreguntas);
        //dd($totalPreguntas->groupBy('level')->toArray());

        // $str = 'total preguntas' . $totalPreguntas->count() . ' múltiples ' . $preguntasMultiples->count() . ' simples ' . $preguntasSimples->count();

        //dd($str);
        $level = $totalPreguntas->groupBy('level');
        $level_str = '';
        foreach ($level as $key => $l) {
            $level_str = $level_str . ' ' . $key . ' : ' . $l->count();
        }

        $type = $totalPreguntas->groupBy('type');
        $type_str = '';
        foreach ($type as $key => $l) {
            $type_str = $type_str . ' ' . $key . ' : ' . $l->count();
        }
        //dd($type, $type_str);
        $data->level = $level_str;
        $data->type = $type_str;
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
