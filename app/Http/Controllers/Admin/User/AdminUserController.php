<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\User\AdminRequest;
use App\Models\Permission\Permission;
use App\Models\User\Role;
use App\Notifications\NewUserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
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
        $admins = User::where('user_type' , '1')->orWhere('isAdmin' , 1)->get();
        return view('admin.user.admin-user.index' ,compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.admin-user.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request, ImageService $imageService)
    {
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
        if($request->hasFile('profile_photo_path'))
        {

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'user-panel-profile');

            $result = $imageService->save($request->file('profile_photo_path'));
            if($result === false)
            {
                return redirect()->route('admin.user.admin-user.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 1;
        $inputs['isAdmin'] = 1;
        // dd($inputs);
        $admin = User::create($inputs);
        $details = [
            'message' => 'ادمین جدید به اسم :  '.  $admin->fullName  .'  به سایت اضافه شد.',
        ];
        $adminUser = auth()->user();
        $adminUser->notify(new NewUserRegistered($details));
        return redirect()->route('admin.user.admin-user.index')->with('swal-success', 'ادمین جدید با موفقیت ثبت شد');
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
        return view('admin.user.admin-user.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, User $user , ImageService $imageService)
    {
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
                return redirect()->route('admin.user.admin-user.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 1;
        $inputs['isAdmin'] = 1;
        // dd($inputs);
        $user->update($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success', 'ادمین جدید با موفقیت ثبت شد');
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
        return redirect()->route('admin.user.admin-user.index')->with('swal-success' , 'ادمین با موفقیت حذف شد .');;
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

    public function role(User $user)
    {
        $roles = Role::where('status', 1)->get();
        return view('admin.user.admin-user.role.create' , compact('user' , 'roles'));
    }
    public function roleStore(Request $request , User $user)
    {
        $validate = $request->validate([
            'role' => 'exists:roles,id|array'
        ]);
        $user->roles()->sync($request->role);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success' , 'نقش جدید شما با موفقیت ثبت شد .');
    }

    public function permission(User $user)
    {
        $permissions = Permission::where('status' , 1)->get();
        return view('admin.user.admin-user.permission.create' , compact('user' , 'permissions'));
    }
    public function permissionStore(Request $request , User $user)
    {
        $validate = $request->validate([
            'permission' => 'exists:permissions,id|array'
        ]);
        $user->permissions()->sync($request->permission);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success' , 'سطح دسترسی جدید شما با موفقیت ثبت شد .');
    }


}
