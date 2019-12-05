<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notifications;
use Auth;
use DB;

class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        $notifications = DB::table('notifications')
            ->where('user_id', $request->input('user_id'))
            ->get();

        $ctr = DB::table('notifications')
            ->where('user_id', $request->input('user_id'))
            ->where('seen', false)
            ->count();

        return compact('notifications', 'ctr');
    }

    public function storeNotifications(Request $request)
    {
        $notification = new notifications;
        $notification->user_id = $request->input('user_id');
        $notification->message = $request->input('message');
        $notification->save();
    }

    public function seenNotifications()
    {
        $notif = DB::table('notifications')
            ->where('user_id', Auth::user()->id)
            ->where('seen', false)
            ->update(['seen' => true]);
    }

}
