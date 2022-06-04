@extends('layouts.app')

@section('title')
Crear usuario
@endsection


@section('content')
<div class="container">
    <div class="card col-md-8 offset-2">
        <div class="card-header">
            <div class="card-title">
                Crear Usuario
            </div>
        </div>
        <div class="card-body">

            <form action="/users" method="POST">
                @csrf
                
                <div class="row mb-2">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}"
                        aria-describedby="helpId" placeholder="" required>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror    

                </div>

                <div class="row mb-2">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}"
                        aria-describedby="helpId" placeholder="" required>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror    
                </div>


                <div class="row mb-2">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value
                        aria-describedby="helpId" placeholder="" required>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror    
                </div>

                <div class="row mb-2">
                    <label for="confirm-password">Confirmar contraseña</label>
                    <input type="password" class="form-control @error('confirm-password') is-invalid @enderror" name="confirm-password" id="confirm-password" value
                        aria-describedby="helpId" placeholder="" required>

                        @error('confirm-password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror    
                </div>

                <div class="mb-2">
                    <label for="name">Seleccione los roles</label>
                    @foreach ($roles as $key => $rol)
                    <div class="d-block">
                        <label for="">
                            <input type="checkbox" name="roles[]" value="{{$rol->id}}" 
                            >
                            {{$rol->name}}
                        </label>
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary btn-block">Crear</button>
            </form>
        </div>
    </div>
</div>
@endsection

