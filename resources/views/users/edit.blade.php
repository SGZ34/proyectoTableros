@extends('layouts.app')

@section('title')
Usuarios
@endsection


@section('content')
<div class="container">
    <div class="card col-md-8 offset-2">
        <div class="card-header">
            <div class="card-title">
                Editar Usuario
            </div>
        </div>
        <div class="card-body">

            <form action="/users">
                @csrf
                @method("PUT")
                <div class="row mb-2">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}"
                        aria-describedby="helpId" placeholder="" required>

                </div>

                <div class="row mb-2">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}"
                        aria-describedby="helpId" placeholder="" required>

                </div>

                <div class="mb-2">
                    <label for="name">Seleccione los roles</label>
                    @foreach ($roles as $rol)
                    <div class="d-block">
                        <input type="checkbox" name="roles[]" id="" value="{{$rol->id}}">
                        <label for=""> {{$rol->name}}</label>
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary btn-block">Editar</button>
            </form>
        </div>
    </div>
</div>
@endsection