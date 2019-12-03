<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      // $age = date('Y', strtotime(Carbon::now())) - date('Y', strtotime($data['bday'])) ;
      // $data['bday'] = $age;

      $dt = Carbon::now();
      $before = $dt->subYears(13)->format('Y-m-d');

        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'firstname' => ['required', 'string', 'regex:/^[\pL\s\-]+$/u', 'max:255'],
            'lastname' => ['required', 'string', 'regex:/^[\pL\s\-]+$/u', 'max:255'],
            'contact' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/','min:10', 'max:11'],
            'address' => ['required', 'string', 'max:255'],
            'bday' => ['required', "before:$before",'max:100'],
        ],
      [

        'firstname.regex'=> 'Must only contain letters and spaces',
        'lastname.regex'=> 'Must only contain letters and spaces',
        'bday.before'=> "Age must be 13 and above",
      ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       // $bdate =  $data['bday'];
        //$newDateFormat = $bdate->format('Y/m/d');
        //$newDateFormat = $user->created_at->format('d/m/Y');
       // dd($bdate);
       $no = "63";

       if(substr($data['contact'], 0, 2) == '09'){
         $no = $no . substr($data['contact'], 1);
       }else if(substr($data['contact'], 0, 3) == '+63'){
         $no = $no . substr($data['contact'], 3);
       }else{
         $no = $data['contact'];
       }

        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'contact' => $no,
            'address' => $data['address'],
            'birthdate' => $data['bday'],
            'photo' => 'https://storage.googleapis.com/eharvest-files/user/photos/images.png',

        ]);
    }
}
