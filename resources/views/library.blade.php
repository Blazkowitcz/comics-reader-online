@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($libraries as $library)
        <div class="col-md-2">
            <a href="/{{ $library->slug }}">
                <img src="{{ $library->picture }}" alt="" itemprop="image" class="col-md-12" style="width: 200px; height: 200px;">
            </a>
            <center>
                <p>{{ $library->name }}</p>
            </center>
        </div>
        @endforeach
    </div>
</div>
@endsection