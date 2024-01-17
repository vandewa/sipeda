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
                    <button type="button" wire:click='simpan' class="btn btn-warning">Update</button>
                </div>
            </div>

        </div>
    @endif
</div>
