
@extends('adminlte::page')
@can('TI')
@section('title', 'Mi Pueblito')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
* {
padding: 0;
margin: 0;
font-family: 'Poppins', sans-serif;
}
   </style>

@section('content_header')

<p style="font-weight: bold;color:#f2ca28; text-align: right;">¡BIENVENIDO {{Auth::user()->name}} {{Auth::user()->lastname}} !</p>
<div class=" m-0  card bg-gradient-to-tr from-gray-500 to-gray-900  rounded-lg  text-white font-bold text-md">
  <div class="card-body m-2 p-0">
  <h5 class="text-center">Registro de Activos/Dispositivos </h5>
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
<div class="container shadow min-vh-100 py-2">
  <div class="container network_wrapper col-sm p-2 ">
      <div class="card">
        {{-- inicia la navegacion --}}
          <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs" data-bs-tabs="tabs">
                  <li class="nav-item">
                      <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#equipos">EQUIPOS</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#password">CONTRASEÑAS</a>
                     
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#dispositivos">DISPOSITIVOS</a>
                </li>
              </ul>
          </div>
 {{------------------------ termina la navegacion ----------------------------------------------------------------------------------------------------------------}}
          <div class="card-body tab-content">
 {{---------------------- form equipos ---------------------------------------------------------------------------------------------------------------------------}}
              <div class="tab-pane active" id="equipos">
             <form class="rounded" method="POST"  action="{{route('RegistroEquipo')}}" enctype="multipart/form-data">
              @csrf
              <div class="container text-center">
                <div class="row">
                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Usuario</label>
                    <select class="form-select js-example-basic-multiple" style="width: 100%" name="usere" id="usere" value="{{ old('usere') }}" required>
                      <option selected value="" disabled>Selecciona una opción</option>
                      @foreach ($users as $users)
                      <option  value="{{$users->id}}" >{{$users->name }} {{$users->lastname}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Estado del equipo</label>
                    <select class="form-select" name="estadod" id="estadod" value="{{ old('estadod') }}" required>
                      <option  value="REASIGNADO">REASIGNADO</option>
                      <option  value="NUEVO">NUEVO</option>
                    </select>
                  </div>
                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Tipo de dispositivo</label>
                    <select class="form-select" id="tdis" name="tdis">
                     
                      <option selected value="LAPTOP">LAPTOP</option>
                      <option  value="PC">PC</option>
                    </select>
                  </div>
               
                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Estado del dispositivo</label>
                    <select class="form-select" id="identificar" name="identificar">
                      <option selected value="" disabled>Selecciona una opción</option>
                      <option value="BUENO">BUENO</option>
                      <option value="REGULAR">REGULAR</option>
                      <option value="MALO">MALO</option>
                    </select>
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Nombre del equipo</label>
                    <input type="text" class="form-control fw-light" id="nombred" name="nombred" value="{{ old('nombred') }}" required>
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Marca</label>
                    <input type="text" class="form-control fw-light" id="marcad" name="marcad" value="{{old('marcad')}}" required>
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Modelo</label>
                    <input type="text" class="form-control fw-light" id="modelod" name="modelod" value="{{old('modelod')}}" required>
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Numero de serie</label>
                    <input type="text" class="form-control fw-light" id="nseried" name="nseried" value="{{old('nseried')}}" required>
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Procesador y velocidad</label>
                    <input type="text" class="form-control fw-light" id="procesadord" name="procesadord" value="{{old('procesadord')}}" required>
                  </div>


                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Memoria</label>
                    <input type="text" class="form-control fw-light" id="memoriad" name="memoriad" value="{{old('memoriad')}}" required>
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Almacenamiento</label>
                    <input type="text" class="form-control fw-light" id="discod" name="discod" value="{{old('discod')}}" required>
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Fecha de compra</label>
                    <input type="date" class="form-control fw-light" id="fechacomprad" name="fechacomprad" value="{{old('fechacomprad')}}" >
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Fecha de asignación</label>
                    <input type="date" class="form-control fw-light" id="fechaentrega" name="fechaentrega" value="{{old('fechaentrega')}}" >
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Proveedor</label>
                    <input type="text" class="form-control fw-light" id="proveedord" name="proveedord" value="{{old('proveedord')}}">
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Sistema operativo</label>
                    <select class="form-select" name="sod" id="sod" value="{{ old('estadod') }}" required>
                      <option  value="Windows">Windows</option>
                      <option  value="Mac Os">Mac OS</option>
                             <option  value="Unix">Unix</option>
                                    <option  value="Linux">Linux</option>
                    </select>
                    
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Ip del dispositivo</label>
                    <input type="text" class="form-control fw-light" id="ipd" name="ipd" value="{{old('ipd')}}" required>
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Correo del dispositivo</label>
                    <input type="text" class="form-control fw-light" id="correod" name="correod" value="{{old('correod')}}" required>
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">MAC</label>
                    <input type="text" class="form-control fw-light" id="mace" name="mace" value="{{old('mace')}}" required>
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Wifi/Ethernet</label>
                    <select class="form-select" id="wifi" name="wifi" required>
                      <option selected value="" disabled>Selecciona una opción</option>
                      <option  value="WIFI" >WIFI</option>
                      <option  value="ETHERNET" >ETHERNET</option>
                    </select>
                  </div>

                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">IP/DHCP</label>
                    <select class="form-select" id="dhcp" name="dhcp" required>
                      <option selected value="" disabled>Selecciona una opción</option>
                      <option  value="IP" >IP</option>
                      <option  value="DHCP" >DHCP</option>
                    </select>
                  </div>
               
                  <div class="col-lg-4">
                    <label for="" class="form-label fst-italic ">Observaciones</label>
                    <textarea class="form-control" id="observacionesx" name="observacionesx" maxlength="200" value="{{old('observacionesx')}}"></textarea>
                  </div>

                  <div class="card mt-2">
                    <div class="card-body">
                      <h5 class="card-title fst-italic fw-semibold">Programas instalados</h5>
                  <br>
                  <br>
                      <div clas="mt-3">
                      
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="google" name="checks[]" value="Google Chrome">
                          <label class="form-check-label fw-light" for="">Google Chrome</label>
                        </div>
                       
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="Anydesk" name="checks[]" value="Anydesk">
                          <label class="form-check-label fw-light" for="">Anydesk</label>
                        </div>
                  
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="VNC" name="checks[]" value="VNC">
                          <label class="form-check-label fw-light" for="">VNC</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="Adobe" name="checks[]" value="Adobe Reader">
                          <label class="form-check-label fw-light" for="">Adobe Reader</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="WinRar" name="checks[]" value="WinRar">
                          <label class="form-check-label fw-light" for="">WinRar</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="Forticlient" name="checks[]" value="Antivirus Forticlient">
                          <label class="form-check-label fw-light" for="">Antivirus Forticlient</label>
                        </div>
                      
            
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="zebra" name="checks[]" value="Zebra">
                          <label class="form-check-label fw-light" for="">Zebra</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="ZKTime" name="checks[]" value="ZKTime">
                          <label class="form-check-label fw-light" for="">ZKTime</label>
                        </div>
                      
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="vpn" name="checks[]" value="VPN">
                          <label class="form-check-label fw-light" for="">VPN</label>
                        </div>
                        
                          <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="compaqi"  name="checks[]" value="COMPAQI">
                          <label class="form-check-label fw-light" for="">COMPAQI</label>
                        </div>
                          <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="share"  name="checks[]" value="SharePoint">
                          <label class="form-check-label fw-light" for="">SharePoint</label>
                        </div>
                         <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="teams"  name="checks[]" value="Teams">
                          <label class="form-check-label fw-light" for="">Teams</label>
                        </div>
                         <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="OneDrive"  name="checks[]" value="OneDrive">
                          <label class="form-check-label fw-light" for="">OneDrive</label>
                        </div>
                          <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="tickets"  name="checks[]" value="Tickets TI">
                          <label class="form-check-label fw-light" for="">Tickets TI</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="office" value="Office" name="checks[]">
                          <label class="form-check-label fw-light" for="">Office</label>
                        </div>
                  
                  <div class="container" style="display:none" id="doffice">
                    <div class="row">
                      <div class="col">
                       
                          <label  class="form-label fst-italic">Versión de office</label>
                          <input type="text" class="form-control" id="voffice" name="voffice" value="office 365">
                   
                      </div>
                      <div class="col">
                        <label  class="form-label fst-italic">Tipo de licencia</label>
                        <select class="form-select" name="clavep" id="clavep"  required>
                     
                      <option selected value="Negocios">Negocios</option>
                       <option  value="Estandar">Estandar</option>
                      <option  value="Basica">Basica</option>
                     
                    </select>
                     
                      </div>
                    
                    </div>
                  </div>
                  {{--  --}}
                  <input type="hidden" id="str2" name="str2" >
                  </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="d-grid gap-2 m-4 col-6 mx-auto">
                <button class="btn btn-dark" type="submit">Aceptar</button>
              </div>
             </form>
              </div>
{{---------------------------termina form equipos ------------------------------------------------------------------------------------------------------------------------}}
 {{------------------ form dispositivos ----------------------------------------------------------------------------------------------------------------------------------}}
              <div class="tab-pane" id="dispositivos">
          <form class="rounded" method="POST"  action="{{route('RegistroDispositivos')}}" enctype="multipart/form-data">
          @csrf
          <div class="container text-center">
            <div class="row">
              <div class="col-lg-4">
                <label for="" class="form-label fst-italic ">Usuario</label>
                <select class="form-select js-example-basic-multiple" style="width: 100%" name="userdis" id="userdis" value="{{ old('userdis') }}" required>
                  <option selected value="" disabled>Selecciona una opción</option>
                  @foreach ($dispositivos as $dispositivos)
                  <option  value="{{$dispositivos->id}}" >{{$dispositivos->name }} {{$dispositivos->lastname}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-lg-4">
                <label  class="form-label fst-italic">Estado del equipo</label>
                <select class="form-select" name="estadodis" id="estadodis"  required>
                  <option  value="REASIGNADO">REASIGNADO</option>
                  <option  value="NUEVO">NUEVO</option>
                </select>
              </div>
              <div class="col-lg-4">
                <label  class="form-label fst-italic">Tipo de dispositivo</label>
                <input type="text" class="form-control" id="tdis" name="tdis" required>
              </div>
              <div class="col-lg-4">
                <label  class="form-label fst-italic">Marca</label>
                <input type="text" class="form-control" id="marcadis" name="marcadis" required>
              </div>
              <div class="col-lg-4">
                <label  class="form-label fst-italic">Modelo</label>
                <input type="text" class="form-control" id="modelodis" name="modelodis" required>
              </div>
              <div class="col-lg-4">
                <label  class="form-label fst-italic">Numero de serie</label>
                <input type="text" class="form-control" id="nseriedis" name="nseriedis" required>
              </div>
              <div class="col-lg-4">
                <label  class="form-label fst-italic">MAC</label>
                <input type="text" class="form-control" id="macdis" name="macdis" >
              </div>
              <div class="col-lg-4">
                <label  class="form-label fst-italic">IMEI</label>
                <input type="text" class="form-control" id="imeidis" name="imeidis" >
              </div>

              <div class="col-lg-4">
                <label  class="form-label fst-italic">Fecha de compra</label>
                <input type="date" class="form-control" id="fechadis" name="fechadis" >
              </div>
              <div class="col-lg-4">
                <label  class="form-label fst-italic">Fecha de asignación</label>
                <input type="date" class="form-control" id="fasignacion" name="fasignacion" required>
              </div>
              <div class="col-lg-4">
                <label  class="form-label fst-italic">Ip del dispositivo</label>
                <input type="text" class="form-control" id="fdisp" name="fdisp" >
              </div>
              <div class="col-lg-4">
                <label  class="form-label fst-italic">Observaciones</label>
                <textarea class="form-control" id="obsdis" name="obsdis" maxlength="200" ></textarea>
              </div>
          
            </div>
          </div>

          <div class="d-flex justify-content-center"> 
            <button type="submit" class="btn btn-dark mt-3" id="">Aceptar</button>
          </div>  
           </form>
           </div>
           
{{------------------------------ termina form dispositivos ---------------------------------------------------------------------------------------------------------------}}
{{---------------------------- form contraseña ---------------------------------------------------------------------------------------------------------------------------}}
              <div class="tab-pane" id="password">
                <form class="rounded" method="POST"   name="formcheck" id="formcheck" action="" enctype="multipart/form-data">
                  @csrf
                  <div class="container text-center">
                    <div class="row">
                      <div class="col-lg-4">
                        <label for="" class="form-label fst-italic ">Usuario</label>
                        <select class="form-select js-example-basic-multiple" style="width: 100%" name="userpassw" id="userpassw" value="{{ old('userpassw') }}" required>
                          <option selected value="" disabled>Selecciona una opción</option>
                          @foreach ($userspassw as $userspassw)
                          <option  value="{{$userspassw->id}}" >{{$userspassw->name }} {{$userspassw->lastname}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-lg-4">
                        <label  class="form-label fst-italic">Usuario/Correo</label>
                        <input type="text" class="form-control" id="userapp" name="userapp" onkeyup="btnblock();">
                      </div>
                      <div class="col-lg-4">
                        <label  class="form-label fst-italic">Contraseña</label>
                        <input type="text" class="form-control" id="passw" name="passw" onkeyup="btnblock();">
                      </div>
                      <div class="col-lg-4">
                        <label  class="form-label fst-italic">Url/Aplicación</label>
                        <input type="text" class="form-control" id="url" name="url" onkeyup="btnblock();">
                      </div>
                      <div class="col-lg-4">
                        <label  class="form-label fst-italic">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" onkeyup="btnblock();">
                      </div>
                      <div class="col-lg-4">
                        <label for="" class="form-label fst-italic ">Categoría</label>
                        <select class="form-select" name="categoria" id="categoria" value="{{ old('categoria') }}" required>
                          <option selected value="" disabled>Selecciona una opción</option>
                          <option  value="CORREO" >CORREO</option>
                          <option  value="OFFICE 365" >OFFICE 365</option>
                          <option  value="APLICACION" >APLICACION</option>
                          <option  value="PAGINA WEB" >PAGINA WEB</option>
                          <option  value="DISPOSITIVO" >DISPOSITIVO</option>
                          <option  value="EQUIPO" >EQUIPO</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="d-flex justify-content-center"> 
                    <button type="button" class="btn btn-dark mt-3" id="list" onclick="agregarFila()" disabled>Agregar a la lista</button>
                  </div>
{{--  --}}
<form method="POST" name="formcheck" id="formcheck"  action="{{route('RegistroPasswords')}}">
  @csrf
  <button type="button" class="btn btn-danger m-2" onclick="borrar()">Eliminar</button>
  <button type="submit" class="btn btn-dark m-2"  id="btnsave" disabled>Registrar Contraseñas</button>
  <input type="hidden" class="form-control" name="id" id="id" value="{{ auth()->user()->id }}">

  <table class="table">
  <tbody id="tablaprueba">
    <th scope="col">User ID</th>
    <th scope="col">Usuario</th>
    <th scope="col">Usuario/Correo</th>
    <th scope="col">Contraseña</th>
    <th scope="col">Url/Aplicación</th>
    <th scope="col">Descripción</th>
    <th scope="col">Categoría</th>
    <th scope="col">Check</th>
  </tbody>
</table>

</form>
                 </form>
              </div>
{{-------------------------------termina form contraseña -----------------------------------------------------------------------------------------------------------------}}
          </div>
      </div>
  </div>
</div>

@stop
@section('css')
<link rel="icon" href="http://mipueblitofoods.net/public/images/icono.png"> 
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
    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

      <script>
        $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    document.getElementById("office").onclick = function() {
    if(this.checked)
        document.getElementById('doffice').style.display = "block";
    else
        document.getElementById('doffice').style.display = "none";
        document.getElementById("voffice").value = "";
        document.getElementById("clavep").value = "";
        document.getElementById("identificar").checked = false;
}
</script>


<script>
$(document).ready(function() {

  $('[name="checks[]"]').click(function() {
      
    var arr = $('[name="checks[]"]:checked').map(function(){
      return this.value;
    }).get();
    var str = arr.join(',');  
    $('#str2').val(str);
  });

});

    </script>
    <script>
      const agregarFila = () => {
        let userselect=$('#userpassw').find('option:selected').text();
        let userselectid=document.getElementById("userpassw").value;
        let userapp=document.getElementById("userapp").value;
        let url=document.getElementById("url").value;
        let descripcion=document.getElementById("descripcion").value;
        let categoriat=$('#categoria').find('option:selected').text();
        let passw=document.getElementById("passw").value;
        document.getElementById('tablaprueba').insertRow(-1).innerHTML = '<td><input type="text" class="form-control" name="userselectid[]" value="'+userselectid+'" readonly></td><td><input type="text" class="form-control" name="userselect[]" value="'+userselect+'" readonly></td><td><input type="text" class="form-control" name="userapp[]" value="'+userapp+'" ></td><td><input type="text" class="form-control" name="passw[]" value="'+passw+'" ></td><td><input type="text" class="form-control" name="url[]" value="'+url+'" ></td> <td><input type="text" class="form-control" name="descripcion[]" value="'+descripcion+'"></td> <td><input type="text" class="form-control" name="categoria[]" value="'+categoriat+'" readonly></td><td><input type="checkbox" name="check"/></td>'
        document.getElementById("passw").value="";
          document.getElementById("userapp").value="";
        document.getElementById("url").value="";
        document.getElementById("descripcion").value="";
        $('#producto option:first').attr('selected',true);
        // document.getElementById("categoria").disabled = true;
        document.getElementById("userapp").disabled = false;
      }
      </script>
      <script type="text/javascript">
      function borrar() {
        tab = document.getElementById('tablaprueba');
        for (i=tab.getElementsByTagName('input').length-1; i>=0; i--) {
          chk = tab.getElementsByTagName('input')[i];
          if (chk.checked)
            tab.removeChild(chk.parentNode.parentNode);}  
      }
      </script>
      <script type="text/javascript">
        function btnblock()
        {
         if(document.getElementById("userapp").value!="" && document.getElementById("passw").value!="" && document.getElementById("url").value!="" && document.getElementById("descripcion").value!="")
         {
           document.getElementById("list").disabled = false;
           document.getElementById("btnsave").disabled = false;
           
         }else{
           document.getElementById("list").disabled = true;
           document.getElementById("btnsave").disabled = true;
         }
        }
       </script>
@stop

@endcan

