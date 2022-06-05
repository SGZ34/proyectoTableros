@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="/css/index.css">
@endsection

@section('title')
Dashboard
@endsection


@section('content')
<div class="d-flex justify-content-center flex-wrap">

    @forelse ($tableros as $tablero)
    <div class="card col-5 mx-2 p-0">
        <div class="card-header px-2" style="background: #ff8138 !important; border-bottom: 8px solid #fff">
            <div class="card-title text-white">
                <h4>{{$tablero->title}}</h4>
                <p>{{$tablero->description}}</p>
            </div>
        </div>
        <div class="card-body">

            @if ($tablero->mimeName == "application/pdf")
            <div class="d-flex justify-content-center flex-column">
                <button class="btn btn-outline-warning mb-2 eventosModal" url="/files/{{$tablero->file}}" tipo="pdf">Ver</button>
                <div class="embed-responsive embed-responsive-16by9">
                    <embed class="embed-responsive-item" src="/files/{{$tablero->file . "#toolbar=0"}}" type="application/pdf">
                </div>
            </div>
            @endif


           @if ($tablero->mimeName == "image/jpeg" || $tablero->mimeName == "image/png")
           <div class="d-flex justify-content-center flex-column">
            <button class="btn btn-outline-warning mb-2 eventosModal" url="/files/{{$tablero->file}}" tipo="img">Ver</button>
            <img src="/files/{{$tablero->file}}" class="w-100 img-fluid imagen-eventos" alt="imagen">
           </div>
           @endif
               
           @if ($tablero->mimeName != "application/pdf" && $tablero->mimeName != "image/jpeg" && $tablero->mimeName != "image/png")
            
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <a href="/tableros/download/{{$tablero->id}}" class="btn btn-outline-primary">Descargar</a>
                    </div>
                </div>
            
           @endif
        </div>
    </div>    
    @empty
        Aquí no hay datos.
    @endforelse
    
</div>
<div class="modal-evento">
    <div class="d-block text-right float-right">
        <i class="fa fa-times p-3" style="cursor: pointer; font-size: 2rem" id="icono-modal">
        </i>
    </div>
</div>


@endsection


@section('scripts')
    
<script>
    const arrayBotones = document.querySelectorAll(".eventosModal");
    const modalEvento = document.querySelector(".modal-evento");
    const iconoModal = document.querySelector("#icono-modal");

    

    arrayBotones.forEach(b =>{
        b.addEventListener("click", e=>{
            aparecerModal(b.getAttribute("url"), b.getAttribute("tipo"))
         
        })
    })

    function aparecerModal(url,tipo){
        modalEvento.classList.add("aparecer-modal");
        if(tipo == 'pdf'){
            modalEvento.innerHTML += `
                <div class="embed-personalizado">
                    
                        <embed class="contenido-modal" src="${url}#toolbar=0" type="application/pdf">
                    
                </div>
            `
        }else if(tipo == "img"){
            modalEvento.innerHTML += `
                <div class="d-flex justify-content-center align-items-center h-100">
                    <img src="${url}" class="imagen-moda contenido-modal" alt="imagen">
                </div>    
            `
        }
    }


    modalEvento.addEventListener("click",({target})=>{
        
        let contenidoModal = document.querySelector(".contenido-modal");
        if(target != contenidoModal){
            modalEvento.classList.remove("aparecer-modal");
            modalEvento.innerHTML = `
                <div class="d-block text-right float-right">
                    <i class="fa fa-times p-3" style="cursor: pointer; font-size: 2rem" id="icono-modal">
                    </i>
                </div> 
            `
        }
        
    })
</script>
@endsection