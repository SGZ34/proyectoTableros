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
                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}"
                        aria-describedby="helpId" placeholder="" required>

                    @error('name')
                        <span class="text-danger"><b>{{$message}}</b></span>
                    @enderror    

                </div>

                <div class="row mb-2">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}"
                        aria-describedby="helpId" placeholder="" required>

                        @error('email')
                        <span class="text-danger"><b>{{$message}}</b></span>
                        @enderror    
                </div>


                <div class="row mb-2">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password" value
                        aria-describedby="helpId" placeholder="" required>

                        @error('password')
                        <span class="text-danger"><b>{{$message}}</b></span>
                        @enderror    
                </div>

                <div class="row mb-2">
                    <label for="confirm-password">Confirmar contraseña</label>
                    <input type="password" class="form-control" name="confirm-password" id="confirm-password" value
                        aria-describedby="helpId" placeholder="" required>

                        @error('confirm-password')
                        <span class="text-danger"><b>{{$message}}</b></span>
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

