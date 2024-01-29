<div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-3 card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Background Login</h3>
                            </div>
                            <form class="mt-2 form-horizontal" wire:submit='save'>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="{{ asset(str_replace('public', 'storage', $form['path_bupati'])) }}" alt="" width="100%;">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="file" wire:model="photo" class="mb-3 form-control" accept="image/png">
                                            @error('photo')  <span
                                            class="form-text text-danger">{{ $message }}</span>@enderror
                                            @if ($photo) 
                                                <img src="{{ $photo->temporaryUrl() }}" width="100%;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="float-right btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
