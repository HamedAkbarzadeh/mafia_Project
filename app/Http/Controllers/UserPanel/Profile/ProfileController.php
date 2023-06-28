<?php

namespace App\Http\Controllers\UserPanel\Profile;

use App\Models\User;
use App\Models\Event\Event;
use App\Models\Event\Mafia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Attempting;
use App\Http\Services\Image\ImageService;

class ProfileController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $user_infoes = $user->events()->wherePivot('user_id', $user->id)->get();

        $allGame = $user->events()->get()->count();

        $wins = 0;
        $failed = 0;
        $mafia = 0;
        $citizen = 0;
        $independent = 0;
        foreach($user_infoes as $user_info){
            $mafia_id = $user_info->pivot->mafia_id;
            $user_side = Mafia::where('id', $mafia_id)->first();

            if($user_info->pivot->mafia_id != null && $user_info->pivot->win_status != null){
                if($user_side->side == 2){
                    $independent++;
                }elseif($user_side->side == 1){
                    $mafia++;
                }else{
                    $citizen++;
                }
                if($user_info->pivot->win_status == 1){
                    $wins++;
                }elseif($user_info->pivot->win_status == 0){
                    $failed++;
                }
            }
        }
        return view('user-panel.profile.profile' , compact('user' , 'independent' , 'mafia' , 'allGame' , 'citizen' , 'wins' , 'failed'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'new-password' => 'required',
            'new-password-confirm' => 'required',
        ]);
        $inputs = $request->all();
        $user = auth()->user();
        if(Hash::check($inputs['password'], $user->password)){
            if($inputs['new-password'] == $inputs['new-password-confirm']){
                $user->password = Hash::make($inputs['new-password']);
                $user->save();
                return redirect()->route('user-panel.profile')->with('swal-success' , 'پسورد جدید شما با موفقیت ثبت شد .');
            }else{
            return redirect()->route('user-panel.profile')->with('swal-error' , 'تکرار پسورد اشتباه وارد شده است .');
            }
        }else{
            return redirect()->route('user-panel.profile')->with('swal-error' , 'پسورد کنونی شما اشتباه وارد شده است .');
        }

    }
    public function updateProfile(Request $request , ImageService $imageService)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => ['required','digits:11', 'unique:users'],
            'image_profile' => 'nullable',
            'profile_photo_path' => 'image|mimes:png,jpg,jpeg,gif|max:1000'
        ]);
        $inputs = $request->all();

      //check id is mobile or not
      if(preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['mobile'])){
        // all mobile numbers are in on format 9** *** ***
        $inputs['mobile'] = ltrim($inputs['mobile'], '0');
        $inputs['mobile'] = substr($inputs['mobile'], 0, 2) === '98' ? substr($inputs['mobile'], 2) : $inputs['mobile'];
        $inputs['mobile'] = str_replace('+98', '', $inputs['mobile']);

    }else{
            return redirect()->back()->with('swal-error', 'شماره تلفن وارد شده نامعتبر است');
    }

        $user = auth()->user();

        $user->name = $inputs['name'];
        $user->mobile = $inputs['mobile'];
        if(!$request->hasFile('profile_photo_path'))
        {
            $user->profile_photo_path = $inputs['image_profile'] ?? $user->profile_photo_path;
        }
        $user->save();

        if($request->hasFile('profile_photo_path'))
        {
            if(!empty($user->profile_photo_path))
            {
                if(!str_contains($user->profile_photo_path , 'defult'))
                {
                    $imageService->deleteImage($user->profile_photo_path);
                }else{
                    $user->profile_photo_path = null;
                    $user->save();
                }
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'user-panel-profile');
            $imageService->setImageName('profile_photo_path');
            $result = $imageService->save($request->file('profile_photo_path'));

            if($result === false)
            {
                return redirect()->route('user-panel.profile')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $user->profile_photo_path = $result;
            $user->save();
        }

        return redirect()->route('user-panel.profile')->with('swal-success' , 'اطلاعات شما با موفقیت ثبت شد.');
    }

    public function activityInfo(Request $request)
    {
        $user = auth()->user();
        $events = $user->events()->wherePivot('user_id' , $user->id)->get();

        $mafia_numbers = [];
        $citizen_numbers = [];
        $independent_numbers = [];

        foreach($events as $event){
            $mafia_id = $event->pivot->mafia_id;
            $mafia_role = Mafia::where('id', $mafia_id)->first();

            if ($event->pivot->mafia_id != null && $event->pivot->win_status != null)
            {
                if($mafia_role->side == 1){
                    array_push($mafia_numbers, $event);
                }elseif($mafia_role->side == 2){
                    array_push($independent_numbers, $event);
                }else{
                    array_push($citizen_numbers, $event);
                }
            }
        }

        if($request->type == 'all'){
            $events = $user->events()->get();
        }
        elseif($request->type == 'mafia'){
            $events = $mafia_numbers;
        }elseif($request->type == 'citizen'){
            $events = $citizen_numbers;
        }elseif($request->type == 'independent'){
            $events = $independent_numbers;
        }

        return view('user-panel.profile.profile-activity-info' , compact('events'));
    }
}
