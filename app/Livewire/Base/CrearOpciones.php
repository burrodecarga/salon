<?php

namespace App\Livewire\Base;

use App\Models\Option;
use Livewire\Component;
use App\Models\Question;

class CrearOpciones extends Component
{
    public $question;
    public $answer = '';
    public $is_true = false;
    public $is_multiple = true;
    public $options;
    public Option $option;


    protected function rules()
    {
        return [
            'answer' => 'required',
            'is_true' => 'required',

        ];
    }

    public function mount(Question $question)
    {
        $this->question = $question;
        $this->options = $question->options;
    }

    public function save()
    {
        if ($this->is_multiple) {
            $this->validate();
            $option = Option::create([
                'answer' => $this->answer,
                'is_true' => $this->is_true,
                'question_id' => $this->question->id
            ]);
        }

        if (!$this->is_multiple) {
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

        }
        $this->answer = '';
        $this->is_true = false;
        $this->is_multiple = true;
        $this->question = $option->question;
        $this->options = $this->question->options;
        $this->render();
    }

    public function delete(Option $option)
    {
        $option->delete();
        $this->question = $option->question;
        $this->options = $this->question->options;
        $this->render();
    }

    public function render()
    {
        return view('livewire.base.crear-opciones');
    }
}
