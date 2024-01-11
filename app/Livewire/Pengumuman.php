<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pengumuman as ModelsPengumuman;

class Pengumuman extends Component
{
    use WithPagination;

    public $form = [
        'isi' => '',
        'status' => '',
    ];

    public $cari, $edit = false;
    public $idHapus;

    public function mount()
    {
        //    
    }

    public function getEdit($a)
    {
        $this->form = ModelsPengumuman::find($a)->only(['isi', 'status']);
        $this->edit = true;
        $this->idHapus = $a;

    }

    public function batal()
    {
        $this->edit = false;
        $this->reset();

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
            title: 'Berhasil!',
            text: 'Data berhasil disimpan.',
            icon: 'success',
          })
        JS);

        $this->redirect(Pengumuman::class);

    }

    public function store()
    {
        dd($this->form);
        ModelsPengumuman::create($this->form);
    }

    public function delete($id)
    {
        $this->idHapus = $id;
        $this->js(<<<'JS'
        Swal.fire({
            title: 'Apakah Anda yakin?',
                text: "Apakah kamu ingin menghapus data ini? proses ini tidak dapat dikembalikan.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
                $wire.hapus()
            }
          })
        JS);
    }

    public function hapus()
    {
        ModelsPengumuman::destroy($this->idHapus);
        $this->js(<<<'JS'
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data berhasil dihapus.',
            icon: 'success',
          })
        JS);
    }

    public function storeUpdate()
    {
        ModelsPengumuman::find($this->idHapus)->update($this->form);
        $this->reset();
        $this->edit = false;
    }

    public function render()
    {
        $data = ModelsPengumuman::orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.pengumuman', [
            'post' => $data
        ]);
    }
}
