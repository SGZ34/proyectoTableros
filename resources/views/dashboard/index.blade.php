@extends('layouts.app')

@section('title')
Dashboard
@endsection


@section('content')
    <div class="d-flex justify-content-center flex-wrap">
        @foreach ($tableros as $tablero)
            <div class="card col-5 mx-4 p-0" style="overflow-y:hidden;">
                <div class="card-header px-2" style="background: #ff8138 !important; border-bottom: 8px solid #fff">
                    <div class="card-title text-white">
                        <h4>{{$tablero->title}}</h4>
                        <p>{{$tablero->description}}</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <embed class="embed-responsive-item" src="/files/{{$tablero->file .'#toolbar=0'}}" allowfullscreen>
                      </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection