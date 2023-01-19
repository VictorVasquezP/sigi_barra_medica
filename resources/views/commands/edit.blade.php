@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div id="app">
        
        <command-edit-view url="{{ url('/') }}" date="{{date('Y-m-d')}}" info="{{$dataTypeContent}}" role_id="{{$role_id}}"></command-edit-view>
        <command-products-view url="{{ url('/') }}" date="{{date('Y-m-d')}}" info="{{$dataTypeContent}}" role_id="{{$role_id}}"></command-products-view>
    </div>
@stop

@section('javascript')
    <script src="{{asset('/js/app.js')}}"></script>
@stop