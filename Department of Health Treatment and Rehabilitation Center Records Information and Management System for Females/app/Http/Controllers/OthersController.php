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
use Auth;
use DB;
use App\Users;
use App\User_roles;
use App\User_departments;
use App\Departments;
use App\Transfer_Requests;
use App\Employees;
use App\Cities;
use App\Case_Type; 
use App\Graduate_Requests;
use App\Dismissal_Reason;
use App\Logs;
use App\Patients;
use App\City_Jails;
use App\Checklist;
use App\Checklist_Status;
use App\Civil_Status;
use App\Gender;
use App\Drugs_Abused;
use App\Educational_Attainment;
use App\Employment_Status;
use Notification;
use Hash;
use Session;

class OthersController extends Controller
{
	public function add_a_city()
	{
		    $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.addcity')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addcity')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        }
	}

	public function addcity(Request $request)
	{

		$validation = $this->validate($request,[
			'name' => 'required|unique:cities',
		]);

     	if(!$validation){
        $errors = new MessageBag(['name' => ['City name should be unique']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
      	}
      	
      	else{
		$city = new Cities([
			'name' => $request->input('name'),
		]);

		$city->save();

		Session::flash('alert-class', 'success'); 
		flash('City Created', '')->overlay();

		$roles = User_roles::where('description','!=','Employee')->get();
      	$deps = Departments::all();
      	$users = Users::find(Auth::user()->id);
      	$transfer = Transfer_Requests::all();
      	$city = Cities::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
             return redirect('show_cities');
             //return view('superadmin.cities')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('city',$city)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
                       return redirect('show_cities');

            // return view('superadmin.cities')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('city',$city)->with('user_dept', $depts)->with('graduate',$graduate);
        }
	  }
	}

  public function deletecity(Request $request)
  {
    
    $city = Cities::where('id',$request->input('cityid'))->update(['flag' => 'deleted']);

    Session::flash('alert-class', 'danger'); 
    flash('City Deleted', '')->overlay();

    return back();
  }

  public function updatecity(Request $request)
  {
      $list = Cities::where('id',$request->input('cityid'))->update(['name' => $request->input('cityname')]);

      Session::flash('alert-class', 'success');
      flash('City Updated', '')->overlay();

      return back();
  }

  public function activatecity(Request $request)
  {
    
    $city = Cities::where('id',$request->input('cityid'))->update(['flag' => NULL]);

    Session::flash('alert-class', 'success'); 
    flash('City Activated', '')->overlay();

    return back();
  }

  public function add_a_status()
  {
        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.addstatus')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addstatus')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        }
  }

  public function addstatus(Request $request)
  {

    $validation = $this->validate($request,[
      'name' => 'required|unique:civil__statuses',
    ]);

      if(!$validation){
        $errors = new MessageBag(['name' => ['Civil Status name should be unique']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
        
        else{
    $city = new Civil_Status([
      'name' => $request->input('name'),
    ]);

    $city->save();

    Session::flash('alert-class', 'success'); 
    flash('Status Created', '')->overlay();

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $status = Civil_Status::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
                      $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){

          return redirect('show_civilstat');
             //return view('superadmin.civilstat')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('status',$status)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
                  return redirect('show_civilstat');

            // return view('superadmin.civilstat')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('status',$status)->with('user_dept', $depts)->with('graduate',$graduate);
        }
    }
  }

  public function deletestatus(Request $request)
  {
    
    $stat = Civil_Status::where('id',$request->input('statid'))->update(['flag' => 'deleted']);

    Session::flash('alert-class', 'danger'); 
    flash('Status Deleted', '')->overlay();

    return back();
  }

  public function updatestatus(Request $request)
  {
      $list = Civil_Status::where('id',$request->input('statid'))->update(['name' => $request->input('statname')]);

      Session::flash('alert-class', 'success');
      flash('Status Updated', '')->overlay();

      return back();
  }

  public function activatestatus(Request $request)
  {
    
    $stat = Civil_Status::where('id',$request->input('statid'))->update(['flag' => NULL]);

    Session::flash('alert-class', 'success'); 
    flash('Status Activated', '')->overlay();

    return back();
  }

  public function add_a_gender()
  {
        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
          return view('superadmin.addgender')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addgender')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        }
  }

  public function addgender(Request $request)
  {

    $validation = $this->validate($request,[
      'name' => 'required|unique:genders',
    ]);

      if(!$validation){
        $errors = new MessageBag(['name' => ['Gender name should be unique']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
        
        else{
    $gender = new Gender([
      'name' => $request->input('name'),
    ]);

    $gender->save();

    Session::flash('alert-class', 'success'); 
    flash('Gender Created', '')->overlay();

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $gender = Gender::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();



        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
                       return redirect('show_gender');

             //return view('superadmin.gender')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('gender',$gender)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
                      return redirect('show_gender');

            // return view('superadmin.gender')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('gender',$gender)->with('user_dept', $depts)->with('graduate',$graduate);
        }
    }
  }

  public function deletegender(Request $request)
  {
    
    $stat = Gender::where('id',$request->input('gendid'))->update(['flag' => 'deleted']);

    Session::flash('alert-class', 'danger'); 
    flash('Gender Deleted', '')->overlay();

    return back();
  }

  public function updategender(Request $request)
  {
      $list = Gender::where('id',$request->input('gendid'))->update(['name' => $request->input('gendname')]);

      Session::flash('alert-class', 'success');
      flash('Gender Updated', '')->overlay();

      return back();
  }

  public function activategender(Request $request)
  {
    
    $stat = Gender::where('id',$request->input('gendid'))->update(['flag' => NULL]);

    Session::flash('alert-class', 'success'); 
    flash('Gender Activated', '')->overlay();

    return back();
  }

  public function add_a_dabused()
  {
        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.addabused')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addabused')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        } 
  }

  public function addabused(Request $request)
  {

    $validation = $this->validate($request,[
      'name' => 'required|unique:drugs__abuseds',
    ]);

      if(!$validation){
        $errors = new MessageBag(['name' => ['Level name should be unique']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
        
        else{
    $dab = new Drugs_Abused([
      'name' => $request->input('name'),
    ]);

    $dab->save();

    Session::flash('alert-class', 'success'); 
    flash('Level Created', '')->overlay();

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $dab = Drugs_Abused::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){

          return redirect('show_dabused');
          //   return view('superadmin.dabused')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('dab',$dab)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
                    return redirect('show_dabused');

           //  return view('superadmin.dabused')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('dab',$dab)->with('user_dept', $depts)->with('graduate',$graduate);
        }
    }
  }

  public function deletedabused(Request $request)
  {
    
    $stat = Drugs_Abused::where('id',$request->input('dabid'))->update(['flag' => 'deleted']);

    Session::flash('alert-class', 'danger'); 
    flash('Level Deleted', '')->overlay();

    return back();
  }

  public function updatedabused(Request $request)
  {
      $list = Drugs_Abused::where('id',$request->input('dabid'))->update(['name' => $request->input('dabname')]);

      Session::flash('alert-class', 'success');
      flash('Level Updated', '')->overlay();

      return back();
  }

  public function activatedabused(Request $request)
  {
    
    $stat = Drugs_Abused::where('id',$request->input('dabid'))->update(['flag' => NULL]);

    Session::flash('alert-class', 'success'); 
    flash('Level Activated', '')->overlay();

    return back();
  }

  public function add_a_eduatain()
  {
        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.addeduatain')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addeduatain')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        } 
  }

  public function addeduatain(Request $request)
  {

    $validation = $this->validate($request,[
      'name' => 'required|unique:educational__attainments',
    ]);

      if(!$validation){
        $errors = new MessageBag(['name' => ['Attainment name should be unique']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
        
        else{
    $dab = new Educational_Attainment([
      'name' => $request->input('name'),
    ]);

    $dab->save();

    Session::flash('alert-class', 'success'); 
    flash('Attainment Created', '')->overlay();

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $eduatain = Educational_Attainment::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
              return redirect('show_eduatain');
             //return view('superadmin.eduatain')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('eduatain',$eduatain)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
                           return redirect('show_eduatain');

             //return view('superadmin.eduatain')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('eduatain',$eduatain)->with('user_dept', $depts)->with('graduate',$graduate);
        }
    }
  }

  public function deleteeduatain(Request $request)
  {
    
    $stat = Educational_Attainment::where('id',$request->input('eduid'))->update(['flag' => 'deleted']);

    Session::flash('alert-class', 'danger'); 
    flash('Attainment Deleted', '')->overlay();

    return back();
  }

  public function updateeduatain(Request $request)
  {
      $list = Educational_Attainment::where('id',$request->input('eduid'))->update(['name' => $request->input('eduname')]);

      Session::flash('alert-class', 'success');
      flash('Attainment Updated', '')->overlay();

      return back();
  }

  public function activateeduatain(Request $request)
  {
    
    $stat = Educational_Attainment::where('id',$request->input('eduid'))->update(['flag' => NULL]);

    Session::flash('alert-class', 'success'); 
    flash('Attainment Activated', '')->overlay();

    return back();
  }

  public function add_a_estat()
  {
        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.addestat')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addestat')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        } 
  }

  public function addestat(Request $request)
  {

    $validation = $this->validate($request,[
      'name' => 'required|unique:employment__statuses',
    ]);

      if(!$validation){
        $errors = new MessageBag(['name' => ['Status name should be unique']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
        
        else{
    $dab = new Employment_Status([
      'name' => $request->input('name'),
    ]);

    $dab->save();

    Session::flash('alert-class', 'success'); 
    flash('Status Created', '')->overlay();

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $estat = Employment_Status::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){

          return redirect('show_estat');
            // return view('superadmin.estat')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('estat',$estat)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){

          return redirect('show_estat');
          //  return view('superadmin.estat')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('estat',$estat)->with('user_dept', $depts)->with('graduate',$graduate);
        }
    }
  }

  public function deleteestat(Request $request)
  {
    
    $stat = Employment_Status::where('id',$request->input('emstatid'))->update(['flag' => 'deleted']);

    Session::flash('alert-class', 'danger'); 
    flash('Status Deleted', '')->overlay();

    return back();
  }

  public function updateestat(Request $request)
  {
      $list = Employment_Status::where('id',$request->input('emstatid'))->update(['name' => $request->input('emstatname')]);

      Session::flash('alert-class', 'success');
      flash('Status Updated', '')->overlay();

      return back();
  }

  public function activateestat(Request $request)
  {
    
    $stat = Employment_Status::where('id',$request->input('emstatid'))->update(['flag' => NULL]);

    Session::flash('alert-class', 'success'); 
    flash('Status Activated', '')->overlay();

    return back();
  }
    

  public function add_a_city_jail()
  {
    $roles = User_roles::where('description','!=','Employee')->get();
    $deps = Departments::all();
    $users = Users::find(Auth::user()->id);
    $transfer = Transfer_Requests::all();
    $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
          $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.addcityjail')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addcityjail')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
      }
  }

  public function addjail(Request $request)
  {

    $jail_id = rand();

    $validation = $this->validate($request,[
      'name' => 'required|unique:city__jails',
    ]);

      if(!$validation){
        $errors = new MessageBag(['name' => ['City Jail name should be unique']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
        
        else{
    $jail = new City_Jails([
      'jail_id' => $jail_id,
      'name' => $request->input('name'),
    ]);

    $jail->save();

    Session::flash('alert-class', 'success'); 
    flash('Jail Created', '')->overlay();

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $jails = City_Jails::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
             return redirect('show_jails');
             //return view('superadmin.jails')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('jails',$jails)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
             return redirect('show_jails');
             //return view('superadmin.jails')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('jails',$jails)->with('user_dept', $depts)->with('graduate',$graduate);
        }
    }
  }

   public function deletejail(Request $request)
   {
      $city = City_Jails::where('id',$request->input('jailid'))->update(['flag' => 'deleted']);

      Session::flash('alert-class', 'danger');
      flash('Jail Deleted', '')->overlay();

      return back();
    }

  public function updatejail(Request $request)
  {
      $list = City_Jails::where('id',$request->input('jailid'))->update(['name' => $request->input('jailname')]);

      Session::flash('alert-class', 'success');
      flash('Jail Updated', '')->overlay();

      return back();
  }

    public function activatejail(Request $request)
    {
      $city = City_Jails::where('id',$request->input('jailid'))->update(['flag' => NULL]);

      Session::flash('alert-class', 'success');
      flash('Jail Activated', '')->overlay();

      return back();
    }

    public function add_a_checklist()
  {
    $roles = User_roles::where('description','!=','Employee')->get();
    $deps = Departments::all();
    $users = Users::find(Auth::user()->id);
    $transfer = Transfer_Requests::all();
    $list = Checklist::where(function ($list) {
      $list->where('parent','=',0)
           ->orWhere('has_sublist','=',1);
    })->get();
    $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
          $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.addchecklist')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('list',$list)->with('user_dept', $depts)->with('graduate',$graduate);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addchecklist')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('list',$list)->with('user_dept', $depts)->with('graduate',$graduate);
      }
  }

    public function addchecklist(Request $request)
  {

    if($request->input('parentlist') == NULL){
      $parent = 0;
      $hassublist = 0;
    }
    else{
      $parent = $request->input('parentlist');
      $hassublist = $request->input('slist');
    }

      $list = new Checklist([
        'parent' => $parent,
        'name' => $request->input('name'),
        'has_sublist' => $hassublist
      ]);

        $list->save();

        $pats = Patients::all();

        foreach($pats as $pat)
        {
          $stat = new Checklist_Status([
            'checklist_id' => $list->id,
            'patient_id' => $pat->id,
            'department_id' => $pat->department_id,
            'has_files' => 0
          ]);

          $stat->save();
        }

        Session::flash('alert-class', 'success'); 
        flash('List Added', '')->overlay();

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $checklist = Checklist::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
                      $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

       if($request->input('parentlist') == NULL){
        
        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
             return redirect('/show_checklist')->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist)->with('user_dept', $depts)->with('graduate',$graduate);;
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
             return redirect('/show_checklist')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist)->with('user_dept', $depts)->with('graduate',$graduate);;
        }
      }
      else{
        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
             return redirect('/show_sub_checklist/'.$request->input('parentlist'))->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist)->with('user_dept', $depts)->with('graduate',$graduate);;
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
             return redirect('/show_sub_checklist/'.$request->input('parentlist'))->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist)->with('user_dept', $depts)->with('graduate',$graduate);
        }
      }
  }

   public function deletechecklist(Request $request)
    {
      $list = Checklist::where('id',$request->input('listid'))->update(['flag' => 'deleted']);
      $sublist = Checklist::where('parent',$request->input('listid'))->update(['flag' => 'deleted']);

      Session::flash('alert-class', 'danger');
      flash('List Deleted', '')->overlay();

      return back();
    }

     public function updatechecklist(Request $request)
    {
      $list = Checklist::where('id',$request->input('listid'))->update(['name' => $request->input('listname')]);

      Session::flash('alert-class', 'success');
      flash('List Updated', '')->overlay();

      return back();
    }


    public function activatechecklist(Request $request)
    {
      $city = Checklist::where('id',$request->input('listid'))->update(['flag' => NULL]);
      $sublist = Checklist::where('parent',$request->input('listid'))->update(['flag' => NULL]);

      Session::flash('alert-class', 'success');
      flash('List Activated', '')->overlay();

      return back();
    }


  public function add_a_casetype()
	 {
		    $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }


        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.addcasetype')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addcasetype')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        }
	 }


	public function add_casetype(Request $request)
	{

		$validation = $this->validate($request,[
			'case_name' => 'required|unique:case__types',
		]);

     	if(!$validation){
        $errors = new MessageBag(['case_name' => ['Case name should be unique']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
      	}
      	
      	else{

		$case = new Case_Type([
			'case_name' => $request->input('case_name'),
			'court_order' => $request->input('court'),
		]);

		$case->save();

    $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Case Type Created',
            'action' => 'Created Case Type '.$case->case_name,
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

		Session::flash('alert-class', 'success'); 
		flash('Case Type Created', '')->overlay();

		$roles = User_roles::where('description','!=','Employee')->get();
      	$deps = Departments::all();
      	$users = Users::find(Auth::user()->id);
      	$transfer = Transfer_Requests::all();
      	$case = Case_Type::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
              $graduate = Graduate_Requests::all();


        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){

          return redirect('show_case_types');
            // return view('superadmin.casetypes')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('case',$case)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
           return redirect('show_case_types');
          //   return view('superadmin.casetypes')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('case',$case)->with('user_dept', $depts)->with('graduate',$graduate);
        }
	  }
	}

	public function delete_case(Request $request)
  {
    	$case = Case_Type::where('id',$request->input('caseid'))->update(['flag' => 'deleted']);


    	Session::flash('alert-class', 'danger'); 
		  flash('Case Type Deleted', '')->overlay();

		  return back();
  }

  public function update_case(Request $request)
  {
      $list = Case_Type::where('id',$request->input('caseid'))->update(['case_name' => $request->input('casename')]);

      $list = Case_Type::where('id',$request->input('caseid'))->update(['court_order' => $request->input('court')]);

      Session::flash('alert-class', 'success');
      flash('Case Updated', '')->overlay();

      return back();
  }

  public function activate_case(Request $request)
  {
      $case = Case_Type::where('id',$request->input('caseid'))->update(['flag' => NULL]);


      Session::flash('alert-class', 'success'); 
      flash('Case Type Activated', '')->overlay();

      return back();
    }

    public function add_a_reason()
   {
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
            return view('superadmin.addreason')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addreason')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
   }

   public function add_reason(Request $request)
  {

    $validation = $this->validate($request,[
        'reason' => 'required|unique:dismissal__reasons'
    ]);

      if(!$validation){
          $errors = new MessageBag(['reason' => ['Reason already exist']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
        
        else{
          
      $reason = new Dismissal_Reason([
          'reason' => $request->input('reason'),
          ]);

      $reason->save();

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Dismissal Reason Created',
            'action' => 'Created Dismissal Reason '.$reason->reason,
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();


    Session::flash('alert-class', 'success'); 
    flash('Created', '')->overlay();

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();
        $reasons = Dismissal_Reason::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
             return redirect('show_dismiss_reason');
             //return view('superadmin.reasons')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('gradute',$graduate)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
                          return redirect('show_dismiss_reason');
             //return view('superadmin.reasons')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('user_dept', $depts);
        }
    }
  }

  public function deletereason(Request $request)
  {
      $reason = Dismissal_Reason::where('id',$request->input('reasonid'))->update(['flag' => 'deleted']);


      Session::flash('alert-class', 'danger'); 
      flash('Deleted Reason')->overlay();

      return back();
  }

  public function updatereason(Request $request)
  {
      $list = Dismissal_Reason::where('id',$request->input('reasid'))->update(['reason' => $request->input('reasname')]);

      Session::flash('alert-class', 'success');
      flash('Reason Updated', '')->overlay();

      return back();
  }

   public function activatereason(Request $request)
  {
      $reason = Dismissal_Reason::where('id',$request->input('reasonid'))->update(['flag' => NULL]);

      Session::flash('alert-class', 'success'); 
      flash('Activated Reason')->overlay();

      return back();
  }

}
