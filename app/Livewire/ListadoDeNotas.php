<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Aula;

class ListadoDeNotas extends Component
{

    public $aula;
    public function mount(Aula $aula)
    {
        $this->aula = $aula;
    }
    public function render()
    {
        return view('livewire.listado-de-notas');
    }
}
