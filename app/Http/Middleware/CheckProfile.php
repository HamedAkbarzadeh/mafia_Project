<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if($user->mobile == null){
            return redirect()->route('user-panel.profile')->with('swal-info', 'لطفا از بخش پروفایل کاربری قسمت تنظیمات ابتدا شماره تلفن خود را ثبت نمایید .');
        }
        if($user->name == null){
            return redirect()->route('user-panel.profile')->with('swal-info', 'لطفا از بخش پروفایل کاربری قسمت تنظیمات ابتدا نام خود را ثبت نمایید .'); 
         }
        return $next($request);
    }
}
