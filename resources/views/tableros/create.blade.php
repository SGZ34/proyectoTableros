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
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{old('title')}}"
                        aria-describedby="helpId" placeholder="" required>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror    

                </div>

                <div class="row mb-2">
                    <label for="description">Descripción</label>

                    <textarea name="description" id="description" resize='none' rows="4" class="form-control @error('description') is-invalid @enderror" required>{{old('email')}}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror    
                </div>


                <div class="row mb-2">
                        <label for="file" class="form-label">Seleccione un archivo</label>
                        <input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file" required>
                        @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror    
                </div>

                <button type="submit" class="btn btn-primary btn-block">Crear</button>
            </form>
        </div>
    </div>
</div>
@endsection

