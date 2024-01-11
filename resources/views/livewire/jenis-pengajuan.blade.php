<div>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Master Data</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item active">Spesialis</li>
                </ol>
            </div>
        </div>
    </x-slot>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-success card-outline">
                        <form class="form-horizontal mt-2" wire:submit='save'>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Judul</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" wire:model='form.judul'
                                                    placeholder="Masukkan Judul">
                                                @error('form.judul')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal
                                                Mulai</label>
                                            <div class="col-sm-2">
                                                <input type="date" class="form-control" wire:model='form.time_start'>
                                                @error('form.time_start')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal
                                                Selesai</label>
                                            <div class="col-sm-2">
                                                <input type="date" class="form-control" wire:model='form.time_end'>
                                                @error('form.time_end')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Simpan</button>
                                <button type="button" class="btn btn-default float-right"
                                    wire:click='batal'>Batal</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                        <!-- /.card-header -->
                        <!-- form start -->
                    </div>

                    <!-- /.card -->

                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <div class="card-title">
                                Data Jenis Pengajuan
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($post as $item)
                                        <tr>
                                            <td>{{ $loop->index + $post->firstItem() }}</td>
                                            <td>{{ $item->judul ?? '' }}</td>
                                            @if ($item->time_start)
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->time_start)->isoFormat('D MMMM Y') }}
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            @if ($item->time_end)
                                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->time_end)->isoFormat('D MMMM Y') }}
                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif

                                            <td>
                                                <button type="button" wire:click="getEdit('{{ $item->id }}')"
                                                    class="btn btn-warning btn-flat btn-sm" data-toggle="tooltip"
                                                    data-placement="left" title="Edit"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                <button type="button" class="btn btn-danger btn-flat btn-sm"
                                                    wire:click="delete('{{ $item->id }}')"><i
                                                        class="fas fa-trash"></i></button>
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
