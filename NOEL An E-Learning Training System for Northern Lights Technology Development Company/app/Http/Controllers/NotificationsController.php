<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class NotificationsController extends Controller
{
    public function getUserUnreadNotifications($id) {
        $user = User::findOrFail($id);
        return response()->json($user->unreadNotifications);
    }

    public function getAllNotifications($id) {
        $user = User::findOrFail($id);
        return response()->json($user->notifications);
    }

    public function markAsRead($notif, $id) {
        $user = User::findOrFail($id);
        foreach($user->notifications as $notification) {
            if($notification->id === $notif) {
                $notification->markAsRead();
            }
        }
        return $this->getUserUnreadNotifications($id);
    }

}
