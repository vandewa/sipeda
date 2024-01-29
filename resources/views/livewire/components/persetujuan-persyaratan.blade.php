<div>
    <div class="col-md-12">
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Status</label>
            <div class="col-md-9">
                <select class="form-control" wire:model.live="form.pengajuan_tp">
                    <option value="">-- Pilih Status --</option>
                    @foreach ($status ?? [] as $item)
                        <option value="{{ $item['com_cd'] }}">
                            {{ $item['code_nm'] }}
                        </option>
                    @endforeach
                </select>
                @error('form.pengajuan_tp')
                    <span class="form-text text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
