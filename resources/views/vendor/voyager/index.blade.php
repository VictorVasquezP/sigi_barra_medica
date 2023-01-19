@extends('voyager::master')

@section('content')
    <div id="app">
        <dashboard-view url="{{ url('/') }}" ></dashboard-view>
    </div>
@stop
@section('javascript')
    <script src="{{asset('/js/app.js')}}"></script>
@stop