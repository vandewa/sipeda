<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Role;
use App\Models\User as ModelsUser;

class User extends Component
{

    public $role, $listRole, $konfirmasi_password, $idHapus, $edit = false, $user;

    public $form = [
        'name' => null,
        'email' => null,
        'password' => null,
    ];


    public function mount($id = '')
    {
        if ($id) {
            $user = ModelsUser::find($id)->only(['name', 'email']);
            $data = ModelsUser::find($id);
            $this->form = $user;
            $this->role = $data->roles()->first()->id;
            $this->edit = true;
            $this->user = $id;
        }

        $this->listRole = Role::all()->toArray();
    }

    public function ambilRole()
    {
        return Role::all()->toArray();

    }

    public function save()
    {

        if ($this->edit) {
            $this->storeUpdate();
        } else {
            $this->store();
        }

        $this->js(<<<'JS'
        Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success',
          })
        JS);

        return redirect(route('master.user.index'));
    }

    public function store()
    {
        $this->validate([
            'konfirmasi_password' => 'required|same:form.password',
            'form.password' => 'required',
            'form.name' => 'required',
            'form.email' => 'required|unique:users,email',
            'role' => 'required',
        ]);

        $this->form['password'] = bcrypt($this->form['password']);
        $a = ModelsUser::create($this->form);
        $a->addrole($this->role);
    }

    public function storeUpdate()
    {
        $this->validate([
            'konfirmasi_password' => 'same:form.password',
            'form.name' => 'required',
            'form.email' => 'required|email|unique:users,email,' . $this->user,
            'role' => 'required',
        ]);

        if ($this->form['password'] ?? "") {
            $this->form['password'] = bcrypt($this->form['password']);
        }

        ModelsUser::find($this->user)->update($this->form);
        $this->reset();
        $this->edit = false;

    }


    public function render()
    {
        return view('livewire.user', [
            'listRole' => $this->ambilRole()
        ]);
    }
}
