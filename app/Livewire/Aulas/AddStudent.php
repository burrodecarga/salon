<?php

namespace App\Livewire\Aulas;

use App\Models\Aula;
use App\Models\Student;
use Livewire\Component;

class AddStudent extends Component
{

    public $students = [], $inscritos = [], $aula;

    public function mount(Aula $aula)
    {
        $this->aula = $aula;
        $this->inscritos = $aula->students;
        $this->students = Student::all();

    }

    public function add(Student $student)
    {

        $this->aula->students()->syncWithoutDetaching($student->id);
        $this->render();

    }

    public function del(Student $student)
    {
        $this->aula->students()->detach($student->id);
    }


    public function render()
    {
        $this->inscritos = $this->aula->students;
        $this->students = Student::all();
        return view('livewire.aulas.add-student');
    }
}
