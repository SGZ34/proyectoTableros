@extends('layouts.app')

@section('title')
Editar tablero
@endsection


@section('content')
<div class="container">
    <div class="card col-md-8 offset-2">
        <div class="card-header">
            <div class="card-title">
                Editar tablero
            </div>
        </div>
        <div class="card-body">

            <form action="/tableros/{{$tablero->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="row mb-2">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{$tablero->title}}"
                        aria-describedby="helpId" placeholder="" required>

                    @error('title')
                        <span class="text-danger"><b>{{$message}}</b></span>
                    @enderror    

                </div>

                <div class="row mb-2">
                    <label for="description">Descripción</label>

                    <textarea name="description" id="description" resize='none' rows="4" class="form-control" required>{{$tablero->description}}</textarea>
                        @error('description')
                        <span class="text-danger"><b>{{$message}}</b></span>
                        @enderror    
                </div>


                <div class="row mb-2">
                        <label for="file" class="form-label">Seleccione un archivo</label>
                        <input class="form-control" type="file" id="file" name="file" value="{{$tablero->file}}">
                        @error('file')
                        <span class="text-danger"><b>{{$message}}</b></span>
                        @enderror    
                </div>

                <div class="row">
                    @if ($tablero->file != null)
                    
                    <div class="embed-responsive embed-responsive-16by9">
                        <embed class="embed-responsive-item" src="/files/{{$tablero->file .'#toolbar=0'}}" allowfullscreen>
                      </div>
                    @else
                        <span class="text-center text-danger">Sin archivo</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-block">Editar</button>
            </form>
        </div>
    </div>
</div>
@endsection

