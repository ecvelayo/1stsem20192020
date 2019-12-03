<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MyNotifications;
use Illuminate\Support\MessageBag;
use Auth;
use DB;
use App\Users;
use App\User_roles;
use App\Departments;
use App\Transfer_Requests;
use App\Graduate_Requests;
use App\Employees;
use App\Logs;
use App\User_departments;
use Notification;
use Hash;
use Session;

class RegisterController extends Controller 
{
    public function registernow(request $request)
    {
    
    $validation = $this->validate($request,[
            'username' =>'required|unique:users',
            'contact'=>'required|unique:users|digits:11',
            'email' => 'required|unique:users'
      ]);

      if(!$validation){
        
        $errors = new MessageBag;
        $errors->add(['username' => ['Username already taken'],'contact' => ['Contact number already taken'],'email' => ['Email already taken']]);

           return back()->with($errors);
      }

        $id = rand();
        $depts = $request->input('depart');

    $designation_id = $request->designation;

        if($request->input('designat')){
            $role = new User_roles([
            'parent' => $request->input('roleid'),
            'name' =>  $request->input('designat'),
            'description' => 'Designation',
        ]);

        $role->save();
        
        $roles = User_roles::where('name',$request->input('designat'))->get();

        foreach($roles as $rol)
        {
            $designation_id = $rol->id;
        }
    }

    elseif($request->input('designation')){

        $designation_id = $request->input('designation');

    }
    else{

        $designation_id = NULL;

    }

    	$user = new Users([
            'user_id' => $id,
    		'fname' => $request->input('fname'),
    		'lname' => $request->input('lname'),
    		'username' => $request->input('username'),
    		'password' => Hash::make($request->input('password')),
    		'contact' => $request->input('contact'),
    		'email' => $request->input('email'),
    		'role' => $request->input('roleid'),
            'designation' => $designation_id,
    		'department' => $request->input('department'),
    	]);


        $user->save();

     $users = Users::where('user_id',$id)->with('user_departments')->with('user_roles')->get();

    if($request->input('department') != NULL){

         foreach($depts as $dept)
         {
            
            $user_department = new User_departments([
                    'user_id' => $user->id,
                    'department_id' => $dept
                ]);

                $user_department->save();
         }
    }


        foreach($users as $usz)
        {   
            $userid = $usz->id;
            $role = $usz->user_roles->name;
            if($usz->department == ""){
                $department = "none";
            }
            else{
                $department = $usz->user_departments->department_name;
            } 
        }


        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'User Register',
            'action' => 'Registered User no. '.$userid.' as '.$role. ' in '.$department.' Department ',
            'date_time' => date('M-j-Y g:i A'),
        ]);

        $logs->save();


        $allusers = Users::all();

        Notification::send($allusers, new MyNotifications($usz));

    	Session::flash('alert-class', 'success'); 
		flash('User Created', '')->overlay();

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $rolex = User_roles::find($request->input('roleid'));
        $urole = Users::where('role',$request->input('roleid'))->with('user_departments')->with('user_roles')->get();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
        $udepts = User_departments::all();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.showusers')->with('roles',$roles)->with('deps',$deps)->with('rolex',$rolex)->with('urole' ,$urole)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts)->with('udepts',$udepts);
        }
        else if (Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.showusers')->with('roles',$roles)->with('deps',$deps)->with('rolex',$rolex)->with('urole' ,$urole)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts)->with('udepts',$udepts);
        }

}

    public function register_role(request $request)
    {
        

        $validation = $this->validate($request,[
            'name' => 'required|unique:user_roles',
        ]);

        if(!$validation){
            $errors = new MessageBag(['name' => ['Role name should be unique']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }     
        else{
        
            $role = new User_roles([
                'name' => $request->input('name'),
                'description' => $request->input('rdesc')
            ]);
 
            $role->save();

        }

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Role Creation',
            'action' => 'Created '.$request->input('rname').' role ',
            'date_time' => date('M-j-Y g:i A'),
        ]);

        $logs->save();

        Session::flash('alert-class', 'success'); 
		flash('Role Created', '')->overlay();

		$roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.chooseuser')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.chooseuser')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
    }

    public function register_dep(request $request)
    {


        $role = new Departments([
            'department_name' => $request->input('depname'),
            'description' => $request->input('depdesc')
        ]);

        $role->save();

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Department Creation',
            'action' => 'Created '.$request->input('depname').' Department ',
            'date_time' => date('M-j-Y g:i A'),
        ]);

        $logs->save();

        Session::flash('alert-class', 'success'); 
		flash('Department Created', '')->overlay();

		$roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
        return view('superadmin.postcreatedep')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
      }
      elseif(Auth::user()->user_role()->first()->name == 'Admin'){
        return view('admin.postcreatedep')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
      }
    }   

    public function newemployee()
    {

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();
        $designation = User_roles::where('description','Employee')->get();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.createemployee')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('designation',$designation)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.createemployee')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('designation',$designation)->with('user_dept', $depts);
        }

    }
 
    public function create_employee(Request $request)
    {


    if($request->input('designat')){
        $role = new User_roles([
            'parent' => 0,
            'name' =>  $request->input('designat'),
            'description' => 'Employee',
        ]);

        $role->save();
        
        $roles = User_roles::where('name',$request->input('designat'))->get();

        foreach($roles as $rol)
        {
            $designation_id = $rol->id;
        }
    }

    else{

        $designation_id = $request->input('designation');

    }

        $validation = $this->validate($request,[
        'contact'=>'required|unique:employees|digits:11',
        'email' => 'required|unique:employees'
        ]);

      if(!$validation){
        $errors = new MessageBag(['contact' => ['Contact number should be unique'],'email' => ['Email should be unique']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
      }
      else{



        $employee = new Employees([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'mname' => $request->input('mname'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'designation' => $designation_id,
            'department' => $request->input('department'),
        ]);

        $employee->save();

        }

        $emplo = Employees::with('emp_department')->with('emp_designation')->where('id', $employee->id)->get();

        foreach($emplo as $employ)
        {
            $id_employee = $employ->id;
            $department_employee = $employ->emp_department->department_name;
            $designation_employee = $employ->emp_designation->name;

        }

        date_default_timezone_set('Asia/Singapore');
        
        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Employee Register',
            'action' => 'Registered '.$designation_employee.' no. '.$id_employee.' in '.$department_employee.' Department ',
            'date_time' => date('M-j-Y g:i A'), 
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        Session::flash('alert-class', 'success'); 
        flash('Employee Created', '')->overlay();


        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $emp = Employees::all();
        $graduate = Graduate_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }


        
       if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.showemployees')->with('roles' , $roles)->with('deps',$deps)->with('emp' ,$emp)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.showemployees')->with('roles' , $roles)->with('deps',$deps)->with('emp' ,$emp)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.showemployees')->with('roles' , $roles)->with('deps',$deps)->with('emp' ,$emp)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
    }

}
