<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Event\Event;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index(Comment $comment)
    {
        // unSeen Comment
        // $unSeenComments = Comment::where('seen' , 0)->get();
        // dd($unSeenComments);
        // $unSeenCommentsCount = Comment::where('seen' , 0)->count();
        // foreach($unSeenComments as $unSeenComment){
        //     $unSeenComment->seen = $unSeenComment->seen == 0 ? 1 : 1;
        //     $unSeenComment->save();
        // }
        // return view('admin.index' , compact('unSeenComments'));


        /// for Admin Panel LandPage
        $users = User::where('user_type' ,  0)->where('status' , 1)->orderBy('created_at' , 'desc')->get();
        $admins = User::where('user_type' ,  1)->where('status' , 1)->orderBy('created_at' , 'desc')->get();
        $games = Event::where('status' , 1)->orderBy('created_at' , 'desc')->get();
        $endGames = Event::where('game_status' , 1)->get();

        $allPrice = 0;
        $profitPrice = 0;
        $cashPayment = 0;

        foreach($endGames as $game){
            $oneGamePrice = 0;
            $lessPrice = 0;

            $citizenWinPrice = 0;
            $mafiaWinPrice = 0;
            $independentWinPrice = 0;

            $oneGamePrice = $game->amount_of_players * $game->price;
            $allPrice += $game->amount_of_players * $game->price;
            $cashPayment += $game->users()->count();

            //pay price for each side
            $citizenWinPrice = $game->pay_citizen_win;
            $mafiaWinPrice = $game->pay_mafia_win;
            $independentWinPrice = $game->pay_independent_win;
            foreach($game->users as $user){
                $userInfo = $game->users()->wherePivot('user_id' , $user->id)->wherePivot('event_id' , $game->id)->first()->pivot;

                if($userInfo->win_status == 1 && $userInfo->payment_status == 1){

                    switch($userInfo->side){
                        case 0 :
                            $lessPrice += $citizenWinPrice;
                            break;
                        case 1 :
                            $lessPrice += $mafiaWinPrice;
                            break;
                        case 2 :
                            $lessPrice += $independentWinPrice;
                            break;

                            default:
                            break;
                    }
                }
            }
            $profitPrice += $oneGamePrice - $lessPrice;

        }
        return view('admin.index' , compact('users' , 'admins' , 'games' , 'allPrice' , 'profitPrice' , 'cashPayment'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('customer.home');
    }
}
