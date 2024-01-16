<div>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Region</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Region</li>
                </ol>
            </div>
        </div>
    </x-slot>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="tab-pane fade active show">
                            <div class="tab-pane active show fade" id="custom-tabs-one-rm" role="tabpanel"
                                aria-labelledby="custom-tabs-one-rm-tab">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="card card-success card-outline   card-tabs">
                                            <div class="tab-content" id="custom-tabs-six-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-six-riwayat-rm"
                                                    role="tabpanel" aria-labelledby="custom-tabs-six-riwayat-rm-tab">
                                                    <div class="card-body">
                                                        <div class="card-header">
                                                            {{-- <div class="text-left mb-3">
                                                                <a href="{{ route('admin.region') }}"
                                                                    class="btn btn-info"><i
                                                                        class="fas fa-plus-square mr-2"></i>Tambah
                                                                    Data</a>
                                                            </div> --}}
                                                            <form class="form-horizontal mt-2" wire:submit='save'>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <div class="row mb-2">
                                                                                <label for="inputEmail3"
                                                                                    class="col-sm-3 col-form-label">Desa
                                                                                    / Kelurahan<small
                                                                                        class="text-danger">*</small></label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        wire:model='desa'
                                                                                        placeholder="Desa / Kelurahan">
                                                                                    @error('desa')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <label for=""
                                                                                    class="col-sm-3 col-form-label">Kecamatan</label>
                                                                                <div class="col-md-9">
                                                                                    <select class="form-control"
                                                                                        wire:model='kecamatan'>
                                                                                        <option value="">Pilih
                                                                                            Kecamatan</option>
                                                                                        @foreach ($listKecamatan ?? [] as $item)
                                                                                            <option
                                                                                                value="{{ $item['region_cd'] }}">
                                                                                                {{ $item['region_nm'] }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('kecamatan')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-info">Simpan</button>
                                                                </div>
                                                            </form>
                                                            <div class="card-body">
                                                                <div class="row mb-2">
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="cari" wire:model.live='cari'>
                                                                    </div>
                                                                </div>

                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>No</th>
                                                                                <th>Desa/Kelurahan</th>
                                                                                <th>Kecamatan</th>
                                                                                <th>Aksi</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($posts as $item)
                                                                                <tr>
                                                                                    <td>{{ $loop->index + $posts->firstItem() }}
                                                                                    </td>
                                                                                    <td>{{ $item->region_nm ?? '' }}
                                                                                    </td>
                                                                                    <td>{{ $item->root->region_nm ?? '' }}
                                                                                    </td>
                                                                                    <td>
                                                                                        <button type="button"
                                                                                            class="btn btn-sm btn-danger"
                                                                                            wire:click="delete('{{ $item->region_cd }}')">Hapus
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                {{ $posts->links() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
    </section>
</div>
