<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\PermissionRequest;
use App\Http\Requests\Admin\User\RoleRequest;
use App\Models\Permission\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
        $permissions = Permission::orderBy('created_at' , 'desc')->get();
        return view('admin.user.permission.index' , compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $inputs = $request->all();
        $inputs['status'] = 1;
        $permission = Permission::create($inputs);
        // dd($inputs);
        return redirect()->route('admin.user.permission.index')->with('swal-success', 'دسترسی جدید با موفقیت ثبت شد');
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
    public function edit(Permission $permission)
    {
        return view('admin.user.permission.edit' , compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $inputs = $request->all();
        $permission->update($inputs);
        return redirect()->route('admin.user.permission.index')->with('swal-success', 'ویرایش دسترسی با موفقیت ثبت شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
       $permission->delete();
       return redirect()->route('admin.user.permission.index')->with('swal-success', ' دسترسی با موفقیت حذف شد .');
    }
    public function status(Permission $permission){
        $permission->status = $permission->status == 0 ? 1 : 0;
        $result = $permission->save();
        if($result){
                if($permission->status == 0){
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
}
