<?php

namespace App\Http\Controllers\Admin\Event;

use App\Models\Event\Mafia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Event\MafiaRoleRequest;
use App\Models\Event\Event;

class MafiaRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mafias = Mafia::orderBy('created_at' , 'desc')->get();
        return view('admin.event.role.index' , compact('mafias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MafiaRoleRequest $request)
    {
        $inputs = $request->all();
        Mafia::create($inputs);
        return redirect()->route('admin.event.role.index')->with('swal-success' , 'نقش جدید شما با موفقیت ثبت شد .');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        // return view();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mafia $role)
    {
        return view('admin.event.role.edit' , compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MafiaRoleRequest $request,Mafia $role)
    {
        $inputs = $request->all();
        $role->update($inputs);
        return redirect()->route('admin.event.role.index')->with('swal-success' , 'نقش مورد نظر شما با موفقیت ویرایش شد .');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mafia $mafia)
    {
        $mafia->delete();
        return redirect()->route('admin.event.role.index')->with('swal-success' , 'نقش  شما با موفقیت حذف1 شد .');
    }
    public function status(Mafia $mafia)
    {
        $mafia->status = $mafia->status == 0 ? 1 : 0;
        $result = $mafia->save();
        if ($result) {
            if ($mafia->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
