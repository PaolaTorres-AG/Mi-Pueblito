@can('MI-PUEBLITO')
@extends('adminlte::page')
@section('title', 'Mi Pueblito')
@section('content_header')
@foreach ($solicitud as $solicitud)

<p style="font-family: 'Lexend Tera', sans-serif;font-family: 'Poiret One', cursive;font-weight: bold;color:#48B406; text-align: right;">! HOLA {{Auth::user()->name}} {{Auth::user()->lastname}} ! </p>
 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
 <div class=" m-0 p-0 card bg-gradient-to-tr  from-gray-500 to-gray-900   rounded-lg  text-white font-bold text-md">
  
  <div class="card-body m-2 p-0">
<h5 class="text-center">Solicitud de Análisis</h5> 
  </div>
  </div>
@stop
@section('content')
<div class="flash-message">
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
   
    <p class="alert alert-{{ $msg }}">{{Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
  @endforeach
</div> <!-- end .flash-message -->

<div class="card p-2 m-0">
  <form class="  rounded" method="POST" >
    @csrf
  
    <div class="container col-12">
      <div class="row col-12">
        <div class="col-sm-6 col-md-1 col-lg-1 mb-4">
            <label for="exampleInputEmail1" class="form-label text-sm">Folio</label>
            <input type="text" class="form-control text-sm"  id="folio" name="folio" required readonly value="{{$solicitud->id}}" >
        </div>
        <div class="col-sm-12 col-md-2 col-lg-2 mb-4">
          <label for="exampleInputEmail1" class="form-label text-sm">Idioma del COA</label>
          <input type="text" class="form-control text-sm"   required id="coa" name="coa" required readonly value="{{$solicitud->idioma}}">
      </div>
        <div class="col-sm-6 col-md-3 col-lg-3 mb-4">
            <label for="exampleInputEmail1" class="form-label text-sm">Estatus</label>
            <input type="text" class="form-control text-sm"  id="estatus" name="estatus" required readonly value="{{$solicitud->estatus}}" >
        </div>
 <div class="col-sm-6 col-md-2 col-lg-2 mb-4">
    <label for="exampleInputEmail1" class="form-label text-sm">Código</label>
    <input type="text" class="form-control text-sm"  id="codigoc" name="codigoc" required readonly value="{{$solicitud->codigo}}">
</div>
<div class="col-sm-6 col-md-2 col-lg-2 mb-4">
    <label for="exampleInputEmail1" class="form-label text-sm">Lote</label>
    <input type="text" class="form-control text-sm"  id="lote" name="lote"  required  readonly value="{{$solicitud->lote}}">
</div>
<div class="col-sm-6 col-md-2 col-lg-2 mb-4">
  <label for="exampleInputEmail1" class="form-label text-sm">Fecha de elaboración</label>
  <input type="text" class="form-control text-sm"  id="felab" name="felab"  required  readonly value="{{$solicitud->fecha_produccion}}">
</div>
<div class="col-sm-6 col-md-2 col-lg-2 mb-4">
  <label for="exampleInputEmail1" class="form-label text-sm">Fecha de caducidad</label>
  <input type="text" class="form-control text-sm"  id="fcad" name="fcad"  required  readonly value="{{$solicitud->fecha_caducidad}}">
</div>
<div class="col-sm-6 col-md-3 col-lg-3 mb-4">
    <label for="exampleInputEmail1" class="form-label text-sm">Solicitado por</label>
    <input type="text" class="form-control text-sm"  id="" name=""  required  readonly value="{{$solicitud->usuario}}">
</div>
<div class="col-sm-6 col-md-2 col-lg-2 mb-4">
    <label for="exampleInputEmail1" class="form-label text-sm">Fecha de solicitud</label>
    <input type="text" class="form-control text-sm"  id="" name=""  required  readonly value="{{$solicitud->created_at}}">
</div>
<div class="col-sm-6 col-md-3 col-lg-3 mb-4">
    <label for="exampleInputEmail1" class="form-label text-sm">Muestra recibida por</label>
    <input type="text" class="form-control text-sm"  id="" name=""  required  readonly value="{{$solicitud->recibio}}">
</div>
<div class="col-sm-6 col-md-2 col-lg-2 mb-4">
    <label for="exampleInputEmail1" class="form-label text-sm">Fecha de recepción </label>
    <input type="text" class="form-control text-sm"  id="lote" name="lote"  required  readonly value="{{$solicitud->fecha_recepcion}}">
</div>
 <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
    <label for="exampleInputEmail1" class="form-label text-sm">Producto</label>
    <input type="text" class="form-control text-sm"  id="producto" name="producto"  required readonly value="{{$solicitud->producto}}">
</div>
<div class="col-sm-12 col-md-6 col-lg-6 mb-4">
    <label for="exampleInputEmail1" class="form-label text-sm">Comentarios</label>
    <textarea class="form-control text-sm" name="indicaciones" id="indicaciones" readonly >{{$solicitud->comentarios}} </textarea>
</div>

@if ($pdf == 0 && $solicitud->estatus== "LIBERADO" || $solicitud->estatus== "EN HOLD")
<div class="col-sm-1 col-md-1 col-lg-1 mb-4">
  <label for="exampleInputEmail1" class="form-label">COA-ESP</label>
 <p> <a href="{{ URL::route('generate.invoice.pdf', ['id' => Crypt::encrypt($solicitud->id) ]) }}" class="btn btn-secondary"><i class="fa-solid fa-file-pdf"></i></a></p>
</div>
<div class="col-sm-1 col-md-1 col-lg-1 mb-4">
  <label for="exampleInputEmail1" class="form-label">COA-ING</label>
 <p> <a href="{{ URL::route('generatePdfIng', ['id' => Crypt::encrypt($solicitud->id) ]) }}" class="btn btn-secondary"><i class="fa-solid fa-file-pdf"></i></a></p>
</div>

@endif
    </div>
  </div>
  @endforeach
  </form>
</div>
{{-- comienza can cancelacion --}}
@if($solicitud->estatus != "CANCELADO")
<div class=" m-0 p-0 card bg-gradient-to-tr  from-gray-500 to-gray-900  rounded-lg  text-white font-bold text-md">
    <div class="card-body m-2 p-0">
        <h5 class="text-center">Análisis</h5>
    </div>
  </div>


<div class="table-responsive p-3 mt-3 bg-gray-300 rounded-lg ">
<table class="table  data-table table-hover rounded-lg text-xs " id="example">
  <thead>
      <tr style="border-style:none !important"> 
          <th>PARAMETRO</th>
          <th>RESULTADO</th>
          <th>LIMITE MAX</th>
          <th>UNIDADES</th>
          <th>METODO</th>
          <th>REALIZO</th>
      </tr>
  </thead>
  <tbody style=" border-radius: 25px !important;">
      @foreach($metodos as $tablametodos)
          <tr > 
              <td>{{$tablametodos->analisis }}</td>
              <td>{{$tablametodos->resultado }}</td>
              <td>{{$tablametodos->limit}}</td>
              <td>{{$tablametodos->unidades }}</td>
              <td>{{$tablametodos->metodo }}</td>
              <td>{{$tablametodos->realizado }}</td>
          </tr>
      @endforeach
  </tbody>
</table>
</div>
@endif

@stop
@section('css')
<link rel="icon" href="http://mipueblitofoods.net/public/images/icono.png"> 
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@300&family=Poiret+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>
@stop

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>
    <!-- Buttons -->
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script>$.fn.poshytip={defaults:null}</script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
@stop
@endcan