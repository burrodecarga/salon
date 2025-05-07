<?php

namespace App\Livewire\Examenes;

use App\Models\Question;
use Livewire\Component;
use App\Models\Examen;

class AddPreguntas extends Component
{
    public $examen, $asignatura_id, $examen_questions, $question_add = [];
    public function mount(Examen $examen)
    {
        $this->examen = $examen;
        $this->asignatura_id = $examen->asignatura_id;
        $this->examen_questions = $examen->questions->pluck('question.id')->toArray();
    }

    public function add($id)
    {
        $this->examen->questions()->syncWithoutDetaching($id);
        flash()->success('Pregunta de Exámen agregada correctamente!');
        return redirect()->route('examenes.add_pregunta', $this->examen->id);
    }

    public function del($id)
    {
        $this->examen->questions()->detach($id);
        flash()->success('Pregunta de Exámen agregada correctamente!');
        return redirect()->route('examenes.add_pregunta', $this->examen->id);
    }



    public function render()
    {
        $questions = Question::where('asignatura_id', $this->asignatura_id)
            ->whereNotIn('id', [$this->examen->id])->get();
        // dd($questions, $this->examen->id, $this->examen->asignatura_id);
        return view('livewire.examenes.add-preguntas', compact(['questions']));
    }
}
