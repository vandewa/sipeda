<div>
    {{-- <x-slot name="header">
        <div class="mb-2 row">
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
    </x-slot> --}}
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
                                        <div class="card card-success card-outline card-tabs">
                                            <div class="tab-content" id="custom-tabs-six-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-six-riwayat-rm"
                                                    role="tabpanel" aria-labelledby="custom-tabs-six-riwayat-rm-tab">
                                                    <div class="card-body">
                                                        <div class="col-md-12">
                                                            {{-- <div class="card card-success card-outline"> --}}
                                                            <form class="mt-2 form-horizontal" wire:submit='save'>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">

                                                                            <div class="mb-2 row">
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

                                                                            <div class="mb-2 row">
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




                                                                            <div class="mb-2 row">
                                                                                <label for="inputEmail3"
                                                                                    class="col-sm-3 col-form-label">WhatsApp
                                                                                    <small class="text-danger">*</small>
                                                                                </label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        wire:model='form.telepon'
                                                                                        placeholder="Nomor WhatsApp">
                                                                                    @error('form.telepon')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-check mb-3 mt-3">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input"
                                                                                    id="exampleCheck1"
                                                                                    wire:model.live='gantiPassword'>
                                                                                <label class="form-check-label"
                                                                                    for="exampleCheck1">
                                                                                    <b>Ganti
                                                                                        Password</b>
                                                                                </label>
                                                                            </div>

                                                                            @if ($gantiPassword)

                                                                                @if ($edit)
                                                                                    <legend class="text-center">Ganti
                                                                                        Password</legend>
                                                                                    <hr>
                                                                                @endif

                                                                                <div class="mb-2 row">
                                                                                    <label for="inputEmail3"
                                                                                        class="col-sm-3 col-form-label">Password
                                                                                        <small
                                                                                            class="text-danger">*</small>
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

                                                                                <div class="mb-2 row">
                                                                                    <label for="inputEmail3"
                                                                                        class="col-sm-3 col-form-label">Konfirmasi
                                                                                        Password
                                                                                        <small
                                                                                            class="text-danger">*</small>
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
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button type="submit" class="btn btn-info">Simpan
                                                                    </button>
                                                                    {{-- <a href="{{ route('admin.user-index') }}"
                                                                        class="float-right btn btn-warning">Kembali
                                                                    </a> --}}
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
