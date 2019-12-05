<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginPage(request $request)
    {
        if($request->session()->get('username')!=null){
            return redirect('/');
        }else{
            return view('login');
        }
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|exists:users',
            'password' => 'required'
        ]);

        $loggedIn = Auth::attempt($credentials);

        if($loggedIn){
            return redirect('/')->with('loginMessage', "Welcome, {$credentials['username']}!");
        } else {
            $errors = 'Password is invalid';
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
}
