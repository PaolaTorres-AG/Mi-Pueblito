<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalendarioMttos;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class CalendarioTiController extends Controller
{
     public function cmindex(Request $request)
    {
        if ($request->ajax()) {
            $data = CalendarioMttos::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)->where('lugar',$request->id)
                ->get(['id', 'title', 'start', 'end','user_name','lugar','user_id','description','event_id','departamento','estatus','correo','dispositivo','dispositivo_id','background']);
            return response()->json($data);  
        }
        return view('ti.CalendarioMttos');
    }

    public function cmistore(Request $request)
    {
        switch ($request->type) {
            case 'add':

                $x=CalendarioMttos::whereBetween('start',[$request->start,$request->end])->whereBetween('end',[$request->start,$request->end])->count();
                if($x==0){
                    $user = DB::table('users')->where('id',$request->title)->first();
                $event = CalendarioMttos::create([
                    'title' => $user->name." ".$user->lastname,
                    'start' => $request->start,
                    'end' => $request->end,
                    'recurrence' => 'none',
                    'user_id' => $request->title,
                    'user_name' => $user->name." ".$user->lastname,
                    'lugar' => $request->salaid,
                   'departamento' => $user->dto,
                   'estatus' => "NO INICIADO",
                   'correo' =>$user->email ,
                   'dispositivo' => $request->equipoid,
                   'background' => "#BE240F",
                   'dispositivo_id' => $request->equipo,
                ]);
                       $response = Http::post('https://prod-93.westus.logic.azure.com:443/workflows/610d0da4cb294c3ea20d594451eaa41f/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=zoVNId3YccRBWD0CwC2sJwbvgjUR9Eb2pwEvgMfC_OU',["id","$event->id"]);
                return response()->json($event);
          
            }
            else{
              return response()->json(array('status'=>'error', 'msg'=>'Error!'), 500);
            }
                break;

            case 'update':
     
$x=CalendarioMttos::where('end', '>=',$request->start)->where('start','<=', $request->end)->where('id','!=',$request->id)->count();
if($x==0){
                $event = CalendarioMttos::find($request->id)->update([
                 
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
                return response()->json($event);
            }
            else{
                return response()->json(array('status'=>'error', 'msg'=>'Error!'), 500);
              }
                break;
                // 
                case 'finalizar':
 $event = CalendarioMttos::find($request->id)->update(['estatus' => "FINALIZADO",'background' => "#63D603"]);
 $user = DB::table('calendario_mttos')->where('id',$request->id)->first();

 $event = CalendarioMttos::create([
     'title' => $user->title,
     'start' =>  Carbon::parse( $user->start)->addWeekdays(90),
     'end' => Carbon::parse( $user->end)->addWeekdays(90),
     'recurrence' => 'none',
     'user_id' => $user->user_id,
     'user_name' => $user->user_name,
     'lugar' => $user->lugar,
    'departamento' => $user->departamento,
    'estatus' => "NO INICIADO",
    'correo' =>$user->correo,
    'dispositivo' => $user->dispositivo,
    'background' => "#BE240F",
    'dispositivo_id' => $user->dispositivo_id
 ]);

                                    return response()->json($event);
                              
                                    break;
                // 
            case 'delete':
                $event = CalendarioMttos::find($request->id)->delete();
                return response()->json($event);
                break;
                case 'secuencia':
                    $event = CalendarioMttos::where('event_id',$request->id)->delete();
                    return response()->json($event);
                    break;
                case 'recurring':
                    
if($request->recurrence=='daily'){
    $this_month = Carbon::parse($request->rhasta); // returns 2019-07-01
    $start_month = Carbon::parse($request->start); // returns 2019-06-01
    $diff = $start_month->diffInDays($this_month);  // returns 1
    $diff = $diff+2;
}
elseif($request->recurrence=='weekly'){
    $this_month = Carbon::parse($request->rhasta); // returns 2019-07-01
    $start_month = Carbon::parse($request->start); // returns 2019-06-01
    $diff = $start_month->diffInDays($this_month);  // returns 1
    $diff = $diff+2;
     $diff=$diff/7;
   
}
elseif($request->recurrence=='monthly'){
    $this_month = Carbon::parse($request->rhasta)->floorMonth(); // returns 2019-07-01
    $start_month = Carbon::parse($request->start)->floorMonth(); // returns 2019-06-01
    $diff = $start_month->diffInMonths($this_month);  // returns 1 
    $diff = $diff+1;
}

                    $recurrences = [
                        'daily'     => [
                            'times'     =>  $diff,
                            'function'  => 'addDay'
                        ],
                        'weekly'    => [
                            'times'     =>  $diff,
                            'function'  => 'addWeek'
                        ],
                        'monthly'    => [
                            'times'     =>  $diff,
                            'function'  => 'addMonth'
                        ]
                    ];
                    $startTime = Carbon::parse($request->start);
                    $endTime = Carbon::parse($request->end);
                    $recurrence = $recurrences[$request->recurrence] ?? null;
                 
                    try {
                        DB::beginTransaction();

                    $x=CalendarioMttos::whereBetween('start',[$request->start,$request->end])->where('lugar',$request->salaid)->count();
                    if($x==0){
                        $eventx = CalendarioMttos::create([
                            'title' => $request->title,
                            'start' => $startTime,
                            'end' => $endTime,
                            'recurrence'=> $request->recurrence,
                        
                            'user_id' => $request->userid,
                            'user_name' => $request->username,
                            'lugar' => $request->salaid,
                            'description' => $request->salaname,
                        ]);
                  $eventid=$eventx->id;
                  CalendarioMttos::where("id", $eventid)->update(["event_id" => $eventid]);

                    if($recurrence)
                        for($i = 1; $i < $recurrence['times']; $i++)
                        {
                            $startTime->{$recurrence['function']}();
                            $endTime->{$recurrence['function']}();
                            $x=CalendarioMttos::whereBetween('start',[$startTime,$endTime])->where('lugar',$request->salaid)->count();
                    if($x==0){
                            $event = CalendarioMttos::create([
                                'title' => $request->title,
                                'start' => $startTime,
                                'end' => $endTime,
                                'recurrence'=> $request->recurrence,
                                'event_id'=> $eventid,
                                'user_id' => $request->userid,
                                'user_name' => $request->username,
                                'lugar' => $request->salaid,
                                'description' => $request->salaname,
                            ]);
                        } else{
                            return response()->json(array('status'=>'error', 'msg'=>'Error!'), 500);
                          }
                        }

                        DB::commit();
                    return response()->json($event);        
            }
        } catch (\PDOException $e) {
          
            DB::rollBack();
        }
      
                    break;
            default:
                break;
        }
    }
}
