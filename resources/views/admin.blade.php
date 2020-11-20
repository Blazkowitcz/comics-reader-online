@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <a class="col-md-5">
            <div class="card  text-white bg-primary">
                <div class="card-body">
                    <h2><i class="fas fa-users"></i> Users : {{ $users }}</h2>
                </div>
            </div>
        </a>
        <a href="/admin/libraries/" class="col-md-5">
            <div class="card offset-md-2 text-white bg-info">
                <div class="card-body">
                    <h2><i class="fas fa-book"></i> Libraries : {{ $libraries }}</h2>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection