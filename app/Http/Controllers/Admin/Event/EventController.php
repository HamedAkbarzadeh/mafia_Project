<?php

namespace App\Http\Controllers\Admin\Event;

use App\Models\Event\Event;
use App\Models\Event\Mafia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Event\EventRequest;
use App\Models\User;

class EventController extends Controller
{
    function __construct(){
        // $this->middleware('role:owner,create-event')->only(['store','create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderby('created_at' , 'desc')->get();
        return view('admin.event.index' , compact('events'));
    }
    public function over()
    {
        $events = Event::where('game_status' , 1)->orderby('created_at' , 'desc')->get();
        return view('admin.event.index' , compact('events'));
    }
    public function ahead()
    {
        $events = Event::where('game_status' , 0)->orderby('created_at' , 'desc')->get();
        return view('admin.event.index' , compact('events'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $citizens = Mafia::where([['side' , 0] , ['status' , 1]])->get();
        $mafias = Mafia::where([['side' , 1] , ['status' , 1]])->get();
        $independents = Mafia::where([['side' , 2] , ['status' , 1]])->get();
        return view('admin.event.create' , compact('citizens' , 'mafias' , 'independents'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $inputs = $request->all();
        if(!isset($inputs['vip_game'])){
            $inputs['vip_game'] = 0;
        }
        //fix date
        $realTimePublishedAt = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y/m/d H:i:s', (int)$realTimePublishedAt);

        DB::transaction(function () use($inputs) {
        $event = Event::create($inputs);

        $inputs['independentRole'] = $inputs['independentRole'] ?? [];
        $inputs['citizenRole'] = $inputs['citizenRole'] ?? [];
        $inputs['mafiaRole'] = $inputs['mafiaRole'] ?? [];

        $event->mafias()->attach($inputs['citizenRole'] , ['side' => 0]);
        $event->mafias()->attach($inputs['mafiaRole'] , ['side' => 1]);
        $event->mafias()->attach($inputs['independentRole'] , ['side' => 2]);
        });
        return redirect()->route('admin.event.index')->with('swal-success' , 'مسابقه جدید شما با موفقیت ثبت شد .');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $countCitizen = $event->mafias()->wherePivot('event_id' , $event->id)->wherePivot('side' , 0)->count();
        $countMafia = $event->mafias()->wherePivot('event_id' , $event->id)->wherePivot('side' , 1)->count();
        $countIndependents = $event->mafias()->wherePivot('event_id' , $event->id)->wherePivot('side' , 2)->count();

        $citizenTeams = $event->mafias()->wherePivot('side' , 0)->get();
        $mafiaTeams = $event->mafias()->wherePivot('side' , 1)->get();
        $independentTeams = $event->mafias()->wherePivot('side' , 2)->get();

        return view('admin.event.show' , compact('event' , 'countCitizen' ,'countMafia' ,'countIndependents' , 'independentTeams' , 'citizenTeams' , 'mafiaTeams'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $citizens = Mafia::where([['side' , 0] , ['status' , 1]])->get();
        $mafias = Mafia::where([['side' , 1] , ['status' , 1]])->get();
        $independents = Mafia::where([['side' , 2] , ['status' , 1]])->get();

        //
        $selectedCitizens = $event->mafias()->wherePivot('event_id' , $event->id)->wherePivot('side' , 0)->get();
        $selectedMafias = $event->mafias()->wherePivot('event_id' , $event->id)->wherePivot('side' , 1)->get();
        $selectedIndependents = $event->mafias()->wherePivot('event_id' , $event->id)->wherePivot('side' , 2)->get();
        //
        // dd($mafias->first()->mafiaRole);
        return view('admin.event.edit' , compact('event' , 'citizens' , 'mafias' , 'independents' ,'selectedIndependents' , 'selectedMafias' , 'selectedCitizens'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $inputs = $request->all();
        if(!isset($inputs['vip_game'])){
            $inputs['vip_game'] = 0;
        }
        DB::transaction(function () use($event , $inputs , $request) {
            //fix date
            $realTimePublishedAt = substr($request->start_date, 0, 10);
            $inputs['start_date'] = date('Y/m/d H:i:s', (int)$realTimePublishedAt);
            $event->update($inputs);

            $inputs['independentRole'] = $inputs['independentRole'] ?? [];
            $inputs['citizenRole'] = $inputs['citizenRole'] ?? [];
            $inputs['mafiaRole'] = $inputs['mafiaRole'] ?? [];

            $event->mafias()->detach($inputs['citizenRole'] , ['side' => 0]);
            $event->mafias()->detach($inputs['mafiaRole'] , ['side' => 1]);
            $event->mafias()->detach($inputs['independentRole'] , ['side' => 2]);

            $event->mafias()->attach($inputs['citizenRole'] , ['side' => 0]);
            $event->mafias()->attach($inputs['mafiaRole'] , ['side' => 1]);
            $event->mafias()->attach($inputs['independentRole'] , ['side' => 2]);
            return redirect()->route('admin.event.index')->with('swal-success' , 'مسابقه جدید شما با موفقیت ویرایش شد .');
        });
        return redirect()->route('admin.event.index')->with('swal-error' , 'مسابقه جدید شما به خطا مواجه شد .');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        $event->mafias()->detach($event->id);
        return redirect()->route('admin.event.index')->with('swal-success' , 'مسابقه جدید شما با موفقیت حذف شد .');
    }
    public function status(Event $event)
    {
        $event->status = $event->status == 0 ? 1 : 0;
        $result = $event->save();
        if ($result) {
            if ($event->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
    public function complationStatus(Event $event)
    {
        $event->complation_status = $event->complation_status == 0 ? 1 : 0;
        $result = $event->save();
        if ($result) {
            if ($event->complation_status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function gameStatus(Event $event)
    {
        $event->game_status = $event->game_status == 0 ? 1 : 0;
        $result = $event->save();
        if ($result) {
            if ($event->game_status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
