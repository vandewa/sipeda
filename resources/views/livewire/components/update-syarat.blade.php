<div>
    <div class="mt-3">
        <h4>Nama Dokumen: <b>{{ $data->dokumen->name ?? '' }}</b></h4>
        <object data="{{ asset('storage/' . $data->path) }}" type="application/pdf" width="100%" height="500"
            style="border: solid 1px #ccc;">
        </object>
    </div>

    @if (
        $data->pengajuan->statusTerbaru->status_tp != 'STATUS_TP_01' and
            $data->pengajuan->statusTerbaru->posisi_st == 'POSISI_ST_01')

        <div class="row">
            <div class="col-md-3">Update</div>
            <div class="col-md-9">
                <input type="file" class="form-control" wire:model.live='file'>
            </div>
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="col-md-12 mt-2">
                <div class="card-footer">
                    <div wire:loading wire:target="file">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-danger" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-warning" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-info" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-light" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="spinner-border text-dark" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    @if ($file)
                        <button type="button" wire:click='simpan' class="btn btn-warning">Update</button>
                    @endif
                </div>
            </div>

        </div>
    @endif
    <div class="row">
        <br>
        <h5 class="">Riwayat</h5>
        <table class="table">

            @foreach ($data->history ?? [] as $index => $a)
                <tr>
                    <td>{{ $a->created_at }}</td>
                    <td>Revisi {{ $index + 1 }}</td>
                    <td> <a href="{{ url('storage', $a->path) }}" target="_blank"
                            class="btn btn-primary btn-sm">Lihat</a> </td>
                </tr>
            @endforeach
        </table>

    </div>
    <hr>
</div>
