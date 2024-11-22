@can('TI')
@extends('adminlte::page')

@section('title', 'Mi Pueblito')

@section('content_header')

@stop
@section('content')

<div class=" mt-2 p-0 card bg-gradient-to-tr  from-gray-500 to-gray-900  rounded-lg  text-white font-bold text-md">
    <div class="card-body m-2  p-0">
    <h5 class="text-center">Incidencia</h5>
    </div>
    </div> 

@foreach ($soportes as $soportes )
<div class="card mb-3 mt-3" style="max-width: 100%;">
    <div class="row g-0">
      <div class="col-md-6">
        <img src="{{ asset('storage/IncidenciasImg/'.$soportes->imagen) }}" data-enlargeable width="100%" style="cursor: zoom-in"  class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-6">
        <div class="card-body">
          <p class="card-text fw-semibold fst-italic">USUARIO: <span class="fw-normal">{{$soportes->username}}</span></p>
          <p class="card-text fw-semibold fst-italic">FOLIO: <span class="fw-normal">{{$soportes->id}}</span></p>
          <p class="card-text fw-semibold fst-italic">PRIORIDAD: <span class="fw-normal">{{$soportes->prioridad}}</span></p>
          <p class="card-text fw-semibold fst-italic">INCIDENCIA: <span class="fw-normal">{{$soportes->t_incidencia}}</span></p>
          <p class="card-text fw-semibold fst-italic">DESCRIPCION: <span class="fw-normal">{{$soportes->descripcion}}</span></p>
          <p class="card-text fw-semibold fst-italic">DEPARTAMENTO: <span class="fw-normal">{{$soportes->dto}}</span></p>
          <p class="card-text fw-semibold fst-italic">EMAIL: <span class="fw-normal">{{$soportes->email}}</span></p>
          <p class="card-text fw-semibold fst-italic">FECHA DE SOLICITUD: <span class="fw-normal">{{$soportes->created_at}}</span></p>
          <p class="card-text fw-semibold fst-italic">ESTATUS DE LA SOLICITUD: <span class="fw-normal">{{$soportes->estatus}}</span></p>
          <p class="card-text fw-semibold fst-italic">TECNICO ASIGNADO: <span class="fw-normal">{{$soportes->asignado}}</span></p>
    
        </div>
      </div>
    </div>
  </div>
  @endforeach
  {{-- <div class="card">
    <div class="card-body">
      <p class="card-text">IMAGEN DE EVIDENCIA</p>
    </div>
    @foreach ($soportes as $soportes )
    <img src="{{ asset('storage/IncidenciasImg/'.$soportes->imagen) }}" class="card-img-bottom" style="width: 50%!important">
    <br>
    <p>Descripción del problema:</p><br> <p>{{$soportes->descripcion}}</p>
    @endforeach
  </div> --}}

@stop

@section('css')
<link rel="icon" href="http://mipueblitofoods.net/public/images/icono.png"> 
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@300&family=Poiret+One&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" >
{{-- datatables --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" >
<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" >
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet" >
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet" >
@stop

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

   <script>
    $('img[data-enlargeable]').addClass('img-enlargeable').click(function() {
  var src = $(this).attr('src');
  var modal;

  function removeModal() {
    modal.remove();
    $('body').off('keyup.modal-close');
  }
  modal = $('<div>').css({
    background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
    backgroundSize: 'contain',
    width: '100%',
    height: '100%',
    position: 'fixed',
    zIndex: '10000',
    top: '0',
    left: '0',
    cursor: 'zoom-out'
  }).click(function() {
    removeModal();
  }).appendTo('body');
  //handling ESC
  $('body').on('keyup.modal-close', function(e) {
    if (e.key === 'Escape') {
      removeModal();
    }
  });
});
    </script>
@stop
@endcan
