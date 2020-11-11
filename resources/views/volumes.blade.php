@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($volumes as $volume)
        <a class="col-md-4" href="/media/{{ $library }}/{{ $collection }}/{{ $volume->slug }}" style="margin-bottom: 20px;">
            <div class="card">
                <div class="card-header">
                    {{ $volume->name }}
                    @if( $volume->isRead() )
                    <span class="badge badge-success" style="float: right;">V</span>
                    @endif
                </div>
                <div class="card-body">
                    <img src="{{ $volume->getPicture() }}" alt="" itemprop="image" class="col-md-12" style="width: 200; height: 350px">
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection