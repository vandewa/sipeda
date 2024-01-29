<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Background;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class BackgroundLogin extends Component
{

    use WithFileUploads;

    public $photo, $idHapus, $edit = false;

    public $form = [
        'path_bupati' => null,
    ];

    public function mount()
    {
        $data = Background::find(1);
        $this->form = $data;
    }

    public function save()
    {
        $this->validate([
            'photo' => 'required|image|max:3000'
        ]);

        $nama = $this->photo->store('public/photos');
        Background::where('id', 1)->update([
            'path_bupati' => $nama
        ]);

        $this->js(<<<'JS'
        Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success',
          })
        JS);

        $this->redirect(BackgroundLogin::class);

    }

    public function render()
    {
        return view('livewire.background-login');
    }
}
