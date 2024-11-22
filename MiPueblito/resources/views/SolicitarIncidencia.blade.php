{{-- @can('TI') --}}
@extends('adminlte::page')
@section('title', 'Mi Pueblito')
@section('content_header')
<p style="font-family: 'Lexend Tera', sans-serif;font-family: 'Poiret One', cursive;font-weight: bold;color:#6B3CA3; text-align: right;">¡HOLA {{Auth::user()->name}} {{Auth::user()->lastname}} !</p>
 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
 <div class=" m-0 p-0 card bg-gradient-to-tr  from-purple-300 to-purple-500  rounded-lg  text-white font-bold text-md">
    <div class="card-body m-2 p-0">
        <h5 class="text-center">Reportar incidencia</h5>
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
  <form class="  rounded" method="POST" id="subform" action="{{route('NewSol')}}" >
    @csrf
    <div class="container col-12">
      <div class="row col-12">

  <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
    <label for="exampleInputEmail1" class="form-label">*Código</label>
    <select class="form-select js-example-basic-single" required id="codigoc" name="codigoc" onchange="BuscarCodigo()" onchange="validar()">
        <option selected value="" disabled>Selecciona una opción</option>
        @foreach ($productos as $producto)
        <option value="{{$producto->id}}">{{$producto->codigo}}</option>
        @endforeach
      
     
      </select>
 </div>
 <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
    <label for="exampleInputEmail1" class="form-label">*Producto</label>
    <input type="text" class="form-control"  id="producto" name="producto"  required readonly>
</div>
<div class="col-sm-6 col-md-4 col-lg-3 mb-4">
    <label for="exampleInputEmail1" class="form-label">*Lote</label>
    <input type="text" class="form-control"  id="lote" name="lote"  required onkeyup="validar()">
</div>
<div class="col-sm-6 col-md-4 col-lg-3 mb-4">
  <label for="exampleInputEmail1" class="form-label">Fecha de producción</label>
  <input type="text" class="form-control"  id="fproduccion" name="fproduccion"  required onkeyup="validar()" readonly>
</div>
<div class="col-sm-6 col-md-4 col-lg-3 mb-4">
  <label for="exampleInputEmail1" class="form-label">Días de caducidada</label>
  <input type="text" class="form-control"  id="dcad" name="dcad"  required onkeyup="validar()" readonly>
</div>
<div class="col-sm-6 col-md-4 col-lg-3 mb-4">
  <label for="exampleInputEmail1" class="form-label">Fecha de caducidad</label>
  <input type="text" class="form-control"  id="fcad" name="fcad"  required onkeyup="validar()" readonly >
</div>
<div class="col-sm-12 col-md-6 col-lg-6 mb-4">
  <label for="exampleInputEmail1" class="form-label">*Idioma del COA</label>
  <select class="form-select " required id="coa" name="coa" onchange="validar()" >
      <option selected value="" disabled>Selecciona una opción</option>
      <option value="ESP" >ESPAÑOL</option>
      <option value="ING" >INGLES</option>
    </select>
</div>
<div class="col-sm-12 col-md-6 col-lg-6 mb-4">
    <label for="exampleInputEmail1" class="form-label">Comentarios</label>
    <textarea class="form-control" name="comentarios" id="comentarios"></textarea>

</div>
    </div>
  
  </div>
  <input type="text" class="form-control"  id="usuario" name="usuario" value="{{Auth::user()->name}} {{Auth::user()->lastname}}" required style="display:none" >
  <input type="text" class="form-control"  id="dto" name="dto" value="{{Auth::user()->dto}}" required style="display:none"  >
  <input type="text" class="form-control"  id="code" name="code"  required style="display:none"  >
  <div class="d-flex justify-content-center"><button type="button" onclick="alerta()" class="btn btn-dark" id="but" disabled>Aceptar</button></div>
  </form>
</div>
<br>

<div class="card">
  <div class="card-header   bg-gradient-to-tr  from-purple-300 to-purple-500  rounded-lg text-center  text-white font-bold text-md">
    POLÍTICA DE RECEPCIÓN DE MUESTRAS Y ENTREGA DE RESULTADOS
  </div>
  <div class="card-body">
    <div class="container text-center">
      <div class="row">
        <div class="col">
          <div class="card text-bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">HORARIO DE RECEPCIÓN</div>
            <div class="card-body">
              <h5 class="card-title"></h5>
              <p class="card-text fw-bold">Lunes a viernes de 07:00 a 10:00 a.m. </p>
              <p class="card-text text-justify">NOTA 1: Las muestras que se reciban después de las 10:00 a.m. se procesarán al día siguiente (atrasando 24 horas la entrega de resultados), situaciones extraordinarias serán evaluadas entre las partes interesadas para llegar al mejor acuerdo posible.  </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card text-bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">MUESTRAS CONGELADAS</div>
            <div class="card-body">
           
              <p class="card-text text-justify">NOTA 2: Las muestras congeladas se inician análisis 24 horas después de su recepción. </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card text-bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">CONDICIONES DE LA MUESTRA</div>
            <div class="card-body">
           
              <p class="card-text text-justify">Muestras de producto terminado: deben entregarse muestras de 3 piezas o 300 gramos (muestras compuestas, el total no debe sobrepasar los 300 gramos) a temperatura no mayor a 10°C para muestras refrigeradas y -12°C para productos congelados.</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card text-bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">ETIQUETADO </div>
            <div class="card-body">
           
              <p class="card-text text-justify">Cada producto deberá contar con una etiqueta con los siguientes datos: </p>

              <p class="card-text text-justify">*Producto </p>
                
              <p class="card-text text-justify">*Presentación </p>
                
              <p class="card-text text-justify">*Marca y/o cliente </p>
                
              <p class="card-text text-justify">*Lote </p>
                
              <p class="card-text text-justify">*Fecha de elaboración </p>
                
              <p class="card-text text-justify">*Caducidad </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  {{--  --}}
@stop
@section('css')

<link rel="icon" href="data:image/png;base64,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"> 
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Buttons --> 
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs"></script>
    <script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
    <script>
     $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
    </script>
       <script>
   function BuscarCodigo() {
  let id= $('#codigoc').val();
var url = "{{route('BuscarProducto', ':id')}}";
        $.ajax({
            url:url = url.replace(':id', id),      
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#producto').val(data[0].producto);
                    $('#code').val(data[0].codigo);
                    $('#dcad').val(data[0].dias_cad);
                    validar();
                }
            });       
        }
       </script>
             <script>
              function alerta()
              {
   var codigo=document.getElementById("code").value;
  var producto=document.getElementById("producto").value;
  var lote=document.getElementById("lote").value;
  var idioma=document.getElementById("coa").value;
                Swal.fire({
    title: '¡Revisa los datos ingresados!',
    text: "¿Estas seguro de enviar la solicitud ?",
    html: "Codigo: "+ codigo +" <br> Lote: "+lote+ " <br>Idioma: "+idioma ,
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#AC7BF8',
    cancelButtonColor: '#C9BFDA',
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      var selectedForm=document.getElementById("subform");
  selectedForm.submit();
    }
  })
 }
</script>

<script>
  function validar(){
  if(document.getElementById("lote").value!="" && document.getElementById("coa").value!="" && document.getElementById("producto").value!="" ){
    document.querySelector('#but').disabled = false;
  }else{
    document.querySelector('#but').disabled = true;
    function getFromWD(w,d,y) {
      var totalDays = ((w-1) * 7) + d ; 
      return new Date(y, 0, totalDays);
  }
  dayjs.locale("es");
  lote=document.getElementById("lote").value;
  anio="20"+lote.substr(2, 2);
  dia=lote.substr(4, 3);
  r=getFromWD(1,dia,anio);
var a =new Date(r);
var lote=document.getElementById("fproduccion").value=moment(a).format('DD/MM/YYYY');
var dias=document.getElementById("dcad").value;
var fecha=document.getElementById("fproduccion").value;
const date = dayjs(a).add(dias, 'd');
const formatedDate = date.format('DD/MM/YYYY');
document.getElementById("fcad").value=formatedDate;

// 
  }
  }
  </script>
@stop
{{-- @endcan --}}
