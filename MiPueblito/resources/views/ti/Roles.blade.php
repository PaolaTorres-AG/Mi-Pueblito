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
</style>
  <p style="font-weight: bold;color:#f2ca28; text-align: right;">¡BIENVENIDO {{Auth::user()->name}} {{Auth::user()->lastname}} !</p>
@stop

@section('content')
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <p class="alert alert-{{ $msg }}">{{Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->

<form  method="POST"  action="{{route('RolesRegister')}}" >
    @csrf
    {{--  --}}
    <div class="card ">
      <div class="card-header bg-gradient-to-tr  from-gray-500 to-gray-900 text-white font-bold ">
        CREAR UN NUEVO ROL 
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
  <i class="fa-solid fa-circle-info"></i>
</button>
      </div>
      <div class="card-body">
        <div class="container col-12">
          <div class="row col-12">
      <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                  <label for="exampleInputEmail1" class="form-label">Nombre del Rol</label>
                  <input type="text" class="form-control" id="name" name="name" value="" style="text-transform:uppercase;">
                  
     </div>
     <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
      <label for="exampleInputEmail1" class="form-label">Permisos</label>
      <br>
    @foreach ($permisos as $permisos)
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="permisos[]" id="{{$permisos->id}}" value="{{$permisos->id}}">
        <label class="form-check-label" for="{{$permisos->id}}">{{$permisos->name}}</label>
      </div>
    @endforeach
      
    </div>
      <div class="d-flex justify-content-center"><button type="submit" class="btn btn-dark">Aceptar</button></div>
        </div>
      </div>
      </div>
    </div>
    {{--  --}}
  </form>
{{-- ///////////////////////////////////////////////////////////////////////////////--}}

<!-- component -->
<!-- component -->

          <div class=" shadow-md rounded my-6">
              <table class="min-w-max w-full table-auto">
                  <thead>
                      <tr class="bg-gradient-to-tr  from-gray-500 to-gray-900  rounded-md py-2 px-4 text-white font-bold text-md">
                          <th class="py-3 px-6 text-left rounded-l-lg ">ID</th>
                          <th class="py-3 px-6 text-left  ">ROL</th>
                         
                          <th class="py-3 px-6 text-center rounded-r-lg ">Actions</th>
                      </tr>
                  </thead>
                  @foreach ($roles as $roles)
                  <tbody class=" text-sm font-light">
                      <tr class="border-b border-gray-200 hover:bg-gray-100">
                          <td class="py-3 px-6 ">
                            {{$roles->id}}
                          </td>
                          <td class="py-3 px-6 ">
                            {{$roles->name}}
                          </td>
                         
                          <td class="py-3 px-6 text-center">
                            <a  href="{{ URL::route('EditRol', $roles->id) }}" target="_blank">
                         
                              <div class="flex item-center justify-center">
                                 
                                  <div class="w-4 mr-2 transform hover:text-green-400 text-green-600 hover:scale-110">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                      </svg>
                                  </div>
                                 
                              </div>
                            </a>
                          </td>
                      </tr>
                  </tbody>
                  @endforeach
              </table>
          </div>
     

{{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////7 --}}

<!---->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">PERMISOS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
             <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto text-xs">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">PERMISO</th>
                                <th class="py-3 px-6 text-left">MODULO</th>
                                <th class="py-3 px-6 text-center">ACCION</th>

                            </tr>
                        </thead>
 <tbody class="text-gray-600 text-sm font-light">
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">ROLES</td>
<td class="py-3 px-6 text-left">ROLES </td>
<td class="py-3 px-6 text-center">ACCESO AL MODULO ROLES </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">NUEVOS-USUARIOS </td>
<td class="py-3 px-6 text-left">USUARIOS </td>
<td class="py-3 px-6 text-center">ACCESO AL MODULO USUARIOS </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">PRODUCTOS </td>
<td class="py-3 px-6 text-left">PRODUCTOS  </td>
<td class="py-3 px-6 text-center">ACCESO AL MODULO PRODCUTOS </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">METODOS </td>
<td class="py-3 px-6 text-left">METODOS </td>
<td class="py-3 px-6 text-center">ACCESO AL MODULO METODOS </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">SGC </td>
<td class="py-3 px-6 text-left">SGC  </td>
<td class="py-3 px-6 text-center">ACCESO AL MODULO SGC </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">ADMIN-SOLICITUDES </td>
<td class="py-3 px-6 text-left">ADMINISTRAR SEGUIMIENTO  </td>
<td class="py-3 px-6 text-center">ACCESO PARA ASINGAR ANALISIS A UNA SOLICITUD </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">ADMIN-SEGUIMIENTO </td>
<td class="py-3 px-6 text-left">ADMINISTRAR SEGUIMIENTO </td>
<td class="py-3 px-6 text-center">VER SOLICITUDES </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">SOLICITAR-ANALISIS </td>
<td class="py-3 px-6 text-left">SOLICITAR ANALISIS </td>
<td class="py-3 px-6 text-center">ACCESO PARA CREAR SOLICITUDES </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">MIS-SOLICITUDES </td>
<td class="py-3 px-6 text-left">SOLICITUDES ENVIADAS
 </td>
<td class="py-3 px-6 text-center">ACCESO AL BUSCADOR DE USUARIOS AGROIN
 </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">RECEPCIONES </td>
<td class="py-3 px-6 text-left">RECEPCION </td>
<td class="py-3 px-6 text-center">ACCESO AL MODULO RECEPCIONES </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">EDICION-RAPIDA</td>
<td class="py-3 px-6 text-left">EDICION RAPIDA </td>
<td class="py-3 px-6 text-center">ACCESO AL MODULO EDICION RAPIDA </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">HISTORIAL-LAB </td>
<td class="py-3 px-6 text-left">HISTORIAL </td>
<td class="py-3 px-6 text-center">ACCESO AL MODULO HISTORIAL </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">EDITAR-RESULTADOS </td>
<td class="py-3 px-6 text-left">EDICION RAPIDA </td>
<td class="py-3 px-6 text-center">PERMITE EDITAR LOS RESULTADOS MAS DE UNA VEZ
 </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">ADMIN </td>
<td class="py-3 px-6 text-left">TITULO DEL MENU </td>
<td class="py-3 px-6 text-center">MUESTRA EL TITULO EN EL MENU </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">AGROIN </td>
<td class="py-3 px-6 text-left">TITULO DEL MENU </td>
<td class="py-3 px-6 text-center">MUESTRA EL TITULO EN EL MENU </td>
</tr>
<!---->
<tr class="border-b border-gray-200 hover:bg-gray-100">
 <td class="py-3 px-6 text-left whitespace-nowrap">ANALISTAS </td>
<td class="py-3 px-6 text-left">TITULO DEL MENU </td>
<td class="py-3 px-6 text-center">MUESTRA EL TITULO EN EL MENU</td>
</tr>


                           
                            
                        </tbody>
                    </table>
                </div>
            </div>
      </div>
      
    </div>
  </div>
</div>
<!---->
@stop
@section('css')

<link rel="icon" href="{{asset('images/icono.png')}}">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@300&family=Poiret+One&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>
    <!-- Buttons -->
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
     
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    </script>
   <script type="text/javascript">
    $(document).ready(function () {
        $('#mydatatable tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="Filtrar.."  style="font-size: 8px;"/>');
        });
        var table = $('#mydatatable').DataTable({
            "dom": 'B<"float-left"l><"float-right"f>t<"float-left"i><"float-right"p><"clearfix">',
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
            "buttons": [ ]
        });
    });
</script>
<script>
    $("body").on("click", "#mydatatable a", function(event) {
        event.preventDefault();
        idsele = $(this).attr("href");
        id= $(this).parent().parent().children("td:eq(0)").text();
        $("#rid").val(id);
        $("#eid").val(id);
        eliminaEspacio();
    });
    function eliminaEspacio(){

$('input').val(function(_, value) {
return $.trim(value);
});

$('textarea').val(function(_, value) {
return $.trim(value);
});
}
    </script>

@stop
@endcan