<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Soportes;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Equipos;
use App\Models\Passwords;
use App\Models\Dispositivos;
use App\Models\Activosti;
use Illuminate\Support\Facades\Crypt;
use App\Models\Asignaciones;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeController extends Controller
{
    public function Panel()
    {
        
    $id = Auth::id();
    $info = DB::table('users')->where('id',$id)->take(1)->get();
    $directorio = DB::table('users')->where('active','=','ACTIVO')->get();
               return view('ti.Panel',compact('info','directorio'));
    } 
//////////////////////////////////////////Roles y Usuarios//////////////////////////////////////////////////////////////////// 
public function Roles()
    {
        $permisos = DB::table('permissions')->get();
        $roles= Role::with('permissions')->get();
        return view('ti.Roles',compact('permisos','roles'));
    }
    public function RolesRegister(Request $request)
    {
        $request->validate([
    'name' =>'required', 'permisos' =>'required'
         ]);
         
    DB::beginTransaction();
    try {
        $role = Role::create(['name' =>strtoupper($request->name)]);
        $role->syncPermissions($request->permisos);
        DB::commit(); 
        $request->session()->flash('alert-success', 'ROL CREADO');
        return redirect()->back()->withSuccess('ROL CREADO! ');
        } catch (\Exception $e) {
        DB::rollback();
        $request->session()->flash('alert-danger', 'ERROR AL CREAR EL PERMISO ');
        return redirect()->back()->withDanger('ERROR AL CREAR EL PERMISO');
        } catch (\Throwable $e) {
        DB::rollback();
        $request->session()->flash('alert-danger','ERROR AL CREAR EL PERMISO ');
        return redirect()->back()->withDanger('ERROR AL CREAR EL PERMISO ');
        }  
    }

    public function EditRol($role)
    {
        $role = Role::where('id', $role)->with('permissions')->first();
        $permisos = Permission::all();
        $permissions = Permission::all();
        return view('ti.EditRoles')->with('permisos',$permisos)->with('role',$role)->with('permissions',$permissions);

    }
    public function EditRolP(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
               'perm' =>'required'
                     ]);
                     $role = Role::findByName($request->RoleName);
                    $role->syncPermissions($request->perm);
        DB::commit(); 
        $request->session()->flash('alert-success', 'ROL ACTUALIZADO');
        return redirect()->back()->withSuccess('ROL ACTUALIZADO! ');
        } catch (\Exception $e) {
        DB::rollback();
        $request->session()->flash('alert-danger', 'ERROR AL ACTUALIZAR EL ROL ');
        return redirect()->back()->withDanger('ERROR AL ACTUALIZAR EL ROL');
        } catch (\Throwable $e) {
        DB::rollback();
        $request->session()->flash('alert-danger','ERROR AL ACTUALIZAR EL ROL ');
        return redirect()->back()->withDanger('ERROR AL ACTUALIZAR EL ROL');
        }  
    }
//////////////////////////USUARIOS////////////////////////////////////77777
public function RegistroUsuarios()
{
    $roles = DB::table('roles')->get();
    $roles2 = DB::table('roles')->get();
    $users = DB::table('users')->get();
    $usersa = DB::table('users')->where('active','=','ACTIVO')->get();
 $users2 =User::with('roles')->get();
    return view('ti.Usuarios',compact('users','roles','roles2','usersa','users2'));
}
public function ViewAddAdminRegister(Request $request){
    $request->validate([
        'name'=>'required',
        'lastname'=>'required',
    'email'=>'required',
    'password'=>'required',
 
    'rol'=>'required',
    'dto'=>'required',
   
]);
 DB::beginTransaction();
try {
$registro = new User();
$registro->name =strtoupper($request->name);
$registro->email = $request->email;
$registro->password	 =Hash::make($request->password);
$registro->lastname=strtoupper($request->lastname);
$registro->dto=strtoupper($request->dto);
$registro->puesto=strtoupper($request->puesto);
$registro->ext=strtoupper($request->ext);
$registro->nomina=strtoupper($request->nomina);
$registro->active="ACTIVO";
$registro->save(); 
$registro->assignRole($request->rol);
DB::commit();
$request->session()->flash('alert-success', 'REGISTRO EXITOSO!');
return redirect()->back()->withSuccess('REGISTRO EXITOSO!');
} catch (\Exception $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'NO SE PUDO HACER EL REGISTRO DE USUARIO'.$e);
return redirect()->back()->withDanger('NO SE PUDO HACER EL REGISTRO DE USUARIO'.$e);
} catch (\Throwable $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'NO SE PUDO HACER EL REGISTRO DE USUARIO '.$e);
return redirect()->back()->withDanger('NO SE PUDO HACER EL REGISTRO DE USUARIO'.$e);
}
}
public function EditarInfoUser(Request $request)
{
    $request->validate([
        'nameu'=>'required',
        'lastnameu'=>'required',
    'mailu'=>'required',
    'estatusu'=>'required',
    'dtou'=>'required',
    'nominau'=>'required',
    'puestou'=>'required',
]);
 DB::beginTransaction();
try {
    DB::table('users')
    ->where('id', $request->id)  // find your user by their email
    ->limit(1)  // optional - to ensure only one record is updated.
    ->update(array('name' => $request->nameu,'lastname' => $request->lastnameu,'email' => $request->mailu,'dto'=>$request->dtou,'active'=>$request->estatusu,'ext' =>$request->extu,'nomina'=>$request->nominau,'puesto'=>$request->puestou));  // update the record in the DB
    DB::commit();
    $request->session()->flash('alert-success', 'ACTUALIZACION EXITOSA!');
    return redirect()->back()->withSuccess('ACTUALIZACION EXITOSA!');
    } catch (\Exception $e) {
    DB::rollback();
    $request->session()->flash('alert-danger', 'NO SE PUDO ACTUALIZAR EL REGISTRO DE USUARIO');
    return redirect()->back()->withDanger('NO SE PUDO ACTUALIZAR EL REGISTRO DE USUARIO ');
    } catch (\Throwable $e) {
    DB::rollback();
    $request->session()->flash('alert-danger', 'NO SE PUDO ACTUALIZAR EL REGISTRO DE USUARIO ');
    return redirect()->back()->withDanger('NO SE PUDO ACTUALIZAR EL REGISTRO DE USUARIO ');
    }
}
public function UpdateRole(Request $request)
{
    $request->validate([
        'upuser'=>'required',
        'uprol'=>'required',
]);
 DB::beginTransaction();
try {
    DB::table('model_has_roles')
    ->where('model_id', $request->upuser)  // find your user by their email
    ->limit(1)  // optional - to ensure only one record is updated.
    ->update(array('role_id' => $request->uprol));  // update the record in the DB
    DB::commit();
    $request->session()->flash('alert-success', 'ACTUALIZACION EXITOSA!');
    return redirect()->back()->withSuccess('ACTUALIZACION EXITOSA!');
    } catch (\Exception $e) {
    DB::rollback();
    $request->session()->flash('alert-danger', 'NO SE PUDO ACTUALIZAR EL REGISTRO DE USUARIO');
    return redirect()->back()->withDanger('NO SE PUDO ACTUALIZAR EL REGISTRO DE USUARIO ');
    } catch (\Throwable $e) {
    DB::rollback();
    $request->session()->flash('alert-danger', 'NO SE PUDO ACTUALIZAR EL REGISTRO DE USUARIO ');
    return redirect()->back()->withDanger('NO SE PUDO ACTUALIZAR EL REGISTRO DE USUARIO');
    }
}
public function UpdatePassword(Request $request)
{
    $request->validate([
        'pasuser'=>'required',
        'password1'=>'required',
        'confirm_password'=>'required']);

        DB::beginTransaction();
try {
 
 DB::table('users')
->where('id', $request->pasuser)  // find your user by their email
->limit(1)  // optional - to ensure only one record is updated.
->update(array('password'=> Hash::make($request->password1)));  // update the record in the DB

DB::commit(); 
$request->session()->flash('alert-success', 'ACTUALIZACION EXITOSA! ');
return redirect()->back()->withSuccess('ACTUALIZACION EXITOSA! ');   
//
} catch (\Exception $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'FALLA EN LA ACTUALIZACION ');
return redirect()->back()->withDanger('FALLA EN LA ACTUALIZACION ');
} catch (\Throwable $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'FALLA EN LA ACTUALIZACION');
return redirect()->back()->withDanger('FALLA EN LA ACTUALIZACION');
}  

}
// //////////////////////////////////////////COMPRAS/////////////////////////////////////////777777
public function compras()
{
      return view('ti.Compras');
} 
// //////////////////////////////////////////SGC/////////////////////////////////////////777777
public function sgc()
{
      return view('ti.Sgc');
} 

// //////////////////////////////////////////SISTEMAS/////////////////////////////////////////777777
public function sistemas()
{
  $id=auth()->user()->id;
  
    $incidencias = DB::table('soportes')->where('user_id',$id)->orderBy('id', 'desc')->limit(60)->get(); 
      return view('ti.Sistemas',compact('incidencias'));
} 
public function Panelp(Request $request){
    $request->validate([
       
'prioridad'=>'required',
'incidencia'=>'required',
'descripcion'=>'required',

]);

    DB::beginTransaction();
try {
    if($request->img=="")
    {
$fecha = Carbon::now();
$registrot = new Soportes();
$registrot->username = auth()->user()->name.' '.auth()->user()->lastname;
$registrot->dto = auth()->user()->dto;
$registrot->prioridad = $request->prioridad;
$registrot->t_incidencia = $request->incidencia;
$registrot->descripcion = $request->descripcion;
$registrot->email = auth()->user()->email;
$registrot->user_id = auth()->user()->id;
$registrot->estatus ='PENDIENTE';
$registrot->save();

}else{
    $nombre_a_guardar ="Soporte-".$request->departamento.date('mdYHis').".".$request->file('img')->getClientOriginalExtension();
    $docs = $request->file('img')->storeAs('public/IncidenciasImg',$nombre_a_guardar);
            $url= Storage::url($docs);
    $fecha = Carbon::now();
$registrot = new Soportes();
$registrot->username = auth()->user()->name.' '.auth()->user()->lastname;
$registrot->dto = auth()->user()->dto;
$registrot->prioridad = $request->prioridad;
$registrot->t_incidencia = $request->incidencia;
$registrot->descripcion = $request->descripcion;
$registrot->email = auth()->user()->email;
$registrot->estatus ='PENDIENTE';
$registrot->imagen =$nombre_a_guardar;
$registrot->user_id = auth()->user()->id;
$registrot->save();

}
// create connector instance
// $connector = new \Sebbmyr\Teams\TeamsConnector("https://agroinags.webhook.office.com/webhookb2/9ca445c7-242c-4646-b55d-b842c7b6ed6a@843d77c3-da89-46ac-ab66-a8c3ce00defc/IncomingWebhook/c3e7e6df11d84daca19055539a826aa7/af943f59-9ad9-4b2a-b0ee-18584f76890e");
// $card  = new \Sebbmyr\Teams\Cards\CustomCard('NUEVA SOLICITUD DE SOPORTE', 'Se genero una nueva solicitud de soporte.');

// $card->setColor('48B406')
//     ->addAction('REVISAR MIS SOLICITUDES','https://agro.bi-agroin.net/ti/IncidenciasAsignacion')
//     ->addFacts('Detalles',['USUARIO' => auth()->user()->name, 'DEPARTAMENTO' =>auth()->user()->dto,'PRIORIDAD' =>$request->prioridad,'CLASIFICACION'=>$request->incidencia]);

// $connector->send($card);
DB::commit();
$request->session()->flash('alert-success', 'SOLICITUD DE SOPORTE ENVIADA! ');
return redirect()->back()->withSuccess('SOLICITUD DE SOPORTE ENVIADA! ');
} catch (\Exception $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL TICKET DE SOPORTE '.$e);
return redirect()->back()->withDanger('NO SE PUDO CREAR EL TICKET DE SOPORTE '.$e);
} catch (\Throwable $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL TICKET DE SOPORTE '.$e);
return redirect()->back()->withDanger('NO SE PUDO CREAR EL TICKET DE SOPORTE '.$e);
}
}

public function CrearAsignacion()
{
    $users = DB::table('users')->where('active','ACTIVO')->orderBy('id', 'desc')->get(); 
    $userspassw = DB::table('users')->where('active','ACTIVO')->orderBy('id', 'desc')->get(); 
    $dispositivos = DB::table('users')->where('active','ACTIVO')->orderBy('id', 'desc')->get(); 
    return view('ti.CrearAsignacion',compact('users','userspassw','dispositivos'));   
}
public function RegistroEquipo(Request $request)
{
    $request->validate([
'usere'=>'required',
'estadod'=>'required',
'tdis'=>'required',
]);
    DB::beginTransaction();
try {
   
    $registrot = new Equipos ();
    $registrot->colaborador_id = $request->usere;
    $registrot->tipo_disp = $request->tdis;
    $registrot->estado_disp = $request->estadod;
    $registrot->nombre_disp = $request->nombred;
    $registrot->marca = $request->marcad;
    $registrot->modelo = $request->modelod;
     $registrot->mac = $request->mace;
    $registrot->num_serie = $request->nseried;
    $registrot->proc_velocidad = $request->procesadord;
    $registrot->memoria = $request->memoriad;
    $registrot->disco = $request->discod;
    $registrot->proveedor = $request->proveedord;
    $registrot->so = $request->sod;
    $registrot->ip = $request->ipd;
    $registrot->ip_dhcp = $request->dhcp;
    $registrot->identificar = $request->identificar;
    $registrot->correo_disp = $request->correod;
    $registrot->programas_instalados = $request->str2;
    $registrot->v_office = $request->voffice;
    $registrot->clave_office = $request->clavep;
    $registrot->observaciones = $request->observacionesx;
    $registrot->activo = "ACTIVO";
    $registrot->fecha_compra = $request->fechacomprad;
    $registrot->fecha_entrega = $request->fechaentrega;
    $registrot->wifi_ethernet = $request->wifi;
    $registrot->save();
DB::commit();
$request->session()->flash('alert-success', 'REGISTRO EXITOSO! ');
return redirect()->back()->withSuccess('REGISTRO EXITOSO! ');
} catch (\Exception $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO '.$e);
return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO '.$e.' ');
} catch (\Throwable $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO'.$e.' ');
return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO'.$e.' ');
}
}
public function RegistroPasswords(Request $request)
{
    DB::beginTransaction();
    try {
        for ($i = 0; $i < count($request->passw); $i++){
            $answers[]=[
               'user_id'=>$request->userselectid[$i],
               'user_email'=>$request->userapp[$i],
               'password'=>$request->passw[$i],
               'urlapp'=>$request->url[$i],
               'descripcion'=>$request->descripcion[$i],
               'categoria'=>$request->categoria[$i],
                'estatus'=>"ACTIVO",
               'created_at'=>now(),
                'updated_at'=>now()
            ];
        }
    
    DB::table('passwords')->insert($answers);         
    DB::commit();
    $request->session()->flash('alert-success', 'REGISTRO EXITOSO! ');
    return redirect()->back()->withSuccess('REGISTRO EXITOSO! ');
    } catch (\Exception $e) {
    DB::rollback();
    $request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO '.$e);
    return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO '.$e.' ');
    } catch (\Throwable $e) {
    DB::rollback();
    $request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO'.$e.' ');
    return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO'.$e.' ');
    }
 }

 public function RegistroDispositivos(Request $request)
 {
     DB::beginTransaction();
 try {
    
     $registrot = new Dispositivos ();
     $registrot->user_id = $request->userdis;
     $registrot->t_dispositivo = $request->tdis;
     $registrot->estado_disp = $request->estadodis;
     $registrot->marca_disp = $request->marcadis;
     $registrot->modelo_disp = $request->modelodis;
     $registrot->numserie_disp = $request->nseriedis;
     $registrot->mac_disp = $request->macdis;
     $registrot->imei_disp = $request->imeidis;
     $registrot->fecha_compra = $request->fechadis;
     $registrot->fecha_asignacion = $request->fasignacion;
     $registrot->ip_disp = $request->fdisp;
     $registrot->observaciones_disp = $request->obsdis;
     $registrot->estatus_disp = "ACTIVO";
     $registrot->save();
 DB::commit();
 $request->session()->flash('alert-success', 'REGISTRO EXITOSO! ');
 return redirect()->back()->withSuccess('REGISTRO EXITOSO! ');
 } catch (\Exception $e) {
 DB::rollback();
 $request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO '.$e);
 return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO '.$e.' ');
 } catch (\Throwable $e) {
 DB::rollback();
 $request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO'.$e.' ');
 return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO'.$e.' ');
 }
 }

 public function ConsultarAsignaciones()
 {
    $usuarios = DB::table('users')->where('active','ACTIVO')->orderBy('id', 'desc')->get(); 

    return view('ti.ConsultarAsignacion',compact('usuarios'));   
 } 

 public function VerAsignacion($id)
 {
    $equipos = DB::table('equipos')->where('colaborador_id',$id)->where('activo','ACTIVO')->get();
    $dispositivos= DB::table('dispositivos')->where('user_id',$id)->where('estatus_disp','ACTIVO')->get();
    $password= DB::table('passwords') ->select('users.name','users.lastname','passwords.id','passwords.user_email','passwords.password','passwords.urlapp','passwords.descripcion','passwords.categoria')->join('users', 'passwords.user_id', '=', 'users.id')->where('user_id',$id)->where('estatus','ACTIVO')->get();
    $users= DB::table('users')->where('id',$id)->where('active','ACTIVO')->first();
    return view('ti.VerAsignaciones',compact('equipos','dispositivos','password','users'));   
 }
public function VerAsignacionPost(Request $request,$id)
{
    DB::beginTransaction();
    try {

//  $id=substr($id, 2); 
        DB::table('equipos')
        ->where('id', $id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('tipo_disp' =>  $request->input('tipodisp'.$id),'estado_disp' =>  $request->input('estado'.$id),'nombre_disp' =>  $request->input('nombredisp'.$id),'marca' =>  $request->input('marca'.$id),'modelo' =>  $request->input('modelo'.$id),'num_serie' =>  $request->input('nserie'.$id),'proc_velocidad' =>  $request->input('pv'.$id),'memoria' =>  $request->input('memoria'.$id),'disco' =>  $request->input('alm'.$id),'fecha_compra' =>  $request->input('fcompra'.$id),'fecha_entrega' =>  $request->input('fasig'.$id),'proveedor' =>  $request->input('prov'.$id),'so' =>  $request->input('so'.$id),'ip' =>  $request->input('ipd'.$id),'correo_disp' =>  $request->input('correo'.$id),'mac' =>  $request->input('mac'.$id),'wifi_ethernet' =>  $request->input('wifieth'.$id),'ip_dhcp' =>  $request->input('ipdhcp'.$id),'activo' =>  $request->input('activo'.$id),'observaciones' =>  $request->input('obs'.$id),'programas_instalados' =>  $request->input('programas'.$id)));  // update the record in the DB
      

    DB::commit();
 $request->session()->flash('alert-success', 'REGISTRO EXITOSO! ');
 return redirect()->back()->withSuccess('REGISTRO EXITOSO! ');
 } catch (\Exception $e) {
 DB::rollback();
 $request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO '.$e);
 return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO '.$e.' ');
 } catch (\Throwable $e) {
 DB::rollback();
 $request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO'.$e.' ');
 return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO'.$e.' ');
 }
}
public function VerAsignacionPost2(Request $request,$id)
{
    DB::beginTransaction();
    try {

//  $id=substr($id, 2); 
        DB::table('dispositivos')
        ->where('id', $id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('estado_disp' =>  $request->input('eqd'.$id),'t_dispositivo' =>  $request->input('tdd'.$id),'marca_disp' =>  $request->input('marcad'.$id),'modelo_disp' =>  $request->input('modelod'.$id),'numserie_disp' =>  $request->input('nseriedis'.$id),'mac_disp' =>  $request->input('macd'.$id),'imei_disp' =>  $request->input('imeid'.$id),'ip_disp' =>  $request->input('ipd'.$id),'fecha_compra' =>  $request->input('fcd'.$id),'fecha_asignacion' =>  $request->input('fad'.$id),'observaciones_disp' =>  $request->input('obsd'.$id),'estatus_disp' =>  $request->input('activod'.$id)));  // update the record in the DB
      

    DB::commit();
 $request->session()->flash('alert-success', 'REGISTRO EXITOSO! ');
 return redirect()->back()->withSuccess('REGISTRO EXITOSO! ');
 } catch (\Exception $e) {
 DB::rollback();
 $request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO '.$e);
 return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO '.$e.' ');
 } catch (\Throwable $e) {
 DB::rollback();
 $request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO'.$e.' ');
 return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO'.$e.' ');
 }
}


public function contrasenas(Request $request,$ip)
{
    DB::beginTransaction();
    try {
        DB::table('passwords')
        ->where('id', $request->idpw)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('descripcion' =>  $request->descpw,'password' =>  $request->passpw,'urlapp' =>  $request->urlpw,'categoria' =>  $request->catpw,'estatus' =>  $request->estatusu));  // update the record in the DB
      
    DB::commit();
 $request->session()->flash('alert-success', 'REGISTRO EXITOSO! ');
 return redirect()->back()->withSuccess('REGISTRO EXITOSO! ');
 } catch (\Exception $e) {
 DB::rollback();
 $request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO '.$e);
 return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO '.$e.' ');
 } catch (\Throwable $e) {
 DB::rollback();
 $request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO'.$e.' ');
 return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO'.$e.' ');
 }
}

public function ActivosTI()
    {
    $activos = DB::table('activostis')->where('activo','=','ACTIVO')->get();
               return view('ti.ActivosTi',compact('activos'));
    } 

public function ActivosTIPost(Request $request){
    DB::beginTransaction();
    try {
       
        $registrot = new Activosti ();
        $registrot->tipos_dispositivo = $request->disp;
        $registrot->marca = $request->marca;
        $registrot->modelo = $request->modelo;
        $registrot->numero_serie = $request->numserie;
        $registrot->ubicacion = $request->ubicacion;
        $registrot->wifi_ethernet = $request->wifieth;
        $registrot->mac = $request->mac;
        $registrot->ip = $request->ip;
        $registrot->observaciones = $request->observaciones;
        $registrot->fecha_compra = $request->fecha_compra;
        $registrot->activo ='ACTIVO';
        $registrot->save();
    DB::commit();
    $request->session()->flash('alert-success', 'REGISTRO EXITOSO! ');
    return redirect()->back()->withSuccess('REGISTRO EXITOSO! ');
    } catch (\Exception $e) {
    DB::rollback();
    $request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO '.$e);
    return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO '.$e.' ');
    } catch (\Throwable $e) {
    DB::rollback();
    $request->session()->flash('alert-danger', 'NO SE PUDO CREAR EL REGISTRO'.$e.' ');
    return redirect()->back()->withDanger('NO SE PUDO CREAR EL REGISTRO'.$e.' ');
    }   

}

public function UpdateActivosTIPost(Request $request){
    DB::beginTransaction();
    try {
        DB::table('activostis')
        ->where('id', $request->id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('tipos_dispositivo' => $request->dispu,'marca' => $request->marcau,'modelo' => $request->modelou,'numero_serie' => $request->serieu,'ubicacion' => $request->ubi,'wifi_ethernet' => $request->we,'mac' => $request->macu,'ip' => $request->ipu,'observaciones' => $request->obsu,'activo' => $request->estatusu));  // update the record in the DB
      
        DB::commit();
        $request->session()->flash('alert-success', 'ACTUALIZACION EXITOSA!');
        return redirect()->back()->withSuccess('ACTUALIZACION EXITOSA!');
        } catch (\Exception $e) {
        DB::rollback();
        $request->session()->flash('alert-danger', 'NO SE PUDO ACTUALIZAR EL REGISTRO DE USUARIO');
        return redirect()->back()->withDanger('NO SE PUDO ACTUALIZAR EL REGISTRO DE USUARIO ');
        } catch (\Throwable $e) {
        DB::rollback();
        $request->session()->flash('alert-danger', 'NO SE PUDO ACTUALIZAR EL REGISTRO DE USUARIO ');
        return redirect()->back()->withDanger('NO SE PUDO ACTUALIZAR EL REGISTRO DE USUARIO ');
        }  

}
public function Incidencias2()
{
$users = DB::table('equipos')->select( 'tipo_disp',DB::raw('COUNT(tipo_disp) as tot'))->where('activo','Activo')->groupBy('tipo_disp')->get();
   $datos=[];
   foreach($users as $users){
       
$datos[]=[$users->tipo_disp, floatval($users->tot)];
   }
   
   $users3 = DB::table('equipos')->select( 'identificar',DB::raw('COUNT(identificar) as tot'))->where('activo','Activo')->groupBy('identificar')->get();
   $datos3=[];
   foreach($users3 as $users3){
       
$datos3[]=[$users3->identificar, floatval($users3->tot)];
   }
   
   $users2 = DB::table('equipos')->select( 'memoria',DB::raw('COUNT(memoria) as toti'))->where('activo','Activo')->groupBy('memoria')->get();
   $def = DB::table('equipos')->select('users.id as uid','equipos.id as eid','name','lastname','equipos.activo','mac','nombre_disp','ip','memoria','disco','v_office','identificar','proc_velocidad','observaciones','obs_equipo')->join('users','users.id','=','colaborador_id')->where('equipos.activo','Activo')->orderBy('identificar', 'DESC')->get();
    $disp = DB::table('dispositivos')->select('users.id as uid','dispositivos.id as disp','name','lastname','dispositivos.t_dispositivo','dispositivos.estado_disp','dispositivos.ip_disp','marca_disp','dispositivos.mac_disp','dispositivos.observaciones_disp')->join('users','users.id','=','user_id')->where('dispositivos.estatus_disp','ACTIVO')->whereNotNull('dispositivos.ip_disp')->get();
   $datos2=[];
   foreach($users2 as $users2){
$datos2[]=[$users2->memoria, floatval($users2->toti)];
   }
   return view('ti.EstadisticasEquipos',["datos" => json_encode($datos),"datos2" => json_encode($datos2),"datos3" => json_encode($datos3)],compact('def','disp'));
}

public function Incidencias2post(Request $request)
{
    $request->validate([
        'status'=>'required',
    ]);
DB::beginTransaction();
try {
DB::table('equipos')
->where('id', $request->idt)  // find your user by their email
->limit(1)  // optional - to ensure only one record is updated.
->update(array('identificar' => strtoupper($request->status),'obs_equipo' =>$request->obs));  // update the record in the DB

DB::commit(); 
$request->session()->flash('alert-success', 'ACTUALIZACION EXITOSA! ');
return redirect()->back()->withSuccess('ACTUALIZACION EXITOSA! ');
} catch (\Exception $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'FALLA EN LA ACTUALIZACION ');
return redirect()->back()->withDanger('FALLA EN LA ACTUALIZACION ');
} catch (\Throwable $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'FALLA EN LA ACTUALIZACION');
return redirect()->back()->withDanger('FALLA EN LA ACTUALIZACION');
}   
}


public function IncidenciasAsignacion()
{
    $incidencias = DB::table('soportes')->WhereNull('asignado')->Where('estatus','!=','CANCELADO')->get();
    $incidenciasasignadas = DB::table('soportes')->where('asignado','!=','')->where('estatus','!=','FINALIZADO')->Where('estatus','!=','CANCELADO') ->get();

    $users = User::Permission('TI')->where('active','=','ACTIVO')->get();
    return view('ti.Incidencias',compact('incidencias','users','incidenciasasignadas'));
}

public function Asignar(Request $request){
    $request->validate([
        'user'=>'required',
    ]);
DB::beginTransaction();
try {
    $fechaAsignacion = Carbon::now();
DB::table('soportes')
->where('id', $request->idt)  // find your user by their email
->limit(1)  // optional - to ensure only one record is updated.
->update(array('asignado' => strtoupper($request->user),'estatus' => 'PENDIENTE','fecha_inicial' => $fechaAsignacion));  // update the record in the DB


DB::commit(); 
$request->session()->flash('alert-success', 'ASIGNACION EXITOSA! ');
return redirect()->back()->withSuccess('ASIGNACION EXITOSA! ');
} catch (\Exception $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'FALLA EN LA ASIGNACION ');
return redirect()->back()->withDanger('FALLA EN LA ASIGNACION ');
} catch (\Throwable $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'FALLA EN LA ASIGNACION');
return redirect()->back()->withDanger('FALLA EN LA ASIGNACION');
}  
}

public function CompletarSoporte(Request $request)
{
    $request->validate([
        'obs'=>'required', 'folio'=>'required', 'clasificacion'=>'required','tiempo_a_agregar' => 'required'
    ]);
DB::beginTransaction();
try {

    /*$hasta = substr($request->datetimes, -16); 
    $de = substr($request->datetimes, 0,-20); */
    $soporte = soportes::find($request->folio);
    $tiempoAgregar = $request->input('tiempo_a_agregar');
    $fechainicial = Carbon::parse($soporte->fecha_inicial);
    $fechafinal = $fechainicial->addMinutes($tiempoAgregar);



DB::table('soportes')
->where('id', $request->folio)  // find your user by their email
->limit(1)  // optional - to ensure only one record is updated.
->update(array('estatus' => strtoupper('FINALIZADO'),'clasificacion'=>$request->clasificacion, 'observaciones' => $request->obs,'fecha_final' => $fechafinal));  // update the record in the DB


DB::commit(); 
$request->session()->flash('alert-success', 'SOPORTE FINALIZADO! ');
return redirect()->back()->withSuccess('SOPORTE FINALIZADO! ');
} catch (\Exception $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'FALLA EN LA LIBERACION '.$e);
return redirect()->back()->withDanger('FALLA EN LA LIBERACION '.$e);
} catch (\Throwable $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'FALLA EN LA LIBERACION'.$e);
return redirect()->back()->withDanger('FALLA EN LA LIBERACION'.$e);
}  
}

public function ImgIncidencia($id){
    $soportes= DB::table('soportes')->where('id',$id)->get();
	return view('ti.viewer',compact('soportes'));
}

public function Cancelar (Request $request)
   {
   
    DB::beginTransaction();
    try {
    DB::table('soportes')
    ->where('id', $request->idtx)  // find your user by their email
    ->limit(1)  // optional - to ensure only one record is updated.
    ->update(array('estatus' => 'CANCELADO'));  // update the record in the DB

    DB::commit();
    $request->session()->flash('alert-success', 'ACTUALIZACION EXITOSA! ');
return redirect()->back()->withSuccess('ACTUALIZACION EXITOSA! ');
} catch (\Exception $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'FALLA EN LA ACTUALIZACION '.$e);
return redirect()->back()->withDanger('FALLA EN LA ACTUALIZACION '.$e.' ');
} catch (\Throwable $e) {
DB::rollback();
$request->session()->flash('alert-danger', 'FALLA EN LA ACTUALIZACION'.$e.' ');
return redirect()->back()->withDanger('FALLA EN LA ACTUALIZACION'.$e.' ');
}
   }

   public function IncidenciasFiltro(Request $request)
   {
       
       $total=DB::table('soportes')->select(DB::raw('COUNT(id) as total'))->whereBetween(DB::raw('DATE(created_at)'), [$request->de, $request->hasta])->where('estatus','!=','CANCELADO')->first();
       $terminadas=DB::table('soportes')->select(DB::raw('COUNT(id) as total'))->whereBetween(DB::raw('DATE(created_at)'), [$request->de, $request->hasta])->where('estatus','=','FINALIZADO')->first();
       $proceso=DB::table('soportes')->select(DB::raw('COUNT(id) as total'))->whereBetween(DB::raw('DATE(created_at)'), [$request->de, $request->hasta])->where('estatus','!=','FINALIZADO')->where('estatus','!=','CANCELADO')->first();
       $prioridad = DB::table('soportes')->select( 'prioridad',DB::raw('COUNT(id) as tot'))->whereBetween(DB::raw('DATE(created_at)'), [$request->de, $request->hasta])->where('estatus','!=','CANCELADO')->groupBy('prioridad')->get();
       $prioriadg=[];
       foreach($prioridad as $prioridad){
          $prioriadg[]=[$prioridad->prioridad, floatval($prioridad->tot)];
             }
     
             $comparacion=DB::select("SELECT
             SUM(CASE WHEN MONTH(soportes.created_at) = 1 THEN 1 ELSE 0 END) AS Ene,
             SUM(CASE WHEN MONTH(soportes.created_at) = 2 THEN 1 ELSE 0 END) AS Feb,
             SUM(CASE WHEN MONTH(soportes.created_at) = 3 THEN 1 ELSE 0 END) AS Mar,
             SUM(CASE WHEN MONTH(soportes.created_at) = 4 THEN 1 ELSE 0 END) AS Abr,
             SUM(CASE WHEN MONTH(soportes.created_at) = 5 THEN 1 ELSE 0 END) AS May,
             SUM(CASE WHEN MONTH(soportes.created_at) = 6 THEN 1 ELSE 0 END) AS Jun,
             SUM(CASE WHEN MONTH(soportes.created_at) = 7 THEN 1 ELSE 0 END) AS Jul,
             SUM(CASE WHEN MONTH(soportes.created_at) = 8 THEN 1 ELSE 0 END) AS Ago,
             SUM(CASE WHEN MONTH(soportes.created_at) = 9 THEN 1 ELSE 0 END) AS Sep, 
             SUM(CASE WHEN MONTH(soportes.created_at) = 10 THEN 1 ELSE 0 END) AS Oct,
             SUM(CASE WHEN MONTH(soportes.created_at) = 11 THEN 1 ELSE 0 END) AS Nov,
             SUM(CASE WHEN MONTH(soportes.created_at) = 12 THEN 1 ELSE 0 END) AS Dic
             FROM soportes 
    WHERE  DATE(soportes.created_at) between '$request->de' and '$request->hasta' and estatus!='CANCELADO' ");
             $datosH=[];
             foreach($comparacion as $comparacion){
                 $datosH[] = [
                     'name'=> "Mes",
                           'data'=> [floatval($comparacion->Ene),floatval($comparacion->Feb),floatval($comparacion->Mar),floatval($comparacion->Abr),floatval($comparacion->May),floatval($comparacion->Jun),floatval($comparacion->Jul),floatval($comparacion->Ago),floatval($comparacion->Sep),floatval($comparacion->Oct),floatval($comparacion->Nov),floatval($comparacion->Dic)],
                          ];
         }
       $incidencias = DB::table(table: 'soportes')->select( 't_incidencia',DB::raw('COUNT(t_incidencia) as tot'))->whereBetween(DB::raw('DATE(created_at)'), [$request->de, $request->hasta])->where('estatus','!=','CANCELADO')->groupBy('t_incidencia')->get();
         //consulta para la grafica de detalles por tiempo de soporte.
       $Detalleincidencias = DB::table('soportes')
           ->select( 't_incidencia',DB::raw('COUNT(t_incidencia) as tot'))
           ->where('estatus','FINALIZADO')
           ->whereBetween(DB::raw('DATE(created_at)'), [$request->de, $request->hasta])
           ->whereNotIn('t_incidencia', ['Solicitud de equipo de computo nuevo','Solicitud de ordenador', 'SOLICITAR EQUIPO NUEVO'])
           ->groupBy('t_incidencia')
           ->get();
   
       //////////////////////////////////////////////////////////////////// 
       $incidencias3 = DB::table('soportes')->select(DB::raw('sum(t_incidencia) as tot2'),DB::raw('sum(TIMESTAMPDIFF(MINUTE,fecha_inicial,fecha_final)) AS tiempo2'))->where('estatus','=','FINALIZADO')->whereNotIn('t_incidencia', ['Solicitud de equipo de computo nuevo','Solicitud de ordenador','SOLICITAR EQUIPO NUEVO'])->whereBetween(DB::raw('DATE(created_at)'), [$request->de, $request->hasta])->first();
        //Consulta para medir tiempo por categoria de tiempo reportada para el datatable de detalles.
       $tiemincidencias = DB::table('soportes')
           ->select('t_incidencia',DB::raw('SUM(TIMESTAMPDIFF(MINUTE,fecha_inicial,fecha_final)) AS tiempo3 ') ,DB::raw('COUNT(t_incidencia) as tot'),DB::raw('SUM(TIMESTAMPDIFF(MINUTE, fecha_inicial, fecha_final)) / COUNT(t_incidencia) AS promedioinc'))
           ->where('estatus','FINALIZADO')
           ->whereBetween(DB::raw('DATE(created_at)'), [$request->de, $request->hasta])
           ->whereNotIn('t_incidencia', ['Solicitud de equipo de computo nuevo','Solicitud de ordenador', 'SOLICITAR EQUIPO NUEVO']) 
           ->groupBy('t_incidencia')
           ->get();
   
   
   
       //Consulta para medir el tiempo de solicitud de ordenador
       $tiemordenador = DB::table('soportes')
           ->select(DB::raw('sum(t_incidencia) as tot2'),DB::raw('SUM(TIMESTAMPDIFF(MINUTE,fecha_inicial,fecha_final)) AS tiempo'))
           ->where('estatus','FINALIZADO') 
           ->where('t_incidencia', ['Solicitud de equipo de computo nuevo','Solicitud de ordenador', 'SOLICITAR EQUIPO NUEVO']) 
           ->whereBetween(DB::raw('DATE(created_at)'), [$request->de, $request->hasta])
           ->first();   
   
       $tiempoord = $this->convertirTiempo($tiemordenador->tiempo);
       $tiemposop = $this->convertirTiempo($incidencias3->tiempo2);
   
    
       
       $datos=[];
       $pend=[];
       $atr=[];
       $inc=[];
       $det=[];
   
       foreach($incidencias as $incidencias){
           $inc[]=[$incidencias->t_incidencia, floatval($incidencias->tot)];
       }
   
       foreach($Detalleincidencias as $Detalleincidencia){
           $det[]=[$Detalleincidencia->t_incidencia, floatval($Detalleincidencia->tot)];
       }    
                  
       $users = DB::table('soportes')->select( 'asignado',DB::raw('COUNT(asignado) as tot'))->where('estatus','FINALIZADO')->whereBetween(DB::raw('DATE(created_at)'), [$request->de, $request->hasta])->groupBy('asignado')->get();
           
       $datos=[];
                     
       foreach($users as $users){
           $datos[]=[$users->asignado, floatval($users->tot)];
       }
   
         return view('ti.IncidenciasGraficas',["datos" => json_encode($datos),"datosp" => json_encode($pend),"datosa" => json_encode($atr),"datosi" => json_encode($inc),"datosd" => json_encode($det),"prioridad" => json_encode($prioriadg),"datosH" => json_encode($datosH)],compact('tiemordenador','incidencias3','total','terminadas','proceso','prioridad','tiemincidencias', 'tiempoord', 'tiemposop'));
      
   }
 
   
   public function Incidencias()
   {
       $total=DB::table('soportes')->select(DB::raw('COUNT(id) as total'))->whereRaw('MONTH(created_at) = MONTH(now())')->whereRaw('YEAR(created_at) = YEAR(now())')->where('estatus','!=','CANCELADO')->first();
       $terminadas=DB::table('soportes')->select(DB::raw('COUNT(id) as total'))->whereRaw('MONTH(created_at) = MONTH(now())')->whereRaw('YEAR(created_at) = YEAR(now())')->where('estatus','=','FINALIZADO')->first();
       $proceso=DB::table('soportes')->select(DB::raw('COUNT(id) as total'))->whereRaw('MONTH(created_at) = MONTH(now())')->whereRaw('YEAR(created_at) = YEAR(now())')->where('estatus','!=','FINALIZADO')->where('estatus','!=','CANCELADO')->first();
       $prioridad = DB::table('soportes')->select( 'prioridad',DB::raw('COUNT(id) as tot'))->whereRaw('MONTH(created_at) = MONTH(now())')->whereRaw('YEAR(created_at) = YEAR(now())')->where('estatus','!=','CANCELADO')->groupBy('prioridad')->get();
       $prioriadg=[];
       foreach($prioridad as $prioridad){
           $prioriadg[]=[$prioridad->prioridad, floatval($prioridad->tot)];
           }
       $comparacion=DB::select("SELECT
           SUM(CASE WHEN MONTH(soportes.created_at) = 1 THEN 1 ELSE 0 END) AS Ene,
           SUM(CASE WHEN MONTH(soportes.created_at) = 2 THEN 1 ELSE 0 END) AS Feb,
           SUM(CASE WHEN MONTH(soportes.created_at) = 3 THEN 1 ELSE 0 END) AS Mar,
           SUM(CASE WHEN MONTH(soportes.created_at) = 4 THEN 1 ELSE 0 END) AS Abr,
           SUM(CASE WHEN MONTH(soportes.created_at) = 5 THEN 1 ELSE 0 END) AS May,
           SUM(CASE WHEN MONTH(soportes.created_at) = 6 THEN 1 ELSE 0 END) AS Jun,
           SUM(CASE WHEN MONTH(soportes.created_at) = 7 THEN 1 ELSE 0 END) AS Jul,
           SUM(CASE WHEN MONTH(soportes.created_at) = 8 THEN 1 ELSE 0 END) AS Ago,
           SUM(CASE WHEN MONTH(soportes.created_at) = 9 THEN 1 ELSE 0 END) AS Sep, 
           SUM(CASE WHEN MONTH(soportes.created_at) = 10 THEN 1 ELSE 0 END) AS Oct,
           SUM(CASE WHEN MONTH(soportes.created_at) = 11 THEN 1 ELSE 0 END) AS Nov,
           SUM(CASE WHEN MONTH(soportes.created_at) = 12 THEN 1 ELSE 0 END) AS Dic
           FROM soportes 
           WHERE  year(soportes.created_at)= YEAR(now()) and estatus!='CANCELADO' "
       );
       
       $datosH=[];
   
       foreach($comparacion as $comparacion){
           $datosH[] = [
               'name'=> "Mes",
               'data'=> [floatval($comparacion->Ene),floatval($comparacion->Feb),floatval($comparacion->Mar),floatval($comparacion->Abr),floatval($comparacion->May),floatval($comparacion->Jun),floatval($comparacion->Jul),floatval($comparacion->Ago),floatval($comparacion->Sep),floatval($comparacion->Oct),floatval($comparacion->Nov),floatval($comparacion->Dic)],
           ];
       }
   
       $incidencias = DB::table('soportes')->select( 't_incidencia',DB::raw('COUNT(t_incidencia) as tot'))->where('estatus','!=','CANCELADO')->whereRaw('MONTH(created_at) = MONTH(now())')->whereRaw('YEAR(created_at) = YEAR(now())')->groupBy('t_incidencia')->get();
       //consulta para la grafica de detalles por tiempo de soporte.
       $Detalleincidencias = DB::table('soportes')
       ->select( 't_incidencia',DB::raw('COUNT(t_incidencia) as tot'))
       ->whereRaw('MONTH(created_at) = MONTH(now())')
       ->whereRaw('YEAR(created_at) = YEAR(now())')
       ->whereNotIn('t_incidencia', ['Desarrollos internos', 'Solicitud de ordenador', 'Solicitud de equipo de computo nuevo','SOLICITAR EQUIPO NUEVO'])
       ->whereNotIn('estatus', ['PENDIENTE'])
       ->groupBy('t_incidencia')
       ->get();

   
       //////////////////////////////////////////////////////////////////// 
       $incidencias3 = DB::table('soportes')->select(DB::raw('sum(t_incidencia) as tot2'),DB::raw('SUM(TIMESTAMPDIFF(MINUTE,fecha_inicial,fecha_final)) AS tiempo2'))->where('estatus','FINALIZADO') ->whereNotIn('t_incidencia', ['Solicitud de equipo de computo nuevo','Solicitud de ordenador', 'SOLICITAR EQUIPO NUEVO'])->whereRaw('MONTH(created_at) = MONTH(now())')->whereRaw('YEAR(created_at) = YEAR(now())')->first();
       //Consulta para medir tiempo por categoria de tiempo reportada para el datatable de detalles.
       $tiemincidencias = DB::table('soportes')
           ->select('t_incidencia',DB::raw('SUM(TIMESTAMPDIFF(MINUTE,fecha_inicial,fecha_final)) AS tiempo3'),DB::raw('SUM(TIMESTAMPDIFF(MINUTE, fecha_inicial, fecha_final)) / COUNT(t_incidencia) AS promedioinc'))
           ->where('estatus','FINALIZADO')
           ->whereRaw('MONTH(created_at) = MONTH(now())')
           ->whereNotIn('t_incidencia', ['Desarrollos internos', 'Solicitud de ordenador','Solicitud de equipo de computo nuevo',  'SOLICITAR EQUIPO NUEVO']) 
           ->whereRaw('YEAR(created_at) = YEAR(now())')
           ->groupBy('t_incidencia')
           ->get();
   
       //Consulta para medir el tiempo de solicitud de ordenador
   
       $tiemordenador = DB::table('soportes')
           ->select(DB::raw('sum(t_incidencia) as tot2'),DB::raw('SUM(TIMESTAMPDIFF(MINUTE,fecha_inicial,fecha_final)) AS tiempo'))
           ->where('estatus','FINALIZADO') 
           ->where('t_incidencia', ['Solicitud de equipo de computo nuevo','Solicitud de ordenador', 'SOLICITAR EQUIPO NUEVO']) 
           ->whereRaw('MONTH(created_at) = MONTH(now())')->whereRaw('YEAR(created_at) = YEAR(now())')
           ->first();    
       
       $tiempoord = $this->convertirTiempo($tiemordenador->tiempo);
       $tiemposop = $this->convertirTiempo($incidencias3->tiempo2);
   
   
       $datos=[];
       $pend=[];
       $atr=[];
       $inc=[];
       $det=[];
   
       
       
       foreach($incidencias as $incidencias){
           $inc[]=[$incidencias->t_incidencia, floatval($incidencias->tot)];
       }
       
       foreach($Detalleincidencias as $Detalleincidencia){
           $det[]=[$Detalleincidencia->t_incidencia, floatval($Detalleincidencia->tot)];
       } 
   
       $users = DB::table('soportes')->select( 'asignado',DB::raw('COUNT(asignado) as tot'))->where('estatus','FINALIZADO')->whereRaw('MONTH(fecha_final) = MONTH(now())')->whereRaw('YEAR(fecha_final) = YEAR(now())')->groupBy('asignado')->get();
       $datos=[];
   
       foreach($users as $users){
           $datos[]=[$users->asignado, floatval($users->tot)];
       }
   
       return view('ti.IncidenciasGraficas',["datos" => json_encode($datos),"datosp" => json_encode($pend),"datosa" => json_encode($atr),"datosi" => json_encode($inc),"datosd" => json_encode($det),"prioridad" => json_encode($prioriadg),"datosH" => json_encode($datosH)],compact('tiemordenador','incidencias3','total','terminadas','proceso','prioridad','tiemincidencias','tiempoord','tiemposop'));
   }
   
   public function convertirTiempo($minutos)
   {
       $horas = floor($minutos / 60); 
       $minutosRestantes = $minutos % 60;
   
       return sprintf("%02d:%02d", $horas, $minutosRestantes);
       
   }
public function HistorialGeneral ()
{
    $risc_conexion = DB::connection('mysql2');
      
     $data=$risc_conexion->table('solicitu_agroins')->limit(60)->orderBy('solicitu_agroins.created_at', 'desc')->get();
          return view('ti.HistorialGeneral',compact('data')); 
}
// ****************************************************
public function HistorialGeneralP(Request $request)
{
    $risc_conexion = DB::connection('mysql2');
if($request->lote !="")
{
 $data=$risc_conexion->table('solicitu_agroins')->where('lote',$request->lote)->get();
}elseif($request->de !="" && $request->hasta !="")
{
  $data=$risc_conexion->table('solicitu_agroins')->whereBetween(DB::raw ('DATE(created_at)'), [$request->de, $request->hasta])->get();
}
else{
    $data=$risc_conexion->table('solicitu_agroins')->limit(60)->orderBy('solicitu_agroins.created_at', 'desc')->get();
}
return view('ti.HistorialGeneral',compact('data')); 
}

public function ValidarPdf($id)
{
    $risc_conexion = DB::connection('mysql2');
    $solicitud = DB::connection('mysql2')->table('solicitu_agroins')->select('idioma')->where('id',$id)->first();
    $pdf= DB::connection('mysql2')->table('asignacion_metodos')->where('sol_id',$id)->where('estatus','ACTIVO')->whereNull('resultado')->count();
    $pdf2= DB::connection('mysql2')->table('asignacion_metodos')->where('sol_id',$id)->where('estatus','ACTIVO')->count();
    if($pdf2>=1){
  if($pdf==0){
    if($solicitud=="ING")
    {

        return redirect()->route('generatePdfIng',['id' => Crypt::encrypt($id) ]);
    }
    else{
        return redirect()->route('generate.invoice.pdf',['id' => Crypt::encrypt($id) ]);  
    }
    
  } else{
   
    return redirect()->back()->with('success', 'your message,here');   
  } 
 
}else{
    return redirect()->back()->with('success', 'your message,here');   
}
}

public function generateInvoicePDF($id)
{
    $id = Crypt::decrypt($id);  
    $solicitud = DB::connection('mysql2')->table('solicitu_agroins')->where('id',$id)->get();
    $metodos = DB::connection('mysql2')->table('lista_analises')->select('lista_analises.metodo','lista_analises.unidades','lista_analises.identificador','realizado','limit','lista_analises.id as lid','metodologia','lista_analises.analisis','solicitu_agroins.id','asignacion_metodos.id as asigid','asignacion_metodos.intentos as intentos','asignacion_metodos.resultado','limite','observaciones_lab','fecha_produccion','fecha_caducidad')->join('asignacion_metodos','lista_analises.id','=','asignacion_metodos.metodo_id')->join('solicitu_agroins','asignacion_metodos.sol_id','=','solicitu_agroins.id')->where('asignacion_metodos.sol_id',$id)->where('asignacion_metodos.estatus','ACTIVO')->get();
    $sgc = DB::connection('mysql2')->table('sistema_gestions')->where('id',1)->get();
    $sgcf = DB::connection('mysql2')->table('sistema_gestions')->select('aviso1','aviso2')->where('id',1)->get();
    $liberacion = DB::connection('mysql2')->table('asignacion_metodos')->select('updated_at')->take(1)->where('sol_id',$id)->where('estatus','ACTIVO')->get();
     $pdf = PDF::loadView('ti.PDF',compact('solicitud','metodos','sgc','sgcf','liberacion'));
  //  return $pdf->download('COA.pdf');
  return $pdf->stream('COAESP.pdf');
}
public function generateInvoicePDFIng($id)
{
    $id = Crypt::decrypt($id); 
    $solicitud = DB::connection('mysql2')->table('solicitu_agroins')->select('solicitu_agroins.id as sid','solicitu_agroins.codigo','solicitu_agroins.lote','solicitu_agroins.updated_at','solicitu_agroins.usuario','solicitu_agroins.created_at','solicitu_agroins.fecha_recepcion','solicitu_agroins.estatus','productos_agroins.producto_ing','fecha_produccion','fecha_caducidad')->join('productos_agroins','solicitu_agroins.producto_id','=','productos_agroins.id')->where('solicitu_agroins.id',$id)->get();
    
    $metodos = DB::connection('mysql2')->table('lista_analises')->select('lista_analises.metodo','lista_analises.analisis_ing','lista_analises.unidades','lista_analises.identificador','realizado','limit','lista_analises.id as lid','metodologia','lista_analises.analisis','solicitu_agroins.id','asignacion_metodos.id as asigid','asignacion_metodos.intentos as intentos','asignacion_metodos.resultado','limite','observaciones_lab')->join('asignacion_metodos','lista_analises.id','=','asignacion_metodos.metodo_id')->join('solicitu_agroins','asignacion_metodos.sol_id','=','solicitu_agroins.id')->where('asignacion_metodos.sol_id',$id)->where('asignacion_metodos.estatus','ACTIVO')->get();
    $sgc = DB::connection('mysql2')->table('sistema_gestions')->where('id',2)->get();
    $sgcf = DB::connection('mysql2')->table('sistema_gestions')->select('aviso1','aviso2')->where('id',2)->get();
    $liberacion = DB::connection('mysql2')->table('asignacion_metodos')->select('updated_at')->take(1)->where('sol_id',$id)->where('estatus','ACTIVO')->get();
     $pdf = PDF::loadView('ti.PDFING',compact('solicitud','metodos','sgc','sgcf','liberacion'));
     return $pdf->stream('COAING.pdf');
}
public function VerSolicitud($id)
    {
       $solicitud = DB::connection('mysql2')->table('solicitu_agroins')->where('id',$id)->get();
       $metodos =DB::connection('mysql2')->table('lista_analises')->select('lista_analises.metodo','lista_analises.unidades','lista_analises.identificador','realizado','limit','lista_analises.id as lid','metodologia','lista_analises.analisis','solicitu_agroins.id','asignacion_metodos.id as asigid','asignacion_metodos.intentos as intentos','asignacion_metodos.resultado','limite')->join('asignacion_metodos','lista_analises.id','=','asignacion_metodos.metodo_id')->join('solicitu_agroins','asignacion_metodos.sol_id','=','solicitu_agroins.id')->where('asignacion_metodos.sol_id',$id)->where('asignacion_metodos.estatus','ACTIVO')->get();
       $pdf= DB::connection('mysql2')->table('asignacion_metodos')->where('sol_id',$id)->where('estatus','ACTIVO')->whereNull('resultado')->count();
       $pdf2= DB::connection('mysql2')->table('asignacion_metodos')->where('sol_id',$id)->where('estatus','ACTIVO')->count();
        return view('ti.MiSolicitud',compact('solicitud','metodos','pdf','pdf2'));  
    }  
    
    // 
    public function PaseSalida($id)
    {
 $equipos=DB::table('equipos')->where('colaborador_id',$id)->where('activo','ACTIVO')->get();
 $dispositivos=DB::table('dispositivos')->where('user_id',$id)->where('estatus_disp','ACTIVO')->get();
 $user=DB::table('users')->where('id',$id)->first();
             return view('ti.PaseSalida',compact('equipos','dispositivos','user'));  
    }

    public function PaseSalidaPDF($id)
    {  
        $equipos=DB::table('equipos')->where('colaborador_id',$id)->where('activo','ACTIVO')->get();
        $dispositivos=DB::table('dispositivos')->where('user_id',$id)->where('estatus_disp','ACTIVO')->get();
        $user=DB::table('users')->where('id',$id)->first();
         $pdf = PDF::loadView('ti.PaseSalidaPDF',compact('equipos','dispositivos','user'));
      //  return $pdf->download('COA.pdf');
      return $pdf->stream('Pase-de-Salida.pdf');
    }
public function PostPaseSalidaPDF(Request $request)
{
$fsalida= $request->fsalida;
$fllegada= $request->fllegada;
$responsable=$request->username;
$condiciones=$request->condiciones;
$actividades=$request->actividades;
$id=$request->id;
foreach($request->equipos as $equipos)
{
    $equipo=DB::table('equipos')->where('id',$equipos)->get();
    $data = ['tipo_disp' => $equipo->tipo_disp,'marca' => $equipo->marca,'modelo' => $equipo->modelo,'num_serie'=> $equipo->num_serie];
}

foreach($request->dispositivos as $dispositivos)
{
    $dispositivo=DB::table('equipos')->where('id',$dispositivos->$dispositivos)->get();
    $datad = ['tipo_disp' => $dispositivo->t_dispositivo,'marca' => $dispositivo->marca_disp,'modelo' => $dispositivo->modelo_disp,'num_serie'=> $dispositivo->numserie_disp];
}
$pdf = PDF::loadView('ti.PaseSalidaPDF',compact('fsalida','fllegada','responsable','condiciones','actividades','id','data','datad'));
//  return $pdf->download('COA.pdf');
return $pdf->stream('Pase-de-Salida.pdf');

}
// *********************Calendario soprotes ti*****************************
    public function CalendarioMttosTI()
    {
        $usuarios= DB::table('users')->where('active',"ACTIVO")->get(); 
    
     return view('ti.CalendarioMttos',compact('usuarios')); 
    }
    public function BuscarEquipo($id)
    {
        $productos= DB::table('equipos')->where('colaborador_id',$id)->where('activo','ACTIVO')->get();
        return response()->json($productos);
    }
    public function Calendario()
    {
    return view('ti.calendario'); 
    }
}


