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
table.dataTable td {
  font-size: 1em;
}
#mydatatable tfoot {
            display: table-header-group !important;
        }
        
   </style>
@stop
<p style="font-weight: bold;color:#f2ca28; text-align: right;">¡BIENVENIDO {{Auth::user()->name}} {{Auth::user()->lastname}} !</p>
     
@section('content')
    <div class="container col-12">
  <div class="row col-12">
{{-- grafica de soportes x usuarios --}}
  <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <figure class="highcharts-figure">
        <div id="container"></div>
      </figure>
 </div>
 <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <figure class="highcharts-figure">
        <div id="container2"></div>
      </figure>
 </div>
  <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
    <figure class="highcharts-figure">
        <div id="container3"></div>
      </figure>
 </div>
    </div>
  </div>
{{--  --}}
<div class="card">
    <h5 class="card-header">Lista de equipos </h5>
    <div class="card-body">
        <div class="table-responsive" id="mydatatable-container">
            <table class="records_list table table-striped table-bordered table-hover" id="mydatatable">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                          <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">USUARIO</th>
                        <th class="py-3 px-6 text-left">NOMBRE EQUIPO</th>
                        <th class="py-3 px-6 text-left">IP</th>
                           <th class="py-3 px-6 text-center">MAC</th>
                              <th class="py-3 px-6 text-center">PROCESADOR</th>
                        <th class="py-3 px-6 text-center">MEMORIA</th>
                        <th class="py-3 px-6 text-center">DISCO</th>
                         <th class="py-3 px-6 text-center">OFFICE</th>
                        <th class="py-3 px-6 text-center">ESTADO</th>
                   
                        <th class="py-3 px-6 text-center">OBSERVACIONES</th>
                         <th class="py-3 px-6 text-center">EDITAR</th>
                        
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
                          <th>Filter..</th>
            
                    </tr>
                </tfoot>
                <tbody class="text-gray-600 text-sm font-light ">
                    @foreach ($def as $def)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                         <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$def->eid}}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$def->name}} {{$def->lastname}}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <span class="font-light">{{$def->nombre_disp}}</span>
                            </div>
                        </td>
                           <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <span class="font-light">{{$def->ip}}</span>
                            </div>
                        </td>
                         <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$def->mac}}</span>
                            </div>
                        </td>
                         <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$def->proc_velocidad}}</span>
                            </div>
                        </td>
                        
                        <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$def->memoria}}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$def->disco}}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                                <span class="font-light">{{$def->v_office}}</span>
                            </div>
                        </td>
                               @if($def->identificar=="MALO")
                            <td class="py-3 text-center">
                                <span class="font-light  rounded-md text-xs bg-red-200 p-2">{{$def->identificar}}</span>     
                        </td>
                        @elseif($def->identificar=="REGULAR")
                          <td class="py-3  text-center ">
                                <span class="font-light  bg-yellow-200 rounded-md text-xs p-2">{{$def->identificar}}</span>
                        </td>
                        @elseif($def->identificar=="BUENO")
                          <td class="py-3  text-center ">
    <span class="font-light  rounded-md text-xs p-2 bg-blue-200">{{$def->identificar}}</span>   
                        </td>
                        @else
                         <td class="py-3  text-center "> 
                                <span class="font-light  rounded-md text-xs p-2 bg-blue-200">SIN PROPIEDAD</span>
                        </td>
                            @endif
                      
                      
                         <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$def->obs_equipo}}</span>
                            </div>
                        </td>
                          <td class="py-3 px-6 text-left whitespace-nowrap d-flex justify-content-center">
                                  <a class="btn btn-light" href="" name="idsele" data-toggle="modal" data-target="#exampleModal" role="tab">
                                    <i class="fa fa-cogs"></i>
                                  </a>
                            </td>
                          
                          
                    </tr>
                    @endforeach
                     <!--disp-->
                      @foreach ($disp as $disp)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                         <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">D-{{$disp->disp}}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$disp->name}} {{$disp->lastname}}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <span class="font-light">{{$disp->t_dispositivo}}</span>
                            </div>
                        </td>
                           <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <span class="font-light">{{$disp->ip_disp}}</span>
                            </div>
                        </td>
                           <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$disp->mac_disp}}</span>
                            </div>
                        </td>
                           <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$disp->marca_disp}}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">NA</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">NA</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                                <span class="font-light">NA</span>
                            </div>
                        </td>
                       
                         <td class="py-3  text-center "> 
                                <span class="font-light  rounded-md text-xs p-2 bg-blue-200">NA</span>
                        </td>
                           
                      
                    
                         <td class="py-3 px-6 text-left ">
                            <div class="flex items-center">
                              
                                <span class="font-light">{{$disp->observaciones_disp}}</span>
                            </div>
                        </td>
                          <td class="py-3 px-6 text-left whitespace-nowrap d-flex justify-content-center">
                               NA
                            </td>
                          
                          
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
           
            </div>
            <div class="modal-body">
              <form method="POST"  action="{{route('Incidencias2post')}}">
                @csrf
                <input type="hidden" id="idt" name="idt">
         
                <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                    <label for="exampleInputEmail1" class="form-label">Estado del equipo:</label>
                    <select class="form-select js-example-basic-multiple" name="status" id="status"  required>
                     
                      <option value="BUENO">BUENO</option>
                       <option value="REGULAR">REGULAR</option>
                        <option value="MALO">MALO</option>
                    </select>
                </div>
             <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                    <label for="exampleInputEmail1" class="form-label">Observaciones:</label>
                   <div class="form-floating">
  <textarea class="form-control" id="obs" name="obs"></textarea>
</div>
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

 <script>
        $("body").on("click", "#mydatatable a", function(event) {
            event.preventDefault();
            idsele = $(this).attr("href");
            id= $(this).parent().parent().children("td:eq(0)").text();
        
            //Cargamos en el formulario los valores del registro
        
            $("#idt").val(id);
         
            eliminaEspacio();
        });
        function eliminaEspacio(){
    
    $('input').val(function(_, value) {
    return $.trim(value);
    });
    
    }
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
        Highcharts.chart('container', {
       chart: {
           type: 'column',
           backgroundColor:'#ADAFA9 ',
       },
       title: {
           text: 'EQUIPOS'
       },
       subtitle: {
           text: 'Total de equipos de computo.'
       },
       xAxis: {
           type: 'category',
           labels: {
               rotation: -45,
               style: {
                   fontSize: '13px',
                   fontFamily: 'Verdana, sans-serif'
               }
           }
       },
       yAxis: {
           min: 0,
           title: {
               text: 'EQUIPOS'
           }
       },
       legend: {
           enabled: false
       },
       series: [{
           name: 'En uso',
           data: <?= $datos ?>,
           color: '#81ED11',
           dataLabels: {
               enabled: true,
               rotation: -90,
               color: '#FFFFFF',    
               align: 'right',
               y: 10,
               style: {
                   fontSize: '13px',
                   fontFamily: 'Verdana, sans-serif',  
               }
           }
       }
   ]
   });
        </script>
        <script>
          Highcharts.chart('container2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
     
           backgroundColor:'#ADAFA9 ',
    },
    title: {
        text: 'MEMORIA RAM'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: ''
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
            enabled: true,
            format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>Equipos: {point.y}',
            }
        }
    },
    series: [{
        name: 'Porcentaje',
        colorByPoint: true,
        data:<?= $datos2 ?>,
    }]
});
            </script>
             <script>
          Highcharts.chart('container3', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
     
           backgroundColor:'#ADAFA9 ',
    },
    title: {
        text: 'ESTADO DE LOS EQUIPOS'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: ''
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
            enabled: true,
            format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>Equipos: {point.y}',
            }
        }
    },
    series: [{
        name: 'Porcentaje',
        colorByPoint: true,
        data:<?= $datos3 ?>,
    }]
});
            </script>
@stop
@endcan