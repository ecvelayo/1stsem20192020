<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\role;
use App\bloodtype;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:NURSE,ADMIN']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'contact_no' => ['required'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'middle_name' => ['required'],
            'sex' => ['required'],
            'birthday' => ['required'],
            'citizenship' => ['required'],
            'civil_status' => ['required'],
            'address_line_1' => ['required'],
            'address_line_2' => ['required'],
            'bloodtype_id' => ['required']
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
        $password = strtolower($data['last_name'].'1234');
        
        if(Auth::user()->role_id == 4){
            $role = 2;
        }elseif(Auth::user()->role_id == 1){
            $role = $data['role_id'];
        }

        return User::create([
            'contact_no' => $data['contact_no'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($password),
            'role_id' => $role,
            'first_name' => strtoupper($data['first_name']),
            'last_name' => strtoupper($data['last_name']),
            'middle_name' => strtoupper($data['middle_name']),
            'sex' => $data['sex'],
            'birthday' => $data['birthday'],
            'citizenship' => strtoupper($data['citizenship']),
            'civil_status' => $data['civil_status'],
            'address_line_1' => strtoupper($data['address_line_1']),
            'address_line_2' => strtoupper($data['address_line_2']),
            'bloodtype_id' => $data['bloodtype_id']
        ]);
    }

    public function showRegistrationForm()
    {
        $roles = role::all();
        $items_1 = user::getEnumValues('civil_status');
        $items_2 = user::getEnumValues('sex');
        $bloodtypes = bloodtype::all();

        return view('auth.register', compact('roles', 'items_1', 'items_2', 'bloodtypes'));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        
        return $this->registered($request, $user)?: redirect($this->redirectPath());
    }

    protected function redirectTo() 
    {
        if (Auth::check()) {
            $username = Auth::user()->username;
            if (Auth::user()->role->description == 'ADMIN') {
                $route = '/admin/dashboard'.'/'.$username;
            } elseif (Auth::user()->role->description == 'NURSE') {
                $route = '/nurse/dashboard'.'/'.$username;
            }
        }

        return $route; 
    }
}
