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

<form  method="POST"  action="{{route('EditRolP')}}" >
    @csrf
    {{--  --}}
    <div class="card">
      <div class="card-header bg-gradient-to-tr  from-gray-500 to-gray-900  rounded-lg  text-white font-bold text-md">
        EDITAR PERMISOS DEL ROL
      </div>
      <div class="card-body">
        <div class="container col-12">
          <div class="row col-12">
      <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
                  <label for="exampleInputEmail1" class="form-label">Nombre del Rol</label>
                  <input type="text" class="form-control" id="RoleName" name="RoleName" value="{{$role->name}}" required  readonly >
     </div>

     <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
      <label for="exampleInputEmail1" class="form-label">Permisos</label>
      <br>
      @foreach($permissions as $permission)

      <div class="col-sm-3">
          <label class="checkbox-inline "for="perm[{{ $permission->id }}]">
              <input class="form-check-input" id="perm[{{ $permission->id }}]" name="perm[{{ $permission->id }}]" type="checkbox" value="{{ $permission->id }}"
              @if($role->permissions->contains($permission->id)) checked=checked @endif
              > {{ $permission->name }}
          </label>
      </div>
  
  @endforeach
   
 
 
   

   

      <div class="d-flex justify-content-center"><button type="submit" class="btn btn-dark">Aceptar</button></div>
        </div>
      </div>
      </div>
    </div>
    {{--  --}}
  </form>
{{-- ///////////////////////////////////////////////////////////////////////////////--}}

@stop
@section('css')
<link rel="icon" href="{{asset('images/icono.png')}}">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@300&family=Poiret+One&display=swap" rel="stylesheet">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<link rel="icon" href="{{asset('images/icono.png')}}">
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