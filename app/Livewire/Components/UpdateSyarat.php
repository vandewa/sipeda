<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\PangajuanSyarat;
use Storage;
use Livewire\WithFileUploads;

class UpdateSyarat extends Component
{
    use WithFileUploads;
    public $idnya;
    public $file;
    public function simpan() {
        $this->validate([
            'file' => 'required'
        ]);
        $nama = date('Ymdhis') . '.pdf';
        $cek = PangajuanSyarat::find($this->idnya);
        if(Storage::exists($cek->path)){
            Storage::delete($cek->path);
        }

        $cek->path =  $this->file->store('pengajuan', 'public');

        $cek->save();
        session()->flash('message', 'Data berhasil update.');
        // dd($cek);


    }
    public function render()
    {
        $data = PangajuanSyarat::with(['dokumen'])->find($this->idnya);
        return view('livewire.components.update-syarat', [
            'data' => $data
        ]);
    }
}
