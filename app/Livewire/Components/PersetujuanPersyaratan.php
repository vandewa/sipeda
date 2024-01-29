<?php

namespace App\Livewire\Components;

use Livewire\Component;

class PersetujuanPersyaratan extends Component
{
    public $idnya;

    public function mount($id = "") {

    }
    public function render()
    {
        return view('livewire.components.persetujuan-persyaratan');
    }
}
