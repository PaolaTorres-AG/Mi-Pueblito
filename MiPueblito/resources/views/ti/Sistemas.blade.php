@can('MI-PUEBLITO')
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
        <p style="font-weight: bold;color:#f2ca28; text-align: right;">¡BIENVENIDO {{Auth::user()->name}} {{Auth::user()->lastname}} !</p>

<div class="flash-message">
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <p class="alert alert-{{ $msg }}">{{Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
  @endforeach
</div> <!-- end .flash-message -->
<div class=" m-0  card bg-gradient-to-tr from-gray-500 to-gray-900  rounded-lg  text-white font-bold text-md">
    <div class="card-body m-2 p-0">
    <h5 class="text-center">Generar Solicitud </h5>
    </div>
  </div>
<div class="card p-2 m-0">
    <form class="rounded" method="POST"  action="{{ route('Panelp') }}" enctype="multipart/form-data">
      @csrf
      <div class="container col-12">
        <div class="row col-12">
  <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
    <label for="exampleInputEmail1" class="form-label">Nivel de prioridad</label>
    <select class="form-select " required id="prioridad" name="prioridad"  >

        <option value="BAJO" >BAJO</option>
        <option value="MEDIO" >MEDIO</option>
        <option value="ALTO" >ALTO</option>
      </select>
  </div>

  <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
    <label for="exampleInputEmail1" class="form-label">Tipo de incidencia</label>
    <select class="form-select " required id="incidencia" name="incidencia"  >
      <option selected disabled value="">*Tipo de incidencia</option>
      <option value="Solicitud de equipo de computo nuevo">Solicitud de equipo de computo nuevo</option>
    <option value="Reasignación de equipo de computo">Reasignación de equipo de computo</option>
        <option value="Acceso a internet (Justificado y Autorizado)">Acceso a internet (Justificado y Autorizado)</option>
     <option value="Acceso a cámaras de vigilancia">Acceso a cámaras de vigilancia</option>
          <option value="Acceso a multifuncionales (Impresoras)">Acceso a multifuncionales (Impresoras)</option>
          <option value="Acceso o mantenimiento de telefonía fija">Acceso o mantenimiento de telefonía fija</option>
            <option value="Soporte en equipo de computo por lentitud o falla">Soporte en equipo de computo por lentitud o falla</option>
            <option value="Soporte en general (Equipos y redes)">Soporte en general (Equipos y redes)</option>
             <option value="" class="fw-bold text-black"  disabled>****Acceso a aplicaciones****</option>
              <option value="Office 365">Office 365</option>
               <option value="Sharepoint">Sharepoint</option>
                <option value="Contpaq contabilidad">Contpaq contabilidad</option>
                 <option value="Contpaq Nominas">Contpaq Nominas</option>
                  <option value="Contpaq Empresarial">Contpaq Empresarial</option>
                  <option value="Correo corporativo">Correo corporativo</option>
                  <option value="Desarrollos internos">Desarrollos internos</option>
      </select>
  </div>

  <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
      <label for="exampleInputEmail1" class="form-label">Descripción del problema</label>
      <textarea
               id="descripcion"  name="descripcion" required maxlength="240" required value="{{ old('descripcion') }}"
                  rows="6"
                  placeholder="Descripción del problema"
                  class="
                  w-full
                  rounded
                  py-3
                  px-[14px]
                  text-body-color text-base
                  border border-[f0f0f0]
                  resize-none
                  outline-none
                  focus-visible:shadow-none
                  focus:border-primary
                  ">{{ old('descripcion') }}</textarea>
  </div>
  <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
    <label for="exampleInputEmail1" class="form-label">Adjuntar imagen de evidencia (Opcional).</label>
    <input type="file" id="img" class="form-control"  name="img" accept="image/*">
</div>
<div class="d-flex justify-content-center"><button type="submit"  class="btn btn-dark"  >Aceptar</button></div>
</div>
</div>
    
    </div>

       </form>
  </div>
  <div class=" mt-4 p-0 card bg-gradient-to-tr   from-gray-500 to-gray-900  rounded-lg  text-white font-bold text-md">
    <div class="card-body m-2 p-0">
        <h5 class="text-center"> Historial</h5>
    </div>
  </div>

  {{--  --}}
  <div class="card ">
    <div class="table-responsive  p-3" id="mydatatable-container">
        <table class="records_list table table-striped table-bordered table-hover text-xs" id="mydatatable">
            <thead>
                <tr class="bg-gray-200 text-gray-300 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">FOLIO</th>
                    <th class="py-3 px-6 text-left">ESTATUS</th>
                    <th class="py-3 px-6 text-center">ASIGNADO</th>
                    <th class="py-3 px-6 text-center">CATEGORIA</th>
                     <th class="py-3 px-6 text-center">DESCRIPCION</th>
                   <th class="py-3 px-6 text-center">SOLICITADO</th>
                    <th class="py-3 px-6 text-center">FINALIZADO</th>                       
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
            <tbody class="text-gray-600 text-xs font-light ">
                @foreach ($incidencias as $data)
                <tr class="border-b border-gray-200 hover:bg-gray-100">

<td class="py-3 px-6 text-center">{{$data->id}}</td>
<td class="py-3 px-6 text-center">{{$data->estatus}}</td>
<td class="py-3 px-6 text-left">{{$data->asignado}}</td>
<td class="py-3 px-6 text-center">{{$data->clasificacion}}</td>
<td class="py-3 px-6 text-center">{{$data->descripcion}}</td>
<td class="py-3 px-6 text-center">{{$data->fecha_inicial}}</td>
<td class="py-3 px-6 text-center">{{$data->fecha_final}}</td>
               </tr>
                @endforeach
            </tbody>
        </table>
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
   <script type="text/javascript">
   $(document).ready(function(){
    $("#butonsub").click(function(){
        this.disabled = true;
        return true;
    });
});
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

@stop
@endcan