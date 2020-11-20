@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($libraries as $library)
        <a class="col-md-4" href="/media/{{ $library->slug }}">
            <div class="card  text-white custom-card">
                <div class="card-body">
                    <h2>{{ $library->name }}</h2>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection