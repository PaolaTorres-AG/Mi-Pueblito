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
     <h1>Consultar incidencias</h1>
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
        <div class="container text-center m-0 p-0 bg-black">
            <div class="row col-12 m-0 p-0">
              <div class="col-sm-6 col-md-3 cold-lg-3 rounded-1 pt-3 ">
                <div class="card">
                    <div class="card-body">
                 <p style="font-size: 18px " class="fw-bold"> <i class="fa-solid fa-chart-line text-cyan-50"></i> TOTAL DE SOLICITUDES RECIBIDAS</p>
                 <p style="font-size: 38px " class="fw-bold">{{$total->total}}</p>
                    </div>

                    
                  </div>
              </div>
              <div class="col-sm-6 col-md-3 cold-lg-3 rounded-1   pt-3" >
                <div class="card">
                    <div class="card-body">
                        <p style="font-size: 18px"  class="fw-bold"> <i class="fa-solid fa-bell"></i> TOTAL DE SOLICITUDES TERMINADAS</p>
                        <p style="font-size: 38px " class="fw-bold">{{$terminadas->total}}</p>
                        
                    </div>
                  </div>
              </div>
              <div class="col-sm-6 col-md-3 cold-lg-3 rounded-1  pt-3" >
                <div class="card">
                    <div class="card-body">
                        <p style="font-size: 18px" class="fw-bold"> <i class="fa-solid fa-gauge"></i>  TOTAL DE SOLICITUDES EN PROCESO</p>
                         <p style="font-size: 38px " class="fw-bold">{{$proceso->total}}</p>
                    </div>
                  </div>
              </div>
              <div class="col-sm-6 col-md-3 cold-lg-2 rounded-1   pt-3" >
                <div class="card">
                    <div class="card-body">
                        <p style="font-size: 18px" class="fw-bold"><i class="fa-solid fa-stopwatch"></i> TOTAL DE TIEMPO INVERTIDO</p>
                        <p style="font-size: 38px " class="fw-bold">  {{number_format($incidencias3->tiempo2/60, 2)}} hrs</p>
                    </div>
                  </div>
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
@stop



@section('css')
<link rel="icon" href="data:image/png;base64,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"> 
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
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
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
    subtitle: {
        text: 'Soportes realizados por tipo de incidencia. ',
      
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
        colorByPoint: true,
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
          text: 'Comparativa de incidencias anual'
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
   text: 'Soportes'
},
subtitle: {
   text: 'Soportes del mes realizados por usuarios'
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
       y: 10, // 10 pixels down from the top
       style: {
           fontSize: '13px',
           fontFamily: 'Verdana, sans-serif',
          
       }
   }
},



]
});
</script>
@stop