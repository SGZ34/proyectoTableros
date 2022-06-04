@extends('layouts.app')

@section('title')
Editar usuario
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

            <form action="/users/{{$user->id}}" method="POST">
                @csrf
                @method("PUT")
                <div class="row mb-2">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$user->name}}"
                        aria-describedby="helpId" placeholder="" required>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="row mb-2">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{$user->email}}"
                        aria-describedby="helpId" placeholder="" required>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                @if ($usuarioEdit->hasRole("admin"))
                <div class="mb-2">
                    <label for="name">Seleccione los roles</label>
                    @foreach ($roles as $key => $rol)
                    <div class="d-block">
                        <label for="">
                            <input type="checkbox" name="roles[]" value="{{$rol->id}}" @foreach ($rolesDelUsuario as
                                $rolDelUsuario) {{($rol->name == $rolDelUsuario ? 'checked' : '')}}
                            @endforeach
                            >
                            {{$rol->name}}
                        </label>
                    </div>
                    @endforeach
                </div>
                @endif

                <button type="submit" class="btn btn-primary btn-block">Editar</button>
            </form>
        </div>
    </div>
</div>
@endsection