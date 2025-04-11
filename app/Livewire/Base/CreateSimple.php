<?php

namespace App\Livewire\Base;

use Livewire\Component;
use App\Models\Question;
use App\Models\Option;

class CreateSimple extends Component
{

    public $question;
    public $answer = '';
    public $is_true = false;

    public $options;
    public Option $option;

    public function mount(Question $question)
    {
        $this->question = $question;
        $this->options = $question->options;
    }

    public function save()
    {

        if ($this->is_true) {
            $option = Option::create([
                'answer' => 'verdadero',
                'is_true' => 1,
                'question_id' => $this->question->id
            ]);
            $option = Option::create([
                'answer' => 'falso',
                'is_true' => 0,
                'question_id' => $this->question->id
            ]);
        } else {
            $option = Option::create([
                'answer' => 'verdadero',
                'is_true' => 0,
                'question_id' => $this->question->id
            ]);
            $option = Option::create([
                'answer' => 'falso',
                'is_true' => 1,
                'question_id' => $this->question->id
            ]);
        }

        $this->answer = '';
        $this->is_true = false;
        $this->is_multiple = true;
        $this->question = $option->question;
        $this->options = $this->question->options;
        $this->render();
        $lesson = $this->question->lesson;
        $modulo = $lesson->modulo;
        //dd($lesson, $modulo);
        return redirect()->route('base.preguntas', [$modulo, $lesson]);

    }
    public function render()
    {
        return view('livewire.base.create-simple');
    }
}
