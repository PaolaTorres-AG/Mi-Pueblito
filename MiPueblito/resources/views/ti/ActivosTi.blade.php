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
  #example tfoot {
          display: table-header-group !important;
      }
      #example tfoot {
          display: table-header-group !important;
      }
  
      </style>
<p style="font-weight: bold;color:#f2ca28; text-align: right;">¡BIENVENIDO {{Auth::user()->name}} {{Auth::user()->lastname}} !</p>
     
 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

 <div class=" m-0 p-0 card bg-gradient-to-tr  from-gray-500 to-gray-900 text-white font-bold text-md">
    <div class="card-body m-2 p-0">
        <h5 class="text-center"> Registro de Activos TI</h5>
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
  <form class="  rounded" method="POST"  action="{{route('ActivosTIPost')}}" >
    @csrf
    <div class="container col-12">
      <div class="row col-12">

  <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
              <label for="exampleInputEmail1" class="form-label">Tipo de dispositivo</label>
              <input type="text" class="form-control"  id="disp" name="disp" value="{{ old('disp') }}" required  >
 </div>
 <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">Marca</label>
    <input type="text" class="form-control"  id="marca" name="marca" value="{{ old('marca') }}" required  >
</div>

  <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">Modelo</label>
    <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo') }}" required>
  </div>

  <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">Numero de serie</label>
    <input type="text" class="form-control" id="numserie" name="numserie" value="" maxlength="15" required>
  </div>

  <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">Ubicación</label>
    <input type="text" class="form-control"  id="ubicacion" name="ubicacion" value="{{ old('ubicacion') }}" required  >
</div>
<div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">Wifi/Ethernet</label>
    {{-- <input type="text" class="form-control"  id="wifieth" name="wifieth" value="{{ old('wifieth') }}"  > --}}
 <select class="form-select text-sm" id="wifieth" name="wifieth" value="{{ old('wifieth') }}" >
         
          <option value="WIFI">WIFI</option>
          <option value="ETHERNET">ETHERNET</option>
        </select>  
</div>
<div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">MAC</label>
    <input type="text" class="form-control"  id="mac" name="mac" value="{{ old('mac') }}"  >
</div>
<div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">IP</label>
    <input type="text" class="form-control"  id="ip" name="ip" value="{{ old('ip') }}"  >
</div>
<div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">Observaciones</label>
    <textarea class="form-control" id="observaciones" name="observaciones" maxlength="200" value="{{old('observaciones')}}"></textarea>

</div>


    </div>
  </div>
  <div class="d-flex justify-content-center"><button type="submit" class="btn btn-dark">Aceptar</button></div>
  </form>
</div>
  {{--  --}}
  <div class=" mt-3 p-0 card bg-gradient-to-tr  from-gray-500 to-gray-900 text-white font-bold text-md">
    <div class="card-body m-2 p-0">
        <h5 class="text-center text-white"> Lista de Activos TI</h5>
    </div>

 <div class="card">
  <table class=" table  text-sm text-left text-gray-500" id="example" >
    <thead >
      <tr class="">
        <th class="p-2 text-sm" >ID</th>
        <th>DISPOSITIVO</th>
        <th >MARCA</th>
        <th>MODELO</th>
        <th>MAC</th>
        <th>IP</th>
        <th>NUMERO DE SERIE</th>
        <th>UBICACION</th>
        <th>WIFI/ETHERNET</th>
        <th>OBSERVACIONES</th>
        <th>EDITAR</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
          <th>Filter..</th>
          <th>Filter..</th>
          <th>Filter..</th>
          <th>Filter..</th>
          <th>Filter..</th>
          <th>Filter..</th>
          <th>Filter..</th>
          <th>Filter..</th>
          <th>Filter..</th>
          <th>Filter..</th>
          <th>Filter..</th>
      </tr>
  </tfoot>
   
    <tbody>
      @foreach ($activos as $activos )
      <tr class="fw-light ">
        <td class="py-3 px-6 text-left" scope="row">{{$activos->id}}</td>
        <td class="py-3 px-6 text-left">{{$activos->tipos_dispositivo}}</td>
        <td class="py-3 px-6 text-left">{{$activos->marca}}</td>
        <td class="py-3 px-6 text-left">{{$activos->modelo}}</td>
        <td class="py-3 px-6 text-left">{{$activos->mac}}</td>
        <td class="py-3 px-6 text-left">{{$activos->ip}}</td>
        <td class="py-3 px-6 text-left">{{$activos->numero_serie}}</td>
        <td class="py-3 px-6 text-left">{{$activos->ubicacion}}</td>
        <td class="py-3 px-6 text-left">{{$activos->wifi_ethernet}}</td>
        <td class="py-3 px-6 text-left">{{$activos->observaciones}}</td>
        <td class="py-3 px-6 text-left">
            <a>
            <div class="flex item-center justify-center">
              <button class="w-4 mr-2 transform hover:text-green-700 hover:scale-130" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                  </svg>
              </button>
          </div>
        </a>
          </td>
       
      </tr>
      @endforeach
    </tbody>

  </table>
</div>
</div>
{{-- modal edit users --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg rounded-lg">
    <div class="modal-content">
      <div class="modal-header bg-gradient-to-tr from-gray-500 to-gray-900  rounded-lg  text-white font-bold text-md">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Información de usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
  {{--  --}}
  <form class=" shadow p-3  rounded" method="POST"  action="{{route('UpdateActivosTIPost')}}" >
    @csrf
    <div class="mb-3">
      <label for="" class="form-label">ID</label>
      <input type="text" class="form-control" id="id" name="id" readonly >
    </div>
    <div class="mb-3">
      <label for="" class="form-label">DISPOSITIVO</label>
      <input type="text" class="form-control" id="dispu" name="dispu" >
    </div>
    <div class="mb-3">
      <label for="" class="form-label">MARCA</label>
      <input type="text" class="form-control" id="marcau" name="marcau" >
    </div>
    <div class="mb-3">
      <label for="" class="form-label">MODELO</label>
      <input type="text" class="form-control" id="modelou" name="modelou" >
    </div>
    <div class="mb-3">
      <label for="" class="form-label">MAC</label>
      <input type="text" class="form-control" id="macu" name="macu" >
    </div>
    <div class="mb-3">
        <label for="" class="form-label">IP</label>
        <input type="text" class="form-control" id="ipu" name="ipu" >
      </div>
      <div class="mb-3">
        <label for="" class="form-label">NUMERO DE SERIE</label>
        <input type="text" class="form-control" id="serieu" name="serieu" >
      </div>
      <div class="mb-3">
        <label for="" class="form-label">UBICACION</label>
        <input type="text" class="form-control" id="ubi" name="ubi" >
      </div>
    <div class="mb-3">
      <label for="" class="form-label">WIFI/ETHERNET</label>
      <select class="form-select" name="we" id="we">
        <option value="WIFI">WIFI</option>
        <option value="ETHERNET">ETHERNET</option>
      </select>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">OBSERVACIONES</label>
        <input type="text" class="form-control" id="obsu" name="obsu" >
      </div>
    <div class="mb-3">
        <label for="" class="form-label">ESTATUS</label>
        <select class="form-select" name="estatusu" id="estatusu">
          <option value="ACTIVO">ACTIVO</option>
          <option value="INACTIVO">INACTIVO</option>
        </select>
      </div>
    <div class="d-flex justify-content-center"><button type="submit" class="btn shadow btn-dark">Aceptar</button></div>
    
  </form>
  {{--  --}}
      </div>
    </div>
  </div>
</div>
{{--  --}}



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
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>
<script>
  $(document).ready(function() {
 $('.js-example-basic-single').select2();
});
 </script>
    <script type="text/javascript">
      $(document).ready(function () {
          $('#example tfoot th').each(function () {
              var title = $(this).text();
              $(this).html('<input type="text" class="form-control" placeholder="Filtrar.."  style="font-size: 12px;"/>');
          });
  
          var table = $('#example').DataTable({
                "dom": '<"float-left"B><"float-right"f>t<"float-left"i><"float-right"p><"clearfix">',
              "responsive": false,
              "language": {
                  "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
              },
              "order": [
                  [0, "desc"]
              ],
              "initComplete": function () {
                  this.api().columns().every(function () {
                      var that = this;
  
                      $('input', this.footer()).on('keyup change', function () {
                          if (that.search() !== this.value) {
                              that
                                  .search(this.value)
                                  .draw();
                          }
                      });
                  })
              },
           "buttons": [
                  {
                  extend:    'copyHtml5',
                  text:      '<i class="fa fa-copy"></i>',
                  titleAttr: 'Copiar al portapapeles'
              },
              {
                  extend:    'excel',
                  text:      '<i class="fa fa-file-excel"></i>',
                  titleAttr: 'Descargar informaci贸n en excel'
              },
              {
                  extend:    'pageLength',
                  text:      '<i class="fa fa-ellipsis"></i>',
                  titleAttr: 'Mostrar resultados'
              }
    ],
          });
      });
  </script>
        {{--  --}}
        <script>
          $("body").on("click", "#example a", function(event) {
              event.preventDefault();
              idsele = $(this).attr("href");
              id= $(this).parent().parent().children("td:eq(0)").text();
             disp = $(this).parent().parent().children("td:eq(1)").text();
            marca = $(this).parent().parent().children("td:eq(2)").text();
            modelo= $(this).parent().parent().children("td:eq(3)").text();
           mac = $(this).parent().parent().children("td:eq(4)").text();
        ip= $(this).parent().parent().children("td:eq(5)").text();
       serie = $(this).parent().parent().children("td:eq(6)").text();
   ubic  = $(this).parent().parent().children("td:eq(7)").text();
    wifieth  = $(this).parent().parent().children("td:eq(8)").text();
      obs  = $(this).parent().parent().children("td:eq(9)").text();
              //Cargamos en el formulario los valores del registro
              $("#id").val(id);
              $("#dispu").val(disp);
              $("#marcau").val(marca);
              $("#modelou").val(modelo);
              $("#macu").val(mac);
              $("#ipu").val(ip);
              $("#serieu").val(serie);
              $("#ubi").val(ubic);
              $("#we").val(wifieth);
              $("#obsu").val(obs);
      
              eliminaEspacio();
          });
        
          </script>
          <script>
            $('#password1, #confirm_password').on('keyup', function () {
    if ($('#password1').val() == $('#confirm_password').val()) {
        $('#message').html('Coinciden').css('color', 'green');
        $('#passwbut').attr('disabled', false);
    } else {
        $('#message').html('No coinciden').css('color', 'red');
        $('#passwbut').attr('disabled', true);
    }
});
            </script>
        {{--  --}}
@stop
@endcan