<?php

namespace App\Livewire\Base;

use App\Models\Asignatura;
use App\Models\Option;
use App\Models\Question;
use Livewire\Component;

class CreateQuestion extends Component
{
    public $type, $level = 'dificultad media', $modulo_id = 1, $lesson_id = 1;
    public $asignatura;
    public $modulos = [];
    public $lessons = [];
    public $pregunta = 'PREGUNTA DE PRUEBA';
    public $explain = 'EXPLICACIÓN DE RESPUESTA';
    public $correct = 'RESPUESTA CORRECTA', $op1 = 'OPCION 1', $op2 = 'OP2', $op3 = 'op3', $op4 = 'op4';

    protected function rules()
    {
        return [
            'pregunta' => 'required',
            'correct' => 'required',
            'op1' => 'required',
            'modulo_id' => 'required',
            'lesson_id' => 'required',

        ];
    }

    public function save()
    {
        $data = $this->validate();
        $question = Question::create([
            'question' => $this->pregunta,
            'type' => $this->type,
            'level' => $this->level,
            'asignatura' => $this->asignatura->name,
            'modulo' => $this->modulo->name,
            'lesson' => $this->lesson->name,
            'asignatura_id' => $this->asignatura->id,
            'modulo_id' => $this->modulo->id,
            'lesson_id' => $this->lesson->id,
            'correct' => $this->correct,
        ]);

        Option::create([]);

    }

    public function mount(Asignatura $asignatura)
    {
        $this->asignatura = $asignatura;
        $this->modulos = $asignatura->modulos;
        $this->lessons = $asignatura->lessons;


    }
    public function render()
    {
        return view('livewire.base.create-question');
    }
}
