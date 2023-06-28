<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\User\UserRequest;

class CustomerController extends Controller
{
    function __construct(){
        // $this->middleware('role:owner');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_type' , '0')->get();
        return view('admin.user.customer.index' , compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.customer.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if(preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['mobile'])){
            // all mobile numbers are in on format 9** *** ***
            $inputs['mobile'] = ltrim($inputs['mobile'], '0');
            $inputs['mobile'] = substr($inputs['mobile'], 0, 2) === '98' ? substr($inputs['mobile'], 2) : $inputs['mobile'];
            $inputs['mobile'] = str_replace('+98', '', $inputs['mobile']);

        }else{
                return redirect()->back()->with('swal-error', 'شماره تلفن وارد شده نامعتبر است');
        }

        if($request->hasFile('profile_photo_path'))
        {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'User');
            $result = $imageService->save($request->file('profile_photo_path'));
            if($result === false)
            {
                return redirect()->route('admin.user.customer.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 0;
        // dd($inputs);
        $user = User::create($inputs);
        return redirect()->route('admin.user.customer.index')->with('swal-success', 'کاربر جدید با موفقیت ثبت شد');
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
    public function edit(User $user)
    {
        return view('admin.user.customer.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user , ImageService $imageService)
    {
        $inputs = $request->all();

        if(preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['mobile'])){
            // all mobile numbers are in on format 9** *** ***
            $inputs['mobile'] = ltrim($inputs['mobile'], '0');
            $inputs['mobile'] = substr($inputs['mobile'], 0, 2) === '98' ? substr($inputs['mobile'], 2) : $inputs['mobile'];
            $inputs['mobile'] = str_replace('+98', '', $inputs['mobile']);

        }else{
                return redirect()->back()->with('swal-error', 'شماره تلفن وارد شده نامعتبر است');
        }

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
            $result = $imageService->save($request->file('profile_photo_path'));
            if($result === false)
            {
                return redirect()->route('admin.user.customer.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 0;
        // dd($inputs);
        $user->update($inputs);
        return redirect()->route('admin.user.customer.index')->with('swal-success', 'ادمین جدید با موفقیت ثبت شد');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->forceDelete();
        return redirect()->route('admin.user.customer.index')->with('swal-success' , 'ادمین با موفقیت حذف شد .');;
    }

    public function status(User $user){

        $user->status = $user->status == 0 ? 1 : 0;
        $result = $user->save();
        if($result){
                if($user->status == 0){
                    return response()->json(['status' => true, 'checked' => false]);
                }
                else{
                    return response()->json(['status' => true, 'checked' => true]);
                }
        }
        else{
            return response()->json(['status' => false]);
        }

    }
    public function activation(User $user){

        $user->activation = $user->activation == 0 ? 1 : 0;
        $result = $user->save();
        if($result){
                if($user->activation == 0){
                    return response()->json(['activation' => true, 'checked' => false]);
                }
                else{
                    return response()->json(['activation' => true, 'checked' => true]);
                }
        }
        else{
            return response()->json(['activation' => false]);
        }

    }
}
