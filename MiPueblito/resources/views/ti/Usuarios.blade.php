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
        <h5 class="text-center"> Registro de Usuarios</h5>
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
  <form class="  rounded" method="POST"  action="{{route('ViewAddAdminRegister')}}" >
    @csrf
    <div class="container col-12">
      <div class="row col-12">

  <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
              <label for="exampleInputEmail1" class="form-label">Nombre del usuario</label>
              <input type="text" class="form-control"  id="name" name="name" value="{{ old('name') }}" required  >
 </div>
 <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">Apellido del usuario</label>
    <input type="text" class="form-control"  id="lastname" name="lastname" value="{{ old('lastname') }}" required  >
</div>

  <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">Correo</label>
    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
  </div>

  <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">Contraseña</label>
    <input type="text" class="form-control" id="password" name="password" value="" maxlength="15" required>
  </div>

  <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">Departamento</label>
    <input type="text" class="form-control"  id="dto" name="dto" value="{{ old('dto') }}" required  >
</div>
<div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">Puesto</label>
    <input type="text" class="form-control"  id="puesto" name="puesto" value="{{ old('puesto') }}" required  >
</div>
<div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">Ext</label>
    <input type="text" class="form-control"  id="ext" name="ext" value="{{ old('ext') }}" required  >
</div>
<div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">N# Nomina</label>
    <input type="text" class="form-control"  id="nomina" name="nomina" value="{{ old('nomina') }}" required  >
</div>
  <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <label for="exampleInputEmail1" class="form-label">Rol de Usuario</label>
    <select class="form-control  " id="rol" name="rol" required >
      <option selected disabled value="">Selecciona una opcion</option>
      @foreach ($roles as $roles)
<option  value="{{$roles->id}}"> {{strtoupper($roles->name)}}</option>
@endforeach
    </select>
  </div>

    </div>
  </div>
  <div class="d-flex justify-content-center"><button type="submit" class="btn btn-dark">Aceptar</button></div>
  </form>
</div>
  {{--  --}}
  <div class=" m-0 p-0 card bg-gradient-to-tr  from-gray-500 to-gray-900 text-white font-bold text-md">
    <div class="card-body m-2 p-0">
        <h5 class="text-center text-white"> Lista de usuarios</h5>
    </div>

 <div class="card">
  <table class=" table  text-sm text-left text-gray-500" id="example" >
    <thead >
      <tr class="">
        <th class="p-2 text-sm" >ID</th>
        <th>NOMBRE</th>
        <th >APELLIDO</th>
        <th>CORREO</th>
        <th>DTO</th>
        <th>PUESTO</th>
        <th>NOMINA</th>
        <th>EXT</th>
        <th >ROL</th>
        <th>ESTATUS</th>
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
      @foreach ($users2 as $users )
      <tr class="fw-light ">
        <td class="py-3 px-6 text-left" scope="row">{{$users->id}}</td>
        <td class="py-3 px-6 text-left">{{$users->name}}</td>
        <td class="py-3 px-6 text-left">{{$users->lastname}}</td>
        <td class="py-3 px-6 text-left">{{$users->email}}</td>
        <td class="py-3 px-6 text-left">{{$users->dto}}</td>
        <td class="py-3 px-6 text-left">{{$users->puesto}}</td>
        <td class="py-3 px-6 text-left">{{$users->nomina}}</td>
        <td class="py-3 px-6 text-left">{{$users->ext}}</td>
        <td class="py-3 px-6 text-left">
       @foreach ( $users->roles as  $rol)
         {{$rol->name}}
       @endforeach
        </td> 
        <td class="py-3 px-6 text-left">{{$users->active}}</td>
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
  <form class=" shadow p-3  rounded" method="POST"  action="EditarInfoUser" >
    @csrf
    <div class="mb-3">
      <label for="" class="form-label">ID</label>
      <input type="text" class="form-control" id="id" name="id" readonly >
    </div>
    <div class="mb-3">
      <label for="" class="form-label">NOMBRE(S)</label>
      <input type="text" class="form-control" id="nameu" name="nameu" >
    </div>
    <div class="mb-3">
      <label for="" class="form-label">APELLIDO(S)</label>
      <input type="text" class="form-control" id="lastnameu" name="lastnameu" >
    </div>
    <div class="mb-3">
      <label for="" class="form-label">CORREO</label>
      <input type="text" class="form-control" id="mailu" name="mailu" >
    </div>
    <div class="mb-3">
      <label for="" class="form-label">DEPARTAMENTO</label>
      <input type="text" class="form-control" id="dtou" name="dtou" >
    </div>
    <div class="mb-3">
        <label for="" class="form-label">PUESTO</label>
        <input type="text" class="form-control" id="puestou" name="puestou" >
      </div>
      <div class="mb-3">
        <label for="" class="form-label">NOMINA</label>
        <input type="text" class="form-control" id="nominau" name="nominau" >
      </div>
      <div class="mb-3">
        <label for="" class="form-label">EXT</label>
        <input type="text" class="form-control" id="extu" name="extu" >
      </div>
    <div class="mb-3">
      <label for="" class="form-label">ESTATUS</label>
      <select class="form-select" name="estatusu" id="estatusu">
        <option selected value="" disabled>SELECCIONA UNA OPCION</option>
       
        <option value="INACTIVO">INACTIVO</option>
        <option value="ACTIVO">ACTIVO</option>
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
<div class="container text-center">
  <div class="row">
    <div class="col-6">
      <div class="mt-4  shadow-lg rounded-lg text-left">
        <div class="h-2 bg-green-600 rounded-t-md"></div>
        <h5 class="h5 p-3 text-center">Cambiar contraseña de usuarios</h5>
        <div class="px-8 py-6 ">
          <form   action="{{route('UpdatePassword')}}" method="POST"  >
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Selecciona el usuario</label>
              <select class="form-select js-example-basic-single"  style="width: 100%" id="pasuser" name="pasuser" required >
                <option selected disabled value="">Selecciona una opcion</option>
                @foreach ($usersa as $usersa2)
          <option  value="{{$usersa2->id}}"> {{strtoupper($usersa2->name)}} {{strtoupper($usersa2->lastname)}}</option>
          @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label  class="form-label">Escribe la nueva contraseña</label>
              <input type="password" class="form-control" id="password1" name="password1" minlength="6" required>
            </div>
            <div class="mb-3">
              <label  class="form-label">Confirma la nueva contraseña</label>
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" minlength="6" required>
              <span id='message'></span>
            </div>
            <div class="d-flex justify-content-center"><button type="submit" id="passwbut" class="btn btn-dark" disabled>Aceptar</button></div>
          </form>
          {{-- comienza --}}
          {{-- termina --}}
        </div>
    </div>
    </div>
    <div class="col-6">
      <div class="mt-4  shadow-lg rounded-lg text-left">
        <div class="h-2 bg-green-600 rounded-t-md"></div>
        <h5 class="h5 p-3 text-center">Cambiar rol de usuario</h5>
        <div class="px-8 py-6 ">
          <form action="{{route('UpdateRole')}}"  method="POST">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Selecciona el usuario</label>
              <select class="form-select js-example-basic-single"  style="width: 100%"  id="upuser" name="upuser" required >
                <option selected disabled value="">Selecciona una opcion</option>
                @foreach ($usersa as $usersa)
          <option  value="{{$usersa->id}}"> {{strtoupper($usersa->name)}} {{strtoupper($usersa->lastname)}}</option>
          @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Rol de Usuario</label>
              <select class="form-control  " id="uprol" name="uprol" required >
                <option selected disabled value="">Selecciona una opcion</option>
                @foreach ($roles2 as $roles2)
          <option  value="{{$roles2->id}}"> {{strtoupper($roles2->name)}}</option>
          @endforeach
              </select>
            </div>
            <div class="d-flex justify-content-center"><button type="submit" class="btn btn-dark" >Aceptar</button></div>
          </form>
        </div>
    </div>
    </div>
    
  </div>
</div>


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
             nombre = $(this).parent().parent().children("td:eq(1)").text();
            apellido = $(this).parent().parent().children("td:eq(2)").text();
            correo= $(this).parent().parent().children("td:eq(3)").text();
           dto = $(this).parent().parent().children("td:eq(4)").text();
        rolx= $(this).parent().parent().children("td:eq(8)").text();
       puesto = $(this).parent().parent().children("td:eq(5)").text();
      nomina  = $(this).parent().parent().children("td:eq(6)").text();
      ext  = $(this).parent().parent().children("td:eq(7)").text();
      estatus  = $(this).parent().parent().children("td:eq(9)").text();
              //Cargamos en el formulario los valores del registro
              $("#id").val(id);
              $("#nameu").val(nombre);
              $("#lastnameu").val(apellido);
              $("#mailu").val(correo);
              $("#dtou").val(dto);
              $("#roleu").val(rolx);
              $("#estatusu").val(estatus);
              $("#puestou").val(puesto);
              $("#nominau").val(nomina);
              $("#extu").val(ext);
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