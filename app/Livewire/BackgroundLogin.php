<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Background;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class BackgroundLogin extends Component
{
    use WithFileUploads;

    #[Validate('image|max:3000')]
    public $photo, $idHapus, $edit = false;

    public $form = [
        'path_bupati' => null,
        'path_kadis' => null,
    ];

    public function mount()
    {
        $data = Background::all()->toArray();
        $this->form = $data;
    }

    public function getEdit($a)
    {
        $this->form = Background::find($a)->toArray();
        $this->idHapus = $a;
        $this->edit = true;
    }

    public function save()
    {
        if ($this->edit) {
            $this->storeUpdate();
        } else {
            $this->store();
        }

        $this->photo = null;

        $this->js(<<<'JS'
        Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success',
          })
        JS);
    }

    public function storeUpdate()
    {
        $this->validate([
            'form2.perawatan_id' => 'required'
        ]);

        // if ($this->photo) {
        //     $foto = $this->photo->store('public/photos');
        //     $this->form2['path'] = $foto;
        // }
        
        Background::find($this->idHapus)->update($this->form2);
        $this->edit = false;
    }


    public function render()
    {
        return view('livewire.background-login');
    }
}
