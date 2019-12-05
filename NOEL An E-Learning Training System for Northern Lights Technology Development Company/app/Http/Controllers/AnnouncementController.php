<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;

class AnnouncementController extends Controller
{
    public function getAnnouncements() {
        $announcements = Announcement::all();
        return response()->json($announcements);
    }

    public function storeAnnouncement(Request $request) {
        $validateData = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $announcements = new Announcement;
        $announcements->title = $validateData['title'];
        $announcements->description = $validateData['description'];
        $announcements->save();

        return $this->getAnnouncements();
}
}