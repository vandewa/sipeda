<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Pengumpulan;
use Livewire\WithFileUploads;
use App\Models\StatusPengajuan;
use App\Models\Pengajuan as ModelsPengajuan;
use App\Models\Pengumpulan as ModelsPengumpulan;


class Pengajuan extends Component
{
    use WithPagination;

    use WithFileUploads;

    public $form = [
        'judul' => '',
        'path' => '',
        'user_id' => '',
        'pengumpulan_id' => '',
    ];

    public $cari, $edit = false;
    public $idHapus;
    public $lokasi;
    public $path;
    public $namaPath;
    public $judul;
    public $idnya;

    public function mount($id = '')
    {
        if ($id) {
            $this->idnya = $id;
            $this->judul = ModelsPengumpulan::find($id)->toArray();
        }

    }


    public function getEdit($a)
    {
        $this->form = ModelsPengajuan::find($a)->only(['judul', 'path']);
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

        $this->redirect(Pengumpulan::class);
    }

    public function store()
    {
        $this->validate([
            'form.judul' => 'required',
            'path' => 'required|mimes:pdf|max:4000',
        ]);


        unlink(storage_path('app/' . $this->namaPath));
        $nama = date('Ymdhis') . '.pdf';
        $this->form['path'] = $this->path->storeAs('public/pengajuan', $nama);
        $this->form['user_id'] = auth()->user()->id;
        $this->form['pengumpulan_id'] = $this->idnya;

        $pengajuan = ModelsPengajuan::create($this->form);

        StatusPengajuan::create([
            'pengajuan_id' => $pengajuan->id,
            'status_tp' => 'STATUS_TP_01',
            'posisi_st' => 'POSISI_ST_02',
            'oleh' => auth()->user()->id,
        ]);


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
        ModelsPengajuan::destroy($this->idHapus);
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
        ModelsPengajuan::find($this->idHapus)->update($this->form);
        $this->reset();
        $this->edit = false;
    }

    public function updated($property)
    {
        if ($property === 'path') {
            $nama = date('Ymdhis') . '.pdf';
            $this->lokasi = $this->path->storeAs('public/temporary', $nama);
            $this->namaPath = $this->lokasi;
            $this->lokasi = asset(str_replace('public', 'storage', $this->lokasi));
            return view('livewire.pengajuan', [
            ]);
        }

    }
    public function render()
    {
        $data = ModelsPengajuan::with(['statusTerbaru'])->cari($this->cari)->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.pengajuan', [
            'post' => $data
        ]);
    }
}
