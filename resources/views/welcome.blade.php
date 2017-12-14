@extends('layouts.app')
@section('css')
    <style>
        .font-h1{
            font-size: 25px;
        }
    </style>
@stop
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
                                h
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel-footer text-center"><a href="#">See All</a></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Best After Noon Studios</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($studios->noons as $noon)
                            <div class="col-md-4">
                                h
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel-footer text-center"><a href="#">See All</a></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Best Evening Studios</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($studios->evenings as $evening)
                            <div class="col-md-4">
                                h
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel-footer text-center"><a href="#">See All</a></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Best Night Studios</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($studios->nights as $night)
                            <div class="col-md-4">
                                h
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="panel-footer text-center"><a href="#">See All</a></div>
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
           $('input[type="search"]').focusout(function () {
               $(this).val('');
               $('#suggestion-box').html('');
           });
           function generateHtml(data) {
               var html = '<ul class="list-group">';
               $.each(data, function (key, val) {
                   html = html + '<a href="' + val.action_url + '" class="list-group-item">' + val.name + '</a>'
               });
               html = html + '</ul>';
               return html;
           }
        });
    </script>
@endsection
