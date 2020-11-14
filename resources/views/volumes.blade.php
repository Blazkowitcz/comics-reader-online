@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($volumes as $volume)
        <div class="col-md-4" style="margin-bottom: 20px;">
            <div class="card">
                <div class="card-header" id="card-header">
                    <a href="/media/{{ $library }}/{{ $collection }}/{{ $volume->slug }}">{{ $volume->name }}</a>
                    @if( $volume->isRead() )
                    <span class="badge badge-success" style="float: right;">V</span>
                    @endif
                </div>
                <div class="card-body">
                    <a href="/media/{{ $library }}/{{ $collection }}/{{ $volume->slug }}"><img
                            src="{{ $volume->getPicture() }}" alt="" itemprop="image" class="col-md-12"
                            style=" height: 350px"></a>
                </div>
                <div class="card-footer" id="card-footer">
                    @if( !$volume->isRead() )
                    <span><i class="far fa-eye" style="float: right;" onclick="setVolumeRead('{{ $volume->id }}')"></i></span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
<script>
    function setVolumeRead(id) {
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/api/volume/setVolumeRead/" + id,
            datatype: 'JSON',
            success: function (response) {
                toastr.success('Volume set as read', 'Success');
            }
        });
    }
</script>
