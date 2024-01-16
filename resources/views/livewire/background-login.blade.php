<div>
    <div class="mb-2 row">

        <label for="inputEmail3" class="col-sm-4 col-form-label">Bukti
            <small class="text-danger">*</small></label>
        <div class="col-sm-8">
            <input type="file" class="form-control" wire:model.live="photo" accept="image/png, image/jpeg">
            @error('photo')
                <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12">
            <div class="text-center mt-2">
                @if ($form['path'] ?? '')
                    @if ($photo)
                    @else
                        <img src="{{ asset(str_replace('public', 'storage', $form2['path'])) }}"
                            style="max-width: 500px; max-height:400px;">
                    @endif

                @endif
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" style="max-width: 500px; max-height:400px;">
                @endif
            </div>
        </div>

    </div>
</div>
