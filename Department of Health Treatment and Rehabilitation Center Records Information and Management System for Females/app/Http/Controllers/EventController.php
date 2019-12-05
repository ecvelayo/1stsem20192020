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
use App\Departments;
use App\Events;
use App\Patients;
use App\Interventions;
use App\Patient_Event_List;
use App\Transfer_Requests;
use App\Visit_interven;
use App\EventAssignee;

use Hash;
use Session;
use PDF;
use Carbon\Carbon;
use Response;



class EventController extends Controller
{
 
    public function getCurrentEvent($patientId) {


        $curdate = Carbon::today()->format('Y-m-d');
        $patientEvent = Patient_Event_List::where(['patient_id' => $patientId, 'date' => $curdate])->first();


        if ($patientEvent) {
            $visitIntervens = Visit_interven::where(['patient_event' => $patientEvent->id])->get();



            if ($visitIntervens) {
                return Response::json([
                    'visitIntervens' => $visitIntervens,
                    'patientEventId' => $patientEvent->id,
                    'eventId' => $patientEvent->event_id,
                    'hasEvent' => true
                ]);
            } else {

                return Response::json([
                    'patientEventId' => $patientEvent->id,
                    'eventId' => $patientEvent->event_id,
                    'hasEvent' => true
                ]);
            }
            
        } else {
            return Response::json([
                'hasEvent' => false
            ]);
        }
    }

public function getEvent($patientId) {


            $visitIntervens = Visit_interven::where(['patient_event' => $patientId])->get();


            return Response::json($visitIntervens);
        
    }


     public function event_save_edit(Request $request){
        

           $id = $request->eventId;
           $title = $request->title;
           $venue = $request->venue;
           $description = $request->description;
           $start = $request->start;
           $time = $request->time;
           $end_time = $request->end_time;
           $nameid = $request->nameid;

           $startDateTime = $start." ".date("H:m:s", strtotime($time));
           $endDateTime =  $start." ".date("H:m:s", strtotime($end_time));

         $event = Events::find($id);

        $event->update(array('title'=> $title, 'venue'=>$venue, 'description'=>$description, 'start'=>$startDateTime, 'end'=>$endDateTime, 'start_date'=> $start, 'end_date' => $start, 'start_time'=> $time, 'end_time'=>  $end_time));

        $patient = Patient_Event_List::where('event_id', $event->id)->get();

        foreach ($patient as $pats) {
        
            $patientz = Patient_Event_List::find($pats->id);

            $patientz->update(array('date'=>$start));

        }

        $assign = EventAssignee::where('event_id', $event->id)->get();

        $assignee_id = EventAssignee::where('event_id', $id)->pluck('assignee_id')->toArray();


        if($nameid){
                foreach ($request->nameid as $assignee) {

                     if(!in_array($assignee, $assignee_id)){

                            $d = new EventAssignee;
                            $d->event_id = $event->id;
                            $d->assignee_id = $assignee;

                            $d->save();

                    
                    }
                }

                foreach ($assign as $noshow) {
                    if(!in_array($noshow->assignee_id, $request->nameid)){

                        EventAssignee::where('id', $noshow->id)->delete();


                    }

                }

        }else{

            EventAssignee::where('event_id', $id)->delete();

        }

            Session::flash('success', 'Event edited');
            return back();

   }
    

    public function delete_patient_event($id){


             $patient = Patient_Event_List::destroy($id);
             return Response::json($patient);

    }

    public function view_add_patient(Request $request){

         $patient_list = Patient_Event_List::create($request->all());

         $id = $patient_list->id;


         $patient = Patient_Event_List::where('id',$id)->with('patients')->first();

         return Response::json($patient);

             
    }

    public function patient_visit_noEvent(Request $request, $pID){

        $curdate = Carbon::today()->format('Y-m-d');
        $data = $request->all();

         $patient_list = new Patient_Event_List([

                 'date' => $curdate,
                 'patient_id' => $pID,
                 'status' => 1
            ]);

         $patient_list->save();

           if($patient_list->id){

            foreach ($data as $record) {

                if ($record['isChecked']){

                 $rec = new Visit_interven;

                        $rec->patient_event = $patient_list->id;
                            $rec->patient_id = $pID;
                            $rec->interven_id = $record['interven_id'];
                            $rec->remarks = $record['remarks'];

                            if(!empty( $record['child_interven_id'])){
                            $rec->child_interven_id = $record['child_interven_id'];
                            }
                            $rec->created_by = 1;
                            $rec->save();

                }

           }
       }


            return Response::json($patient_list);



    }

    public function patient_attend_intervention(Request $request, $peID){

            $data = $request->all();
            $id = rand();
            $items = array();
            $cnt = 0;


             foreach ($data as $record) {

                if($record['isChecked']){

                    $cnt++;

                }

                
                if (!$record['isChecked'] && $record['rec_id']) {

                    $rec = Visit_interven::find($record['rec_id']);
                    $rec->delete();

                    $items[] =  $rec;


                } else {

                    if ($record['isChecked']  && (empty($record['rec_id']) ||  $record['rec_id'] == null)) {

                        $rec = new Visit_interven;

                            $rec->patient_event = $record['patient_event_id'];
                            $rec->patient_id = $record['patient_id'];
                            $rec->interven_id = $record['interven_id'];
                            $rec->event_id = $record['event_id'];
                            $rec->remarks = $record['remarks'];

                            if(!empty( $record['child_interven_id'])){
                            $rec->child_interven_id = $record['child_interven_id'];
                            }
                            $rec->created_by = 1;
                            $rec->save();


                    }else if ($record['isChecked'] && $record['rec_id']) {

                        $rec = Visit_interven::find($record['rec_id']);

                            $rec->patient_event = $record['patient_event_id'];
                            $rec->patient_id = $record['patient_id'];
                            $rec->interven_id = $record['interven_id'];
                            $rec->event_id = $record['event_id'];
                            $rec->remarks = $record['remarks'];
                            if(!empty( $record['child_interven_id'])){
                            $rec->child_interven_id = $record['child_interven_id'];
                            }
                            $rec->created_by = 1;
                            $rec->save();


                    }

                   
                }
            }

                if($cnt > 0){

                     $interven = Patient_Event_List::find($peID)->update(array('status'=> 1));


                }else{
                     $interven = Patient_Event_List::find($peID)->update(array('status'=> 0));


                }


         return Response::json($items);
        
    }

    public function view_event_attended() {


        $patient_id = isset($_GET['patient_id']) ? $_GET['patient_id'] : 0;
        $event_id = isset($_GET['event_id']) ? $_GET['event_id'] : 0;
        $eventsAttended = Visit_interven::where(['patient_id' => $patient_id, 'event_id' => $event_id])->get();

        return Response::json($eventsAttended);
    }


}