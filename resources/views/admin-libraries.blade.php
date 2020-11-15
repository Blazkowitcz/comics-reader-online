@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($libraries as $library)
        <h3 class="col-md-12" style="color: white">{{ $library->name }} <button class="btn btn-primary" onclick="scanLibrary('{{ $library->slug }}')">Scanner</button></h3>
        <table class="table table-header">
            <tbody class="table-content">
                @foreach($library->collection as $collection)
                <tr>
                    <td>{{ $collection->name }} ({{ $collection->volumes->count() }} volumes)</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @endforeach
    </div>
</div>
@endsection
<script>
    function scanLibrary(library_slug){
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/' + library_slug + "/scan",
            datatype: 'JSON',
            success: function (response) {
                alert('Done !');
            }
        });
    }
</script>