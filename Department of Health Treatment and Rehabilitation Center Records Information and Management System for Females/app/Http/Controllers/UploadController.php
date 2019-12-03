<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MyNotifications;
use Auth;
use DB;
use App\Files;
use App\User_roles;
use App\Users;
use App\User_departments;
use App\Departments;
use App\Transfer_Requests;
use App\Graduate_Requests;
use App\Patients;
use App\Checklist;
use App\Checklist_Files;
use App\Checklist_Status;
use Session;
use Carbon\Carbon;

class UploadController extends Controller
{
    public function uploadfilechecklist(Request $request)
    {
    	
    $checklist = Checklist::where('id',$request->input('checklistid'))->get();
    $pat = Patients::where('id',$request->input('patientid'))->get();
    $dep = Departments::where('id',$request->input('departmentid'))->get();

    $checkfiles = Checklist_Files::where('checklist_id',$request->input('checklistid'))->where('patient_id',$request->input('patientid'))->where('department_id',$request->input('departmentid'))->get();

    $stat = Checklist_Status::where('checklist_id',$request->input('checklistid'))->where('patient_id',$request->input('patientid'))->where('department_id',$request->input('departmentid'))->update(['has_files' => 1]);

    foreach($pat as $pats)
    foreach($dep as $deps)
    $now = Carbon::now();

        $filee = $request->file('file');

    		$extent = $filee->getClientOriginalName();
            $filename = $deps->department_name.'_'.time().'_'.$extent;
	    	$filesize = $filee->getClientSize();
	    	$filee->move(public_path('files/patients/'.$request->input('patientid').' - '.$pats->fname.' '.$pats->lname),$filename);
	    	$fileModel = new Checklist_Files;
            $fileModel->checklist_id = $request->input('checklistid');
            $fileModel->patient_id = $request->input('patientid');
            $fileModel->department_id = $request->input('departmentid');
            $fileModel->status = 'checked';
	    	$fileModel->name = $request->input('filename');
	    	$fileModel->size = $filesize;
	    	$fileModel->location = 'files/patients/'.$request->input('patientid').' - '.$pats->fname.' '.$pats->lname.'/'.$filename;
	    	$fileModel->save();    		
    	

        Session::flash('alert-class', 'success'); 
        flash('File Uploaded', '')->overlay();

        return back();
   
    		
    }

    public function deletefilechecklist(Request $request)
    {
        $list = Checklist_Files::where('id',$request->input('fileid'))->get();

        foreach($list as $lists)

        unlink(public_path($lists->location));

        $checklist = Checklist_Files::where('id',$request->input('fileid'))->delete();

        $checklistx = Checklist_Files::where('checklist_id',$lists->checklist_id)->where('department_id',$lists->department_id)->where('patient_id',$lists->patient_id)->get();

        if(count($checklistx) != 0){

           Checklist_Status::where('checklist_id',$lists->checklist_id)->where('department_id',$lists->department_id)->where('patient_id',$lists->patient_id)->update(['has_files' => 1]);
        }
        else{

           Checklist_Status::where('checklist_id',$lists->checklist_id)->where('department_id',$lists->department_id)->where('patient_id',$lists->patient_id)->update(['has_files' => 0]);
        }

        Session::flash('alert-class', 'danger'); 
        flash('File Deleted', '')->overlay();

        return back();


    }


}
