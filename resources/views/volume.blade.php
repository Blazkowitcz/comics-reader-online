@extends('layouts.app')
@section('content')
<div style="display: none;" id="library">{{ $library }}</div>
<div style="display: none;" id="collection">{{ $collection }}</div>
<div style="display: none;" id="volume">{{ $volume }}</div>
<div style="display: none;" id="page">{{ $page }}</div>
<div style="display: none;" id="user">{{ $user }}</div>
<div class="container">
    <div class="row">
        <img id="current_img"
            src="https://static.fnac-static.com/multimedia/Images/FR/NR/77/d1/73/7590263/1507-1/tsp20160219152615/Naruto.jpg"
            class="col-md-12">
        <div class="col-md-12" style="margin-top: 10px;">
            <center>
                <button class="btn btn-primary" onclick="previousPage()">Précédent</button>
                <button class="btn btn-primary" onclick="nextPage()">Suivant</button>
            </center>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function () {
        uncompressFile();
        $("body").keydown(function (e) {
            if (e.keyCode == 37) { // left
                previousPage();
            }
            else if (e.keyCode == 39) { // right
                nextPage();
            }
        });
    });

    function uncompressFile() {
        var library = $("#library").text();
        var collection = $("#collection").text();
        var volume = $("#volume").text();
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/media/' + library + "/" + collection + "/" + volume + "/uncompress",
            datatype: 'JSON',
            beforeSend: function () {
                //$("#current_img").attr("src", "/loading.gif");
            },
            success: function (response) {
                getPage();
            }
        });
    }

    function getPage() {
        var library = $("#library").text();
        var collection = $("#collection").text();
        var volume = $("#volume").text();
        var page = $("#page").text();
        var user = $("#user").text();
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/media/' + library + "/" + collection + "/" + volume + "/" + page,
            datatype: 'JSON',
            success: function (response) {
                $("#current_img").attr("src", "/" + user + "/current/" + response);
            }
        });
    }

    function nextPage() {
        currentPage = parseInt($("#page").text());
        currentPage += 1;
        $("#page").text(currentPage);
        var library = $("#library").text();
        var collection = $("#collection").text();
        var volume = $("#volume").text();
        var page = $("#page").text();
        var user = $("#user").text();
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/media/' + library + "/" + collection + "/" + volume + "/" + page,
            datatype: 'JSON',
            success: function (response) {
                $("#current_img").attr("src", "/" + user + "/current/" + response);
            }
        });
    }

    function previousPage() {
        currentPage = parseInt($("#page").text());
        currentPage -= 1;
        $("#page").text(currentPage);
        var library = $("#library").text();
        var collection = $("#collection").text();
        var volume = $("#volume").text();
        var page = $("#page").text();
        var user = $("#user").text();
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/media/' + library + "/" + collection + "/" + volume + "/" + page,
            datatype: 'JSON',
            success: function (response) {
                $("#current_img").attr("src", "/" + user + "/current/" + response);
            }
        });
    }
</script>