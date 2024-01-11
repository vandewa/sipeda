<div>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pengajuan</h1>
            </div>
            {{-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Pengajuan</a></li>
                    <li class="breadcrumb-item active"></li>
                </ol>
            </div> --}}
        </div>
    </x-slot>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <div class="card-title">
                                Jenis Pengajuan
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <th>Judul</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($post as $item)
                                        <tr>
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
                                                <a href="{{ route('pengajuan', $item->id) }}"
                                                    class="btn btn-info btn-flat btn-sm" data-toggle="tooltip"
                                                    data-placement="left" title="Edit"><i
                                                        class="fas fa-pencil-alt mr-2"></i>Pilih
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
