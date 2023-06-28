<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Event\EventNotificationRequest;
use App\Models\Event\EventNotification;
use Illuminate\Http\Request;

class EventNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = EventNotification::orderBy('created_at' , 'desc')->get();
        return view('admin.event.notification.index' , compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(EventNotification $eventNotification)
    {
        return view('admin.event.notification.create' , compact('eventNotification'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventNotificationRequest $request)
    {
        $inputs = $request->all();
        //fix date
        $realTimePublishedAt = substr($request->start_date , 0 , 10);
        $inputs['start_date'] = date('Y/m/d H:i:s',(int)$realTimePublishedAt); 
        //fix date
        $realTimePublishedAt = substr($request->end_date , 0 , 10);
        $inputs['end_date'] = date('Y/m/d H:i:s',(int)$realTimePublishedAt); 

        EventNotification::create($inputs);
        return redirect()->route('admin.event.notification')->with('swal-success' , 'اعلان مورد نظر با موفقیت ثبت شد');

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
    public function edit(EventNotification $eventNotification)
    {
        return view('admin.event.notification.edit' , compact('eventNotification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventNotificationRequest $request, EventNotification $eventNotification)
    {
        $inputs = $request->all();
        //fix date
        $realTimePublishedAt = substr($request->start_date , 0 , 10);
        $inputs['start_date'] = date('Y/m/d H:i:s',(int)$realTimePublishedAt); 
        //fix date
        $realTimePublishedAt = substr($request->end_date , 0 , 10);
        $inputs['end_date'] = date('Y/m/d H:i:s',(int)$realTimePublishedAt); 

        $eventNotification->update($inputs);
        return redirect()->route('admin.event.notification')->with('swal-success' , 'اعلان مورد نظر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventNotification $eventNotification)
    {
        $eventNotification->delete();
        return redirect()->route('admin.event.notification')->with('swal-success' , 'اعلان مورد نظر با موفقیت حذف شد');
    }
    public function status(EventNotification $notification)
    { 
        $notification->status = $notification->status == 0 ? 1 : 0;
        $result = $notification->save();
        if ($result) {
            if ($notification->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
