<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                @if ($judul)
                    <h1 class="m-0">{{ $judul['judul'] ?? '' }}</h1>
                @else
                    <h1 class="m-0">Pengajuan</h1>
                @endif
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @if ($judul)
                        <li class="breadcrumb-item"><a href="{{ route('admin.pengajuan') }}">Kembali</a></li>
                        <li class="breadcrumb-item active">Pengajuan {{ $judul['judul'] ?? '' }}</li>
                    @else
                        <li class="breadcrumb-item active">Pengajuan</li>
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

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Judul</label>
                                                    <div class="col-sm-9">
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
                                                    <div class="col-sm-9">
                                                        <input type="file" wire:model="path" class="form-control"
                                                            accept="application/pdf">
                                                        @error('path')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                @foreach ($syarat as $index => $item)
                                                    <div class="form-group row">
                                                        <label for="inputEmail3"
                                                            class="col-sm-3 col-form-label">{{ $item['name'] }}
                                                            <small class="text-danger">(*pdf)</small></label>
                                                        <div class="col-sm-9">
                                                            <input type="file"
                                                                wire:model="syarat.{{ $index }}.path"
                                                                class="form-control" accept="application/pdf">
                                                            @error('syarat.' . $index . '.path')
                                                                <span class="form-text text-danger">{{ $message }}</span>
                                                            @enderror
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
                            <div class="card-title">
                                Data Pengajuan
                            </div>
                            <div class="card-tools">
                                <select name="" class="form-control" id="" wire:model.live='idnya'>
                                    <option value="">Semua</option>
                                    @foreach ($pengumpulan as $item)
                                        <option value="{{ $item->id }}">{{ $item->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            @role(['dinsos', 'superadmin'])
                                @if ($idnya)
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-12">
                                            <div class="info-box bg-info">
                                                <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Desa</span>
                                                    <span class="info-box-number">236</span>
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
                                            <div class="info-box bg-success">
                                                <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Mengumpulkan</span>
                                                    <span class="info-box-number">236</span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="width: 70%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Jumlah Desa Yang Menhumpulkan
                                                    </span>
                                                </div>

                                            </div>

                                        </div>


                                        <div class="col-md-4 col-sm-6 col-12">
                                            <div class="info-box bg-danger">
                                                <span class="info-box-icon"><i class="fas fa-comments"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Belum Mengumpulkan</span>
                                                    <span class="info-box-number">236</span>
                                                    <div class="progress">
                                                        <div class="progress-bar" style="width: 70%"></div>
                                                    </div>
                                                    <span class="progress-description">
                                                        Jumlah Desa Belum Mengumpulkan
                                                    </span>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                @endif
                            @endrole
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="cari"
                                        wire:model.live='cari'>
                                </div>
                            </div>

                            <table class="table">
                                <thead>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Pengajuan</th>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Judul</th>
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
                                            <td>-</td>
                                            <td>-</td>
                                            <td>{{ $item->judul ?? '' }}</td>
                                            @if ($item->statusTerbaru->posisi_st ?? '' == 'POSISI_ST_01')
                                                <td>

                                                    <span
                                                        class="badge bg-dark">{{ $item->statusTerbaru->posisinya->code_nm }}</span>
                                                </td>
                                            @elseif($item->statusTerbaru->posisi_st ?? '' == 'POSISI_ST_02')
                                                <td>
                                                    <span
                                                        class="badge bg-info text-dark">{{ $item->statusTerbaru->posisinya->code_nm }}</span>
                                                </td>
                                            @elseif($item->statusTerbaru->posisi_st ?? '' == 'POSISI_ST_03')
                                                <td>
                                                    <span
                                                        class="badge bg-success">{{ $item->statusTerbaru->posisinya->code_nm }}</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span
                                                        class="badge bg-danger">{{ $item->statusTerbaru->posisinya->code_nm }}</span>
                                                </td>
                                            @endif
                                            @if ($item->statusTerbaru->pengajuannya ?? '')
                                                <td>{{ $item->statusTerbaru->pengajuannya->code_nm ?? '' }}</td>
                                            @else
                                                <td>{{ $item->statusTerbaru->statusnya->code_nm ?? '' }}</td>
                                            @endif
                                            <td>
                                                <a href="{{ route('detail.pengajuan', $item->id) }}"
                                                    class="btn btn-primary btn-flat btn-sm" data-toggle="tooltip"
                                                    data-placement="left" title="Detail"><i
                                                        class="mr-2 fas fa-eye"></i>Detail</a>
                                                @if (
                                                    $item->statusTerbaru->pengajuan_tp ??
                                                        ('' == 'PENGAJUAN_TP_01' && $item->statusTerbaru->posisi_st ?? '' == 'POSISI_ST_03'))
                                                @else
                                                    @if (auth()->user()->hasRole('desa'))
                                                        <button type="button" class="btn btn-danger btn-flat btn-sm"
                                                            wire:click="delete('{{ $item->id }}')"><i
                                                                class="mr-2 fas fa-trash"></i>Hapus</button>
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
</div>
