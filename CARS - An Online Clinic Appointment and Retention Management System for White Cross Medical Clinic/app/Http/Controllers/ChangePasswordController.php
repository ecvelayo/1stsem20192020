<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function changePassword(Request $request)
    {  
        // The passwords check if matches with the old password
        if (!(Hash::check($request->get('CurrentPassword'), Auth::user()->password))) {
            return redirect()->back()->with("CurrentPassword", "Your current password does not matches with the password you provided. Please try again.");
        }
        
        //Current password and new password are same
        if(strcmp($request->get('CurrentPassword'), $request->get('NewPassword')) == 0){
            return redirect()->back()->with("NewPassword", "New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'CurrentPassword' => 'required',
            'NewPassword' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8|same:NewPassword'
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('NewPassword'));
        $user->save();

        toastr()->success('Password changed successuflly!', 'Successful');
        
        return redirect()->back();
    }
}
