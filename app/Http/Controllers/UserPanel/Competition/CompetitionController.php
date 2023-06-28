<?php

namespace App\Http\Controllers\UserPanel\Competition;

use App\Http\Controllers\Controller;
use App\Models\Event\Event;
use App\Models\Event\Mafia;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $events = Event::where('status' , 1)->where('start_date' , '>' , now())->orderby('created_at' , 'desc')->get();
        return view('user-panel.competition.competition' , compact('events' , 'user'));
    }
    public function registerCompetition(Event $event)
    {
        $peopleInGame = $event->users()->count();
        if($peopleInGame >= $event->amount_of_players){
            $event->complation_status = 1;
            $event->save();
        }else{
            $event->complation_status = 0;
            $event->save();
        }
        if($event->start_date <= now()){
            $event->game_status = 1;
            $event->save();
        }
        $user = auth()->user();
        $countCitizen = $event->mafias()->wherePivot('event_id' , $event->id)->wherePivot('side' , 0)->count();
        $countMafia = $event->mafias()->wherePivot('event_id' , $event->id)->wherePivot('side' , 1)->count();
        $countIndependents = $event->mafias()->wherePivot('event_id' , $event->id)->wherePivot('side' , 2)->count();


        $citizenTeams = $event->mafias()->wherePivot('side' , 0)->get();
        $mafiaTeams = $event->mafias()->wherePivot('side' , 1)->get();
        $independentTeams = $event->mafias()->wherePivot('side' , 2)->get();
        $user = auth()->user();
        $hasGame = $user->events()->wherePivot('event_id' , $event->id)->first();


        $userRole = null;
        $userRoleInfo = null;
        $winStatus = null;

        if($event->game_status == 1){
            $userRole = $event->users()->first()->pivot->mafia_id;
            $userRoleInfo = Mafia::where('id', $userRole)->first();
            $winStatus = $event->users()->first()->pivot->win_status;
        }

        return view('user-panel.competition.register-competition' , compact('event' , 'countCitizen' ,'countMafia' ,'countIndependents' , 'independentTeams' , 'citizenTeams' , 'mafiaTeams' , 'hasGame' , 'user' , 'userRoleInfo' , 'winStatus'));
    }

    public function registerCompetitionSubmit(Request $request ,Event $event)
    {
        $peopleInGame = $event->users()->count();
        if($peopleInGame >= $event->amount_of_players){
            return redirect()->route('user-panel.competition')->with('swal-error' , "ظرفیت ثبت نام تکمیل شده است .");
        }

        $inputs = $request->all();
        if(!isset($inputs['ruleConfirm'])){
            return redirect()->back()->with('swal-error' , "لطفا ابتدا تیک تایید تمام قوانین را بزنید");
        }
        $user = auth()->user();
        $event->users()->attach($user->id , ['random_code' => rand(10000,99999)]);
        $lastInsert = $event->users()->wherePivot('event_id' , $event->id)->wherePivot('user_id' , $user->id)->first()->pivot;
        return redirect()->route('user-panel.competition')->with('swal-success' , "درخواست شما با موفقیت ثبت شد کد ورود : {$lastInsert->random_code} ");
    }

    public function leaveGame(Event $event)
    {
        $user = auth()->user();
        $event->users()->detach($user->id);
        return redirect()->back()->with('swal-success' , 'عملیات با موفقیت انجام شد.');
    }
}
