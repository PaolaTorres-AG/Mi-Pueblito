@extends('adminlte::page')
@section('title', 'Agroin')
@section('content_header')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
* {

font-family: 'Poppins', sans-serif;
}
h1#demo-title {
    margin: 30px 0px 80px 0px;
    text-align: center;
}

table tr {
    position: relative;
}

#event-action-response {
    background-color: 
#c4c6fb;
    border: 
#0ab53f 1px solid;
    padding: 10px 20px;
    border-radius: 3px;
    margin-bottom: 15px;
    color: 
#812c2c;
    display: none;
}

.fc-day-grid-event .fc-content {
    background: 
#40ae0e;
    color: 
#FFF;
    margin-bottom: 4px;
    padding: 3px;
    border-radius: 5px;

}

.fc-event,
.fc-event-dot {
    background-color: rgb(88, 117, 93);
}

.fc-event,
.fc-event-dot {
    background-color: 
rgb(40, 210, 25);
}

.fc-event {
    border: 1px solid 
#fff;
}
.fc-past {
        background-color:#e3e8e5;
    }


    .tooltip {
  display: block;
  position: absolute;
  top: 0px;
  left: 50%;
  transform: translate(-50%, -50%) scale(0.75) rotate(5deg);
  transform-origin: bottom center;
  padding: 10px 30px;
  border-radius: 5px;
  background: rgba(0, 0, 0, 0.75);
  text-align: center;
  color: white;
  transition: 0.15s ease-in-out;
  opacity: 0;
  width: 100%;
  max-width: 100vw;
  pointer-events: none;
  z-index: 5;
}
.tooltip.blue {
  background: rgba(71, 184, 224, 0.75);
}
.tooltip.blue:after {
  border-top: 5px solid rgba(71, 184, 224, 0.75);
}
.tooltip.red {
  background: rgba(231, 29, 54, 0.75);
}
.tooltip.red:after {
  border-top: 5px solid rgba(231, 29, 54, 0.75);
}
.tooltip.green {
  background: rgba(46, 196, 182, 0.75);
}
.tooltip.green:after {
  border-top: 5px solid rgba(46, 196, 182, 0.75);
}
.tooltip.purple {
  background: rgba(165, 147, 224, 0.75);
}
.tooltip.purple:after {
  border-top: 5px solid rgba(165, 147, 224, 0.75);
}
.tooltip:hover {
  opacity: 1;
  transform: translate(-50%, -100%) scale(1) rotate(0deg);
  pointer-events: inherit;
}
.tooltip img {
  max-width: 100%;
}
.tooltip:after {
  content: "";
  display: block;
  margin: 0 auto;
  widtH: 0;
  height: 0;
  border: 5px solid transparent;
  border-top: 5px solid rgba(0, 0, 0, 0.75);
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translate(-50%, 100%);
}

.field {
  position: relative;
  padding: 20px;
}

</style>


@stop

@section('content')

<input type="hidden" name="username" class="form-control" id="username" value="{{Auth::user()->name}} {{Auth::user()->lastname}}" />
<input type="hidden" name="userid" class="form-control" id="userid" value="{{Auth::user()->id}}" />
<div class="container ">
  <select class="form-select p-3 text-lg text-center mb-2 shadow-md fw-bolder" id="sala" name="sala" width='50%' disabled>
   
    <option  selected="selected" value="1" >Sala de juntas mi pueblito</option>
    {{-- <option value="2"></option>
    <option value="3"></option>
    <option value="4"></option> --}}
  </select>
    <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded" id='calendar'></div>
</div>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Editar evento</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <form>
            <div class="mb-3">
                <label for="disabledTextInput" class="form-label text-sm">Título</label>
                <input type="text" id="titulo" name="titulo" class="form-control form-control-sm" onkeyup="desblock2()">
                <input type="hidden" name="event_id" class="form-control" id="event_id" value="" />
                      <input type="hidden" name="event_r" class="form-control" id="event_r" value="" />
                <input type="hidden" name="appointment_id"  class="form-control" id="appointment_id" value="" />
              </div>
            
              <div class="container px-4 text-center ">
                <div class="row gx-5">
                  <div class="col ">
                    <label for="disabledTextInput" class="form-label text-sm">Fecha inicial</label>
                <input  id="finicial" name="finicial" class="form-control datepicker form-control-sm" readonly onchange="desblock2()">
                  </div>
                  <div class="col">
                    <label for="disabledTextInput" class="form-label text-sm">Fecha final</label>
                <input  id="ffinal" name="ffinal" class="form-control datepicker form-control-sm" readonly onchange="desblock2()">
                  </div>
                </div>
               
              </div>
         </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" id="eliminar"  name="eliminar" onclick="eliminar()">Eliminar</button>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" id="addsubmit" class="btn btn-primary btn-sm" onclick="editar()" disabled>Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>
  {{--  --}}
  <!-- Modal -->
<div class="modal fade" id="editModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Crear evento</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <form id="formadd">
            <div class="mb-3">
                <label for="disabledTextInput" class="form-label text-sm">Título</label>
                <input type="text" id="titulo2" name="titulo2" class="form-control form-control-sm " onkeyup="desblock()">
                <input type="hidden" name="event_id2" class="form-control" id="event_id2" value="" />
                <input type="hidden" name="appointment_id2"  class="form-control" id="appointment_id2" value="" />
              </div>
            
              <div class="container px-4 text-center ">
                <div class="row gx-5">
                  <div class="col ">
                    <label for="disabledTextInput" class="form-label text-sm">Hora inicial</label>
                <input  id="finicial2" name="finicial2" class="form-control datepicker form-control-sm" readonly onchange="desblock()">
                  </div>
                  <div class="col">
                    <label for="disabledTextInput" class="form-label text-sm">Hora final</label>
                <input  id="ffinal2" name="ffinal2" class="form-control datepicker form-control-sm" readonly onchange="desblock()">
                  </div>
                </div>
               
              </div>
            <br>
              <p><span>***Frecuencia***</span></p>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="frecuencia1" name="frecuencia" value="Unica" checked>
                <label class="form-check-label text-sm" for="frecuencia1">Unica</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="frecuencia2" name="frecuencia" value="daily">
                <label class="form-check-label text-sm" for="frecuencia2">Diaria</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="frecuencia3" name="frecuencia" value="weekly">
                <label class="form-check-label text-sm" for="frecuencia3">Semanal</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="frecuencia4" name="frecuencia" value="monthly">
                <label class="form-check-label text-sm" for="frecuencia4">Mensual</label>
              </div>
            
              <div class="form-check form-check-inline">
                <label class="form-check-label text-sm" for="frecuencia5">Repetir este evento hasta:</label>
                <input  id="rhasta" name="rhasta" type="date" class="form-control  form-control-sm" >
             
              </div>

         </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary btn-sm" id="editsubmit" onclick="agregar()" disabled>Aceptar</button>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')

<link rel="icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOwAAAB9CAMAAACWN3/AAAAAwFBMVEX///8AAACuyQxAQEB/f3+/v7/v7+8QEBAwMDDPz8/f399wcHAgICDC10mfn5/6/PCPj4/W5IWvr6/r8cJQUFBgYGDM3We40Cr1+OHS4Xfh66Tw9dG90zrm7rPH2ljb55T7x1380GT82GqkvQv81Iz+89/+33D+79VXZAMmLgH/+/T70IH9579sfgT6xVqYsQr+6nn94Kv97MpiZVA/SgKDlwi8yHT7zXdKVwL7yGx3iwQPEgD815b95XYzPQFVV1DSYYu2AAAJEElEQVR4nO1caWObOBA1Acxl4zuxncvpkbRNmzZ7d7fd/f//akEgaUYHRtgcIX6fklgBPTTHm5HwYHDCCSeccMJLRtj2BBrE0Ju3PYXmEFmjYdtzaAquZVlR25NoCqOErOW2PYtm4KRcX4khB1aGV2HIdk7WCtqeSf2YUq6W3/ZUakfoMbKW0/Zk6sbSAui5Ic8hV8tuezq1Yughsta07QnViRXmank9rghcS0R/DXk4kshacduTqguOzNXyeqoaAwVXy1q2Pa164CvJWr2s46dqrr00ZKgTLR/+Ylr+rBfXs9lmnOJmtl2sa5nuYbDhagZISZWv4y9vz8dnIi5mXeOL2DmYe7k6fjGTeVKcd4ou0omjgWDVew15fXujJZph0wCJskA6kZgtileF5c/l5mIP0xRXzRApAaQT83WEhqyv49ezMkyJKU8aIrMHSCfSVIM0hrqOn2yvSjJNMWuQUQEiyIuJCKQeFYa8ODdgmuCiSUpaoDUE8hCut1j+TLay+SaJ9ZxkWI1lXzbKSgOoE2EFizwZ1fHrmUBzs10gl1yownMX7NjRcorUT2GN7Hc8U6+Y7NAdSD8oo2JrHao+WsA1O78uurRg6uO6KJQH1on4M6SrSB2/GJdlmmKCjLl9M44LMwzsrCY5CVAdb0td/rZLZCWdiIFs/Ffuq5vSYheEstujzrwCUFNcUd4A1fiBTvri1kQM8TDVdupR6UQM6tK/vaVUy9kvw5qRPcaEDwDSiepKLiSfffy9ItUBN+Rzw//79Pz4+Pjus/H9dFDrRIw0DX/J5/v2jwo3uaxmxQ+7p12Cpz/fV7inAjqdiOH/RS34S7X9+EpZ9v3T7o5gt/tU4Z4ykE7U0VhQZfD1o86v9yDLV3uTMsb3hOubFHe7dxXuKUGvEzkmG2rBH7QRex+I0xrWPJ+fEq739z/v39zdPR2hEg4hV82mDlvWv//JB1bYj59VWNgfu4Trz2/fUra7IwQppBOV23VsWb/+y0ea78fPzD128JiS/ZbgZ0L22fiWIlCTScngki7r5j841ng/PiVr2l58R8neH4Ms0olK22RC77rE4CJsKijFZ2jGv5j+t4h9OnFCNf9VuiioXDDdjx+f3RhPb/KUsk2QcN0Z/7cAVLwp8smCSf7sd+jgpvvxZ2cVwulznnruDl/YfTqRmTBVhwUl/j5MqlUAP3a7TFMc7LHFOpHX3HyaZZKyGltzOU3wTNTi94MdFhU7kk68pFXZFTS/UnJLhUXlaT48PBxBGBdOnLnrGLlaOSHdPSCTFI+IbClXsSQrUyIRBNOVbdtLR6Mswyj5EN41cJbJeDuKy9lL6DoJ3JLGVagTZzqu6k0SGTE3mxHRKhbVLNkPEX7GQwdcdgXjvA0nmDwgO8CXX5VSN0Vp5FzLVfD0lfraAT6Z4QcC2aGPn7ErHEcCUg6RTX9JLGWOhpcowYp0YhFX1camCCo+fNvOWHkxJku0jD2iWhyMz3+ymckoyFJPonlQ88Q5CqQfTznqFgpuRSoMOZu7nTnfMCbTjSFZj6wue3EoHz8n44OIXN6n15XJkoe9IuEinHpl1lZ/yHbCGoE6ebdHd5GP4TtBcw/aT/YzCE2uMD604XJJZFNbsZnbDZda+yoxX871SivvUFko3ogsvI8WPPRFso44Hj1vsnZzDVnBbon7F+bAAktkNnyhl7JhUfkTKYw7+wdOFkbxNAN6Qkhd8TEKsthHiWEUZSCULNHS8HZ/kZQtiG7kOUpmFWOykTBezNckv8UasuKT9IvtWK8TOddiKYtSC1qWqfToCUaIrIvHyyWFy0xGJivqn0h64NKdKZAuYLppXy8bqUZkyEuRPefEyQrjFeuSTpFEIYmsJw51CslqdeI146oPTqprwPLHU+2MZU+HkR3h8dL0B9lyEeOWyErByFX9Ed6XAVoQ34/ZX3ti1QgEmO7OkKyN/64qjOd0vERWWkRXcwn2H6pp8qRT5igA8nt+r1BnUxqyrma8exyyKJJCA9wwrgVZhyNSXqd+spKDF5DV5kjusOVa2ShX8zBnabSqhmyoGX8csjqdOOFcS7aykQpjfuqpu6woQMGl1Mw0puZyCFnxkC0DN+Kzsh0U9NyoLkjno9AzUx1ZXz1+RWkdQFarExfGCyt4BDXkqaV0wpGObOr68ps0Q5aRDiCr1YljQ48lQLEu97yhpWpgYLkIyQaWqk502AWrk9V2GcDCmuwqqsqf9HmKXht4WrLKdEKkQAhvYU5W3z8CC2tyTgnpk3x9iKcs0VplXDVkyQJgQyZlW74WlckijQcrDaCdzBr36IoRmL0Ptb6XNyeUZDPXggmfdLDoWlQlq9WJ8EyW4d44Kn/yeeRtlilJbG7WN0RtGUdxDZuSGDrpg2EVblWyukO2gwE4Sml4dAdFAeqqcximyd1csZUKkfca/Sh2XSfPZ8yuK5LV6kR2bCeF6R4qiu+UxRC/grsMgYyUyeaNJPhwuNqpRraglwLPUZruyeA3UNkkwxW9nUfa2C57wAqyUicYhLdqZB0bAJfXQD0J8Yl8cjUuOnxKtiEo4EyCOPlDnP9lzqYpjGJ0Vzlfe4oiuXpHACJIN0308xMBX7JSf3LwudnU2vfuXgduA99lc0yy6cNXt1lUDYwWAMniAy3mnpzmGFn+pcGxI19TA19tQLRYjWtwHIJ07AW2QP61DlC34zKARi4TpUGI+YjZFKaltgEKd7zBQ7tSRkqDCCgvYnTjkZzs2gS0Y2CxTDKbHf7IdyBHdpJlVnnq8EtukTcAuLSAGBMbhsfwxL3lzgSnDEAwgtYijdLmLwvGqEBYdSQ2UVzyWoDtBjArrvJGWRhHmVhz5t2xYIoJ14w0RjFP7tS76scBf715TNgxR+7Ou9tHxfp6Mx5TacEq+tbfsWoAzIs78pp6nWB7ta2/KdgA2ML2MDyJ0B/o6x94c/UVLOzNK/JYvh3yCkLxxStaWBaduvF9IbWCR6eKbzG8JLDo1IHvlKgbfIOg7Zfx6wcv5DvwzSg1A5z96n/a4c03wzd7XyB4w6L/opgfwt17MPXFg3PtfyQGHdXeywnAtfcOCw4I9bShCDBZMPQ+OJ1wwgmdwP/W92x8A1sCMwAAAABJRU5ErkJggg=="> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet"/>

@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>


<script>
  $(document).ready(function() {

 // Obtener fecha actual
let fecha = new Date();
// Agregar 3 días
fecha.setDate(fecha.getDate() + 1);
// Obtener cadena en formato yyyy-mm-dd, eliminando zona y hora
let fechaMin = fecha.toISOString().split('T')[0];
// Asignar valor mínimo
document.querySelector('#rhasta').min = fechaMin;
document.getElementById('rhasta').value=fechaMin;
});
$(function() {
  $('.datepicker').datetimepicker({
    step: 30 ,
    format: 'Y-m-d H:i',
    minTime:'06:00',
    maxTime:'20:30',
    locale: 'es',
    minDate:0
  });
 
});
 </script>
 <script>
    
  function desblock(){
    let titulo= $('#titulo2').val();
    let fi= $('#finicial2').val();
    let ff= $('#ffinal2').val();
    
    
    if(titulo!="" && fi!="" && ff!=""){
      document.querySelector('#editsubmit').disabled = false;
    }else{
      document.querySelector('#editsubmit').disabled = true;
    }
  }

  function desblock2(){
    let titulo= $('#titulo').val();
    let fi= $('#finicial').val();
    let ff= $('#ffinal').val();
    
    
    if(titulo!="" && fi!="" && ff!=""){
      document.querySelector('#addsubmit').disabled = false;
    }else{
      document.querySelector('#addsubmit').disabled = true;
    }
  }
  </script>
 <script>
    $(document).ready(function () {
      var id = $('#sala').val(); //outside
        var calendar = $('#calendar').fullCalendar({
            editable:true,
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
            dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            eventLimit: true,
            selectOverlap: false,
            defaultView: 'agendaWeek',
            minTime: "06:00:00",
            maxTime: "20:30:00",
            selectable: true,
            selectHelper: true,
            nowIndicator: true,

    buttonText: {
        today:    'Hoy',
        month:    'Mes',
        week:     'Semana',
        day:      'Día',
        list:     'Lista'
    },
  timeZone: 'America/New_York',
           
    plugins: ['interaction', 'dayGrid', 'timeGrid'],
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay,list'
            },
            
         
          eventRender: function(event, element) {
                if(event.lugar == "1") {
                    element.css('background-color', '#9fe71a');
                    element.css('color', '#537e02');
                    element.css('font-weight', 'bold');
                }
                else if(event.lugar == "2")
                {
                  element.css('background-color', '#9168ff');
                  element.css('color', '#FFFFFF');
                    element.css('font-weight', 'bold');
                }
                else if(event.lugar == "3")
                {
                  element.css('background-color', '#d8f400');
                  element.css('color', '#537e02');
                  element.css('font-weight', 'bold');
                }
                else if(event.lugar == "4")
                {
                  element.css('background-color', '#0010ff');
                  element.css('color', '#FFFFFF');
                  element.css('font-weight', 'bold');
                }
          
          },
          events: {
        url: "{{route('event.get') }}",
        cache: false,
        lazyFetching:true,
        type: 'get',
        data: {
            id:$('#sala').val()
        },
        
        error: function () {
           
        },  
                 
    }, 
   
eventMouseover: function(event, jsEvent) {
var tooltip = '<div class="card text-bg-dark mb-3 calendarTooltip" style="padding-left:10px; border-radius: 8px;position:absolute;z-index:10001;"><div class="card-header text-sm text-center">' + event.title + '</div><div class="card-body"><p class="card-title text-xs"><i class="fa  fa-user"></i> Creado por: ' + event.user_name + '</p><p class="card-text text-xs"><i class="fa fa-solid fa-clock"></i> Horario: ' + event.start.format(' HH:mm') +' - '+ event.end.format(' HH:mm') + '</p><p class="card-text text-xs"><i class="fa  fa-location-dot"></i> Lugar: ' + event.description + '</p></div></div>';
            var $tool = $(tooltip).appendTo('body');
            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                        $tool.fadeIn('1000');
                        $tool.fadeTo('10', 1.9);
            }).mousemove(function(e) {
                $tool.css('top', e.pageY + 10);
                $tool.css('left', e.pageX + 20);
            });
            },
            eventMouseout: function(event, jsEvent) {
            $(this).css('z-index', 8);
            $('.calendarTooltip').remove();
            },
// 
slotEventOverlap: false,
            selectable:true,
            selectHelper: true,
   
            select:function(start, end, allDay)
            {
              var hoy             = new Date();
var fechaFormulario = new Date(start);
hoy.setHours(0,0,0,0); 
if (hoy <= fechaFormulario){
            $('#editModal2').modal('show');        
            $('#finicial2').val(moment(start).format('YYYY-MM-DD HH:mm'));
            $('#ffinal2').val(moment(end).format('YYYY-MM-DD HH:mm'));
  }else{
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "No puedes agendar en fechas pasadas",
});
   
  }
  },
            editable:true,
      
            eventResize: function(event, delta)
            {
                let userid= $('#userid').val();
              if(userid==event.user_id){
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"{{ route('event.store') }}",
                    type:"POST",
                    headers:{
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                    
                        type: 'update',
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire({
      title: "Evento actualizado",
      text: "",
      icon: "success"
    });
                    } ,
                    error: function (xhr, ajaxOptions, thrownError) {
                          Swal.fire({
  icon: "error",
  title: "Revisa la información de tu evento!",
  text: "No puedes agregar eventos sobre horas apartadas",
 
});
calendar.fullCalendar('refetchEvents');
      }
                });
              }else{
                  calendar.fullCalendar('refetchEvents');
              Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "Solo el creador puede editar este evento!",
 
});
            }
                
            },
         
//   ///////
 eventOverlap: function(stillEvent, movingEvent) {
    function checkOverlap(event) {  

var start = new Date(event.start);
var end = new Date(event.end);

var overlap = $('#calendar').fullCalendar('clientEvents', function(ev) {
    if( ev == event)
        return false;
    var estart = new Date(ev.start);
    var eend = new Date(ev.end);

    return (Math.round(estart)/1000 < Math.round(end)/1000 && Math.round(eend) > Math.round(start));
});

if (overlap.length){  
        //either move this event to available timeslot or remove it
   }                  
}
  },
            eventDrop: function(event, delta)
            {
               let userid= $('#userid').val();
              if(userid==event.user_id){ 
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"{{ route('event.store') }}",
                    type:"POST",
                    headers:{
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire({
      title: "Evento actualizado",
      text: "",
      icon: "success"
    });
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                          Swal.fire({
  icon: "error",
  title: "Revisa la información de tu evento!",
  text: "No puedes agregar eventos sobre horas apartadas",
 
});
calendar.fullCalendar('refetchEvents');
      }    
                });
              }else{
                calendar.fullCalendar('refetchEvents');
              Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "Solo el creador puede editar este evento!",
 
});
            }
            },
            // /////////////
            eventClick:function(event,jsEvent, view)
            {
              let userid= $('#userid').val();
             
               var actual = new Date();
                $('#event_id').val(event._id);
            $('#appointment_id').val(event.id);
            $('#titulo').val(event.title);
              $('#event_r').val(event.event_id);
            $('#finicial').val(moment(event.start).format('YYYY-MM-DD HH:mm'));
            $('#ffinal').val(moment(event.end).format('YYYY-MM-DD HH:mm'));
            if(userid==event.user_id){
              $('#editModal').modal('show');
            }else{
              Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "Solo el creador puede editar este evento!",
 
});
            }
           
            }
        

            
        });
    });
    </script>
    <script>
     $('#sala').change(function() {

var events = {
  url: "{{route('event.get') }}",
        cache: false,
        lazyFetching:true,
        type: 'get',
        data: {
            id:$('#sala').val()
        },
}

$('#calendar').fullCalendar('removeEventSource', events);
$('#calendar').fullCalendar('addEventSource', events);
$('#calendar').fullCalendar('refetchEvents');
}).change();

    </script>
    <script>
  function BorrarSecuencia($id){
    let id=$id;

    $.ajax({
                        url:"{{ route('event.store') }}",
                        type:"POST",
                        headers:{
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{
                            id:id,
                            type:"secuencia",
                        },
                        success:function(response){
                            $('#editModal').modal('hide');
                            $('#calendar').fullCalendar('refetchEvents');
                         
                            Swal.fire({
      title: "Secuencia eliminada",
      text: "",
      icon: "success"
    });                       
   }
  }) 
  }
   </script>
   <script>
    function BorrarActual($id){
      let id=$id;
      $.ajax({
                        url:"{{ route('event.store') }}",
                        type:"POST",
                        headers:{
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{
                            id:id,
                            type:"delete"
                        },
                        success:function(response){
                            $('#editModal').modal('hide');
                            $('#calendar').fullCalendar('refetchEvents');
                         
                            Swal.fire({
      title: "Evento eliminado",
      text: "",
      icon: "success"
    });                       
   }
  }) 
    }
     </script>
    <script>
                 function eliminar(){
                    let id= $('#appointment_id').val();
                    let recurrente= $('#event_r').val();
                   
                    if(recurrente>=1){
                      Swal.fire({
  title: "¡Este es un evento programado!",
  text: "¿Desea eliminar la secuencia o solo el evento seleccionado?",
  icon: "warning",
  showDenyButton: true,
  showCancelButton: false,
  confirmButtonText: "Borrar evento seleccionado",
  denyButtonText: "Borrar secuencia"
}).then((result) => {
  if (result.isConfirmed) {
    BorrarActual(id);
} else if (result.isDenied) {
  BorrarSecuencia(recurrente);
 
  }
});
                    }else{
                Swal.fire({
  title: "¿Estás seguro?",
  text: "Está accion no se puede revertir",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Borrar",
  CancelButtonText: "Cancelar",
}).then((result) => {
  if (result.isConfirmed) {
    BorrarActual(id);
  }
});
                    }
  }   
        </script>
        <script>
            function editar(){
               let id= $('#appointment_id').val();
               let end= $('#ffinal').val();
               let start= $('#finicial').val();
           
               let title= $('#titulo').val();
               let userid= $('#userid').val();
               let salaid= $('#sala').val();
           let salaname=$('#sala').find('option:selected').text();
               
           Swal.fire({
title: "¿Estás seguro de actualizar el evento?",
text: "",
icon: "warning",
showCancelButton: true,
confirmButtonColor: "#3085d6",
cancelButtonColor: "#d33",
confirmButtonText: "Aceptar",
CancelButtonText: "Cancelar",
}).then((result) => {
if (result.isConfirmed) {
    $.ajax({
                    url:"{{ route('event.store') }}",
                    type:"POST",
                    headers:{
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        userid:userid,
                        salaid:salaid,
                           salaname:salaname, 
                        type: 'update'
                    },
                    success:function(response)
                    {
                        $('#editModal').modal('hide');
                            $('#calendar').fullCalendar('refetchEvents');
                     
                        Swal.fire({
      title: "Evento actualizado",
      text: "",
      icon: "success"
    });
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                          Swal.fire({
  icon: "error",
  title: "Revisa la información de tu evento!",
  text: "No puedes agregar eventos sobre horas apartadas",
 
});
      }
                })
}
});
            }

 
      
   </script>
    <script>
   
 function agregar(){
   
           let id= $('#appointment_id2').val();
           let end= $('#ffinal2').val();
           let start= $('#finicial2').val();
            start = moment(start).add(10, 'seconds').add(1, 'minutes').format('YYYY-MM-DD HH:mm');
           let title= $('#titulo2').val();
           let username= $('#username').val();
           let userid= $('#userid').val();
           let salaid= $('#sala').val();
           let salaname=$('#sala').find('option:selected').text();
           let radio=  $('input:radio[name="frecuencia"]:checked').val();
        let rhasta= $('#rhasta').val();
                   if(radio=='Unica')
                   {
                 
                    $.ajax({
                        url:"{{ route('event.store') }}",
                        type:"POST",
                        headers:{
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            userid:userid,
                            username:username,
                           salaid:salaid,
                           salaname:salaname, 
                            type: 'add'
                        },
                        success:function(data)
                        {
 $('#editModal2').modal('hide');
$('#calendar').fullCalendar('refetchEvents');
document.getElementById("formadd").reset();
Swal.fire({
      title: "Evento actualizado",
      text: "",
      icon: "success"
    });
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                          $('#calendar').fullCalendar('refetchEvents');
                          Swal.fire({
  icon: "error",
  title: "Revisa la información de tu evento!",
  text: "No puedes agregar eventos sobre horas apartadas",
 
});
      }
                    });
                   }
                   else{

                    $.ajax({
                        url:"{{ route('event.store') }}",
                        type:"POST",
                        headers:{
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            recurrence: radio,
                            userid:userid,
                            username:username,
                            salaid:salaid,
                           salaname:salaname, 
                            type: 'recurring',
                            rhasta:rhasta,
                        },
                        success:function(data)
                        {
 $('#editModal2').modal('hide');
$('#calendar').fullCalendar('refetchEvents');
document.getElementById("formadd").reset();
Swal.fire({
      title: "Evento creado",
      text: "",
      icon: "success"
    });
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                          $('#calendar').fullCalendar('refetchEvents');
                          Swal.fire({
  icon: "error",
  title: "Revisa la información de tu evento!",
  text: "Ya existe un evento programado sobre el periodo que seleccionaste." ,
 
});
      }
                    });
                   }

                 
                
        }


  
</script>

@stop