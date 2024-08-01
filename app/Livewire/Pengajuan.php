<?php

namespace App\Livewire;

use App\Models\ComCode;
use App\Models\User;
use Livewire\Component;
use App\Models\ComRegion;
use App\Jobs\kirimWhatsapp;
use Livewire\WithPagination;
use App\Livewire\Pengumpulan;
use Livewire\WithFileUploads;
use App\Models\StatusPengajuan;
use App\Models\Pengajuan as ModelsPengajuan;
use App\Models\Pengumpulan as ModelsPengumpulan;
use Illuminate\Support\Facades\DB;


class Pengajuan extends Component
{
    use WithPagination;

    use WithFileUploads;

    public $form = [
        'judul' => '',
        'path' => '',
        'user_id' => '',
        'pengumpulan_id' => '',
        'region_kec' => '',
        'region_kel' => '',
    ];

    public $syarat = [];

    public $cari, $edit = false;
    public $idHapus;
    public $lokasi;
    public $path;
    public $namaPath;
    public $judul;
    public $idnya;
    public $cekUser;
    public $pengajuan;
    public $idDesa;
    public $idKecamatan;
    public $idPosisiDokumen;

    public function mount($id = '')
    {
        if ($id) {
            $this->idnya = $id;
            $a = ModelsPengumpulan::with(['syarat'])->find($id);
            $this->judul = $a->toArray();

            foreach ($a->syarat ?? [] as $asu) {
                array_push($this->syarat, ['pengumpulan_syarat_id' => $asu->id, 'path' => null, 'name' => $asu->name]);
            }
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
        $a = "";
        if ($this->edit) {
            $a = $this->storeUpdate();
        } else {
            $a = $this->store();
        }

        $this->js(<<<'JS'
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data berhasil disimpan.',
            icon: 'success',
          })
        JS);

        $this->redirectRoute('detail.pengajuan', $a);

        // $this->redirect(Pengumpulan::class);
    }

    public function store()
    {

        $this->validate([
            // 'form.judul' => 'required',
            // 'path' => 'required|mimes:pdf',
            'syarat.*.path' => 'required|mimes:pdf|max:26288',
        ]);


        // unlink(storage_path('app/' . $this->namaPath));
        // $nama = date('Ymdhis') . '.pdf';
        // $this->form['path'] = $this->path->storeAs('public/pengajuan', $nama);
        $this->form['user_id'] = auth()->user()->id;
        $this->form['pengumpulan_id'] = $this->idnya;
        $this->form['region_kec'] = auth()->user()->region_kec;
        $this->form['region_kel'] = auth()->user()->region_kel;

        $pengajuan = ModelsPengajuan::create($this->form);

        foreach ($this->syarat as $item) {

            $simpanan = $item['path']->store('syarat', 'public');
            $pengajuan->persyaratan()->create([
                'pengumpulan_syarat_id' => $item['pengumpulan_syarat_id'],
                'path' => $simpanan,
            ]);
        }

        StatusPengajuan::create([
            'pengajuan_id' => $pengajuan->id,
            'status_tp' => 'STATUS_TP_00',
            'posisi_st' => 'POSISI_ST_01',
            'oleh' => auth()->user()->id,
        ]);

        return $pengajuan->id;

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

    // public function updated($property)
    // {
    //     // if ($property === 'path') {
    //     //     $nama = date('Ymdhis') . '.pdf';
    //     //     $this->lokasi = $this->path->storeAs('public/temporary', $nama);
    //     //     $this->namaPath = $this->lokasi;
    //     //     $this->lokasi = asset(str_replace('public', 'storage', $this->lokasi));
    //     //     return view('livewire.pengajuan', [
    //     //     ]);
    //     // }



    // }

    public function keDesa($id)
    {
        StatusPengajuan::create([
            'pengajuan_id' => $id,
            'posisi_st' => 'POSISI_ST_01',
            'status_tp' => 'STATUS_TP_02',
            'oleh' => auth()->user()->id,
        ]);

        $a = ModelsPengajuan::find($id)->toArray();
        $this->pengajuan = ModelsPengajuan::with(['pengumpulan'])->find($id)->toArray();

        $terakhirKedua = StatusPengajuan::where('pengajuan_id', $id)->latest()->skip(1)
            ->first();

        $this->cekUser = User::with('kecamatannya', 'desanya')->find($a['user_id'])->toArray();

        //kirim notifikasi ditolak ke desa dari kecamatan yang ditolak dari DinsosPMD
        $pesan = '*Notifikasi*' . "\n\n" .
            'Yth. Admin Desa ' . $this->cekUser['desanya']['region_nm'] . ' pengajuan ' . $this->pengajuan['pengumpulan']['judul'] . ' *Ditolak* oleh Dinas Sosial, Pemberdayaan Masyarakat Dan Desa ' . "\n\n" .
            '(' . $terakhirKedua->keterangan . ')' . "\n\n" .
            'Silahkan lihat pada link berikut ini:' . "\n\n" .
            url('detail-pengajuan/' . $this->idnya) . "\n\n" .
            'Terima Kasih';

        kirimWhatsapp::dispatch($pesan, $this->cekUser['telepon']);


        $this->js(<<<'JS'
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data berhasil dikembalikan ke Desa.',
            icon: 'success',
          })
        JS);

    }

    public function render()
    {
        $pengumpulan = ModelsPengumpulan::all();
        $semua_desa = ComRegion::where('region_level', '4')->orderBy('region_nm', 'asc')->get();
        $semua_kecamatan = ComRegion::where('region_level', '3')->orderBy('region_nm', 'asc')->get();
        $posisi_dokumen = ComCode::where('code_group', 'POSISI_ST')->get();


        $data = ModelsPengajuan::select('pengajuans.*')
            ->selectSub(function ($query) {
                $query->from('com_regions')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('pengajuans.region_kel', 'com_regions.region_cd')
                    ->whereNull('com_regions.deleted_at');
            }, 'desa_count');

        // ->get();

        // $data = ModelsPengajuan::with(['statusTerbaru', 'pengumpulan', 'kecamatan', 'desa'])
        //     ->withCount('desa')
        //     ->cari($this->cari)
        //     ->whereHas('statusTerbaru', function ($query) {
        //         $query->select(DB::raw('MAX(id) as max_id'))
        //             ->groupBy('pengajuan_id')
        //             ->having('posisi_st', 'POSISI_ST_01');

        //     });
        // // dd($data->toSql());
        // // dd($data->get());

        $desa = ComRegion::where('region_level', 4);

        if (auth()->user()->hasRole('kecamatan')) {
            $desa = $desa->where('region_root', auth()->user()->region_kec);
        }

        $sudah = $data;

        //filter berdasarkan jenis pengumpulan 
        if ($this->idnya) {
            $data->where('pengumpulan_id', $this->idnya);
        }

        //filter berdasarkan kecamatan 
        if ($this->idKecamatan) {
            $data->where('region_kec', $this->idKecamatan);
        }

        //filter berdasarkan posisi dokumen 
        if ($this->idPosisiDokumen) {
            $data->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from(DB::raw('(SELECT pengajuan_id, MAX(id) AS max_id FROM status_pengajuans GROUP BY pengajuan_id) AS sp'))
                    ->join('status_pengajuans AS sp2', 'sp.max_id', '=', 'sp2.id')
                    ->whereColumn('pengajuans.id', 'sp2.pengajuan_id')
                    ->where('sp2.posisi_st', $this->idPosisiDokumen);
            });
        }

        //filter berdasarkan user kecamatan mana
        if (auth()->user()->hasRole('kecamatan')) {
            $data->where('region_kec', auth()->user()->region_kec);
        }

        //filter berdasarkan user desa mana
        if (auth()->user()->hasRole('desa')) {
            $data->where('region_kel', auth()->user()->region_kel);
        }

        $cek = $sudah->get();

        //menampilkan judul pengajuan
        $judul_pengumpulan = $sudah->first()->pengumpulan->judul ?? '-';

        //mengumpulkan desa yang di filter
        $array_desa = [];
        foreach ($cek as $item) {
            $array_desa[] = $item->region_kel;
        }

        $detail_desa_mengumpulkan = ComRegion::with(['root'])->where('region_level', 4)->whereIn('region_cd', $array_desa);

        $detail_desa_belum_mengumpulkan = ComRegion::with(['root'])->where('region_level', 4)->whereNotIn('region_cd', $array_desa);

        if (auth()->user()->hasRole('kecamatan')) {
            $detail_desa_mengumpulkan = $detail_desa_mengumpulkan->where('region_root', auth()->user()->region_kec)->get();
            $detail_desa_belum_mengumpulkan = $detail_desa_belum_mengumpulkan->where('region_root', auth()->user()->region_kec)->get();
        } else {
            $detail_desa_mengumpulkan = $detail_desa_mengumpulkan->get();
            $detail_desa_belum_mengumpulkan = $detail_desa_belum_mengumpulkan->get();
        }

        //jumlah desa yg sudah mengumpulkan
        $sudah = $sudah->count();

        //jumlah desa semuanya
        $jml_desa = $desa->count();

        $data = $data->orderBy('created_at', 'desc')->paginate(10);

        //hitung jumlah desa yang belum mengumpulkan
        if ($this->idnya) {
            $belum = $jml_desa - $sudah;
        }

        return view('livewire.pengajuan', [
            'post' => $data,
            'pengumpulan' => $pengumpulan,
            'semua_desa' => $semua_desa,
            'semua_kecamatan' => $semua_kecamatan,
            'posisi_dokumen' => $posisi_dokumen,
            'sudah' => $sudah,
            'belum' => $belum ?? "",
            'jml_desa' => $jml_desa ?? "",
            'judul_pengumpulan' => $judul_pengumpulan ?? "-",
            'detail_desa_mengumpulkan' => $detail_desa_mengumpulkan ?? null,
            'detail_desa_belum_mengumpulkan' => $detail_desa_belum_mengumpulkan ?? null,
        ]);
    }
}
