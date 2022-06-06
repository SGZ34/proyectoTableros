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
    <div class="card col-9 p-0">
        <div class="card-header px-2" style="background: #ff8138 !important; border-bottom: 8px solid #fff">
            <div class="card-title text-white">
                <h4>{{$tablero->title}}</h4>
                <p>{{$tablero->description}}</p>
            </div>
        </div>
        <div class="card-body">

            @if ($tablero->mimeName == "application/pdf")
            <div class="d-flex justify-content-center flex-column">
                <a class="btn btn-outline-warning mb-2" href="/dashboard/show/{{$tablero->id}}">Ver</a>
                <div class="row mx-auto">
                    <iframe src="/files/{{$tablero->file . "#toolbar=0"}}" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            @endif


           @if ($tablero->mimeName == "image/jpeg" || $tablero->mimeName == "image/png")
           <div class="d-flex justify-content-center flex-column">
            <a class="btn btn-outline-warning mb-2" href="/dashboard/show/{{$tablero->id}}">Ver</a>
            <div class="row mx-auto">
                <img src="/files/{{$tablero->file}}" class="imagen-eventos" alt="imagen">
            </div>
           </div>
           @endif
               
           @if ($tablero->mimeName != "application/pdf" && $tablero->mimeName != "image/jpeg" && $tablero->mimeName != "image/png")
            
                <div class="row">
                    <div class="col d-flex justify-content-center flex-column align-items-center">
                        <a href="/tableros/download/{{$tablero->id}}" class="btn btn-outline-primary">Descargar</a>
                        <p>{{$tablero->mimeDescription}}</p>
                    </div>
                </div>
            
           @endif
        </div>
    </div>    
    @empty
        Aquí no hay datos.
    @endforelse
    
</div>
@endsection


@section('scripts')
{{-- <script>
    // const arrayBotones = document.querySelectorAll(".eventosModal");
    // const modalEvento = document.querySelector(".modal-evento");
    // const iconoModal = document.querySelector("#icono-modal");

    

    // arrayBotones.forEach(b =>{
    //     b.addEventListener("click", e=>{
    //         aparecerModal(b.getAttribute("url"), b.getAttribute("tipo"))
         
    //     })
    // })

    // function aparecerModal(url,tipo){
    //     modalEvento.classList.add("aparecer-modal");
    //     if(tipo == 'pdf'){
    //         modalEvento.innerHTML += `
    //             <div class="embed-personalizado">
                    
    //                     <embed class="contenido-modal" src="${url}#toolbar=0" type="application/pdf">
                    
    //             </div>
    //         `
    //     }else if(tipo == "img"){
    //         modalEvento.innerHTML += `
    //             <div class="d-flex justify-content-center align-items-center h-100">
    //                 <img src="${url}" class="imagen-moda contenido-modal" alt="imagen">
    //             </div>    
    //         `
    //     }
    // }


    // modalEvento.addEventListener("click",({target})=>{
        
    //     let contenidoModal = document.querySelector(".contenido-modal");
    //     if(target != contenidoModal){
    //         modalEvento.classList.remove("aparecer-modal");
    //         modalEvento.innerHTML = `
    //             <div class="d-block text-right float-right">
    //                 <i class="fa fa-times p-3" style="cursor: pointer; font-size: 2rem" id="icono-modal">
    //                 </i>
    //             </div> 
    //         `
    //     }
        
    // })
</script> --}}
@endsection