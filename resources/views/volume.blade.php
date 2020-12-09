@extends('layouts.app')
@section('content')
<div style="display: none;" id="library">{{ $library }}</div>
<div style="display: none;" id="collection">{{ $collection }}</div>
<div style="display: none;" id="volume">{{ $volume }}</div>
<div style="display: none;" id="page">{{ $page }}</div>
<div style="display: none;" id="max_page">{{ $max_pages }}</div>
<div style="display: none;" id="user">{{ $user }}</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 style="color: white"><a href="/media/{{ $library }}">{{ $library }}</a> / <a href="/media/{{ $library }}/{{ $collection }}">{{ $collection }}</a><div style="float: right"><a id="current_page">{{ $page }} </a>/ {{ $max_pages }}</div></h3>
        </div>
        <img id="current_img"
            src="/loading.gif"
            class="col-md-12 current_img">
        <div class="col-md-12" style="margin-top: 10px;">
            <div style="text-align: center;">
                <button class="btn btn-primary" onclick="previousPage()">Précédent</button>
                <button class="btn btn-primary" onclick="nextPage()">Suivant</button>
            </div>
        </div>
        <div id="one"></div>
        <p>Swipe right, left and up</p>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-touch-events/1.0.5/jquery.mobile-events.js"></script>
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
        var container = document.querySelector(".current_img");
        container.addEventListener("touchstart", startTouch, false);
        container.addEventListener("touchmove", moveTouch, false);
        var initialX = null;
        var initialY = null;
        function startTouch(e) {
            initialX = e.touches[0].clientX;
            initialY = e.touches[0].clientY;
        };
        function moveTouch(e) {
            if (initialX === null) {
                return;
            }
            if (initialY === null) {
                return;
            }
            var currentX = e.touches[0].clientX;
            var currentY = e.touches[0].clientY;
            var diffX = initialX - currentX;
            var diffY = initialY - currentY;
            if (Math.abs(diffX) > Math.abs(diffY)) {
                if (diffX > 0) {
                    nextPage();
                } else {
                    previousPage();
                }
            }
            initialX = null;
            initialY = null;
            e.preventDefault();
        };
    });

    function uncompressFile() {
        let library = $("#library").text();
        let collection = $("#collection").text();
        let volume = $("#volume").text();
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/media/' + library + "/" + collection + "/" + volume + "/uncompress",
            datatype: 'JSON',
            beforeSend: function () {
                toastr.warning('Volume decompression in progress', 'Info');
            },
            success: function (response) {
                getPage();
            }
        });
    }

    function getPage() {
        let library = $("#library").text();
        let collection = $("#collection").text();
        let volume = $("#volume").text();
        let page = $("#page").text();
        let user = $("#user").text();
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
        let currentPage = parseInt($("#page").text());
        currentPage += 1;
        $("#page").text(currentPage);
        let library = $("#library").text();
        let collection = $("#collection").text();
        let volume = $("#volume").text();
        let page = $("#page").text();
        let user = $("#user").text();
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/media/' + library + "/" + collection + "/" + volume + "/" + page,
            datatype: 'JSON',
            success: function (response) {
                $("#current_page").text(page);
                $("#current_img").attr("src", "/" + user + "/current/" + response);
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                if($("#current_page").text() == $("#max_page").text()){
                    toastr.success('Volume finished', 'Success');
                }
            }
        });
    }

    function previousPage() {
        let currentPage = parseInt($("#page").text());
        currentPage -= 1;
        $("#page").text(currentPage);
        let library = $("#library").text();
        let collection = $("#collection").text();
        let volume = $("#volume").text();
        let page = $("#page").text();
        let user = $("#user").text();
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/media/' + library + "/" + collection + "/" + volume + "/" + page,
            datatype: 'JSON',
            success: function (response) {
                $("#current_page").text(page);
                $("#current_img").attr("src", "/" + user + "/current/" + response);
                $('html, body').animate({ scrollTop: 0 }, 'fast');
se);
