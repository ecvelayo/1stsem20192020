<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Response;
use Auth;
use DB;
use Calendar;
use App\Users;
use App\User_roles;
use App\User_departments;
use App\Departments;
use App\Events;
use App\Patients;
use App\Refers;
use App\ProgressNotes;
use App\DentalNotes;
use App\Services;
use App\Bmi_records;
use App\Blood_sugar_records;
use App\Medical_records;
use Hash;
use Session;

class ReferController extends Controller
{
    public function createRefer(Request $request)
    {


         $refer = Refers::create($request->all());
         return Response::json($refer);

    }

    public function deletePatient(Request $request)
    {

        $newStat = $request->inactive;
        $remarks = $request->remarks;
        $patient = $request->patient_id;

        if($newStat != 1){

              $stat = 1;
        }else{

              $stat = 0;
        }


        $id = Patients::find($patient);


        $id->update(array('inactive' => $stat, 'remarks' => $remarks));

          if($id->inactive == 1){
              Session::flash('alert-class', 'danger');
              flash('Patient Inactive', '')->overlay();
          }else{

            Session::flash('alert-class', 'success');
              flash('Patient  Activated', '')->overlay();
          }

          return Redirect::back();

    }

    public function addsocialworkernotes(Request $request)
    {


         $socialworker = ProgressNotes::create($request->all());

         $id = $socialworker->id;



         $progress = ProgressNotes::where('id', $id)->with('userx')->with('servicex')->get();

        
         return Response::json($progress);

    }
    public function updateRecords(Request $request, $recordType, $id){

        if($recordType == "BMIRecords"){

            $notes = Bmi_records::find($id);

          $notes->update(array('bmi' => $request->bmi, 'weight' => $request->weight, 'remarks' => $request->remarks));

        }else if($recordType == "BloodSugar"){

                      $notes = Blood_sugar_records::find($id);

                $notes->update(array('reading' => $request->reading, 'notes' => $request->notes));


        }else if($recordType == "medicalRecords"){

                        $notes = Medical_records::find($id);
                        $notes->update(array('medication' => $request->medication, 'notes' => $request->notes));


        }

          return Response::json($notes);

    }

    public function updatesocialworkernotes(Request $request,$id){

          $prognotes = ProgressNotes::find($id);

          $prognotes->update(array('notes' => $request->notes, 'service_id' => $request->service_id));

          $progress = ProgressNotes::where('id', $prognotes->id)->with('userx')->with('servicex')->get();

           return Response::json($progress);


    }

    public function findNotes(Request $request, $id)
    {


         $notes = ProgressNotes::where('id', $id)->first();


        
         return Response::json($notes);

    }

    public function updateDentalNotes(Request $request, $id){


      $notes = ProgressNotes::where('id', $id)->first();

      $notes->update(array('notes' => $request->notes, 'diagnose' => $request->diagnose, 'tooth_no' => $request->tooth_no, 'service_rendered' => $request->service_rendered));


       return Response::json($notes);
 

    }

    // public function findNotes(Request $request, $id)
    // {


    //      $notes = ProgressNotes::where('id', $id)->first();
        
    //      return Response::json($notes);

    // }

     public function addRecords(Request $request, $recordType)
    {



        if($recordType == "BMIRecords"){

            $record = Bmi_records::create($request->all());

            $id = $record->id;



          $progress = Bmi_records::where('id', $id)->with('patientx')->with('userxe')->get();

        }else if($recordType == "BloodSugar"){

            $record = Blood_sugar_records::create($request->all());

            $id = $record->id;



          $progress = Blood_sugar_records::where('id', $id)->with('patientx')->with('userxe')->get();

        }else{

               $record = Medical_records::create($request->all());

            $id = $record->id;



          $progress = Medical_records::where('id', $id)->with('patientx')->with('userxe')->get();


        }

    
        
         return Response::json($progress);

    }

    public function getRecords(Request $request, $recordType){

      $id = $request->noteId;


      if($recordType == "mediRecords"){

           $progress = Medical_records::where('id', $id)->with('patientx')->with('userxe')->get();

      }else if($recordType == "bloodSugar"){


          $progress = Blood_sugar_records::where('id', $id)->with('patientx')->with('userxe')->get();



      }else if($recordType == "BMIRecords"){


          $progress = Bmi_records::where('id', $id)->with('patientx')->with('userxe')->get();

        }


         return Response::json($progress);

      
    }

 public function addDentalNotes(Request $request)
    {


         $dentalnotes = DentalNotes::create($request->all());

         $id = $dentalnotes->id;


          $dental = DentalNotes::where('id', $id)->with('userxk')->get();

         return Response::json($dental);

    }




    public function getRefer($id) {
   

           // $data = Refers::find($id);

           $data = Refers::where('id', $id)->with('patients')->with('users')->get();

            foreach($data as $adds)
            {

            $user_data = $adds->id;

            }

            //$vals = json_encode($data);


            return Response::json($data);

    }

    function putRefer(Request $request, $id) {

        $ref_date =  $request->ref_date;
        $patient_id = $request->patient_id;
        $ref_at = $request->ref_at;
        $ref_reason = $request->ref_reason;
        $ref_by = $request->ref_by;
        $contact_person = $request->contact_person;
        $recommen = $request->recommen;
        $ref_back = $request->ref_back_date;
        $ref_back_by = $request->ref_back_by;
        $accepted_by = $request->accepted_by;
        $ref_slip     = $request->ref_slip_return;

        $id = Refers::find($id);

        $id->ref_date = $ref_date ? $ref_date : $id->ref_date;
        $id->patient_id = $patient_id ? $patient_id : $id->patient_id;
        $id->ref_at = $ref_at ? $ref_at : $id->ref_at;
        $id->ref_reason = $ref_reason ? $ref_reason : $id->ref_reason;
        $id->ref_by = $ref_by ? $ref_by :  $id->ref_by;
        $id->contact_person = $contact_person ? $contact_person  : $id->contact_person;
        $id->recommen = $recommen ? $recommen : $id->recommen;
        $id->ref_back_date = $ref_back ? $ref_back : $id->ref_back_date;
        $id->ref_back_by = $ref_back_by ? $ref_back_by : $id->ref_back_by;
        $id->accepted_by = $accepted_by ? $accepted_by : $id->accepted_by;
        $id->ref_slip_return = $ref_slip  ? $ref_slip  : $id->ref_slip_return;

        $id->save();
        return Response::json($id);


    }

    function putInactiveActive(Request $request, $id){

        $newStat = $request->inactive;
        $remarks = $request->remarks;

      //  dd($id);


        $id = Patients::find($id);

    /*    $id->fill([
            'inactive' => 
           
        ]);*/

        $id->update(array('inactive' => $newStat, 'remarks' => $remarks));

        //$id->save();


        return Response::json($id);

    }
          

}
        