 @can('TI') 
@extends('adminlte::page')
@section('title', 'Mi Pueblito')
@section('content_header')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
* {
    padding: 0;
    margin: 0;
    font-family: 'Poppins', sans-serif;
}
body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    width: 100vw;
    background: #ececec;
    overflow: hidden;
}
.flex-row {
    display: flex;
}
.wrapper {
    border: 1px solid #136612;
    border-right: 0;
}
canvas#signature-pad {
    background: #fff;
    width: 100%;
    height: 100%;
    cursor: crosshair;
    color: #48B406
}
canvas#signature-pad2 {
    background: #fff;
    width: 100%;
    height: 100%;
    cursor: crosshair;
    color: #48B406
}
button#clear {
    height: 100%;
    background: #8bc50d;
    border: 1px solid transparent;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
}
button#clear span {
    transform: rotate(90deg);
    display: block;
}

button#clear2 {
    height: 100%;
    background: #8bc50d;
    border: 1px solid transparent;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
}
button#clear2 span {
    transform: rotate(90deg);
    display: block;
}
</style>
<p style="font-family: 'Lexend Tera', sans-serif;font-family: 'Poiret One', cursive;font-weight: bold;color:#48B406; text-align: right;">! HOLA {{Auth::user()->name}} {{Auth::user()->lastname}} !</p>
 
 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
 <div class=" m-0 p-0 card bg-gradient-to-tr  from-gray-500 to-gray-900  rounded-lg  text-white font-bold text-md">
    <div class="card-body m-2 p-0">
        <h5 class="text-center">Generar pase de salida  <a href="{{ URL::route('PaseSalidaPDF',$user->id)}}" class="btn btn-secondary btn-sm" tabindex="-1" role="button"><i class="fa-regular fa-file-pdf fa-sm"></i></a> 
        </h5>
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
  <form class="  rounded" method="POST" id="subform" action="{{route('PostPaseSalidaPDF')}}" >
    @csrf
    <button type="submit" class="btn btn-secondary">aceptar</button>
    <div class="container text-center">
        <div class="row">
          <div class="col-lg-6">
            <div class="mb-3">
                <label  class="form-label">RESPONSABLE DEL EQUIPO</label>
                <input type="text" class="form-control" id="username" name="username" value="{{$user->name}} {{$user->lastname}}">
              </div>
          </div>
          <div class="col-lg-3">
            <div class="mb-3">
                <label  class="form-label">FECHA DE SALIDA</label>
                <input type="date" class="form-control" id="fsalida" name="fsalida">
              </div>
          </div>
          <div class="col-lg-3">
            <div class="mb-3">
                <label  class="form-label">FECHA DE ENTREGA</label>
                <input type="date" class="form-control" id="fentrega" name="fentrega">
              </div>
          </div>
          <div class="col-lg-6">
            <div class="mb-3">
                <label  class="form-label">CONDICIONES</label>
                <input type="text" class="form-control" id="condiciones" name="condiciones" value="Buenas condiciones">
              </div>
          </div>
          <div class="col-lg-6">
            <div class="mb-3">
                <label  class="form-label">ACTIVIDADES A REALIZAR</label>
                <input type="text" class="form-control" id="actividades" name="actividades" value="Trabajo Fuera de la empresa">
              </div>
          </div>

          <div class="col-lg-6">
            <div class="card text-bg-dark mb-3" style="max-width: 100%;">
                <div class="card-header">Seleccione equipos de salida</div>
                <div class="card-body">
                    @foreach ($equipos as $equipos )
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="equipos" name="equipos[]" value="{{$equipos->id}}">
                        <label class="form-check-label" for="equipos">{{$equipos->tipo_disp}} {{$equipos->nombre_disp}} </label>
                      </div>   
                    @endforeach
                </div>
              </div>
          </div>
        {{--  --}}
    
        <div class="col-lg-6">
            <div class="card text-bg-dark mb-3" style="max-width: 100%;">
                <div class="card-header">Seleccione dispositivos de salida</div>
                <div class="card-body">
                    @foreach ($dispositivos as $dispositivos )
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="dispositivos" name="dispositivos[]" value="{{$dispositivos->id}}">
                        <label class="form-check-label" for="dispositivos">{{$dispositivos->t_dispositivo}} </label>
                      </div>   
                    @endforeach
                </div>
              </div>
          </div>
          <div class="col-lg-6">
            <div class="card text-bg-dark mb-3" >
                <div class="card-header">Firma Solicitante</div>
                <div class="card-body">
                    <div class="flex-row">
                        <div class="wrapper">
                            <canvas id="signature-pad" width="500" height="200"></canvas>
                        </div>
                        <div class="clear-btn">
                            <button type="button" id="clear"><span>Limpiar</span></button>
                            
                        </div>
                    </div> 
                </div>
              </div>
          </div>

          <div class="col-lg-6">
            <div class="card text-bg-dark mb-3" >
                <div class="card-header">Firma Solicitante</div>
                <div class="card-body">
                    <div class="flex-row">
                        <div class="wrapper">
                            <canvas id="signature-pad2" width="500" height="200"></canvas>
                        </div>
                        <div class="clear-btn2">
                            <button type="button" id="clear2"><span>Limpiar</span></button>
                        </div>
                    </div> 
                </div>
              </div>
          </div>


      
        </div>
      </div>
      
  </form>
</div>
<br>


@stop
@section('css')

<link rel="icon" href="{{asset('images/icono.png')}}">
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

@stop

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.3.5/signature_pad.min.js" integrity="sha512-kw/nRM/BMR2XGArXnOoxKOO5VBHLdITAW00aG8qK4zBzcLVZ4nzg7/oYCaoiwc8U9zrnsO9UHqpyljJ8+iqYiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
       var canvas = document.getElementById("signature-pad");
       function resizeCanvas() {
           var ratio = Math.max(window.devicePixelRatio || 1, 1);
           canvas.width = canvas.offsetWidth * ratio;
           canvas.height = canvas.offsetHeight * ratio;
           canvas.getContext("2d").scale(ratio, ratio);
       }
       window.onresize = resizeCanvas;
       resizeCanvas();
       var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(250,250,250)'
       });
       document.getElementById("clear").addEventListener('click', function(){
        signaturePad.clear();
       })
</script>
<script>
    var canvas = document.getElementById("signature-pad2");
    function resizeCanvas2() {
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
      
    }
    window.onresize = resizeCanvas;
    resizeCanvas2();
    window.open(signaturePad.toDataURL());
    var signaturePad2 = new SignaturePad(canvas, {
     backgroundColor: 'rgb(250,250,250)'
    });
    document.getElementById("clear2").addEventListener('click', function(){
     signaturePad2.clear();
    })
</script>
@stop
@endcan 