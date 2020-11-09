@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($collections as $collection)
        <div class="col-md-2">
            <a href="/media/{{ $collection->library_slug }}/{{ $collection->slug }}">
                <img src="{{ $collection->picture }}" alt="" itemprop="image" class="col-md-12" style="width: 200px; height: 200px;">
            </a>
            <center>
                <p>{{ $collection->name }}</p>
            </center>
        </div>
        @endforeach
    </div>
</div>
@endsection