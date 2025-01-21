
@extends('adminlte::page')

@section('title', 'Agroin')

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
@stop

@section('content')
<div class="alert  text-center text-lg fw-bold text-white" style="background-color: #F09F29" role="alert">
  Pases de salida
</div>
<div class="flash-message">
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
   
    <p class="alert alert-{{ $msg }}">{{Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
  @endforeach
</div> <!-- end .flash-message -->
{{-- tabla --}}
<div class="card p-3">
  <div class="table-responsive" id="mydatatable-container">
      <table class="records_list table table-striped table-bordered table-hover rounded-3" id="mydatatable">
          <thead>
              <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                  <th class="py-3 px-6 text-left">ID</th>
                  <th class="py-3 px-6 text-center">NOMBRE</th>
                  <th class="py-3 px-6 text-center">SALIDA SM</th>
                  <th class="py-3 px-6 text-center">MOTIVO</th>
                  <th class="py-3 px-6 text-center">AUTORIZO</th>
                  <th class="py-3 px-6 text-center">SALIDA MI PUEBLITO</th>
                  <th class="py-3 px-6 text-center">RECETA</th>
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
              </tr>
          </tfoot>
          <tbody class="text-gray-600 text-sm font-light"> 
              @foreach ($pases as $pases)
              <tr>
              <td class="py-3 px-6 text-center">{{$pases->id}}</td>
              <td class="py-3 px-6 text-center">{{$pases->nombre}}</td>
              <td class="py-3 px-6 text-center">{{$pases->horasm}}</td>
              <td class="py-3 px-6 text-center">{{$pases->motivo}}</td>
              <td class="py-3 px-6 text-center">{{$pases->autorizo}}</td>
             
              @if($pases->horagro=='')
              <td class="py-3 px-6 text-center"><a>
                  <div class="flex item-center justify-center">
                    <button class="w-4 mr-2 transform hover:text-blue-500 hover:scale-130" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                </div>
              </a></td>
              @else
               <td class="py-3 px-6 text-center">{{$pases->horagro}}</td>
              @endif
               @if($pases->receta=='')
               <td class="py-3 px-6 text-center">No hay archivo adjunto</td>
               @else
               <td class="py-3 px-6 text-center"><button class="btn btn-primary" type="button" onclick="location.href='{{$pases->receta}}'"><i class="fa-solid fa-file-prescription"></i></button></td>
               @endif

              </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar salida de colaborador</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="shadow p-3 mb-5 bg-body-tertiary rounded" method="POST" action="{{route('Vigilancia')}}" enctype="multipart/form-data">
          @csrf
      <div class="row">

   
          <input type="hidden" class="form-control" id="idu" name="idu" required>
          <input type="hidden" class="form-control" id="fecha" name="fecha" required value="<?php date_default_timezone_set('America/Mexico_City'); echo date("d-m-Y H:i"); ?>" >
     
        <div class="d-grid gap-2 col-4 mx-auto mt-4">
          <button class="btn bg-primary" type="submit">Aceptar</button>
        </div>
      </div>
  </form>
      </div>
     
    </div>
  </div>
</div>


  @can('INFORME-SM')
  
  <div class="alert  text-center text-lg fw-bold text-white" style="background-color: #F09F29" role="alert">
    Historial de pases de salida
  </div>
  <div class="card">
    <div class="card-header">
   
    </div>
    <div class="card-body">
        <div class="container text-center ">
            <div class="row">
              
              <div class="col-sm-12 col-md-12 col-lg-12">
               <form class="shadow p-3 mb-5 bg-body-tertiary rounded" method="POST" action="{{route('ListaPaseSalida')}}"  enctype="multipart/form-data">
                @csrf
                        <div class="container text-center">
                            <div class="row">
                              <div>
                                <p class="text-center  font-bold form-label">Periodo:  {{$periodo}}</p>
                              </div>
                              <div class="col">
                                <label class="form-label">De:</label>
                                <input type="date" class="form-control" id="de" name="de" required>
                              </div>
                              <div class="col">
                                <label class="form-label">Hasta:</label>
                                <input type="date" class="form-control" id="hasta" name="hasta" required>
                              </div>
                            
                            </div>
                          </div>
                          <div class="d-grid gap-2 col-6 mx-auto mt-3">
                            <button class="btn text-white" type="submit" style="background-color: #F09F29">Buscar</button>
                            
                          </div>
                        </form>
              </div>
              <div class="col-sm-4 col-md-4 col-lg-4 ">
                <div class="card text-center mb-3 " >
                    <div class="card-body   shadow-lg">
                      <h5 class="card-title text-center  font-bold" style="color: #F09F29">  Total de pases de salida</h5>
                     <hr style="color: white">
                      <p class="text-center  font-bold text-lg">{{$enf->total + $interna->total}}</p>
               
                    </div>
                  </div>
              </div>
              <div class="col-sm-4 col-md-4 col-lg-4 ">
                <div class="card text-center mb-3 " >
                    <div class="card-body   shadow-lg">
                      <h5 class="card-title text-center font-bold" style="color: #F09F29">Pases de salida por Enf. general (IMSS)</h5>
                     <hr style="color: white">
                      <p class="text-center  font-bold text-lg">{{$enf->total}}</p>
                    </div>
                  </div>
              </div>
              <div class="col-sm-4 col-md-4 col-lg-4 ">
                <div class="card text-center mb-3 " >
                    <div class="card-body   shadow-lg">
                      <h5 class="card-title text-center font-bold" style="color: #F09F29">Pases de salida por incapacidad interna</h5>
                     <hr style="color: white">
                      <p class="text-center  font-bold text-lg">{{$interna->total}}</p>
                    </div>
                  </div>
              </div>
            </div>
          </div>
    </div>
    
    
  </div>
  @endcan
  

@can('INFORME-SM')
 
  <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
     
      <p class="alert alert-{{ $msg }}">{{Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->
  {{-- tabla --}}
  <div class="card p-3">
    <div class="table-responsive" id="mydatatable-container">
        <table class="records_list table table-striped table-bordered table-hover rounded-3" id="mydatatableh">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-center">NOMBRE</th>
                    <th class="py-3 px-6 text-center">SALIDA SM</th>
                    <th class="py-3 px-6 text-center">MOTIVO</th>
                    <th class="py-3 px-6 text-center">AUTORIZO</th>
                    <th class="py-3 px-6 text-center">SALIDA MI PUEBLITO</th>
                    <th class="py-3 px-6 text-center">RECETA</th>
                </tr>
            </thead>
        
            <tbody class="text-gray-600 text-sm font-light"> 
                @foreach ($paseshistorico as $paseshistoricos)
                <tr>
                <td class="py-3 px-6 text-center">{{$paseshistoricos->id}}</td>
                <td class="py-3 px-6 text-center">{{$paseshistoricos->nombre}}</td>
                <td class="py-3 px-6 text-center">{{$paseshistoricos->horasm}}</td>
                <td class="py-3 px-6 text-center">{{$paseshistoricos->motivo}}</td>
                <td class="py-3 px-6 text-center">{{$paseshistoricos->autorizo}}</td>
               
                @if($paseshistoricos->horagro=='')
                <td class="py-3 px-6 text-center">
                  Salida en proceso
                </td>
                @else
                 <td class="py-3 px-6 text-center">{{$paseshistoricos->horagro}}</td>
                @endif
                 @if($paseshistoricos->receta=='')
                 <td class="py-3 px-6 text-center">No hay archivo adjunto</td>
                 @else
                 <td class="py-3 px-6 text-center"><button class="btn btn-primary" type="button" onclick="location.href='{{$pases->receta}}'"><i class="fa-solid fa-file-prescription"></i></button></td>
                 @endif
 
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
  </div>




  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar salida de colaborador</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="shadow p-3 mb-5 bg-body-tertiary rounded" method="POST" action="{{route('Vigilancia')}}" enctype="multipart/form-data">
            @csrf
        <div class="row">
 
     
            <input type="hidden" class="form-control" id="idu" name="idu" required>
            <input type="hidden" class="form-control" id="fecha" name="fecha" required value="<?php date_default_timezone_set('America/Mexico_City'); echo date("d-m-Y H:i"); ?>" >
       
          <div class="d-grid gap-2 col-4 mx-auto mt-4">
            <button class="btn bg-primary" type="submit">Aceptar</button>
          </div>
        </div>
    </form>
        </div>
       
      </div>
    </div>
  </div>
@endcan

@stop
@section('css')
<link rel="icon" href="{{asset('images/icono.png')}}">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@300&family=Poiret+One&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" >
<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" >
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet" >
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet" >
@stop

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
{{-- datatables --}}
<script src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 
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
        
        ],
      });
  });
</script>
<script type="text/javascript">
  $(document).ready(function () {
      $('#mydatatable tfoot th').each(function () {
          var title = $(this).text();
          $(this).html('<input type="text" class="form-control" placeholder="Filtrar.."  style="font-size: 12px;"/>');
      });

      var table = $('#mydatatableh').DataTable({
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
        
        ],
      });
  });
</script>
      <script>
        $("body").on("click", "#mydatatable a", function(event) {
            event.preventDefault();
            idsele = $(this).attr("href");
            id= $(this).parent().parent().children("td:eq(0)").text();
         
  
            $("#idu").val(id);
         
         
        });
        </script>
@stop