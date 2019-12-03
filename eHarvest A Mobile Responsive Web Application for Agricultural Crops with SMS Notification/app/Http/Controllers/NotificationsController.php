<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class NotificationsController extends Controller
{
    public function markAsRead(Request $request)
    {
        $notif = Auth::user()->notifications()->where('id',$request->notificationID)->first();
        $notif->markAsRead();
        return response()->json(["notif"=>Auth::user()->unreadNotifications,"count"=>count(Auth::user()->unreadNotifications)]);
    }
}
