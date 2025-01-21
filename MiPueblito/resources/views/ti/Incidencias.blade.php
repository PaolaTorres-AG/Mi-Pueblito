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
    #mydatatable-container tfoot {
            display: table-header-group !important;
        }
        #mydatatable-container tfoot {
            display: table-header-group !important;
        }
        #mydatatable2 tfoot {
            display: table-header-group !important;
        }
        #mydatatable2 tfoot {
            display: table-header-group !important;
        }
        </style>

   <!--Incidencias por Asignar-->
@stop
@section('content')
<div class="flash-message">
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
   
    <p class="alert alert-{{ $msg }}">{{Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
  @endforeach
</div> 
    <p class="m-2">INCIDENCIAS POR ASIGNAR</p>
    <div class="table-responsive bg-white p-4 rounded" id="mydatatable-container">
        <table class="records_list table table-striped text-sm table-bordered table-hover" id="mydatatable">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="">FOLIO</th>
                    <th class="">USUARIO</th>
                    <th class="">PRIORIDAD</th>
                    <th class="">INCIDENCIA</th>
                    <th class="">DESCRIPCION</th>
                    <th class="">DEPARTAMENTO</th>
                    <th class="">IMAGEN</th>
                    <th class="">FECHA</th>
                    <th class="">ASIGNAR</th>
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
            
                </tr>
            </tfoot>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($incidencias as $incidencias)
                <tr class="border-b border-gray-200 hover:bg-gray-100">

                    <td class="">
                        <div class="flex items-center">
                        
                            <span class="font-light">{{$incidencias->id}}</span>
                        </div>
                    </td>

                    <td class="">
                        <div class="flex items-center">
                        
                            <span class="font-light">{{$incidencias->username}}</span>
                        </div>
                    </td>
                    @if ($incidencias->prioridad =="ALTO")
                    <td class="text-center">
                        <span class="rounded bg-red-400 py-1 px-3 text-xs font-bold">{{$incidencias->prioridad}}</span>
                    </td>
                        @endif
                        @if ($incidencias->prioridad =="MEDIO")
                        <td class="text-center">
                                <span class="rounded bg-yellow-400 py-1 px-3 text-xs font-bold">{{$incidencias->prioridad}}</span>
                        </td>
                            @endif
                            @if ($incidencias->prioridad =="BAJO")
                            <td class="text-center">
                                <span class="rounded bg-blue-400 py-1 px-3 text-xs font-bold">{{$incidencias->prioridad}}</span>
                            </td>
                                @endif

                    <td class="">
                        <div class="flex items-center">
                            <span class="font-light">{{$incidencias->t_incidencia}}</span>
                        </div>
                    </td>
                    <td class=" text-left">
                        <div class="flex items-center">
                        
                            <span class="font-light">{{$incidencias->descripcion}}</span>
                        </div>
                    </td>
                    <td class=" text-left">
                        <div class="flex items-center">
                        
                            <span class="font-light">{{$incidencias->dto}}</span>
                        </div>
                    </td>
                    <td class=" text-left">
                        <div class="flex items-center">
                            @if ($incidencias->imagen =="" || $incidencias->imagen==NULL)
                            <span class="font-light"><p>Sin evidencia</p></span> 
                            @else
                            <span class="font-light"><button type="button" onclick="window.open('{{route('ImgIncidencia',$incidencias->id)}}', '_blank')"   ><p style="color: rgb(7, 101, 251);">Imagen</p></button></span>
                            @endif
                        
                        </div>
                    </td>
                    <td class="">
                        <div class="flex items-center">
                        
                            <span class="font-light">{{$incidencias->created_at}}</span>
                        </div>
                    </td>
                    <td class="">
                        <a class="btn btn-light" href="" name="idsele" data-toggle="modal" data-target="#exampleModal" role="tab">
                          <i class="fa fa-cogs"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
         {{--tabla incidencias asiganadas  --}}
         <p class="m-2">INCIDENCIAS ASIGNADAS</p>
         <div class="table-responsive bg-white p-4 rounded" id="mydatatable2-container">
            <table class="records_list table table-striped table-bordered table-hover" id="mydatatable2">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="">FOLIO</th>
                        <th class="">USUARIO</th>
                          <th class="">DTO</th>
                        <th class="">PRIORIDAD</th>
                        <th class="">INCIDENCIA</th>
                        <th class="">DESCRIPCION</th>
                          <th class="">IMAGEN</th>
                        <th class="">FECHA</th>
                        <th class="">ASIGNADO</th>
                        <th class="">SETTINGS</th>
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
                    </tr>
                </tfoot>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($incidenciasasignadas as $asig)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">

                        <td class="">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$asig->id}}</span>
                            </div>
                        </td>

                        <td class="">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$asig->username}}</span>
                            </div>
                        </td>
                          <td class="">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$asig->dto}}</span>
                            </div>
                        </td>
                        @if ($asig->prioridad =="ALTO")
                        <td class=" text-center">
     <span class="rounded bg-red-400 py-1 px-3 text-center  text-xs font-bold">{{$asig->prioridad}}</span>   
                        </td>
                            @endif
                            @if ($asig->prioridad =="MEDIO")
                            <td class=" text-center">
     <span class="rounded bg-yellow-400 py-1 px-3 text-xs font-bold">{{$asig->prioridad}}</span>  
                            </td>
                                @endif
                                @if ($asig->prioridad =="BAJO")
                                <td class="text-center">
     <span class="rounded bg-blue-400 py-1 text-center px-3 text-xs font-bold">{{$asig->prioridad}}</span>  
                                </td>
                                    @endif

                        <td class="">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$asig->t_incidencia}}</span>
                            </div>
                        </td>
                        <td class=" ">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$asig->descripcion}}</span>
                            </div>
                        </td>
                            <td class="">
                                <div class="flex items-center">
                                    @if ($asig->imagen =="" || $asig->imagen==NULL)
                                    <span class="font-light"><p>Sin evidencia</p></span> 
                                    @else
                                    <span class="font-light"><button type="button" onclick="window.open('{{route('ImgIncidencia',$asig->id)}}', '_blank')"   ><p style="color: rgb(7, 101, 251);">Imagen</p></button></span>
                                    @endif
                                 
                                </div>
                            </td>
                        <td class="">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$asig->created_at}}</span>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center">
                                <span class="font-light">{{$asig->asignado}}</span>
                            </div>
                        </td>

                        <td class="">
                              <a class="btn btn-light" href="" name="idsele" data-toggle="modal" data-target="#exampleModala" role="tab">
                                <i class="fa fa-cogs"></i>
                              </a>
                        </td>
                        
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
         {{-- modal para asignar --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
           
            </div>
            <div class="modal-body">
              <form method="POST"  action="{{route('Asignar')}}">
                @csrf
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-danger me-md-2" type="button" id="banear" onclick="baner()"><i class="fa fa-solid fa-ban"></i></button>   
                </div>
                <!---->
                
                <input type="hidden" id="idt" name="idt">
                <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                    <label for="exampleInputEmail1" class="form-label">Asignar a Usuario:</label>
                    <select class="form-select js-example-basic-multiple" name="user" id="user"  required>
                        <option selected disabled>Selecciona el usuario</option>
                            @foreach ($users as $user)
                                <option  value="{{$user->name}}"> {{strtoupper($user->name)}} {{strtoupper($user->lastname)}}</option>
                            @endforeach
                    </select>
                </div>
            
                <div class="mt-4 d-flex justify-content-center">
                  <button type="submit" class="btn btn-dark">GUARDAR</button>                 
                </div>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal  asignacion completada-->
<div class="modal fade" id="exampleModala" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
           
            </div>
            <div class="modal-body">
              <form method="POST"  action="{{route('CompletarSoporte')}}">
                @csrf
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-danger me-md-2" type="button" id="banear" onclick="baner()"><i class="fa fa-solid fa-ban"></i></button>   </div>
                <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                    <label for="exampleInputEmail1" class="form-label">FOLIO</label>
                    <input type="text" class="form-control" id="folio" name="folio" readonly>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                    <label for="exampleInputEmail1" class="form-label">CLASIFICACION</label>
                    <select class="form-select js-example-basic-multiple" name="clasificacion" id="clasificacion"  required="true">
                        <option selected disabled>Selecciona una opcion</option>
                        <option  value="Equipo nuevo o reasignación">Equipo nuevo o reasignación</option>
                        <option  value="Soporte general de equipos">Soporte general de equipos</option>
                        <option  value="Acceso a aplicaciones">Acceso a aplicaciones</option>
                        <option  value="Soporte a aplicaciones">Soporte a aplicaciones</option>
                        <option  value="Acceso a impresoras">Acceso a multifuncionales y impresoras</option>
                        <option  value="Soporte a impresoras">Soporte a multifuncionales y impresoras</option>
                        <option  value="Acceso a internet">Acceso a internet</option>
                        <option  value="Cámaras de vigilancia">Cámaras de vigilancia</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                    <label for="exampleInputEmail1" class="form-label">SOLUCION PLANTEADA</label>
                    <textarea class="form-control"  id="obs" name="obs" required maxlength="800"></textarea>
                  </div>
                  <!---->
                   {{-- <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                    <label for="exampleInputEmail1" class="form-label">FECHA</label>
                    <input type="text" name="datetimes" id="datetimes" class="form-control"  />
                  </div> --}}
                  <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                    <label for="exampleInputEmail1" class="form-label">TIEMPO EN QUE SE SOLUCIONO</label>
                    <select name="tiempo_a_agregar" class="form-select js-example-basic-multiple" name="clasificacion" id="clasificacion"  required="true">
                        <option selected disabled>Selecciona una opción</option>
                        <option value="5">5 min</option>
                        <option value="10">10 min</option>
                        <option value="20">20 min</option>
                        <option value="40">40 min</option>
                        <option value="60">1 hr</option>
                        <option value="180">3 hr</option>
                        <option value="300">5 hr</option>
                        <option value="480">8 hr</option>
                        <option value="1440">1 día</option>
                        <option value="2880">2 días</option>
                        <option value="4320">3 días</option>
                        <option value="5760">4 días</option>
                        <option value="7200">1 semana</option>
                        <option value="14400">2 semanas</option>
                        <option value="21600">3 semanas</option>
                    </select>
                </div>  
                  <!---->
                  <!--<div class="col-sm-12 col-md-12 col-lg-12 mb-4">-->
                  <!--  <label for="exampleInputEmail1" class="form-label">FECHA Y HORA DE COMIENZO</label>-->
                  <!--  <input type="datetime-local" class="form-control" id="fin" name="fin" required>-->
                  <!--</div>-->
                  <!--<div class="col-sm-12 col-md-12 col-lg-12 mb-4">-->
                  <!--  <label for="exampleInputEmail1" class="form-label">FECHA Y HORA DE FINALIZACION</label>-->
                  <!--  <input type="datetime-local" class="form-control" id="empieso" name="empieso" required>-->
                  <!--</div>-->
                <div class="mt-4 d-flex justify-content-center">
                  <button type="submit" class="btn btn-dark">GUARDAR</button>                 
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
   <form method="POST"  action="{{route('Cancelar')}}" id="fcancel" style="display:none">
                @csrf
     
                <!---->
                
                <input type="text" id="idtx" name="idtx">
               
            
                <div class="mt-4 d-flex justify-content-center">
                  <button type="submit" class="btn btn-dark">GUARDAR</button>                 
                </div>
              </form>
@stop

@section('css')
<link rel="icon" href="{{asset('images/icono.png')}}">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@300&family=Poiret+One&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" >
{{-- datatables --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" >
<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" >
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet" >
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet" >
<!--piker-->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <!--pikers-->
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
      <script>
        $(function() {
          $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            showDropdowns: true,
        drops: "up",
        timePicker24Hour: true,
            locale: {
              format: 'YYYY-MM-DD hh:mm '
            }
          });
        });
        </script>
  
    <script>
        $("body").on("click", "#mydatatable a", function(event) {
            event.preventDefault();
            idsele = $(this).attr("href");
            id= $(this).parent().parent().children("td:eq(0)").text();
        
            //Cargamos en el formulario los valores del registro
        
            $("#idt").val(id);
              $("#idtx").val(id);
            eliminaEspacio();
        });
        function eliminaEspacio(){
    
    $('input').val(function(_, value) {
    return $.trim(value);
    });
    
    }
        </script>
         <script>
            $("body").on("click", "#mydatatable2 a", function(event) {
                event.preventDefault();
                idsele = $(this).attr("href");
                id= $(this).parent().parent().children("td:eq(0)").text();
                //Cargamos en el formulario los valores del registro
                $("#folio").val(id);
                   $("#idtx").val(id);
                eliminaEspacio();
            });
          
            </script>
   <script type="text/javascript">
    $(document).ready(function () {
        $('#mydatatable tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="Filtrar.."  style="font-size: 12px;"/>');
        });

        var table = $('#mydatatable').DataTable({
            "dom": 'B<"float-left"><"float-right"f>t<"float-left"l><"float-right"p><"clearfix">',
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#mydatatable2 tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="Filtrar.."  style="font-size: 8px;"/>');
        });

        var table = $('#mydatatable2').DataTable({
            "dom": 'B<"float-left"><"float-right"f>t<"float-left"l><"float-right"p><"clearfix">',
            "responsive": false,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            "order": [
                [2, "asc"]
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
<script>
function baner()
{
 Swal.fire({
  title: 'Estás seguro de cancelar la solicitud?',
  text: "...",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar',
}).then((result) => {
  if (result.isConfirmed) {
     var selectedForm=document.getElementById("fcancel");
  selectedForm.submit();
  }
})   
}
</script>
@stop
@endcan