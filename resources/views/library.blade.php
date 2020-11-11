@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($libraries as $library)
        <a class="col-md-4" href="/media/{{ $library->slug }}" style="margin-bottom: 20px;">
            <div class="card">
                <div class="card-header">
                    {{ $library->name }}
                </div>
                <div class="card-body">
                    <img src="{{ $library->picture }}" alt="" itemprop="image" class="col-md-12" style="width: 200; height: 350px">
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection