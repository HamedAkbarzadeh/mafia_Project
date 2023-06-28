<?php

namespace App\Http\Controllers\Admin\Event;

use App\Models\User;
use App\Models\Event\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Event\Mafia;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event , User $user)
    {
        $old = $user->events()->wherePivot('event_id', $event->id)->first()->pivot;

        $win_status = 100;
        $mafia_side = 100;
        $mafia_id = 0;
        if($old->mafia_id != null && $old->win_status != null){
            $win_status = $old->win_status;
            $mafia_id = $old->mafia_id;
            $mafia_info = Mafia::where('id', $mafia_id)->first();
            $mafia_side = $mafia_info->side;
        }
        return view('admin.event.user.user-info' , compact('event' , 'user' , 'win_status' , 'mafia_side' , 'mafia_id'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Event $event , User $user)
    {
        $request->validate([
            'result_game' => 'required|in:0,1|numeric',
            'side' => 'required|in:0,1,2|numeric',
            'user_role' => 'required|numeric|exists:mafias,id'
        ]);
        
       DB::transaction(function () use($event , $user ,$request) {
        $event_user = $event->users()->wherePivot('user_id' , $user->id)->wherePivot('event_id' , $event->id)->first()->pivot;
        $event_user->update([
            'mafia_id' => $request->user_role,
            'win_status' => $request->result_game,
            'side' => $request->side,
        ]);
        $user = auth()->user();
        // $allGame = $user->events->count();
        $win = 0;
        $fail = 0;
        foreach($user->events as $event){
            if($event->pivot->win_status == 1){
                $win += 1;
            }else{
                $fail += 1;
            }
        }
        
        if($fail == 0){
            $vt = $win;
        }elseif($win == 0){
            $vt = $fail;
        }elseif($win != 0 && $fail != 0){
            $vt = $win / $fail; 
        }
        $user->vt = $vt;
        $user->save();
        return redirect()->route('admin.event.user' , $event)->with('swal-success' , 'اطلاعات با موفقیت ثبت شد.'); 
       });
        return redirect()->route('admin.event.user' , $event)->with('swal-error' , 'خطا در بروز رسانی اطلاعات لطفا بعدا تلاش نمایید .');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
