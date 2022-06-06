@extends('layouts.app')


@section('styles')
<link rel="stylesheet" href="/css/index.css">
@endsection

@section('title')
    Detalles del tablero {{$tablero->title}}
@endsection


@section('content')

@if ($tablero->mimeName == "application/pdf")
    <div class="d-flex justify-content-center flex-column align-items-center">
        <iframe src="/files/{{$tablero->file . '#toolbar=0'}}" frameborder="0" class="iframe-custom" allowfullscreen></iframe>
        <p>{{$tablero->description}}</p>
    </div>
@else
    <div class="d-flex justify-content-center">
        <img src="/files/{{$tablero->file}}" alt="">
    </div>
@endif
    
@endsection


@section('scripts')
    
@endsection