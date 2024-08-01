<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                @if ($judul)
                    <h1 class="m-0">{{ $judul['judul'] ?? '' }}</h1>
                @else
                    <h1 class="m-0">Data Pengajuan</h1>
                @endif
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @if ($judul)
                        <li class="breadcrumb-item"><a href="{{ route('admin.pengajuan') }}">Kembali</a></li>
                        <li class="breadcrumb-item active">Pengajuan {{ $judul['judul'] ?? '' }}</li>
                    @else
                        {{-- <li class="breadcrumb-item active">Pengajuan</li> --}}
                    @endif
                </ol>
            </div>
        </div>
    </x-slot>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    @role('desa')
                        <!-- general form elements -->
                        @if (!count($post))
                            <div class="card card-success card-outline">
                                <form class="mt-2 form-horizontal" wire:submit='save'>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">

                                                {{-- <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Judul</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" wire:model='form.judul'
                                                            placeholder="Judul">
                                                        @error('form.judul')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Upload File
                                                        <small class="text-danger">(*pdf)</small></label>
                                                    <div class="col-sm-8">
                                                        <input type="file" wire:model="path" class="form-control"
                                                            accept="application/pdf">
                                                        @error('path')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div wire:loading wire:target="save">
                                                            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                @if ($syarat)
                                                    <legend>Lampiran / syarat</legend>
                                                    <hr>
                                                @endif

                                                @foreach ($syarat as $index => $item)
                                                    <div class="form-group row">
                                                        <label for="inputEmail3"
                                                            class="col-sm-3 col-form-label">{{ $item['name'] }}
                                                            <small class="text-danger">(*pdf)</small></label>
                                                        <div class="col-sm-8">

                                                            <div x-data="{ uploading: false, progress: 0 }"
                                                                x-on:livewire-upload-start="uploading = true"
                                                                x-on:livewire-upload-finish="uploading = false"
                                                                x-on:livewire-upload-cancel="uploading = false"
                                                                x-on:livewire-upload-error="uploading = false"
                                                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                                <input type="file"
                                                                    wire:model="syarat.{{ $index }}.path"
                                                                    class="form-control" accept="application/pdf">
                                                                @error('syarat.' . $index . '.path')
                                                                    <span
                                                                        class="form-text text-danger">{{ $message }}</span>
                                                                @enderror
                                                                <div x-show="uploading">
                                                                    <progress max="100"
                                                                        x-bind:value="progress"></progress> <span
                                                                        x-text="progress"><!-- Will output: "bar" -->
                                                                    </span> %
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">

                                                            @if ($syarat[$index]['path'])
                                                                <span class="fa-li"><i
                                                                        class="fas fa-check-square"></i></span>
                                                            @endif
                                                            <div wire:loading>
                                                                <div class="spinner-border text-primary" role="status">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach

                                                {{-- @if ($path)
                                                    <object data="{{ $lokasi }}" type="application/pdf" width="100%"
                                                        height="500" style="border: solid 1px #ccc;"></object>
                                                @endif --}}





                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">

                                        <button type="submit" class="btn btn-info">Simpan</button>
                                        <button type="button" class="float-right btn btn-default"
                                            wire:click='batal'>Batal</button>
                                    </div>
                                    <!-- /.card-footer -->
                                </form>
                                <!-- /.card-header -->
                                <!-- form start -->
                            </div>
                        @endif
                    @endrole

                    <!-- /.card -->
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <div class="card-tools">
                                <select class="form-control" wire:model.live='idPosisiDokumen'>
                                    <option value="">Semua Posisi Dokumen</option>
                                    @foreach ($posisi_dokumen as $item)
                                        <option value="{{ $item->com_cd }}">{{ $item->code_nm }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-tools">
                                <select class="form-control" wire:model.live='idKecamatan'>
                                    <option value="">Semua Kecamatan</option>
                                    @foreach ($semua_kecamatan as $item)
                                        <option value="{{ $item->region_cd }}">{{ $item->region_nm }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-tools">
                                <select class="form-control" wire:model.live='idnya'>
                                    <option value="">Semua Jenis Pengajuan</option>
                                    @foreach ($pengumpulan as $item)
                                        <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            @role(['dinsos', 'superadmin', 'kecamatan'])
                                @if ($idnya && !$idKecamatan)
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-12">
                                            <div class="info-box bg-info">
                                                <span class="info-box-icon"><i class="fas fa-home"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Desa</span>
                                                    <span class="info-box-number">
                                                        <h4> {{ $jml_desa }}</h4>
                                                    </span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="width: 100%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Jumlah Keseluruhan Desa
                                                    </span>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-4 col-sm-6 col-12">
                                            <a href="#" data-toggle="modal" data-target="#exampleModalLong">
                                                <div class="info-box bg-success">
                                                    <span class="info-box-icon"><i class="fas fa-check-double"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Mengumpulkan</span>
                                                        <span class="info-box-number">
                                                            <h4>{{ $sudah ?? 0 }}</h4>
                                                        </span>
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            Jumlah Desa Yang Mengumpulkan
                                                        </span>
                                                    </div>

                                                </div>
                                            </a>
                                        </div>


                                        <div class="col-md-4 col-sm-6 col-12">
                                            <a href="#" data-toggle="modal" data-target="#modalLong">
                                                <div class="info-box bg-danger">
                                                    <span class="info-box-icon"><i class="fas fa-times-circle"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Belum Mengumpulkan</span>
                                                        <span class="info-box-number">
                                                            <h4>{{ $belum ?? 0 }}</h4>
                                                        </span>
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 70%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            Jumlah Desa Belum Mengumpulkan
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endrole
                            {{-- <div class="row">
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="cari"
                                        wire:model.live='cari'>
                                </div>
                            </div> --}}

                            <table class="table">
                                <thead>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Pengajuan</th>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Posisi</th>
                                    <th>Status</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($post as $item)
                                        <tr wire:key='{{ $item->id }}'>
                                            <td>{{ $loop->index + $post->firstItem() }}</td>
                                            <td>{{ $item->created_at ?? '' }}</td>
                                            <td>{{ $item->pengumpulan->judul ?? '' }}</td>
                                            <td>{{ $item->kecamatan->region_nm ?? '' }}</td>
                                            <td>{{ $item->desa->region_nm ?? '' }}</td>

                                            {{-- POSISI --}}
                                            @if ($item->statusTerbaru->posisi_st == 'POSISI_ST_01')
                                                <td>
                                                    <span
                                                        class="badge bg-dark">{{ $item->statusTerbaru->posisinya->code_nm ?? '' }}</span>
                                                </td>
                                            @elseif($item->statusTerbaru->posisi_st == 'POSISI_ST_02')
                                                <td>
                                                    <span
                                                        class="badge bg-info text-dark">{{ $item->statusTerbaru->posisinya->code_nm ?? '' }}</span>
                                                </td>
                                            @elseif($item->statusTerbaru->posisi_st == 'POSISI_ST_03')
                                                <td>
                                                    <span
                                                        class="badge bg-success">{{ $item->statusTerbaru->posisinya->code_nm ?? '' }}</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span
                                                        class="badge bg-danger">{{ $item->statusTerbaru->posisinya->com_cd ?? '' }}</span>
                                                    D
                                                </td>
                                            @endif
                                            {{-- ENDPOSISI --}}

                                            {{-- STATUS --}}
                                            @if ($item->statusTerbaru->pengajuannya ?? '')
                                                <td>{{ $item->statusTerbaru->pengajuannya->code_nm ?? '' }}</td>
                                            @else
                                                <td>{{ $item->statusTerbaru->statusnya->code_nm ?? '' }}</td>
                                            @endif
                                            {{-- END STATUS --}}

                                            <td>
                                                {{-- TOMBOL --}}

                                                {{-- jika posisi ditolak dari dinsos lalu berada di kecamatan --}}
                                                @if ($item->statusTerbaru)
                                                    @if ($item->statusTerbaru->statusnya)
                                                        @if ($item->statusTerbaru->posisi_st == 'POSISI_ST_02' && $item->statusTerbaru->statusnya->com_cd == 'STATUS_TP_02')
                                                            {{-- jika role bukan dinsos --}}
                                                            @if (!auth()->user()->hasRole('dinsos'))
                                                                <button type="button"
                                                                    class="btn btn-warning btn-flat btn-sm"
                                                                    wire:click="keDesa('{{ $item->id }}')"><i
                                                                        class="mr-2 fas fa-arrow-circle-right"></i>Teruskan
                                                                    Ke
                                                                    Desa</button>
                                                            @else
                                                                <a href="{{ route('detail.pengajuan', $item->id) }}"
                                                                    class="btn btn-primary btn-flat btn-sm"
                                                                    data-toggle="tooltip" data-placement="left"
                                                                    title="Detail"><i
                                                                        class="mr-2 fas fa-eye"></i>Detail</a>
                                                            @endif
                                                        @else
                                                            <a href="{{ route('detail.pengajuan', $item->id) }}"
                                                                class="btn btn-primary btn-flat btn-sm"
                                                                data-toggle="tooltip" data-placement="left"
                                                                title="Detail"><i
                                                                    class="mr-2 fas fa-eye"></i>Detail</a>
                                                            @if (
                                                                $item->statusTerbaru->pengajuan_tp ??
                                                                    ('' == 'PENGAJUAN_TP_01' && $item->statusTerbaru->posisi_st ?? '' == 'POSISI_ST_03'))
                                                            @else
                                                                @if (auth()->user()->hasRole('desa'))
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-flat btn-sm"
                                                                        wire:click="delete('{{ $item->id }}')"><i
                                                                            class="mr-2 fas fa-trash"></i>Hapus</button>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @else
                                                        <a href="{{ route('detail.pengajuan', $item->id) }}"
                                                            class="btn btn-success btn-flat btn-sm"
                                                            data-toggle="tooltip" data-placement="left"
                                                            title="Detail"><i
                                                                class="mr-2 fas fa-search-plus"></i>Lihat</a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $post->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Desa Yang Mengumpulkan
                        {{ $judul_pengumpulan }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <th>No</th>
                                        <th>Kecamatan</th>
                                        <th>Kelurahan / Desa</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail_desa_mengumpulkan as $item)
                                            <tr wire:key='{{ $item->id }}'>
                                                <td>{{ $loop->index + $post->firstItem() }}</td>
                                                <td>{{ $item->root->region_nm ?? '-' }}</td>
                                                <td>{{ $item->region_nm ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalLong" tabindex="-1" role="dialog" aria-labelledby="modalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLongTitle">Desa Belum Mengumpulkan {{ $judul_pengumpulan }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <th>No</th>
                                        <th>Kecamatan</th>
                                        <th>Kelurahan / Desa</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail_desa_belum_mengumpulkan as $item)
                                            <tr wire:key='{{ $item->id }}'>
                                                <td>{{ $loop->index + $post->firstItem() }}</td>
                                                <td>{{ $item->root->region_nm ?? '-' }}</td>
                                                <td>{{ $item->region_nm ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
