@extends('layouts/app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach ($data as $item)
                    <div class="alert alert-info alert-dismissible">
                        <h5><i class="icon fas fa-info"></i> Pengumuman!</h5>
                        {!! $item->isi ?? '' !!}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
