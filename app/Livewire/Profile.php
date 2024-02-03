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
        'region_kec' => null,
        'region_kel' => null,
        'telepon' => null,
    ];


    public function mount($id = '')
    {
        if ($id) {
            $user = ModelsUser::find($id)->only(['name', 'email', 'telepon']);
            $data = ModelsUser::find($id);
            $this->form = $user;
            $this->role = $data->roles()->first()->id;
            $this->edit = true;
            $this->user = $id;
            $this->kecamatan = $data->region_kec;
            $this->desa = $data->region_kel;


        }

        $this->listRole = Role::all()->toArray();
        $this->ambilKecamatan();
        $this->changeKel();
    }

    public function ambilRole()
    {
        return Role::all()->toArray();
    }

    public function ambilKecamatan()
    {
        return ComRegion::where('region_level', '3')->get()->toArray();
    }
    // public function ambilDesa()
    // {
    //     return ComRegion::where('region_level', '4')->get()->toArray();
    // }

    public function changeKel()
    {
        return ComRegion::where('region_root', $this->kecamatan)->get()->toArray();
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

        return redirect(route('admin.user-index'));
    }

    public function store()
    {
        $this->validate([
            'konfirmasi_password' => 'required|same:form.password',
            'form.password' => 'required',
            'form.name' => 'required',
            'form.email' => 'required|unique:users,email',
            'role' => 'required',
            'kecamatan' => 'required_if:role,==,3',
            'desa' => 'required_if:role,==,4',
            'form.telepon' => 'required',
        ]);

        $this->form['telepon'] = konversi_nomor($this->form['telepon']);
        $this->form['password'] = bcrypt($this->form['password']);
        $this->form['region_kec'] = $this->kecamatan;
        $this->form['region_kel'] = $this->desa;
        $a = ModelsUser::create($this->form);
        $a->addrole($this->role);
    }

    public function storeUpdate()
    {

        $this->validate([
            'form.name' => 'required',
            'form.email' => 'required|email|unique:users,email,' . $this->user,
            'role' => 'required',
            'kecamatan' => 'required_if:role,==,3',
            'desa' => 'required_if:role,==,4',
        ]);

        if (filled($this->form['password'] ?? null)) {
            $this->validate([
                'konfirmasi_password' => 'same:form.password',
            ]);
        }

        $this->form['telepon'] = konversi_nomor($this->form['telepon']);
        $this->form['region_kec'] = $this->kecamatan;
        $this->form['region_kel'] = $this->desa;

        if ($this->form['password'] ?? "") {
            $this->form['password'] = bcrypt($this->form['password']);
        }

        ModelsUser::find($this->user)->update($this->form);
        $this->reset();
        $this->edit = false;

    }

    public function updated($property)
    {
        if ($property === 'kecamatan') {
            $this->changeKel($this->kecamatan);
        }
        if ($property === 'role') {
            if ($this->role == 1 || $this->role == 2) {
                $this->desa = null;
                $this->kecamatan = null;
            }

            if ($this->role == 3) {
                $this->desa = null;
            }
        }
    }


    public function render()
    {
        return view('livewire.profile', [
            'listRole' => $this->ambilRole(),
            'listKecamatan' => $this->ambilKecamatan(),
            'listDesa' => $this->changeKel()
        ]);
    }
}
