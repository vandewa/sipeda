<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\ComCode;
use Livewire\Component;
use App\Livewire\Pengajuan;
use Livewire\WithFileUploads;
use App\Models\StatusPengajuan;
use App\Models\Pengajuan as ModelsPengajuan;
use App\Models\Pengumpulan as ModelsPengumpulan;

class DetailPengajuan extends Component
{
    use WithFileUploads;

    public $idnya, $edit = true, $keterangan = false, $posisi, $judul, $cek, $cekStatus, $desa = false, $kecamatan = false, $dinsos = false;

    public $lokasi;
    public $path;
    public $namaPath;
    public $formPengajuan = [
        'path' => '',
        'judul' => '',
    ];

    public $form = [
        'pengajuan_id' => '',
        'pengajuan_tp' => '',
        'posisi_st' => '',
        'keterangan' => '',
        'oleh' => '',
    ];


    public function mount($id = '')
    {
        $this->idnya = $id;
        $dataPengajuan = StatusPengajuan::where('pengajuan_id', $this->idnya)->orderBy('created_at', 'desc')->orderBy('id', 'desc')->first()->toArray();

        $this->posisi = $dataPengajuan['posisi_st'];
        $this->cek = $dataPengajuan['pengajuan_tp'];
        $this->cekStatus = $dataPengajuan['status_tp'];

        $this->judul = ModelsPengajuan::with(['pengumpulan'])->find($id)->toArray();
        $a = ModelsPengajuan::find($this->idnya)->toArray();
        $this->formPengajuan['judul'] = $a['judul'];


        if ($this->posisi == 'POSISI_ST_01' && $this->cekStatus == 'STATUS_TP_02') {
            $this->desa = true;
        }
        if ($this->posisi == 'POSISI_ST_02' && $this->cekStatus == 'STATUS_TP_01') {
            $this->kecamatan = true;
        }
        if ($this->posisi == 'POSISI_ST_03' && $this->cekStatus == 'STATUS_TP_01') {
            $this->dinsos = true;
        }

    }

    public function updated($property)
    {
        if ($property === 'form.pengajuan_tp') {
            if ($this->form['pengajuan_tp'] == 'PENGAJUAN_TP_02') {
                $this->keterangan = true;
            }

            if ($this->form['pengajuan_tp'] == 'PENGAJUAN_TP_01') {
                $this->form['keterangan'] = null;
                $this->keterangan = false;

            }
        }

        if ($property === 'path') {
            $nama = date('Ymdhis') . '.pdf';
            $this->lokasi = $this->path->storeAs('public/temporary', $nama);
            $this->namaPath = $this->lokasi;
            $this->lokasi = asset(str_replace('public', 'storage', $this->lokasi));
            return view('livewire.detail-pengajuan', [
            ]);
        }

    }

    public function save()
    {
        if ($this->edit && !$this->desa) {
            $this->storeUpdate();
        } else {
            $this->store();
        }

    }

    public function storeUpdate()
    {
        $this->js(<<<'JS'
        Swal.fire({
            title: 'Apakah Anda yakin?',
                text: "Apakah kamu ingin submit data ini? proses ini tidak dapat dikembalikan.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya!',
                cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
                $wire.update()
            }
          })
        JS);

        // StatusPengajuan::create($this->form);
    }

    public function update()
    {
        $this->validate([
            'form.pengajuan_tp' => 'required',
        ]);

        $this->form['pengajuan_id'] = $this->idnya;
        $this->form['oleh'] = auth()->user()->id;

        //jika status disetujui
        if ($this->form['pengajuan_tp'] == 'PENGAJUAN_TP_01') {

            //jika posisi di kecamatan
            if ($this->posisi == 'POSISI_ST_02') {

                //membuat status disetujui dari kecamatan
                StatusPengajuan::create([
                    'pengajuan_id' => $this->form['pengajuan_id'],
                    'pengajuan_tp' => $this->form['pengajuan_tp'],
                    'posisi_st' => $this->posisi,
                    'oleh' => auth()->user()->id,
                ]);

                //membuat status menunggu respon dari dinsos
                $this->form['posisi_st'] = 'POSISI_ST_03';
                StatusPengajuan::create([
                    'pengajuan_id' => $this->form['pengajuan_id'],
                    'posisi_st' => $this->form['posisi_st'],
                    'status_tp' => 'STATUS_TP_01',
                    'oleh' => auth()->user()->id,
                ]);
            }

            //jika posisi di dinsos
            if ($this->posisi == 'POSISI_ST_03') {

                //membuat status disetujui dari dinsos
                StatusPengajuan::create([
                    'pengajuan_id' => $this->form['pengajuan_id'],
                    'pengajuan_tp' => $this->form['pengajuan_tp'],
                    'posisi_st' => $this->posisi,
                    'oleh' => auth()->user()->id,
                ]);
            }


        } else {

            //membuat status ditolak dari kecamatan atau dinsos
            StatusPengajuan::create([
                'pengajuan_id' => $this->form['pengajuan_id'],
                'pengajuan_tp' => $this->form['pengajuan_tp'],
                'keterangan' => $this->form['keterangan'],
                'posisi_st' => $this->posisi,
                'oleh' => auth()->user()->id,
            ]);

            //membuat status perbaikan dari kecamatan atau dinsos balik ke desa
            $this->form['posisi_st'] = 'POSISI_ST_01';
            StatusPengajuan::create([
                'pengajuan_id' => $this->form['pengajuan_id'],
                'posisi_st' => $this->form['posisi_st'],
                'status_tp' => 'STATUS_TP_02',
                'oleh' => auth()->user()->id,
            ]);

        }

        $this->js(<<<'JS'
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data berhasil disimpan.',
            icon: 'success',
          })
        JS);

        $this->redirect(Pengajuan::class);


    }

    public function store()
    {
        $this->validate([
            'formPengajuan.judul' => 'required',
            'path' => 'required|mimes:pdf|max:4000',
        ]);

        unlink(storage_path('app/' . $this->namaPath));
        $nama = date('Ymdhis') . '.pdf';
        $this->formPengajuan['path'] = $this->path->storeAs('public/pengajuan', $nama);

        ModelsPengajuan::find($this->idnya)->update([
            'path' => $this->formPengajuan['path'],
            'judul' => $this->formPengajuan['judul'],
        ]);

        StatusPengajuan::create([
            'pengajuan_id' => $this->idnya,
            'status_tp' => 'STATUS_TP_01',
            'posisi_st' => 'POSISI_ST_02',
            'oleh' => auth()->user()->id,
        ]);

        $this->js(<<<'JS'
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data berhasil disimpan.',
            icon: 'success',
          })
        JS);

        $this->redirect(Pengajuan::class);

    }

    public function kirimKecamatan() {
        StatusPengajuan::create([
            'pengajuan_id' =>  $this->idnya ,
            'status_tp' => 'STATUS_TP_01',
            'posisi_st' => 'POSISI_ST_02',
            'oleh' => auth()->user()->id,
        ]);
    }


    public function render()
    {
        $data = StatusPengajuan::with('pengajuannya', 'posisinya', 'usernya', 'statusnya')->where('pengajuan_id', $this->idnya)->orderBy('created_at', 'desc')->orderBy('id', 'desc')->get();

        $pengajuan = ModelsPengajuan::with(['persyaratan.dokumen', 'statusTerbaru'])->find($this->idnya);
        // dd($pengajuan);

        $status = ComCode::where('code_group', 'PENGAJUAN_TP')->get();

        return view('livewire.detail-pengajuan', [
            'post' => $data,
            'pengajuan' => $pengajuan,
            'status' => $status
        ]);
    }
}
