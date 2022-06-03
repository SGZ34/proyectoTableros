@extends('layouts.app')

@section('title')
Crear tablero
@endsection


@section('content')
<div class="container">
    <div class="card col-md-8 offset-2">
        <div class="card-header">
            <div class="card-title">
                Crear tablero
            </div>
        </div>
        <div class="card-body">

            <form action="/tableros" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row mb-2">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}"
                        aria-describedby="helpId" placeholder="" required>

                    @error('title')
                        <span class="text-danger"><b>{{$message}}</b></span>
                    @enderror    

                </div>

                <div class="row mb-2">
                    <label for="description">Descripción</label>

                    <textarea name="description" id="description" resize='none' rows="4" class="form-control" required>{{old('email')}}</textarea>
                        @error('description')
                        <span class="text-danger"><b>{{$message}}</b></span>
                        @enderror    
                </div>


                <div class="row mb-2">
                        <label for="file" class="form-label">Seleccione un archivo</label>
                        <input class="form-control" type="file" id="file" name="file" required>
                        @error('file')
                        <span class="text-danger"><b>{{$message}}</b></span>
                        @enderror    
                </div>

                <button type="submit" class="btn btn-primary btn-block">Crear</button>
            </form>
        </div>
    </div>
</div>
@endsection

