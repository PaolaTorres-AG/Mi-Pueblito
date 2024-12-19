<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;
class EventosController extends Controller
{
    public function index2(Request $request)
    {
      
        if ($request->ajax()) {
           
            $data = Eventos::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end','user_name','lugar','user_id','description','event_id']);

            return response()->json($data);  
        }
        return view('ti.CalendarioDoctor');
    }

    public function storex(Request $request)
    {
        switch ($request->type) {
            case 'add':

 $x=Eventos::whereBetween('start',[$request->start,$request->end])->whereBetween('end',[$request->start,$request->end])->count();
if($x==0){
                $Eventos = Eventos::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                    'recurrence' => 'none',
                    'user_id' => $request->userid,
                    'user_name' => $request->username,
                  
                ]);
                return response()->json($Eventos);
            }
              else{
                return response()->json(array('status'=>'error', 'msg'=>'Error!'), 500);
              }
                break;

            case 'update':
     
$x=Eventos::where('end', '>=',$request->start)->where('start','<=', $request->end)->where('id','!=',$request->id)->count();
if($x==0){
                $Eventos = Eventos::find($request->id)->update([
                    'title' =>$request->title, 
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
                return response()->json($Eventos);
            }
            else{
                return response()->json(array('status'=>'error', 'msg'=>'Error!'), 500);
              }
                break;
            case 'delete':
                $Eventos = Eventos::find($request->id)->delete();
                return response()->json($Eventos);
                break;
                case 'secuencia':
                    $Eventos = Eventos::where('Eventos_id',$request->id)->delete();
                    return response()->json($Eventos);
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

                    $x=Eventos::whereBetween('start',[$request->start,$request->end])->count();
                    if($x==0){
                        $Eventosx = Eventos::create([
                            'title' => $request->title,
                            'start' => $startTime,
                            'end' => $endTime,
                            'recurrence'=> $request->recurrence,
                        
                            'user_id' => $request->userid,
                            'user_name' => $request->username,
                            'lugar' => $request->salaid,
                            'description' => $request->salaname,
                        ]);
                  $Eventosid=$Eventosx->id;
                  Eventos::where("id", $Eventosid)->update(["Eventos_id" => $Eventosid]);

                    if($recurrence)
                        for($i = 1; $i < $recurrence['times']; $i++)
                        {
                            $startTime->{$recurrence['function']}();
                            $endTime->{$recurrence['function']}();
                            $x=Eventos::whereBetween('start',[$startTime,$endTime])->count();
                    if($x==0){
                            $Eventos = Eventos::create([
                                'title' => $request->title,
                                'start' => $startTime,
                                'end' => $endTime,
                                'recurrence'=> $request->recurrence,
                                'Eventos_id'=> $Eventosid,
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
                    return response()->json($Eventos);        
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
