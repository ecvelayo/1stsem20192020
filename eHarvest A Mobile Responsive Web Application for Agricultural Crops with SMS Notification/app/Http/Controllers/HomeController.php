<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }
    public function index()
    {
        $title = "home";
        return view('pages.home')->with('title');
    }

    public function showChangePasswordForm(){
        return view('auth.changePassword');
    }
    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
            // 'new-password_confirmation' => 'required',

        ],[
            // 'current-password.required' => 'Please fill up this field',
            // 'new-password.required' => 'Please fill up this field',
            'new-password.min'=> 'The new password must be at least 8 characters',
            'new-password.confirmed' => 'The new password and new password confirmation does not match',
            // 'new-password_confirmation.required' => 'Please fill up this field',

        ]
    );
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        alert()->success('Password Changed Successfully.')->autoclose(3500);
        return redirect()->back();
    }
}
