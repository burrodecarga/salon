<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Interview;
use App\Models\Aula;

class TeacherInterviewControl extends Component
{
    public $aula;
    public $solicitudes = [];
    public function mount(Aula $aula)
    {
        $this->aula = $aula;
    }

    public function evaluar($calificacion, $solicitud)
    {
        //dd($calificacion, $solicitud);
        $interview = Interview::find($solicitud);
        $nota = 0;
        switch ($calificacion) {
            case 1:
                $nota = 5;
                break;
            case 2:
                $nota = 10;
                break;
            case 3:
                $nota = 15;
                break;
            case 4:
                $nota = 20;
                break;
            default:
                $nota = 0;
                break;
        }

        $interview->status = 2;
        $interview->nota = $nota;
        $interview->save();
        $this->render();
        flash()->success('Estudiante evaluado correctamente..');
    }

    public function actualizar()
    {
        $this->render();
        flash()->success('Se actualizó la información..');
    }

    public function cerrar()
    {
        DB::table('interviews')->where('status', 1)->update(array('status' => 2));
        $this->render();
        flash()->success('Se cerró la pregunta..');
    }
    public function render()
    {
        $this->solicitudes = Interview::where('aula_id', $this->aula->id)->where('status', '1')->get();

        return view('livewire.teacher-interview-control', );
    }
}
