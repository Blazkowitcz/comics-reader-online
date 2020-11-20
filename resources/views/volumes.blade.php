@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <table class="table table-header">
            <tbody class="table-content">
                @foreach ($volumes as $volume)
                <tr>
                    <td><a href="/media/{{ $library }}/{{ $collection }}/{{ $volume->slug }}">
                    @if($agent->isMobile())
                        {{ $volume->getShortName() }}
                    @else 
                        {{ $volume->name }} 
                    @endif
                    {!! $volume->language() !!}
                    @if( $volume->isRead())
                        <span class="badge badge-success badge-table" style="float: right;">read</span>
                    @else
                        <i class="far fa-eye" style="float: right;"></i>
                    @endif
                    @if( $volume->onReading())
                        <span class="badge badge-warning badge-table" style="float: right;">on reading</span>
                    @endif
                    </a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
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