<?php

namespace App\Http\Controllers;

use Auth;
use Session;

class LogoutController extends Controller
{
    public function doLogout()
    {
        Auth::logout();		
        return redirect('/')->with('message', 'You have successfully logged out!');
    }
}
