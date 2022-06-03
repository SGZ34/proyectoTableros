@extends('layouts.app')

@section('title')
Cambiar contraseña
@endsection


@section('content')
<div class="container">
    <div class="card col-md-8 offset-2">
        <div class="card-header">
            <div class="card-title">
                Cambiar contraseña
            </div>
        </div>
        <div class="card-body">

            <form action="/users/updatePassword/{{$user->id}}" method="POST">
                @csrf
                
                <div class="row mb-2">
                    <label for="password">Contraseña antigua</label>
                    <input type="password" class="form-control" name="password" id="password"
                        aria-describedby="helpId" placeholder="" required>

                    @error('password')
                    <span class="text-danger"><b>{{$message}}</b></span>
                    @enderror

                </div>

                <div class="row mb-2">
                    <label for="new-password">Nueva contraseña</label>
                    <input type="password" class="form-control" name="new-password" id="new-password"
                        aria-describedby="helpId" placeholder="" required>

                    @error('new-password')
                    <span class="text-danger"><b>{{$message}}</b></span>
                    @enderror

                </div>
                <div class="row mb-2">
                    <label for="confirm-password">Confirmar contraseña</label>
                    <input type="password" class="form-control" name="confirm-password" id="confirm-password"
                        aria-describedby="helpId" placeholder="" required>

                    @error('confirm-password')
                    <span class="text-danger"><b>{{$message}}</b></span>
                    @enderror

                </div>

                
                <button type="submit" class="btn btn-primary btn-block">Cambiar contraseña</button>
            </form>
        </div>
    </div>
</div>
@endsection