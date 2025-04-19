<?php

namespace App\Livewire;

use function Livewire\Volt\mount;
use Livewire\Component;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use App\Notifications\InterviewNotification;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Interview;
use App\Models\Aula;
use App\Events\InterviewEvent;

class AddInterview extends Component
{
    public $aula;
    public function mount(Aula $aula)
    {
        $this->aula = $aula;
    }

    public function intervenir()
    {
        $teacher = Teacher::find($this->aula->teacher_id);
        $student = Student::find(auth()->user()->id);
        $enProceso = Interview::where('status', 2)
            ->where('aula_id', $this->aula->id)->exists();
        if ($enProceso) {
            flash()->error('Solicitud en proceso!');
            return;
        }
        $interview = Interview::create([
            'fecha' => date(now()),
            'aula_id' => $this->aula->id,
            'teacher_id' => $teacher->id,
            'teacher' => $teacher->name,
            'student_id' => $student->id,
            'student' => $student->name,
            'status' => 2
        ]);

        //dd($teacher);
        Notification::send($teacher, new InterviewNotification($interview));
        flash()->success('Solicitud enviada correctamente creada correctamente!');


    }
    public function render()
    {
        return view('livewire.add-interview');
    }
}
