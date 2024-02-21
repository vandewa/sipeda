<?php

namespace App\Livewire;

use App\Models\ComRegion;
use Livewire\Component;
use App\Models\Role;
use App\Models\User as ModelsUser;

class Profile extends Component
{

    public $role, $listRole, $konfirmasi_password, $idHapus, $edit = false, $user, $kecamatan, $desa;

    public $form = [
        'name' => null,
        'email' => null,
        'password' => null,
        'telepon' => null,
    ];


    public function mount()
    {
        $id = auth()->user()->id;
        if ($id) {
            $user = ModelsUser::find($id)->only(['name', 'email', 'telepon']);
            $data = ModelsUser::find($id);
            $this->form = $user;
            $this->role = $data->roles()->first()->id;
            $this->edit = true;
            $this->user = $id;
        }
    }

    public function save()
    {

        $this->storeUpdate();

        $this->js(<<<'JS'
        Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success',
          })
        JS);

        // return redirect(route('admin.user-index'));
    }

    public function storeUpdate()
    {

        $this->validate([
            'form.name' => 'required',
            'form.email' => 'required|email|unique:users,email,' . $this->user,
        ]);

        if (filled($this->form['password'] ?? null)) {
            $this->validate([
                'konfirmasi_password' => 'same:form.password',
            ]);
        }

        $this->form['telepon'] = konversi_nomor($this->form['telepon']);

        if ($this->form['password'] ?? "") {
            $this->form['password'] = bcrypt($this->form['password']);
        }

        ModelsUser::find($this->user)->update($this->form);
    }
    public function render()
    {
        return view('livewire.profile', [

        ]);
    }
}
