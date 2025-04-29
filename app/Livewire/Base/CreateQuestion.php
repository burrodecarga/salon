<?php

namespace App\Livewire\Base;

use App\Models\Asignatura;
use App\Models\Examen;
use App\Models\Lesson;
use App\Models\Modulo;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateQuestion extends Component
{
    public $type = 'multiple', $level = 'dificultad media', $modulo_id = 1, $lesson_id = 1;
    public $asignatura;
    public $modulos = [];
    public $lessons = [];
    public $pregunta = 'PREGUNTA DE PRUEBA';
    public $explain = 'EXPLICACIÓN DE RESPUESTA';
    public $correct = 'RESPUESTA CORRECTA', $op1 = 'OPCION 1', $op2 = 'OP2', $op3 = 'op3', $op4 = 'op4';
    public $examen;

    protected function rules()
    {
        return [
            'type' => 'required',
            'level' => 'required',
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

        $modulo = Modulo::find($this->modulo_id);
        $lesson = Lesson::find($this->lesson_id);
        $question = Question::create([
            'question' => mb_strtolower($this->pregunta),
            'type' => $this->type,
            'level' => $this->level,
            'asignatura' => $this->asignatura->name,
            'modulo' => $modulo->name,
            'lesson' => $lesson->name,
            'asignatura_id' => $this->asignatura->id,
            'modulo_id' => $this->modulo_id,
            'lesson_id' => $this->lesson_id,
            'correct' => mb_strtolower($this->correct),
            'explain' => mb_strtolower($this->explain),
        ]);

        Option::create([
            'is_true' => 1,
            'answer' => mb_strtolower($question->correct),
            'question_id' => $question->id
        ]);


        Option::create([
            'is_true' => 0,
            'answer' => mb_strtolower($this->op1),
            'question_id' => $question->id
        ]);

        if (strlen($this->op2) > 10) {
            Option::create([
                'is_true' => 0,
                'answer' => mb_strtolower($this->op2),
                'question_id' => $question->id
            ]);
            if (strlen($this->op3) > 10) {
                Option::create([
                    'is_true' => 0,
                    'answer' => mb_strtolower($this->op3),
                    'question_id' => $question->id
                ]);
                if (strlen($this->op4) > 10) {
                    Option::create([
                        'is_true' => 0,
                        'answer' => mb_strtolower($this->op4),
                        'question_id' => $question->id
                    ]);
                }
            }
        }
        flash()->success('Pregunta de Exámen agregada correctamente!');
        return redirect()->route('asignaturas.index');
    }

    public function mount(Asignatura $asignatura, Examen $examen)
    {
        $this->asignatura = $asignatura;
        $this->examen = $examen;
        $this->modulos = $asignatura->modulos;
        $this->lessons = $asignatura->lessons;


    }
    public function render()
    {
        return view('livewire.base.create-question');
    }
}
