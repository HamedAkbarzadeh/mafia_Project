<?php

namespace App\Http\Controllers\Admin\Event;

use App\Models\User;
use App\Models\Event\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        $inGames = $event->users()->get();
        $peopleInEvent = $event->amount_of_players;
        if($inGames->count() <= $peopleInEvent){
            $users = User::all();
        }else{
            $users = null;
        }
        return view('admin.event.user.user-event' , compact('event' , 'users'));
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
    public function store(Request $request ,Event $event)
    {
        $inputs = $request->all();
        $event->users()->attach($inputs['user_id']);
        $event_insert = $event->users()->wherePivot('user_id' , $inputs['user_id'])->wherePivot('event_id' , $event->id)->first()->pivot;
        $event_insert->random_code = rand(10000,99999);
        $event_insert->save();
        return redirect()->route('admin.event.user' , $event->id)->with('swal-success' , 'کاربر مورد نظر به مسابقه اضافه شد .');
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
    public function destroy(Event $event , User $user)
    {
        $user->events()->detach($event->id);
        return redirect()->route('admin.event.user' , $event->id)->with('swal-success' , 'کاربر مورد نظر از مسابقه حذف شد .');
    }

    public function togglePayment(Event $event , User $user)
    {
        $payment_status = $user->events()->wherePivot('event_id' , $event->id)->wherePivot('user_id' , $user->id)->first()->pivot;
        $payment_status->payment_status == 0 ? $payment_status->payment_status = 1 : $payment_status->payment_status = 0;
        $payment_status->save();
        return redirect()->back()->with('swal-success' , 'وضعیت پرداخت کرد');
    }
}
