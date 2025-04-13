<?php

namespace App\Livewire\Examenes;

use App\Models\Lesson;
use App\Models\Question;
use Livewire\Component;
use App\Models\Modulo;
use App\Models\Asignatura;

class CreateExamen extends Component
{
    public $asignaturas;

    public $modulos = [];
    public $lessons = [];

    public $selectedAsignatura = 0, $selectedModulo = 0, $selectedLesson = 0;
    public $simples = 5, $multiples = 15, $preguntas = 20;

    protected function rules()
    {
        return [
            'selectedAsignatura' => 'required|integer|gt:0'
        ];
    }

    public function save()
    {
        if ($this->selectedAsignatura == 0)
            return;


        $totalSimles = intval($this->simples);
        $totalPreguntas = intval($this->preguntas);
        $totalMultiples = $totalPreguntas - $totalSimles;

        if ($totalMultiples < 0) {
            $totalSimles = 0;
            $totalPreguntas = intval($this->preguntas);
            $totalMultiples = $totalPreguntas - $totalSimles;
        }

        //dd($totalPreguntas, $totalMultiples, $totalSimles);
        $asignatura = Asignatura::find($this->selectedAsignatura);
        $asignaturaId = intval($this->selectedAsignatura);
        $query = '';
        if ($this->selectedModulo == 0) {
            $preguntasMultiples = Question::where('asignatura_id', $asignaturaId)->whereLike('type', '%' . 'multiple' . '%')->take($this->multiples)->get();
            $preguntasSimples = Question::where('asignatura_id', $asignaturaId)->whereLike('type', '%' . 'simple' . '%')->take($this->multiples)->get();

            //dd('Todos los modulos', $preguntasMultiples, $preguntasSimples);


        } elseif ($this->selectedModulo != 0 && $this->selectedLesson == 0) {
            $preguntasMultiples = Question::where('asignatura_id', $asignaturaId)
                ->where('modulo_id', $this->selectedModulo)
                ->whereLike('type', '%' . 'multiple' . '%')
                ->take($this->multiples)->get();
            $preguntasSimples = Question::where('asignatura_id', $asignaturaId)
                ->where('modulo_id', $this->selectedModulo)
                ->whereLike('type', '%' . 'simple' . '%')
                ->take($this->multiples)->get();

            //dd('MODULO y TODAS LAS LECCIONES', $preguntasMultiples, $preguntasSimples);


        } elseif ($this->selectedModulo != 0 && $this->selectedLesson != 0) {
            $preguntasMultiples = Question::where('asignatura_id', $asignaturaId)
                ->where('modulo_id', $this->selectedModulo)
                ->where('lesson_id', $this->selectedLesson)
                ->whereLike('type', '%' . 'multiple' . '%')
                ->take($this->multiples)->get();
            $preguntasSimples = Question::where('asignatura_id', $asignaturaId)
                ->where('modulo_id', $this->selectedModulo)
                ->where('lesson_id', $this->selectedLesson)
                ->whereLike('type', '%' . 'simple' . '%')
                ->take($this->multiples)->get();

            //dd('MODULO y LECCION', $preguntasMultiples, $preguntasSimples);

        }






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
        $this->multiples = $this->preguntas - $value;
        if ($this->multiples < 0)
            $this->ajustar();


    }






    public function render()
    {
        return view('livewire.examenes.create-examen');
    }
}
