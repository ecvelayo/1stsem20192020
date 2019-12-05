<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Calendar;
use App\Users;
use App\User_roles;
use App\User_departments;
use App\Departments;
use App\Events;
use App\Patients;
use App\Interventions;
use App\Patient_Event_List;
use App\Transfer_Requests;
use App\Graduate_Requests;
use Notifications;
use App\Charts\PatientChart;
use App\EventAssignee;
use App\ChildInterventions;
use Carbon\Carbon;
use Hash;
use Charts;
use Session;

class CalendarController extends Controller
{
   public function showCalen()
   {


       $roles = User_roles::where('description','!=','Employee')->get();
       $deps = Departments::all();
       $graduate = Graduate_Requests::all();
       $dentist = User_roles::where('name', 'Dentist')->get();
       $psychiatrist = User_roles::where('name', 'Physciatrist')->get();
       $users = Users::find(Auth::user()->id);
       $transfer = Transfer_Requests::all();
       $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

      if(Auth::user()->designation != $dentist[0]->id && Auth::user()->designation != $psychiatrist[0]->id){

       return view('calendar.viewCalendar')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('graduate',$graduate)->with('transfer',$transfer);
      }else{

          return view('calendar.viewCalendarDentist')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('graduate',$graduate)->with('transfer',$transfer);
      }

   }

   public function get_Events()
   {
          $events = Events::all()->toArray();

          return response()->json($events);

   }

    public function event_patient($id)
   {
          $events = Patients::where('department_id', $id)->where('status','Enrolled')->get();

          return response()->json($events);

   }

  
   public function create_event(Request $request, $date){


       $roles = User_roles::where('description','!=','Employee')->get();
       $deps = Departments::all();
       $transfer = Transfer_Requests::all();
       $interven = Interventions::all();
       $users = Users::find(Auth::user()->id);
       $graduate = Graduate_Requests::all();
       $assignee  = Users::with('user_roles')->get();
       $dep = $users->department;
       $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }


        

          $patients = Patients::where('department_id', $dep)->with('departments')->get();



       if($dep == 2 || $dep == 3){

              $patients = Patients::where('department_id','=',2)->orWhere('department_id', '=' , 3)->with('departments')->get();

            
        }else if(!$dep){

                 $patients = Patients::all();

        }

       return view('calendar.createEvent')->with('roles',$roles)->with('deps',$deps)->with('interven', $interven)->with('patients', $patients)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('date', $date)->with('assignee', $assignee)->with('user_dept', $depts);
     
      
    }

    public function add_event(Request $request){


       $validation = $this->validate($request, [
              'title' => 'required',
              'venue' => 'required',
        'start_time' => 'date_format:H:i',
        'end_time' => 'date_format:H:i|after:start_time',
          ]);

        if(!$validation){
          
        $errors = new MessageBag(['start_time' => ['End Time should be later than start time']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
        

        }else{


        $evt = rand();
        $input = $request->all();
        $graduate = Graduate_Requests::all();

        $depts = $request->input('department');


       if($depts == 1){

            $color = '#32CD32';
        }else if($depts == 2){

            $color = '#428bca';
        }else if($depts == 3){

            $color = '#5bc0de';

        }else{

          $color = '#f0ad4e';
        }

       $assignee = $request->input('nameid');

        $patients = $request->input('checkitem');

        $date =  $request->input('start_date');



        $event = new Events([
        'evt_id' => $evt,
        'title' => $request->input('title'),
        'venue' => $request->input('venue'),
        'description' => $request->input('description'),
        'department_id' => $depts,
        'start' => $request->input('start_date')." ".date("H:m:s", strtotime($request->input('start_time'))),
        'end' => $request->input('start_date')." ".date("H:m:s", strtotime($request->input('end_time'))),
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('start_date'),
        'start_time' => $request->input('start_time'),
        'end_time' => $request->input('end_time'),
        'status' => 0,
        'color' => $color

        ]);


      $event->save();

      $eventz = Events::where('evt_id',$evt)->get();

      foreach ($eventz as $ev) 
      {
        $eventid = $ev->id;
      }

        if($request->input('checkitem')){
        foreach($request->input('checkitem') as $pat)
        {


            $patient_event = new Patient_Event_List([

                'date' => $date,
                'event_id' =>  $eventid,
                'patient_id' => $pat,
                'status' => 0

            ]);
            $patient_event->save();
        }
      }


        if($request->input('nameid')){
        foreach($request->input('nameid') as $assinee) {

              $event_assignee = new EventAssignee([

                'event_id' =>  $eventid,
                'assignee_id' => $assinee

            ]);

            $event_assignee->save();


        }
      }

      Session::flash('alert-class', 'success'); 
      flash('Schedule Created', '')->overlay();

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $transfer = Transfer_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }
 

        $users = Users::find(Auth::user()->id);

        return redirect('/showCalendar');

      }

        //view('superadmin.chooseuser')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('graduate',$graduate)->with('transfer',$transfer)->with('user_dept', $depts);

    }

    public function viewevent($id)
    {
       $pid = 0;
        date_default_timezone_set('Asia/Macau');
        $evt = Events::find($id);
        $evts = Events::where('id', $id)->with('Departments')->get();
        $event_assignee = EventAssignee::where('event_id', $id)->with('assignee')->get();
        $users_assignee = EventAssignee::where('event_id', $id)->pluck('assignee_id')->toArray();

        $graduate = Graduate_Requests::all();
        $assignee  = Users::with('user_roles')->get();

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $interven = Interventions::where('department_id', $evt->department_id)->where(function ($query) {
        $query->where('inactive', '!=', 1)
            ->orWhereNull('inactive');
        })->get();



        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

        $childInterven = ChildInterventions::all();

        $users = Users::find(Auth::user()->id);

        $userSome = Users::all();

        $transfer = Transfer_Requests::all();

        $evt_id = $evt->id;
        $dept = $evt->department_id;

        $event_patient = Patient_Event_List::where('event_id', $evt_id)->with('events')->with('patients')->get();
        $eventPatientIds = array_map(function($p) { return $p['patient_id']; }, $event_patient->toArray());

        $start = Carbon::parse($evt->start_date);
        $end = Carbon::parse($evt->end_date);

        $isEventExpired = false;
        $isEventCancelled = false;
        $isPatientRemove = false;

        $mytime = Carbon::today()->timezone('Asia/Macau');

        $date = date('y-m-d');  



        if($mytime->lte($end) && $mytime->gte($start) && ($evt->status != 2) ){
            $isEventExpired = true;

        }

        if($mytime->lte($start) && ($evt->status != 2) ){

           $isEventCancelled = true;

        }
        if($mytime->lte($end) && ($evt->status != 2)){

           $isPatientRemove = true;
                 

        }

        $patients = Patients::where('department_id', $dept)->where('status','Enrolled')->whereNotIn('id', $eventPatientIds)->with('departments')->get();

       // if($dept == 2 || $dept == 3){

       //        $patients = Patients::whereNotIn('id', $eventPatientIds)->whereIn('department_id',[2,3])->get();

            
       //  }else if(!$dept){

       //      $patients = Patients::whereNotIn('id', $eventPatientIds)->get();

       //  }



        return view('calendar.viewEvent')->with('roles' , $roles)->with('deps',$deps)->with('evts' ,$evts)->with('users',$users)->with('pats', $event_patient)->with('intv', $interven)->with('transfer',$transfer)->with('isEventExpired', $isEventExpired)->with('isEventCancelled', $isEventCancelled)->with('graduate',$graduate)->with('isPatientRemove', $isPatientRemove)->with('patients', $patients)->with('childIntervens', $childInterven)->with('assignee',  $assignee)->with('evt', $evt)->with('users_assignee', $users_assignee)->with('userSome', $userSome);


    }


    public function updateEvent($id){

        $evt = Events::find($id);
       $graduate = Graduate_Requests::all();

        $evt_id = $evt->id;


        $updatedetails = array(

            'status' => 2,
            'color'  => '#d9534f'
        );
        $evt->update($updatedetails);

        $evt->status = 2;
        $evt->save();

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $interven = Interventions::all();
        $evts = Events::where('id', $id)->with('Departments')->get();
        $transfer = Transfer_Requests::all();
        $event_patient = Patient_Event_List::where('event_id', $evt_id)->with('events')->with('patients')->get();
        $assignee = EventAssignee::where('event_id', $id)->with('assignee')->get();
        // $patients = Patients::where('department_id', $dept)->whereNotIn('id', $eventPatientIds)->with('departments')->whereNotIn('id', $eventPatientIds)->get();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }



        $start = Carbon::parse($evt->start);
        $end = Carbon::parse($evt->end);

        $isEventExpired = false;
        $isEventCancelled = false;
        $isPatientRemove = false;

        $mytime = Carbon::today();


        if($mytime->lte($end) && $mytime->gte($start) && ($evt->status != 2) ){
            $isEventExpired = true;

        }

        if($mytime->lte($start) && ($evt->status != 2) ){

           $isEventCancelled = true;

        }
        if($mytime->lte($end) && ($evt->status != 2)){

           $isPatientRemove = true;

        }
      
        $users = Users::find(Auth::user()->id);

        return redirect('view_event/'.$id);


    }

    public function getcount_Deps2()
   {
          $deps = Patients::where('department_id',2)->where('status','Enrolled')->get();

          $depz = count($deps);

          return response()->json($depz);

   }

    public function getcount_Deps3()
   {
          $deps = Patients::where('department_id',3)->where('status','Enrolled')->get();

          $depz = count($deps);

          return response()->json($depz);

   }


   public function get_Deps1()
   {
          $deps = Departments::all()->pluck('department_name')->toArray();

          return response()->json($deps);

   }

   public function getcount_Deps1()
   {
          $deps = Patients::where('department_id',1)->where('status','Enrolled')->get();

          $depz = count($deps);

          return response()->json($depz);

   }


  public function chart()
    {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $userss = Patients::where('department_id', Auth::user()->department)->get();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      date_default_timezone_set('Asia/Singapore');

      $patients1 = Patients::where('status','Graduated')->whereRaw('DATE(updated_at) = CURRENT_DATE')->get();

      $pat = count($patients1);

      $patients2 = Patients::where('status','Dismissed')->whereRaw('DATE(updated_at) = CURRENT_DATE')->get();

      $patz = count($patients2);

      $patients3 = Patients::where('status','Enrolled')->whereRaw('DATE(updated_at) = CURRENT_DATE')->get();

      $patx = count($patients3);

      $today_users = Patients::whereDate('created_at', today())->count();
      $yesterday_users = Patients::whereDate('created_at', today()->subDays(1))->count();
      $users_2_days_ago = Patients::whereDate('created_at', today()->subDays(2))->count();

      $chart = new PatientChart;
      $chart->labels(['2 days ago', 'Yesterday', 'Today']);
      $chart->dataset('My dataset', 'line', [$users_2_days_ago, $yesterday_users, $today_users]);

      return view('chart', compact('chart'))->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('pat',$pat)->with('patx',$patx)->with('patz',$patz)->with('user_dept', $depts);

    }


}
