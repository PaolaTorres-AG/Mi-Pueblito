@extends('adminlte::page')
@section('title', 'AGROIN')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
* {
font-family: 'Poppins', sans-serif;
}
.highcharts-figure,
.highcharts-data-table table {
    
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

   </style>
@section('content_header')
   
   <div class="card   " >
    <div class="card-header">
     Consultar incidencias
    </div>
    <div class="card-body">
        <form class="bg-white p-4 rounded" method="POST"  action="{{route('IncidenciasFiltro')}}" >
            @csrf
        <div class="container">
            <div class="row">
              <div class="col">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">De:</label>
                    <input type="date" class="form-control" id="de" name="de" required>
                  </div>
              </div>
              <div class="col">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Hasta:</label>
                    <input type="date" class="form-control" id="hasta" name="hasta" required >
                  </div>
              </div>
              
            </div>
          </div>
          {{--  --}}
          <div class="d-flex justify-content-center"><button type="submit" class="btn btn-dark">Consultar</button></div>
          {{--  --}}
          
      </form>
    </div>
  </div>
@stop
@section('content')
  {{--  --}}
    <div class="card">
      <div class="card-body">
          <div class="container-fluid text-center m-0 p-0">
              <div class="row col-12 m-0 p-0">
                <div class="col-sm-6 col-md-4 cold-lg-4 rounded-1 pt-3 ">
                  <div class="card">
                      <div class="card-body">
                        <p style="font-size: 18px " class="fw-bold"> <i class="fa-solid fa-chart-line text-cyan-50"></i> SOLICITUDES RECIBIDAS</p>
                        <p style="font-size: 38px " class="fw-bold">{{$total->total}}</p>
                      </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-4 cold-lg-4 rounded-1   pt-3" >
                  <div class="card">
                      <div class="card-body">
                          <p style="font-size: 18px"  class="fw-bold"> <i class="fa-solid fa-bell"></i> SOLICITUDES TERMINADAS</p>
                          <p style="font-size: 38px " class="fw-bold">{{$terminadas->total}}</p>
                          
                      </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 cold-lg-4 rounded-1  pt-3" >
                  <div class="card">
                      <div class="card-body">
                          <p style="font-size: 18px" class="fw-bold"> <i class="fa-solid fa-gauge"></i>  SOLICITUDES EN PROCESO</p>
                           <p style="font-size: 38px " class="fw-bold">{{$proceso->total}}</p>
                      </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2 cold-lg-2 rounded-1   pt-3">
  
                </div>
                <div class="col-sm-6 col-md-4 cold-lg-4 rounded-1   pt-3" >
                  <div class="card h-100">
                      <div class="card-body">
                          <p style="font-size: 18px" class="fw-bold"><i class="fa-solid fa-stopwatch"></i> TIEMPO INVERTIDO EN ENTREGA DE EQUIPOS NUEVOS</p>
                          <p style="font-size: 38px " class="fw-bold">  {{$tiempoord}} hrs/min</p>
                      </div>
                    </div>
                </div>
                
                <div class="col-sm-6 col-md-4 cold-lg-4 rounded-1   pt-3" >
                  <div class="card h-100">
                      <div class="card-body">
                          <p style="font-size: 18px" class="fw-bold"><i class="fa-solid fa-stopwatch"></i> TIEMPO INVERTIDO EN SOPORTES</p>
                          <p style="font-size: 38px " class="fw-bold">  {{($tiemposop)}} hrs/min</p>
                          <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#DetallesModal" >Detalles</button>
                      </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-2 cold-lg-2 rounded-1   pt-3" >
  
                </div>
              </div>
            </div>
      </div>
  
  
      
      <div class="3">
          <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 rounded-1   pt-3">
              <figure class="highcharts-figure">
                  <div id="containerPrioridad"></div> 
              </figure>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 rounded-1   pt-3">
              <figure class="highcharts-figure">
                  <div id="containerX" class="chart-container"></div>
              </figure>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 rounded-1   pt-3">
              <figure class="highcharts-figure">
                <div id="containers" class="chart-container"></div>
              </figure>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 rounded-1   pt-3">
              <figure class="highcharts-figure">
                <div id="containeruser" class="chart-container"></div>
              </figure>
            </div>       
          </div>
        </div>
        
      
    </div>
    
  
  
    <div class="3">
        <div class="row">
          <div class="col-sm-12 col-md-4 col-lg-4 rounded-1   pt-3">
            <figure class="highcharts-figure">
                <div id="containerPrioridad"></div> 
            </figure>
          </div>
          <div class="col-sm-12 col-md-8 col-lg-8 rounded-1   pt-3">
            <figure class="highcharts-figure">
                <div id="containerX" class="chart-container"></div>
            </figure>
          </div>
          <div class="col-sm-12 col-md-8 col-lg-8 rounded-1   pt-3">
            <figure class="highcharts-figure">
         <div id="containers" class="chart-container"></div>
        </figure>
          </div>
          <div class="col-sm-12 col-md-4 col-lg-4 rounded-1   pt-3">
            <figure class="highcharts-figure">
         <div id="containeruser" class="chart-container"></div>
        </figure>
          </div>
         
        </div>
      </div>
    
  </div>

  <div class="modal fade " id="DetallesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header ">
          <div class="container text-center " >
            <h1 class=" modal-title fs-2 " id="exampleModalLabel">Detalles de tiempo invertido en soportes.</h1>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="2">
            <div class="row">
                <div class="col-12 col-lg-6" >         
                  <div id="container" style="height: 500px"></div>       
                </div>
                <div class="col-12 col-lg-6">
                  <div class="tab-pane table-responsive" id="area">
                    <table class="records_list table table-striped table-bordered table-hover rounded-md table-responsive"   id="mydatatable2">
                      <thead>
                          <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal rounded-lg" style="color:#516407">
                              <th class="py-3 px-6 text-left">Categoria</th>
                              <th class="py-3 px-6 text-left">Tiempo invertido por categoria</th>
                              <th class="py-3 px-6 text-left">Promedio de tiempo por incidencia</th>
                          </tr>
                      </thead>
                     
                      <tbody class="text-gray-600 text-sm font-light">
                      
                          @foreach ($tiemincidencias as $tiemincidencias)
                          <tr class="border-b border-gray-200 hover:bg-gray-100">
                              <td class="py-3 px-6 text-left whitespace-nowrap">
                                  <div class="flex items-center">
                                      <span class="font-light">{{ $tiemincidencias->t_incidencia}}</span>
                                  </div>
                              </td>
                              <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-light"> {{floor($tiemincidencias->tiempo3 / 60).':'.($tiemincidencias->tiempo3 -   floor($tiemincidencias->tiempo3 / 60) * 60) }} hr/min</span>
                                </div>
                              </td>
                              <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                  <span class="font-light"> {{floor($tiemincidencias->promedioinc / 60).':'.($tiemincidencias->promedioinc -   floor($tiemincidencias->promedioinc / 60) * 60) }} hr/min</span>
                                </div>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>    
            </div>
           
        </div>  
      </div>
    </div>
  </div>
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
@stop

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

   <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
   <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/pdfmake.min.js"></script>
   <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.53/build/vfs_fonts.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script>
  $(window).on('beforeunload', function(){
    $('#pageLoader').show();
});
$(function () {
    $('#pageLoader').hide();
})
</script>
<script>
    $("body").on("click", "#sample_data a", function(event) {
        event.preventDefault();
        idsele = $(this).attr("href");
       
        id= $(this).parent().parent().children("td:eq(0)").text();
        nameup=  $(this).parent().parent().children("td:eq(1)").text();
            areaup = $(this).parent().parent().children("td:eq(2)").text();
            
           puestoup = $(this).parent().parent().children("td:eq(3)").text();
        //Cargamos en el formulario los valores del registro
        $("#idup").val(id);
        $("#nameup").val(nameup);
        $("#areaup").val(areaup);
        $("#puestoup").val(puestoup);
        $("#idt").val(id);
 
    });
    </script>
  
     
      {{--  --}}

  
  
        <script>
 
    
    
Highcharts.chart('containerPrioridad', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
    title: {
        text: 'Total de solicitudes por prioridad',
        align: 'center'
    },
    subtitle: {
        text: '',
        align: 'left'
    },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45,
            dataLabels: {
            enabled: true,
            format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>Total: {point.y}',
            }
        }
    },
    series: [{
        name: 'Medals',
        data: <?= $prioridad ?>,
    }]
});




const chart = new Highcharts.Chart({
    chart: {
        renderTo: 'containerX',
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        }
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '10px',
            }
        }
    },
    yAxis: {
        title: {
            enabled: false
        }
    },
    tooltip: {
        headerFormat: '<b>{point.key}</b><br>',
        pointFormat: 'Total: {point.y}'
    },
    title: {
        text: 'Solicitudes de incidencias registradas',
        align: 'center'
    },
  
    legend: {
        enabled: false
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    series: [{
        data: <?= $datosi ?>,
        dataLabels: {
               enabled: true,
               rotation: 0,
               color: '#000000',    
               align: 'center',
               y: 24,
               style: {
                   fontSize: '12px',
               }
           }
    }]
});

function showValues() {
    document.getElementById('alpha-value').innerHTML = chart.options.chart.options3d.alpha;
    document.getElementById('beta-value').innerHTML = chart.options.chart.options3d.beta;
    document.getElementById('depth-value').innerHTML = chart.options.chart.options3d.depth;
}

// Activate the sliders
document.querySelectorAll('#sliders input').forEach(input => input.addEventListener('input', e => {
    chart.options.chart.options3d[e.target.id] = parseFloat(e.target.value);
    showValues();
    chart.redraw(false);
}));

showValues();

     </script>
     <script>
        var sum2 = 0;
    Highcharts.chart('containers', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Incidencias registradas por mes en el año.'
      },
     
      xAxis: {
          categories: ["ENE", "FEB","MAR", "ABR", "MAY", "JUN", "JUL","AGO","SEP","OCT","NOV","DIC"],
          
      },
      yAxis: {
          title: {
              text: 'TOTAL',
             
          }
      },
      plotOptions: {

column: {
  dataLabels: {
    enabled: true,
    useHTML: true,
    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black',
    style: {
      textShadow: '0 0 3px black, 0 0 3px black'
    },
    formatter: function() {
      var pointHeight = this.point.shapeArgs.height + 20;

      return '<div class="datalabelInside" style="text-shadow:none;color:#000' + pointHeight / 2 + 'px">' + this.y + '</div>';
    }

  }
},
series: {
      allowPointSelect: true,
      point: {
        events: {
          select: function() {

            sum2 += this.y;

            var text = 'Sum =  ' + sum2,
              chart = this.series.chart;
            if (!chart.lbl) {
              chart.lbl = chart.renderer.label(text, 100, 70)
                .attr({
                    padding: 5,
                  r: 5,
                  fill: Highcharts.getOptions().colors[9],
                  zIndex:5
                })
                .css({
                  color: '#FFFFFF'
                })
                .add();
            } else {
              chart.lbl.attr({
                text: text
              });
            }
          },
          unselect: function() {
            sum2 -= this.y

            var text = 'Sum =  ' + sum2,
              chart = this.series.chart;
            if (!chart.lbl) {
              chart.lbl = chart.renderer.label(text, 100, 70)
                .attr({
                    padding: 5,
                  r: 5,
                  fill: Highcharts.getOptions().colors[9],
                  zIndex:5
                })
                .css({
                  color: '#FFFFFF'
                })
                .add();
            } else {
              chart.lbl.attr({
                text: text
              });
            }
          }
        }
      }
    }
},
      tooltip: {
        backgroundColor: '#B2B0B5',
      borderColor: '#E2CEFF',
      borderRadius: 10,
      borderWidth: 3
  },
  colors: ['#ae3dff','#55ffe2','#ff3b93','#a7fd2a','#B49FDC','#C5EBFE','#FEFD97','#BCEBE9','#FEA895','#F9BAC6','#EBF7BC','#DDE6F8','#F7D7E2','#E7CEE9'],
      series:<?= $datosH ?>
  });
    </script>
    <script>

    
Highcharts.chart('containeruser', {
chart: {
   type: 'bar',
 
       
},
title: {
   text: 'Soportes en el periodo realizados por tecnico'
},
subtitle: {
},
xAxis: {
   type: 'category',
   labels: {
       rotation: -45,
       style: {
           fontSize: '12px',
       }
   }
},
yAxis: {
   min: 0,
   title: {
       text: 'Soportes'
   }
},
legend: {
   enabled: false
},

series: [{
   name: 'Soportes Finalizados',
   data: <?= $datos ?>,
   colors:'#B49FDC',

   dataLabels: {
       enabled: true,
       rotation: 5,
          

       align: 'right',
     //  format: '{point.y:.1f}', // one decimal
       y: 4, // 10 pixels down from the top
       style: {
           fontSize: '13px',
          
       }
   }
},
]
});


document.addEventListener('DOMContentLoaded', function () {
        const chart = Highcharts.chart('container', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Incidencias por categoria'
            },
            xAxis: {
              type: 'category',
              labels: {
                style: {
                    fontSize: '9px',
                    fontFamily: 'Verdana, sans-serif'
                }
              }
            },
            yAxis: {
                title: {
                    text: 'Cantidad'
                }
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br>',
                pointFormat: 'Total: {point.y}'
            },
            legend: {
                enabled: false
            },            
            series: [{
                data: <?= $datosd ?>,
                colorByPoint: true,
                dataLabels: {
                      style: {
                          fontSize: '13px',
                          fontFamily: 'Verdana, sans-serif',  
                      }
                  }
            }]
        });
});
</script>
@stop