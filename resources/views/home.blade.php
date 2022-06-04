@extends('layouts.app')

@section('title')
    Bienvenida
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    

                    {{ __('Bienvenido ' .  auth()->user()->name) . '.' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


