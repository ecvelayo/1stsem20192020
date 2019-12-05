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
use App\Users;
use App\User_roles;
use App\User_departments;
use App\Interventions;
use App\Departments;
use App\Transfer_Requests;
use App\ChildInterventions;
use App\IntervenDept;
use App\Graduate_Requests;
use Session;
use Response;


class InterventionController extends Controller
{
   
    public function showintervention()
     {

        
        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $inter = Interventions::with('deptxs')->get();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $child = ChildInterventions::all();
        $graduate = Graduate_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }


        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('intervention.showintervention')->with('roles',$roles)->with('deps',$deps)->with('inter', $inter)->with('users',$users)->with('transfer',$transfer)->with('child', $child)->with('graduate',$graduate)->with('user_dept', $depts)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('intervention.showintervention')->with('roles',$roles)->with('deps',$deps)->with('inter', $inter)->with('users',$users)->with('transfer',$transfer)->with('child', $child)->with('graduate',$graduate)->with('user_dept', $depts)->with('user_dept', $depts);
        }
        else{
            return abort(404);
        }

    }

     public function addintervention()
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

     //   $inter = Interventions::all();

        $inter = Interventions::all();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('intervention.addIntervention')->with('roles',$roles)->with('deps',$deps)->with('inter', $inter)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('intervention.addIntervention')->with('roles',$roles)->with('deps',$deps)->with('inter', $inter)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts)->with('graduate',$graduate);
        }
        else{
            return abort(404);
        }

    }

      public function create_intervention(Request $request)
     { 

        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $inter = Interventions::all();
        $users = Users::find(Auth::user()->id);

        $child = ChildInterventions::all();

        $transfer = Transfer_Requests::all();

          $input = $request->all(); 

          // $validation = $this->validate($request,[
          //   'interven_name' => 'required|unique:intervention',
          // ]);



          if($request->input('parent') != 0){

              $interven = new ChildInterventions([
                'parent' => $request->input('parent'),
                'interven_name' => $request->input('interven_name'),
                'descrp' => $request->input('descrpt'),
                ]);

            $interven->save();

          }else{

             $interven = new Interventions([
              //  'parent' => $request->input('parent'),
                'interven_name' => $request->input('interven_name'),
                 'department_id' => $request->input('department'),
                'descrp' => $request->input('descrpt'),
                ]);

              $interven->save();
          }



      Session::flash('alert-class', 'success'); 
      flash('Intervention Created', '')->overlay();

      

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
           return redirect('showIntervention');
           //return view('intervention.addIntervention')->with('roles',$roles)->with('deps',$deps)->with('inter', $inter)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
                     return redirect('showIntervention');

           //return view('intervention.addIntervention')->with('roles',$roles)->with('deps',$deps)->with('inter', $inter)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts);
        }
   
      
    }

      public function viewIntervention($id)
     { 


        $roles = User_roles::where('description','!=','Employee')->get();
        $deps = Departments::all();
        $intersx = Interventions::find($id);
        $inter = Interventions::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

          if(Auth::user()->user_role()->first()->name == 'Superadmin'){
           return view('intervention.viewIntervention')->with('interven', $intersx)->with('roles',$roles)->with('deps',$deps)->with('inter', $inter)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
           return view('intervention.viewIntervention')->with('interven', $intersx)->with('roles',$roles)->with('deps',$deps)->with('inter', $inter)->with('users',$users)->with('transfer',$transfer)->with('user_dept', $depts);
        }
         
         
     }

     public function patientInterven(Request $request)
     {

          $input = $request->all(); 

          var_dump($input);

          exit;

     }

     public function editintervention(Request $request){

          $interven_id = $request->id;


         $intervention = Interventions::find($interven_id);


              return Response::json($intervention);


     }

     public function updateintervention(Request $request, $id){

        $interven_name = $request->interven_name;
        $descrpt = $request->descrp;
        $dept_id = $request->department_id;



         $interven = Interventions::find($id);

         $interven->update(array('interven_name' => $interven_name, 'descrp' => $descrpt, 'department_id' => $dept_id));



         $intervention = Interventions::where('id', $interven->id)->with('deptxs')->get();


         return Response::json($intervention);

     }

     public function inactiveintervention(Request $request){

            $set = $request->intervenstatus;
            $id = $request->interventionId;
            $inactive = 0;

            if($set == "Delete"){

                  $inactive = 1;
              }else{

                    $inactive =0;
                }
        $interven = Interventions::find($id);

         $interven->update(array('inactive' => $inactive));

         $intervenNAme = $interven->interven_name;

          if($inactive == 1){
              Session::flash('alert-class', 'danger');
              flash('Intervention Deleted', '')->overlay();
          }else{

            Session::flash('alert-class', 'success');
              flash('Intervetion  Activated', '')->overlay();
          }


                      return redirect('/showIntervention');
         //          return Response::json($interven);


     }
   
}