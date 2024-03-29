<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $judul['pengumpulan']['judul'] ?? '' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.pengajuan') }}">Kembali</a></li>
                    <li class="breadcrumb-item">Pengajuan {{ $judul['pengumpulan']['judul'] ?? '' }}</li>
                    <li class="breadcrumb-item active">{{ $formPengajuan['judul'] ?? '' }}</li>
                </ol>
            </div>
        </div>
    </x-slot>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Timelime example  -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-success card-outline">
                        <div class="mt-2 form-horizontal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- <h4>Nama Dokumen: <b>{{ $pengajuan->judul ?? '' }}</b></h4>
                                        <object data="{{ asset(str_replace('public', 'storage', $pengajuan->path)) }}"
                                            type="application/pdf" width="100%" height="500"
                                            style="border: solid 1px #ccc;">
                                        </object>

                                        @if (auth()->user()->hasRole('desa'))
                                            @if ($edit)
                                                @if ($desa)
                                                    @if ($pengajuan->statusTerbaru->status_tp ?? '' == 'kirimKecamatan')
                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Upload File
                                                                <small class="text-danger">(*pdf)</small></label>
                                                            <div class="col-sm-9">
                                                                <input type="file" wire:model="path"
                                                                    class="form-control" accept="application/pdf">
                                                                @error('path')
                                                                    <span
                                                                        class="form-text text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Judul</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control"
                                                                    wire:model="formPengajuan.judul" placeholder="Judul"
                                                                    @if (!auth()->user()->hasRole('desa')) disabled @endif>
                                                                @error('formPengajuan.judul')
                                                                    <span
                                                                        class="form-text text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div class="card-footer">
                                                            <button type="submit"
                                                                class="btn btn-warning">Update</button>
                                                        </div>
                                                    @endif
                                                @endif


                                            @endif


                                            @error('path')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        @endif --}}

                                        @foreach ($pengajuan->persyaratan as $jembut)
                                            <livewire:components.update-syarat :idnya="$jembut->id">
                                        @endforeach

                                        {{-- jika disetujui kecamatan dan tampilkan pdf --}}
                                        @if ($cekPathKec)
                                            <br>
                                            <h4>Persetujuan Kecamatan</h4>
                                            <object data="{{ asset(str_replace('public', 'storage', $cekPathKec)) }}"
                                                type="application/pdf" width="100%"
                                                height="500"style="border: solid 1px #ccc;">
                                            </object>
                                        @endif
                                        <form action=""wire:submit='save'>
                                            @if (auth()->user()->hasRole('kecamatan'))
                                                @if ($kecamatan)
                                                    <div class="mt-3 form-group row">
                                                        <label for=""
                                                            class="col-sm-3 col-form-label">Status</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control"
                                                                wire:model.live="form.pengajuan_tp">
                                                                <option value="">-- Pilih Status --</option>
                                                                @foreach ($status ?? [] as $item)
                                                                    <option value="{{ $item['com_cd'] }}">
                                                                        {{ $item['code_nm'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('form.pengajuan_tp')
                                                                <span
                                                                    class="form-text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif

                                            @if (auth()->user()->hasRole('dinsos'))
                                                @if ($dinsos)
                                                    <div class="mt-3 form-group row">
                                                        <label for=""
                                                            class="col-sm-3 col-form-label">Status</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control"
                                                                wire:model.live="form.pengajuan_tp">
                                                                <option value="">-- Pilih Status --</option>
                                                                @foreach ($status ?? [] as $item)
                                                                    <option value="{{ $item['com_cd'] }}">
                                                                        {{ $item['code_nm'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('form.pengajuan_tp')
                                                                <span
                                                                    class="form-text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif

                                            {{-- jika ditolak tampil keterangan --}}
                                            @if ($keterangan)
                                                <div class="form-group row">
                                                    <label for=""
                                                        class="col-sm-3 col-form-label">Keterangan</label>
                                                    <div class="col-md-9">
                                                        <textarea wire:model="form.keterangan" class="form-control" rows="2"></textarea>
                                                        @error('form.keterangan')
                                                            <span class="form-text text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- jika disetujui input dan tampil pdf --}}
                                            @if ($disetujui)
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Upload File
                                                        <small class="text-danger">(*pdf)</small></label>
                                                    <div class="col-sm-9">
                                                        <div x-data="{ uploading: false, progress: 0 }"
                                                            x-on:livewire-upload-start="uploading = true"
                                                            x-on:livewire-upload-finish="uploading = false"
                                                            x-on:livewire-upload-cancel="uploading = false"
                                                            x-on:livewire-upload-error="uploading = false"
                                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                            <input type="file" wire:model.live="pathKec"
                                                                class="form-control" accept="application/pdf">
                                                            @error('pathKec')
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
                                                        <div wire:loading wire:target="save">
                                                            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($pathKec)
                                                    <div class="form-group row">
                                                        <object
                                                            data="{{ asset(str_replace('public', 'storage', $lokasi)) }}"
                                                            type="application/pdf" width="100%" height="500"
                                                            style="border: solid 1px #ccc;">
                                                        </object>
                                                    </div>
                                                @endif
                                            @endif

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            @if ($edit)
                                @if (auth()->user()->hasRole('desa'))
                                    @if ($desa)
                                        @if ($pengajuan->statusTerbaru->status_tp ?? '' == 'kirimKecamatan')
                                            <div class="card-footer">
                                                <button type="button" class="mr-5 btn btn-primary"
                                                    wire:click='confirmKecamatan'>Kirim Ke Kecamatan
                                                </button>
                                                <img src="{{ asset('tangan.gif') }}">
                                            </div>
                                        @endif
                                    @endif
                                @elseif(auth()->user()->hasRole('kecamatan'))
                                    @if ($kecamatan)
                                        <div class="card-footer">
                                            <button type="button" wire:click='updatePengajuan'
                                                class="btn btn-info">Submit</button>
                                        </div>
                                    @endif
                                @else
                                    @if ($dinsos)
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </div>
                                    @endif
                                    <!-- /.card-footer -->
                                @endif
                            @endif
                            <div wire:loading wire:target="save">
                                <div class="loading-state">
                                    <div class="loading"></div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <!-- /.card-header -->
                        <!-- form start -->
                    </div>
                </div>

                {{-- history --}}
                <div class="col-md-4">
                    <!-- The time line -->
                    <div class="timeline">

                        @php
                            $lastDate = null;
                        @endphp

                        @foreach ($post as $index => $item)
                            @php
                                $currentDate = \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->format('Y-m-d');
                            @endphp

                            @if ($lastDate != $currentDate)
                                <!-- timeline time label -->
                                <div class="time-label">
                                    @if ($index == 0)
                                        <span class="bg-red">
                                        @else
                                            <span class="bg-dark">
                                    @endif
                                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->isoFormat('D MMMM Y') }}
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                            @endif

                            @php
                                $lastDate = $currentDate;
                            @endphp

                            <!-- timeline item -->
                            <div>
                                {{-- @if ($item->posisinya->code_nm == 'Kecamatan')
                                    <i class="fas fa-circle bg-yellow"></i>
                                @elseif($item->posisinya->code_nm == 'Desa')
                                    <i class="fas fa-circle bg-secondary"></i>
                                @else
                                    <i class="fas fa-circle bg-success"></i>
                                @endif --}}
                                @if ($index == 0)
                                    <i class="fas fa-circle bg-danger"></i>
                                @else
                                    <i class="fas fa-circle bg-secondary"></i>
                                @endif
                                <div class="timeline-item">
                                    <span class="time">
                                        <i class="fas fa-clock"></i>
                                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans() }}
                                    </span>
                                    <h3 class="timeline-header">
                                        <a href="#">
                                            {{ $item->posisinya->code_nm ?? '' }}
                                        </a>
                                        @if ($item->pengajuannya)
                                            @if ($item->pengajuannya->code_nm == 'Disetujui')
                                                <span class="badge badge-success">
                                                @else
                                                    <span class="badge badge-danger">
                                            @endif
                                            {{ $item->pengajuannya->code_nm ?? '' }}
                                            </span>
                                        @elseif($item->statusnya)
                                            @if ($item->statusnya->code_nm == 'Menunggu Respon')
                                                <span class="badge badge-dark">
                                                @elseif($item->statusnya->code_nm == 'DRAFT')
                                                    <span class="badge badge-light">
                                                    @else
                                                        <span class="badge badge-warning">
                                            @endif
                                            {{ $item->statusnya->code_nm ?? '' }}
                                            </span>
                                        @endif


                                    </h3>

                                    @if ($item->keterangan)
                                        <div class="timeline-body">
                                            {{ $item->keterangan ?? '' }}
                                        </div>
                                    @endif

                                    @if ($item->path_kec && $item->pengajuan_tp == 'PENGAJUAN_TP_01' && $item->posisi_st == 'POSISI_ST_02')
                                        <div class="timeline-body">
                                            File persetujuan <br>
                                            <a href="{{ url(str_replace('public', 'storage', $item->path_kec)) }}"
                                                class="badge badge-danger" target="_blank">Lihat Disini</a>
                                            {{-- <a href="{{ url(str_replace('public', 'storage', $item->path_kec)) }}"
                                                target="_blank">
                                                {{ url(str_replace('public', 'storage', $item->path_kec)) }}
                                            </a> --}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- END timeline item -->
                        @endforeach

                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-circle bg-secondary"></i>
                            <div class="timeline-item">
                                <span class="time">
                                    <i class="fas fa-clock"></i>
                                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans() }}
                                </span>
                                <h3 class="timeline-header no-border">
                                    <a href="#">{{ $pengajuan->user->name ?? '' }}</a>
                                    melakukan pengajuan {{ $judul['pengumpulan']['judul'] ?? '' }}
                                </h3>
                            </div>
                        </div>
                        <!-- END timeline item -->

                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.timeline -->

    </section>
    <!-- /.content -->
</div>

@push('js')
    <script>
        // setTimeout(() => {
        const totalPageHeight = document.body.scrollHeight;

        // Mendapatkan posisi scroll saat ini
        const currentScrollPosition = window.scrollY;

        // Mendapatkan tinggi jendela browser
        const windowHeight = window.innerHeight;

        // Menghitung posisi scroll ke paling bawah
        const scrollToBottom = totalPageHeight - windowHeight;

        // Menganimasikan scroll ke paling bawah dengan efek smooth
        window.scroll({
            top: scrollToBottom,
            left: 0,
            behavior: 'smooth'
        });
    </script>
@endpush
