<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function readNoti()
    {
        $notifications = Notification::where('read_at' , null)->get();

        foreach($notifications as $notification){
            $notification->update(['read_at' => now()]); 
        }
    }
}
