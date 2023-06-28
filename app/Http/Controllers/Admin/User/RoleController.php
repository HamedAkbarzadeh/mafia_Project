<?php

namespace App\Http\Controllers\admin\user;

use App\Models\User\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\RoleRequest;
use App\Models\Permission\Permission;

class RoleController extends Controller
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
        $roles = Role::orderBy('created_at' , 'desc')->simplePaginate(15);
        return view('admin.user.role.index' , compact('roles'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('created_at' , 'desc')->get();
        return view('admin.user.role.create' , compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $inputs = $request->all();
        $inputs['status'] = 1;
        $role = Role::create($inputs);
        $inputs['permission'] = $inputs['permission'] ?? [];
        $role->permissions()->sync($inputs['permission']);
        return redirect()->route('admin.user.role.index')->with('swal-success', 'نقش جدید با موفقیت ثبت شد');
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
    public function edit(Role $role)
    {
        return view('admin.user.role.edit', compact('role'));
    }
        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permissionEdit(Role $role)
    {
        $permissions = Permission::orderBy('created_at' , 'desc')->get();
        $havePermissions = $role->permissions->pluck('id')->toArray();
        return view('admin.user.role.permission-edit', compact('permissions' , 'role' , 'havePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $inputs = $request->all();
        $role->update($inputs);
        return redirect()->route('admin.user.role.index')->with('swal-success', 'نقش با موفقیت بروز رسانی شد');

    }
    public function permissionUpdate(RoleRequest $request , Role $role)
    {
        $inputs = $request->all();
        $inputs['permission'] = $inputs['permission'] ?? [];
        $role->permissions()->sync($inputs['permission']);
        return redirect()->route('admin.user.role.index')->with('swal-success', 'دسترسی نقش با موفقیت بروز رسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $detachRole = $role->permissions()->wherePivot('role_id' , $role->id)->detach();
        if($detachRole){
            $role->delete();
        }
        return redirect()->route('admin.user.role.index')->with('swal-success', 'نقش با موفقیت حذف شد');
    }
    public function status(Role $role){
        $role->status = $role->status == 0 ? 1 : 0;
        $result = $role->save();
        if($result){
                if($role->status == 0){
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
