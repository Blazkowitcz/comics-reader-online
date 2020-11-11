@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($collections as $collection)
        <a class="col-md-4" href="/media/{{ $collection->library_slug }}/{{ $collection->slug }}" style="margin-bottom: 20px;">
            <div class="card">
                <div class="card-header">
                    {{ $collection->name }}<span class="badge badge-danger"
                        style="float: right;">{{ $collection->volumeLeft() }}</span>
                </div>
                <div class="card-body">
                    <img src="{{ $collection->picture }}" alt="" itemprop="image" class="col-md-12" style="width: 200; height: 350px">
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection