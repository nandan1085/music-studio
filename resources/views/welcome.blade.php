@extends('layouts.app')
@section('css')
    <style>
        .font-h1{
            font-size: 25px;
        }
    </style>
@stop
@section('title', 'Music')
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
            <h1 class="text-center font-h1">Book Best Music Studio In Your City</h1>
            <div class="panel panel-default">
                <div class="panel-heading">Best Morning Studios</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($studios->mornings as $morning)
                            <div class="col-md-4">
                                <div class="card">
                                    <a href="{{ route('studio.details', ['studio_url' => $morning->action_url]) }}">
                                        <img class="w-100" src="{{ $morning->image }}" alt="{{ $morning->name }}">
                                    </a>
                                    <div class="card-container">
                                        <h4><b>{{ $morning->name }}</b></h4>
                                        <p><b>Address:</b> {{ $morning->address }}</p>
                                        <p><b>Timing:</b> {{ date('h:i A', strtotime($morning->opening_time)) }} - {{ date('h:i A', strtotime($morning->closing_time)) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel-footer text-center"><a href="{{ route('studio.list') }}">See All</a></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Best After Noon Studios</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($studios->noons as $noon)
                            <div class="col-md-4">
                                <div class="card">
                                    <a href="{{ route('studio.details', ['studio_url' => $noon->action_url]) }}">
                                        <img class="w-100" src="{{ $noon->image }}" alt="{{ $noon->name }}">
                                    </a>
                                    <div class="card-container">
                                        <h4><b>{{ $noon->name }}</b></h4>
                                        <p><b>Address:</b> {{ $noon->address }}</p>
                                        <p><b>Timing:</b> {{ date('h:i A', strtotime($noon->opening_time)) }} - {{ date('h:i A', strtotime($noon->closing_time)) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel-footer text-center"><a href="{{ route('studio.list') }}">See All</a></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Best Evening Studios</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($studios->evenings as $evening)
                            <div class="col-md-4">
                                <div class="card">
                                    <a href="{{ route('studio.details', ['studio_url' => $evening->action_url]) }}">
                                        <img class="w-100" src="{{ $evening->image }}" alt="{{ $evening->name }}">
                                    </a>
                                    <div class="card-container">
                                        <h4><b>{{ $evening->name }}</b></h4>
                                        <p><b>Address:</b> {{ $evening->address }}</p>
                                        <p><b>Timing:</b> {{ date('h:i A', strtotime($evening->opening_time)) }} - {{ date('h:i A', strtotime($evening->closing_time)) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel-footer text-center"><a href="{{ route('studio.list') }}">See All</a></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Best Night Studios</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($studios->nights as $night)
                            <div class="col-md-4">
                                <div class="card">
                                    <a href="{{ route('studio.details', ['studio_url' => $night->action_url]) }}">
                                        <img class="w-100" src="{{ $night->image }}" alt="{{ $night->name }}">
                                    </a>
                                    <div class="card-container">
                                        <h4><b>{{ $night->name }}</b></h4>
                                        <p><b>Address:</b> {{ $night->address }}</p>
                                        <p><b>Timing:</b> {{ date('h:i A', strtotime($night->opening_time)) }} - {{ date('h:i A', strtotime($night->closing_time)) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel-footer text-center"><a href="{{ route('studio.list') }}">See All</a></div>
            </div>
        </div>
    </div>
@endsection
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
@endsection
