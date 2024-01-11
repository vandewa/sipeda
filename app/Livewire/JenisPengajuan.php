<?php

namespace App\Livewire;

use App\Models\StatusPengajuan;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Models\Pengumpulan as ModelsPengumpulan;

class JenisPengajuan extends Component
{
    use WithPagination;

    public $form = [
        'judul' => '',
        'time_start' => '',
        'time_end' => '',
    ];

    public $cari, $edit = false;
    public $idHapus;

    public function mount()
    {
        $this->form['time_start'] = date('Y-m-d');
        $this->form['time_end'] = date('Y-m-d');
    }

    public function getEdit($a)
    {
        $this->form = ModelsPengumpulan::find($a)->only(['judul', 'time_start', 'time_end']);
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

    }

    public function store()
    {
        $this->validate([
            'form.judul' => 'required',
            'form.time_start' => 'required',
            'form.time_end' => 'required|after:form.time_start',
        ]);

        ModelsPengumpulan::create($this->form);
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
        ModelsPengumpulan::destroy($this->idHapus);
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
        ModelsPengumpulan::find($this->idHapus)->update($this->form);
        $this->reset();
        $this->edit = false;
    }

    public function render()
    {
        $data = ModelsPengumpulan::orderBy('time_start', 'desc')->paginate(10);

        return view('livewire.jenis-pengajuan', [
            'post' => $data
        ]);
    }
}
