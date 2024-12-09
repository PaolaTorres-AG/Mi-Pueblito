<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class EventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)->where('lugar',$request->id)
                ->get(['id', 'title', 'start', 'end','user_name','lugar','user_id','description','event_id']);

            return response()->json($data);  
        }
        return view('ti.calendario');
    }

    public function store(Request $request)
    {
        switch ($request->type) {
            case 'add':

                $x=Event::whereBetween('start',[$request->start,$request->end])->whereBetween('end',[$request->start,$request->end])->where('lugar',$request->salaid)->count();
            if($x==0){
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                    'recurrence' => 'none',
                    'user_id' => $request->userid,
                    'user_name' => $request->username,
                    'lugar' => $request->salaid,
                    'description' => $request->salaname,
                ]);
                return response()->json($event);
            }
            else{
                return response()->json(array('status'=>'error', 'msg'=>'Error!'), 500);
            }
                break;

            case 'update':
     
            $x=Event::where('end', '>=',$request->start)->where('start','<=', $request->end)->where('id','!=',$request->id)->where('lugar',$request->salaid)->count();
            
            if($x==0){
                $event = Event::find($request->id)->update([
                    'title' =>$request->title, 
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
                return response()->json($event);
            }
            else{
                return response()->json(array('status'=>'error', 'msg'=>'Error!'), 500);
              }
                break;
            case 'delete':
                $event = Event::find($request->id)->delete();
                return response()->json($event);
                break;
                case 'secuencia':
                    $event = Event::where('event_id',$request->id)->delete();
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

                    $x=Event::whereBetween('start',[$request->start,$request->end])->where('lugar',$request->salaid)->count();
                    if($x==0){
                        $eventx = Event::create([
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
                  Event::where("id", $eventid)->update(["event_id" => $eventid]);

                    if($recurrence)
                        for($i = 1; $i < $recurrence['times']; $i++)
                        {
                            $startTime->{$recurrence['function']}();
                            $endTime->{$recurrence['function']}();
                            $x=Event::whereBetween('start',[$startTime,$endTime])->where('lugar',$request->salaid)->count();
                    if($x==0){
                            $event = Event::create([
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
