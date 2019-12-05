<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo() 
    {
        if (Auth::check()) {
            $username = Auth::user()->username;
            if (Auth::user()->role->description == 'ADMIN') {
                $route = '/admin/dashboard'.'/'.$username;
            } elseif (Auth::user()->role->description == 'PATIENT') {
                $route = '/patient/appointments'.'/'.$username;
            } elseif (Auth::user()->role->description == 'DOCTOR') {
                $route = '/doctor/dashboard'.'/'.$username;
            } elseif (Auth::user()->role->description == 'NURSE') {
                $route = '/nurse/dashboard'.'/'.$username;
            }
        }

        return $route;      
    }

    public function username()
    {
        $loginType = request()->input('username');
        
        $this->username = filter_var($loginType, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$this->username => $loginType]);

        return property_exists($this, 'username') ? $this->username : 'email';
    }
}
