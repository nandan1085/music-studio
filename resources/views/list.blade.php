@extends('layouts.app')
@section('title', 'Listing')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col md-12">
                <div class="jumbotron">
                    <form action="{{ route('studio.search') }}" method="get" class="search_form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="search" name="string" id="string" class="form-control" placeholder="Search here...">
                            <div id="suggestion-box"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($studios as $studio)
            <div class="col-md-4 margin-t-10">
                <div class="card">
                    <a href="{{ route('studio.details', ['studio_url' => $studio->action_url]) }}">
                        <img class="w-100" src="{{ $studio->image }}" alt="{{ $studio->name }}">
                    </a>
                    <div class="card-container">
                        <h4><b>{{ $studio->name }}</b></h4>
                        <p><b>Address:</b> {{ $studio->address }}</p>
                        <p><b>Timing:</b> {{ date('h:i A', strtotime($studio->opening_time)) }} - {{ date('h:i A', strtotime($studio->closing_time)) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row text-center">
            {{ $studios->links() }}
        </div>
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function () {
            $('input[type="search"]').on('keyup', function (e) {
                e.preventDefault();
                var $form = $('.search_form');
                $.ajax({
                    type: $form.attr('method'),
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    cache: false,
                    success: function (data) {
                        $('#suggestion-box').html('').html(generateHtml(data));
                    },
                    error: function (data) {
                        console.log(data);
                        alert('There was an error. You can see response in console');
                    }
                });
            });
            $(document).on('click', function () {
                $('#suggestion-box').html('');
            });
            function generateHtml(data) {
                var html = '<ul class="list-group">';
                $.each(data, function (key, val) {
                    html = html + '<a href="/studio/' + val.action_url + '" class="list-group-item">' + val.name + '</a>'
                });
                html = html + '</ul>';
                return html;
            }
        });
    </script>
@stop