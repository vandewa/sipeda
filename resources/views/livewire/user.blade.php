<div>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">User</li>
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
                                                        <div class="col-md-12">
                                                            {{-- <div class="card card-success card-outline"> --}}
                                                            <form class="form-horizontal mt-2" wire:submit='save'>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">

                                                                            <div class="row mb-2">
                                                                                <label for="inputEmail3"
                                                                                    class="col-sm-3 col-form-label">Nama
                                                                                    <small class="text-danger">*</small>
                                                                                </label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        wire:model='form.name'
                                                                                        placeholder="Nama">
                                                                                    @error('form.name')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-2">
                                                                                <label for="inputEmail3"
                                                                                    class="col-sm-3 col-form-label">Email
                                                                                    <small class="text-danger">*</small>
                                                                                </label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="email"
                                                                                        class="form-control"
                                                                                        wire:model='form.email'
                                                                                        placeholder="Email">
                                                                                    @error('form.email')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-3">
                                                                                <label for="inputEmail3"
                                                                                    class="col-sm-3 col-form-label">Role</label>
                                                                                <div class="col-sm-9">
                                                                                    <select class="form-control"
                                                                                        wire:model.live='role'>
                                                                                        <option value="">Pilih
                                                                                            Role</option>
                                                                                        @foreach ($listRole ?? [] as $item)
                                                                                            <option
                                                                                                value="{{ $item['id'] }}">
                                                                                                {{ $item['name'] }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('role')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            @if ($role == 3 || $role == 4)
                                                                                <div class="row mb-3">
                                                                                    <label for="inputEmail3"
                                                                                        class="col-sm-3 col-form-label">Kecamatan</label>
                                                                                    <div class="col-sm-9">
                                                                                        <select class="form-control"
                                                                                            wire:model.live='kecamatan'>
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
                                                                                @if ($role == 4)
                                                                                    <div class="row mb-3">
                                                                                        <label for="inputEmail3"
                                                                                            class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                                                                                        <div class="col-sm-9">
                                                                                            <select class="form-control"
                                                                                                wire:model='desa'>
                                                                                                <option value="">
                                                                                                    Pilih
                                                                                                    Desa</option>
                                                                                                @foreach ($listDesa ?? [] as $item)
                                                                                                    <option
                                                                                                        value="{{ $item['region_cd'] }}">
                                                                                                        {{ $item['region_nm'] }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            @error('desa')
                                                                                                <span
                                                                                                    class="form-text text-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endif

                                                                            @if ($edit)
                                                                                <legend>Ganti Password</legend>
                                                                            @endif

                                                                            <div class="row mb-2">
                                                                                <label for="inputEmail3"
                                                                                    class="col-sm-3 col-form-label">Password
                                                                                    <small class="text-danger">*</small>
                                                                                </label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="password"
                                                                                        class="form-control"
                                                                                        wire:model='form.password'
                                                                                        placeholder="Password">
                                                                                    @error('form.password')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-2">
                                                                                <label for="inputEmail3"
                                                                                    class="col-sm-3 col-form-label">Konfirmasi
                                                                                    Password
                                                                                    <small class="text-danger">*</small>
                                                                                </label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="password"
                                                                                        class="form-control"
                                                                                        wire:model='konfirmasi_password'
                                                                                        placeholder="Konfirmasi Password">
                                                                                    @error('konfirmasi_password')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button type="submit" class="btn btn-info">Simpan
                                                                    </button>
                                                                    <a href="{{ route('admin.user-index') }}"
                                                                        class="btn btn-warning float-right">Kembali
                                                                    </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <br>

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
