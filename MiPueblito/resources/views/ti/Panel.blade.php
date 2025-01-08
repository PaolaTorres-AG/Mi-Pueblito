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
 #mydatatable tfoot {
          display: table-header-group !important;
      }
      #mydatatable tfoot {
          display: table-header-group !important;
      }
</style>
@section('content')
{{-- termina indicadores de validaciones --}}
<br> 
<div class="card container col-sm-12 col-md-12 col-lg-10  p-4 rounded">
  <div class="main-body">
        <div class="row gutters-sm">
          @foreach ($info as $info)
          <div class="col-md-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <img src="{{asset('images/icono.png')}}" alt="Admin" class="" width="200">
          
                  <div class="mt-3">
                    <h4>{{$info->name}}</h4>
                    <p class="text-secondary mb-1">{{$info->dto}}</p>
                 
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">N# NOMINA:</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                      {{$info->nomina}}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">CORREO:</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                      {{$info->email}}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">EXT:</h6>
                  </div>
                  <div class="col-sm-9 text-secondary ">
                      {{$info->ext}} 
                  </div>
                </div>
                   <hr>
                  <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">PUESTO:</h6>
                  </div>
                  <div class="col-sm-9 text-secondary ">
                      {{$info->puesto}} 
                  </div>
                </div>
          
                @endforeach
              </div>
            </div>
</div>
</div>
</div>
  </div>
 {{----NUEVO----}}
 {{-- <div class="container text-center mt-4">
  <div class="row justify-content-between">
      
    <div class="col-sm-6 " >
            <div style="background:#6b8108" class="p-2">
       <div class="card w-100 mx-auto bg-white  shadow-xl hover:shadow p-4 " >
     <div class="text-center font-normal text-lg mt-4">Departamento de Sistemas <i class="fa fa-laptop fa-lg" aria-hidden="true"></i></div>
<ul class="text-left font-normal text-sm mt-1 list-style">
<li>*Incidencias</li>
<li>*Solicitudes de equipos </li>
<li>*Acesso a sistemas </li>
<li> </li>
</ul>
     <hr class="mt-4">
       <div class="d-flex justify-content-center mb-2 mt-0">
        <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#exampleModal" style="background:#6b8108; color:white">Crear Solicitud</button>
       </div>
  </div>
  </div>
    </div>
    <div class="col-sm-6  " >
        <div style="background:#384906" class="p-2">
      <div class="card w-100 mx-auto bg-white  shadow-xl hover:shadow p-4">
    <div class="text-center font-normal text-lg mt-4">Mantenimiento y Proyectos <i class="fa fa-tools fa-lg" aria-hidden="true"></i></div>
    <ul class="text-left font-normal text-sm mt-1 list-style">
<li>*Nuevos Proyectos</li>
<li>*Mantenimiento exteriores </li>
<li>*Mantenimiento electrico </li>
<li> </li>
</ul>
    <hr class="mt-8">
      <div class="d-flex justify-content-center mb-2 mt-0">
       <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal2" style="background:#384906; color:white">Crear Solicitud</button>
      </div>
 </div>
 </div>
    </div>
    
  </div>
</div> --}}
   {{-- termina carta --}}
   {{-- <div class="container text-center mt-2 p-3 rounded-md" >
    <div class="row">
      <div class="col">
        <div class="card text-center mb-3 shadow-lg" >
          <div class="card-body" >
            
          <div class="text-center font-normal text-lg mt-4">Departamento de Sistemas <i class="fa fa-laptop fa-lg" aria-hidden="true"></i></div>
          <ul class="text-left font-normal text-sm list-style">
            <li>Gestion de control documental </li>
            </ul>
            <hr class="">
              <div class="d-flex justify-content-center mb-2 ">
               <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal2" style="background:#384906; color:white">Ver mas...</button>
              </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card text-center mb-3 shadow-lg">
          <div class="card-body">
            <div class="text-center font-normal text-lg mt-4">Mantenimiento y Proyectos <i class="fa fa-tools fa-lg" aria-hidden="true"></i></div>
            <hr class="mt-8">
              <div class="d-flex justify-content-center mb-2 mt-0">
               <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal2" style="background:#384906; color:white">Ver mas...</button>
              </div>
          </div>
        </div>
      </div>
      
   
    </div> --}}
    {{--  --}}
    {{-- <div class="row" >
      <div class="col">
        <div class="card text-center mb-3 shadow-lg" >
          <div class="card-body">
            
          <div class="text-center font-normal text-lg mt-4">SGC <i class="fa fa-circle-check fa-lg" aria-hidden="true"></i></div>
          <ul class="text-left font-normal text-sm list-style">
            <li>Gestion de control documental </li>
            </ul>
            <hr class="">
              <div class="d-flex justify-content-center mb-2 ">
               <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal2" style="background:#384906; color:white">Ver mas...</button>
              </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card text-center mb-3 shadow-lg">
          <div class="card-body">
            <div class="text-center font-normal text-lg mt-4">COMPRAS <i class="fa fa-cart-shopping fa-lg" aria-hidden="true"></i></div>
            <hr class="mt-8">
              <div class="d-flex justify-content-center mb-2 mt-0">
               <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal2" style="background:#384906; color:white">Ver mas...</button>
              </div>
          </div>
        </div>
      </div>
      
      <div class="col">
        <div class="card text-center mb-3 shadow-lg" >
          <div class="card-body">
            <div class="text-center font-normal text-lg mt-4">LABORATORIO <i class="fa fa-flask fa-lg" aria-hidden="true"></i></div>
            <hr class="mt-8">
              <div class="d-flex justify-content-center mb-2 mt-0">
               <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal2" style="background:#384906; color:white">Ver mas...</button>
              </div>
          </div>
        </div>
      </div>
    </div>
    
  </div> --}}
{{--  --}}
   <br>
   <div class="table-responsive  border-4 shadow-lg rounded-lg p-4" id="mydatatable-container" style="border-color:#F09F29">
    <h4 class="m-3 text-center">DIRECTORIO</h4>
    <hr>
    <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
        <thead>
<tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal" style="color:#516407">
                <th class="py-3 px-6 text-left">DTO</th>
                <th class="py-3 px-6 text-left">NOMBRE</th>
                <th class="py-3 px-6 text-left">PUESTO</th>
                <th class="py-3 px-6 text-center">CORREO</th>
                <th class="py-3 px-6 text-center">EXT</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
            </tr>
        </tfoot>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach ($directorio as $directorio)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">
                    <div class="flex items-center">
                      
                        <span class="font-light">{{$directorio->dto}}</span>
                    </div>
                </td>
                <td class="py-3 px-6 text-left whitespace-nowrap">
                    <div class="flex items-center">
                      
                        <span class="font-light">{{$directorio->name}} {{$directorio->lastname}}</span>
                    </div>
                </td>
                <td class="py-3 px-6 text-left whitespace-nowrap">
                    <div class="flex items-center">
                      
                        <span class="font-light">{{$directorio->puesto}}</span>
                    </div>
                </td>
                <td class="py-3 px-6 text-left whitespace-nowrap">
                    <div class="flex items-center">
                      
                        <span class="font-light ">{{$directorio->email}}</span>
                    </div>
                </td>
                <td class="py-3 px-6 text-left whitespace-nowrap">
               <p class="font-light text-center">{{$directorio->ext}}</p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
      $('#mydatatable tfoot th').each(function () {
          var title = $(this).text();
          $(this).html('<input type="text" class="form-control" placeholder="Filtrar.."  style="font-size: 12px;"/>');
      });

      var table = $('#mydatatable').DataTable({
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
              titleAttr: 'Descargar información en excel'
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
@stop