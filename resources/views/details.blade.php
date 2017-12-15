@extends('layouts.app')
@section('title', $studio->name.' details')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="container-fluid">
                <div class="row padding-20 bg-white">
                    <div class="col-md-5">
                        <img class="w-100 img-rounded" src="{{ $studio->image }}" alt="{{ $studio->name }}">
                    </div>
                    <div class="col-md-7">
                        <h1 class="text-center text-primary font-25 pointer">{{ $studio->name }}</h1>
                        <div class="help-block text-center">Member since: {{ date('d M, Y', strtotime($studio->created_at)) }}</div>
                        <hr>
                        <p><b>Timing:</b> {{ date('h:i A', strtotime($studio->opening_time)) }} - {{ date('h:i A', strtotime($studio->closing_time)) }}</p>
                        <p><b>Address:</b> {{ $studio->address }}</p>
                        <p><b>Website:</b> <a href="{{ $studio->website }}">{{ $studio->website }}</a></p>
                        <p><b class="text-danger">Note:</b> Slots opens everyday at 12:00 AM.</p>
                    </div>
                </div>
                <div class="row margin-t-20 padding-20 bg-white">
                    <div class="col-md-12">
                        <h2 class="text-primary font-20">About</h2>
                        <hr>
                        <p>{{ $studio->about }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="container-fluid">
                <div class="row padding-20 bg-white">
                    <h3>Reserve You Seat</h3>
                    <hr>
                    <form action="{{ route('studio.booking.store') }}" class="slot-date-form" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="studio" value="{{ $studio->id }}">
                        <div class="form-group has-feedback {{ !empty($errors) && $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Your Name</label>
                            <input type="text" name="name" class="form-control" value="{{ !empty(Auth::check()) ? Auth::user()->name : old('name') }}">
                            @if ( !empty($errors) ? $errors->has('name') : '')
                                <span class="help-block">
                                    <strong>{{ !empty($errors) ? $errors->first('name') : '' }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ !empty($errors) && $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Your Email</label>
                            <input type="email" name="email" class="form-control" value="{{ !empty(Auth::check()) ? Auth::user()->email : old('email') }}">
                            @if ( !empty($errors) ? $errors->has('email') : '')
                                <span class="help-block">
                                    <strong>{{ !empty($errors) ? $errors->first('email') : '' }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ !empty($errors) && $errors->has('mobile') ? 'has-error' : '' }}">
                            <label for="mobile">Your Mobile</label>
                            <input type="tel" name="mobile" class="form-control" value="{{ old('mobile') }}">
                            @if ( !empty($errors) ? $errors->has('mobile') : '')
                                <span class="help-block">
                                    <strong>{{ !empty($errors) ? $errors->first('mobile') : '' }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="people">No. of Guest(s)</label>
                            <select name="people" id="people" class="form-control">
                                @for($i = 1; $i <= 5; $i++)
                                    <option {{ (old('people') == $i) ? 'selected' : '' }} value="{{ $i }}">{{ ($i == 1) ? "$i Guest" : "$i Guests" }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slot">Choose Slot</label>
                            @if(!empty($slots))
                                <select name="slot" id="slot" class="form-control">
                                    @foreach($slots as $slot)
                                        <option {{ (old('slot') == $slot) ? 'selected' : '' }} value="{{ $slot }}">{{ $slot }}</option>
                                    @endforeach
                                </select>
                            @else
                                <span class="text-danger"><br>All slot has been booked. Please try again tomorrow.</span>
                            @endif
                        </div>
                        @if(!empty($slots))
                            <button type="submit" class="btn btn-primary btn-block">Book</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')

@stop