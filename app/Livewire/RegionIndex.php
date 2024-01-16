<?php

namespace App\Livewire;

use App\Models\ComRegion;
use Livewire\Component;
use Livewire\WithPagination;

class RegionIndex extends Component
{

    use WithPagination;
    public $cari, $idHapus, $desa, $kecamatan, $edit = false;

    public function mount()
    {
        $this->ambilKecamatan();
    }

    public function ambilKecamatan()
    {
        return ComRegion::where('region_level', '3')->get()->toArray();
    }

    public function save()
    {
        if ($this->edit) {
            $this->storeUpdate();
        } else {
            $this->store();
        }

        $this->reset();

        $this->js(<<<'JS'
        Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success',
          })
        JS);
    }

    public function store()
    {
        // dd($this->desa);
        ComRegion::create([
            'region_cd' => gen_region($this->kecamatan),
            'region_nm' => $this->desa,
            'region_root' => $this->kecamatan,
            'region_level' => '4',
        ]);
    }

    public function storeUpdate()
    {
        // 

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
        ComRegion::destroy($this->idHapus);
        $this->js(<<<'JS'
        Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success',
          })
        JS);
    }

    public function render()
    {
        $data = ComRegion::with(['root'])->cari($this->cari)->where('region_level', '4')->paginate(10);

        return view('livewire.region-index', [
            'posts' => $data,
            'listKecamatan' => $this->ambilKecamatan()
        ]);
    }
}
