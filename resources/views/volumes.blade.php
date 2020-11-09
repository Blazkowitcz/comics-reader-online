@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($volumes as $volume)
        <div class="col-md-2 col-sm-12">
            <center>
                <a href="/media/{{ $library }}/{{ $collection }}/{{ $volume->slug }}">
                <img src="{{ $volume->picture }}" alt="" itemprop="image" class="col-md-12 col-sm-12" style="width: 200px; height: 200px;">
            </a>
            </center>
            <center>
                <p class="col-sm-12">{{ $volume->name }}</p>
            </center>
        </div>
        @endforeach
    </div>
</div>
@endsection