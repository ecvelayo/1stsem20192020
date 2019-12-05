<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuggestedTrainings;
use App\User;
use App\Notifications\RequestTraining;

class SuggestedTrainingsController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        SuggestedTrainings::create($request->all());

        $sender = User::find($request->user_id);
        
        $this->sendNotification($sender, $request->title);
        
        return response()->json('Request submitted', 200);
    }

    public function sendNotification(User $user, $title) {
        $hrs = User::where('isHR', '=', true)
                        ->orWhere('isAdmin', '=', true)
                        ->get();
        $data = [
            'sender' => $user,
            'title' => $title
        ];
        if(count($hrs) > 0) {
            foreach($hrs as $hr) {
                $hr->notify(new RequestTraining($data));
            }
        }
    }

    public function requests() {
        $requests = SuggestedTrainings::with('user')->orderBy('updated_at', 'desc')->get();
        return response()->json($requests);
    }
}
