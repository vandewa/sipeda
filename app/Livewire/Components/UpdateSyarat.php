<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\PangajuanSyarat;
use App\Models\PengajuanSyaratHistory;
use Storage;
use Livewire\WithFileUploads;

class UpdateSyarat extends Component
{
    use WithFileUploads;
    public $idnya;
    public $file;
    public function simpan() {
        $this->validate([
            'file' => 'required|required|mimes:pdf'
        ]);
        $nama = date('Ymdhis') . '.pdf';
        $cek = PangajuanSyarat::find($this->idnya);
        // if(Storage::exists($cek->path)){
        //     Storage::delete($cek->path);
        // }

        $cek->path =  $this->file->store('pengajuan', 'public');

        PengajuanSyaratHistory::create([
            'pangajuan_syarat_id' => $cek->id,
            'pengajuan_id' => $cek->pengajuan_id,
            'pengumpulan_syarat_id' => $cek->pengumpulan_syarat_id,
            'path' => $cek->path,
            'created_at' => $cek->created_at

        ]);

        $cek->save();
        session()->flash('message', 'Data berhasil update.');
        // dd($cek);


    }
    public function render()
    {
        $data = PangajuanSyarat::with(['dokumen', 'pengajuan.statusTerbaru', 'history'])->find($this->idnya);
        return view('livewire.components.update-syarat', [
            'data' => $data
        ]);
    }
}
