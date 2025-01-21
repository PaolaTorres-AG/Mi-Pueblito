@can('TI')
@extends('adminlte::page')
@section('title', 'Mi Pueblito')
@section('content_header')
<style>
  #mydatatable tfoot {
          display: table-header-group !important;
      }
      #mydatatable tfoot {
          display: table-header-group !important;
      }
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
* {
padding: 0;
margin: 0;
font-family: 'Poppins', sans-serif;
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
 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
 <div class=" m-0 p-0 card bg-gradient-to-tr  from-gray-500 to-gray-900  rounded-lg  text-white font-bold text-md">
    <div class="card-body m-2 p-0">
        <h5 class="text-center">Consultar activos asignados a: {{$users->name }} {{$users->lastname}} 
          <a href="{{ URL::route('PaseSalida',$users->id)}}" class="btn btn-secondary btn-sm" tabindex="-1" role="button"><i class="fa-regular fa-file-pdf fa-sm"></i></a> 
         
        </h5> 
    </div>
  </div>  
@stop

@section('content')
 

{{-- card equipos --}}

{{--  --}}

<div class="m-4">
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="myTab">
                <li class="nav-item">
                    <a href="#home" class="nav-link active" data-bs-toggle="tab">EQUIPOS</a>
                </li>
                <li class="nav-item">
                    <a href="#profile" class="nav-link" data-bs-toggle="tab">DISPOSITIVOS</a>
                </li>
                <li class="nav-item">
                    <a href="#messages" class="nav-link" data-bs-toggle="tab">CONTRASEÑAS</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="home">
                  @foreach ($equipos as $equipo)
                    
                  
                    <div class="card">
                      <form id="form{{$equipo->id}}" name="form{{$equipo->id}}" class="rounded" method="POST"  action="{{route('VerAsignacionpost',$equipo->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                         Equipos Asignados <button type="button" class="btn btn-secondary" value="{{$equipo->id}}" name="btn1{{$equipo->id}}" id="btn1{{$equipo->id}}" onclick="disable(this.value)"><i class="fa-solid fa-unlock"></i> </button> <button type="button" class="btn btn-secondary" name="btn2{{$equipo->id}}" id="btn2{{$equipo->id}}" value="{{$equipo->id}}" onclick="enable(this.value)" style="display: none"><i class="fa-solid fa-lock"></i></button> <button type="submit" id="save{{$equipo->id}}" nameid="save{{$equipo->id}}" class="btn btn-dark" disabled><i class="fa-solid fa-pen-to-square"></i></button>
                        </div>
                        <div class="card-body">
                       
                       
                            <div class="container text-center">
                                <div class="row">
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Estado del equipo</label>
                                    <select class="form-select text-sm"id="estado{{$equipo->id}}" name="estado{{$equipo->id}}" disabled>
                                      <option selected value="{{$equipo->estado_disp}}">{{$equipo->estado_disp}}</option>
                                      <option  value="REASIGNADO">REASIGNADO</option>
                                      <option  value="NUEVO">NUEVO</option>
                                    </select>
                                    {{-- <input type="text" class="form-control text-xs" id="estado{{$equipo->id}}" name="estado{{$equipo->id}}" value="{{$equipo->estado_disp}}" disabled> --}}
                                    <input type="hidden" class="form-control text-xs" id="id{{$equipo->id}}" name="id{{$equipo->id}}" value="{{$equipo->id}}" >
                                  </div>
                                   <div class="col-lg-3">
                                    <label  class="form-label text-sm">Estatus del equipo</label>
                                    <select class="form-select" id="activo{{$equipo->id}}" name="activo{{$equipo->id}}" disabled>
                                      <option selected value="{{$equipo->activo}}" selected>{{$equipo->activo}}</option>
                                      <option  value="ACTIVO">ACTIVO</option>
                                      <option  value="INACTIVO">INACTIVO</option>
                                    </select>
                                  
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Tipo de dispositivo</label>
                                    <select class="form-select text-sm" id="tipodisp{{$equipo->id}}" name="tipodisp{{$equipo->id}}" disabled>
                                      <option selected value="{{$equipo->tipo_disp}}" selected>{{$equipo->tipo_disp}}</option>
                                      <option  value="LAPTOP">LAPTOP</option>
                                      <option  value="PC">PC</option>
                                    </select>
                                    {{-- <input type="text" class="form-control text-xs" id="tipodisp{{$equipo->id}}" name="tipodisp{{$equipo->id}}" value="{{$equipo->tipo_disp}}" disabled > --}}
                                  </div>
                                  {{-- <div class="col-lg-3">
                                    <label  class="form-label text-sm">Estado del dispositivo</label>
                                    <input type="text" class="form-control text-xs" id="" name="" value="{{$equipo->}}" readonly>
                                  </div> --}}
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Nombre del equipo</label>
                                    <input type="text" class="form-control text-xs" id="nombredisp{{$equipo->id}}" name="nombredisp{{$equipo->id}}" value="{{$equipo->nombre_disp}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Marca</label>
                                    <input type="text" class="form-control text-xs" id="marca{{$equipo->id}}" name="marca{{$equipo->id}}" value="{{$equipo->marca}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Modelo</label>
                                    <input type="text" class="form-control text-xs" id="modelo{{$equipo->id}}" name="modelo{{$equipo->id}}" value="{{$equipo->modelo}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Numero de serie</label>
                                    <input type="text" class="form-control text-xs" id="nserie{{$equipo->id}}" name="nserie{{$equipo->id}}" value="{{$equipo->num_serie}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Procesador y velocidad</label>
                                    <input type="text" class="form-control text-xs" id="pv{{$equipo->id}}" name="pv{{$equipo->id}}" value="{{$equipo->proc_velocidad}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Memoria</label>
                                    <input type="text" class="form-control text-xs" id="memoria{{$equipo->id}}" name="memoria{{$equipo->id}}" value="{{$equipo->memoria}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Almacenamiento</label>
                                    <input type="text" class="form-control text-xs" id="alm{{$equipo->id}}" name="alm{{$equipo->id}}" value="{{$equipo->disco}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Fecha de compra</label>
                                    <input type="date" class="form-control text-xs" id="fcompra{{$equipo->id}}" name="fcompra{{$equipo->id}}" value="{{$equipo->fecha_compra}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Fecha de asignación</label>
                                    <input type="date" class="form-control text-xs" id="fasig{{$equipo->id}}" name="fasig{{$equipo->id}}" value="{{$equipo->fecha_entrega}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Proveedor</label>
                                    <input type="text" class="form-control text-xs" id="prov{{$equipo->id}}" name="prov{{$equipo->id}}" value="{{$equipo->proveedor}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Sistema operativo</label>
                                    <input type="text" class="form-control text-xs" id="so{{$equipo->id}}" name="so{{$equipo->id}}" value="{{$equipo->so}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Ip del dispositivo</label>
                                    <input type="text" class="form-control text-xs" id="ipd{{$equipo->id}}" name="ipd{{$equipo->id}}" value="{{$equipo->ip}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Correo del dispositivo</label>
                                    <input type="text" class="form-control text-xs" id="correo{{$equipo->id}}" name="correo{{$equipo->id}}" value="{{$equipo->correo_disp}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">MAC</label>
                                    <input type="text" class="form-control text-xs" id="mac{{$equipo->id}}" name="mac{{$equipo->id}}" value="{{$equipo->mac}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Wifi/Ethernet</label>
                                    <select class="form-select text-sm" id="wifieth{{$equipo->id}}" name="wifieth{{$equipo->id}}" required disabled>
                                      <option selected value="{{$equipo->wifi_ethernet}}" selected>{{$equipo->wifi_ethernet}}</option>
                                      <option  value="WIFI" >WIFI</option>
                                      <option  value="ETHERNET" >ETHERNET</option>
                                    </select>
                                    {{-- <input type="text" class="form-control text-xs" id="wifieth{{$equipo->id}}" name="wifieth{{$equipo->id}}" value="{{$equipo->wifi_ethernet}}" disabled> --}}
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">IP/DHCP</label>
                                    <select class="form-select text-sm" id="ipdhcp{{$equipo->id}}" name="ipdhcp{{$equipo->id}}" disabled required>
                                      <option selected value="{{$equipo->ip_dhcp}}" selected>{{$equipo->ip_dhcp}}</option>
                                      <option  value="IP" >IP</option>
                                      <option  value="DHCP" >DHCP</option>
                                    </select>
                                    {{-- <input type="text" class="form-control text-xs" id="ipdhcp{{$equipo->id}}" name="ipdhcp{{$equipo->id}}" value="{{$equipo->ip_dhcp}}" disabled> --}}
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Observaciones</label>
                                    <input type="text" class="form-control text-xs" id="obs{{$equipo->id}}" name="obs{{$equipo->id}}" value="{{$equipo->observaciones}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Programas instalados</label>
                                    <input type="text" class="form-control text-xs" id="programas{{$equipo->id}}" name="programas{{$equipo->id}}" value="{{$equipo->programas_instalados}}" disabled>
                                  </div>
                               
                                </div>
                              </div> 
                        </form>
                        </div>
                      </div>
                      @endforeach

                </div>
{{------------------------------------------------------------------------------------------------------------------------------}}
                <div class="tab-pane fade" id="profile">
                  @foreach ($dispositivos as $dispositivos)
                    <div class="card">
                    
                      <form id="form2{{$dispositivos->id}}" name="form2{{$dispositivos->id}}" class="rounded" method="POST"  action="{{route('VerAsignacionpost2',$dispositivos->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                         Dispositivos Asignados <button type="button" class="btn btn-secondary" value="{{$dispositivos->id}}" name="btn3{{$dispositivos->id}}" id="btn3{{$dispositivos->id}}" onclick="disable1(this.value)"><i class="fa-solid fa-unlock"></i> </button> <button type="button" class="btn btn-secondary" name="btn4{{$dispositivos->id}}" id="btn4{{$dispositivos->id}}" value="{{$dispositivos->id}}" onclick="enable1(this.value)" style="display: none"><i class="fa-solid fa-lock"></i></button> <button type="submit" id="save2{{$dispositivos->id}}" nameid="save2{{$dispositivos->id}}" class="btn btn-dark" disabled><i class="fa-solid fa-pen-to-square"></i></button>
                        </div>
                        <div class="card-body">
                          
                            <div class="container text-center">
                                <div class="row">
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Estado del equipo</label>
                                    <select class="form-select text-sm"id="eqd{{$dispositivos->id}}" name="eqd{{$dispositivos->id}}" disabled>
                                      <option selected value="{{$dispositivos->estado_disp}}" >{{$dispositivos->estado_disp}}</option>
                                      <option  value="REASIGNADO">REASIGNADO</option>
                                      <option  value="NUEVO">NUEVO</option>
                                    </select>
                                    {{-- <input type="text" class="form-control text-xs" id="marcad{{$dispositivos->id}}" name="marcad{{$dispositivos->id}}" disabled> --}}
                                  </div>
                                   <div class="col-lg-3">
                                    <label  class="form-label text-sm">Estatus del dispositivo</label>
                                    <select class="form-select" id="activod{{$dispositivos->id}}" name="activod{{$dispositivos->id}}" disabled>
                                   
                                      <option  value="ACTIVO">ACTIVO</option>
                                      <option  value="INACTIVO">INACTIVO</option>
                                    </select>
                                  
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Tipo de dispositivo</label>
                              
                                    <input type="text" class="form-control text-xs" id="tdd{{$dispositivos->id}}" name="tdd{{$dispositivos->id}}" value="{{$dispositivos->t_dispositivo}}" disabled>
                                  </div>
                                 
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Marca</label>
                                    <input type="text" class="form-control text-xs" id="marcad{{$dispositivos->id}}" name="marcad{{$dispositivos->id}}" value="{{$dispositivos->marca_disp}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Modelo</label>
                                    <input type="text" class="form-control text-xs"  id="modelod{{$dispositivos->id}}" name="modelod{{$dispositivos->id}}" value="{{$dispositivos->modelo_disp}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Numero de serie</label>
                                    <input type="text" class="form-control text-xs" id="nseriedis{{$dispositivos->id}}" name="nseriedis{{$dispositivos->id}}" value="{{$dispositivos->numserie_disp}}" disabled>
                                  </div>
                               
                                 
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">MAC</label>
                                    <input type="text" class="form-control text-xs"  id="macd{{$dispositivos->id}}" name="macd{{$dispositivos->id}}" value="{{$dispositivos->mac_disp}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">IMEI</label>
                                    <input type="text" class="form-control text-xs"    id="imeid{{$dispositivos->id}}" name="imeid{{$dispositivos->id}}" value="{{$dispositivos->imei_disp}}" disabled>
                                  </div>
                                 
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Ip del dispositivo</label>
                                    <input type="text" class="form-control text-xs"    id="ipd{{$dispositivos->id}}" name="ipd{{$dispositivos->id}}" value="{{$dispositivos->ip_disp}}" disabled>
                                  </div>
                                
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Fecha de compra</label>
                                    <input type="date" class="form-control text-xs"   id="fcd{{$dispositivos->id}}" name="fcd{{$dispositivos->id}}" value="{{$dispositivos->fecha_compra}}" disabled>
                                  </div>
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Fecha de asignación</label>
                                    <input type="date" class="form-control text-xs"   id="fad{{$dispositivos->id}}" name="fad{{$dispositivos->id}}" value="{{$dispositivos->fecha_asignacion}}" disabled>
                                  </div>
                                  
                                  <div class="col-lg-3">
                                    <label  class="form-label text-sm">Observaciones</label>
                                    <input type="text" class="form-control text-xs"   id="obsd{{$dispositivos->id}}" name="obsd{{$dispositivos->id}}" value="{{$dispositivos->observaciones_disp}}" disabled>
                                  </div>            
                                </div>
                              </div> 
                        </form>
                        </div>
                       
                      </div> 
                      @endforeach
                </div>
{{------------------------------------------------------------------------------------------------------------------------------}}
                <div class="tab-pane fade" id="messages">
                    <div class="card ">
                        <div class="table-responsive  p-3" id="mydatatable-container">
                            <table class="records_list table table-striped table-bordered table-hover text-xs " id="mydatatable" cellspacing="0">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class=" text-center" style="width: 30px">ID</th>
                                        <th class=" text-center">DESCRIPCION</th>
                                        <th class=" text-center">USUARIO</th>
                                        <th class=" text-center">CONTRASEÑA</th>
                                        <th class=" text-center">URL/APP</th>
                                        <th class=" text-center"style="width: 50px">CATEGORIA</th>
                                        <th class=" text-center" style="width: 30px">EDITAR</th>
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
                                    @foreach ($password as $passw)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="text-center">{{$passw->id}}</td>
                    <td class=" text-center">{{$passw->descripcion}}</td>
                    <td class=" text-center">{{$passw->user_email}}</td>
                    <td class=" text-center">{{$passw->password}}</td>
                    
                    <td class=" text-center">{{$passw->urlapp}}</td>
                    <td class=" text-center">{{$passw->categoria}}</td>
                    <td class=" text-center">              
                      <a>
                        <div class="flex item-center justify-center">
                          <button class="w-4 mr-2 transform hover:text-green-700 hover:scale-130" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                              </svg>
                          </button>
                      </div>
                    </a>   
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
{{-- modal contraseñas --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-gradient-to-tr from-gray-500 to-gray-900  rounded-lg  text-white font-bold text-md">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Accesos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class=" shadow p-3  rounded" method="POST" action="{{route('contrasenas',2)}}" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="" class="form-label">ID</label>
            <input type="text" class="form-control" id="idpw" name="idpw" readonly >
          </div>
          <div class="mb-3">
            <label for="" class="form-label">DESCRIPCION</label>
            <input type="text" class="form-control" id="descpw" name="descpw" >
          </div>
        
          <div class="mb-3">
            <label for="" class="form-label">USUARIO</label>
            <input type="text" class="form-control" id="userpw" name="userpw" readonly >
          </div>
          <div class="mb-3">
            <label for="" class="form-label">CONTRASEÑA</label>
            <input type="text" class="form-control" id="passpw" name="passpw" >
          </div>
          <div class="mb-3">
            <label for="" class="form-label">URL/APP</label>
            <input type="text" class="form-control" id="urlpw" name="urlpw" >
          </div>
          <div class="mb-3">
              <label for="" class="form-label">CATEGORIA</label>
              <input type="text" class="form-control" id="catpw" name="catpw" >
            </div>
            <div class="mb-3">
              <label for="" class="form-label">ESTATUS</label>
              <select class="form-select" name="estatusu" id="estatusu">
                <option  selected value="ACTIVO">ACTIVO</option> 
                <option value="INACTIVO">INACTIVO</option>
           
              </select>
            </div>
            
          <div class="d-flex justify-content-center"><button type="submit" class="btn shadow btn-dark">Aceptar</button></div>
          
        </form>
      </div>
      
    </div>
  </div>
</div>
@stop

@section('css')
<link rel="icon" href="{{asset('images/icono.png')}}">
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
<script>
  function disable(value){
 $("#form"+value+" :input").prop('disabled', false);
 $("#btn1"+value).css("display", "none"); 
 $("#btn2"+value).css("display", "");
 $("#save"+value).attr("disabled", false)
}

function enable(value){
 $("#form"+value+" :input").prop('disabled', true);
 $("#btn2"+value).css("display", "none");
 $("#btn1"+value).css("display", "");
 $("#btn1"+value).attr("disabled", false);

}

function disable1(value){
 $("#form2"+value+" :input").prop('disabled', false);
 $("#btn3"+value).css("display", "none"); 
 $("#btn4"+value).css("display", "");
 $("#save"+value).attr("disabled", false)
}

function enable1(value){
 $("#form2"+value+" :input").prop('disabled', true);
 $("#btn4"+value).css("display", "none");
 $("#btn3"+value).css("display", "");
 $("#btn3"+value).attr("disabled", false);

}
  </script>
   <script>
    $("body").on("click", "#mydatatable-container a", function(event) {
        event.preventDefault();
        idsele = $(this).attr("href");
        id= $(this).parent().parent().children("td:eq(0)").text();
        descripcion= $(this).parent().parent().children("td:eq(1)").text();
      usuario  = $(this).parent().parent().children("td:eq(2)").text();
      contra  = $(this).parent().parent().children("td:eq(3)").text();
       url = $(this).parent().parent().children("td:eq(4)").text();
      categoria  = $(this).parent().parent().children("td:eq(5)").text();
        //Cargamos en el formulario los valores del registro
        $("#idpw").val(id);
        $("#descpw").val(descripcion);
        $("#userpw").val(usuario);
        $("#passpw").val(contra);
        $("#urlpw").val(url);
        $("#catpw").val(categoria);
          
    });
  
    </script>
        {{--  --}}
       
@stop
@endcan