<?php

namespace App\Http\Controllers\UserPanel\Role;

use App\Models\Event\Mafia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(){
        $countCitizen = Mafia::where('side', 0)->where('status' , 1)->get()->count();
        $countMafia = Mafia::where('side', 1)->where('status' , 1)->get()->count();
        $countIndependent = Mafia::where('side', 2)->where('status' , 1)->get()->count();
        return view('user-panel.role.index' , compact('countCitizen' ,'countMafia' , 'countIndependent'));
    }

    public function role(){
        if(request()->type == 1){
            $roles = Mafia::where('side', 1)->where('status' , 1)->orderby('created_at' , 'desc')->get();
            return view('user-panel.role.role' , compact('roles'));
        }elseif(request()->type == 0){
            $roles = Mafia::where('side', 0)->where('status' , 1)->orderby('created_at' , 'desc')->get();
            return view('user-panel.role.role' , compact('roles'));
        }else{
            $roles = Mafia::where('side', 2)->where('status' , 1)->orderby('created_at' , 'desc')->get();
            return view('user-panel.role.role' , compact('roles'));
        }
    }
}
