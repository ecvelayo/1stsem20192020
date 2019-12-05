<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Project;
use App\MyNotifications;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Response;

class ReportController extends Controller {
	public function generatePdf(Request $request) 
	{
		$sem = $request->semester + 1;
        $year = $request->year;
        $role = $request->role;
        $adviserId = $request->adviserId;
        $isAdviser = Auth::user()->isRole('adviser');
        $currentRole = Auth::user()->user_role;

        if ($year && $sem) {
            if ($isAdviser) {
                if ($role == 'Adviser') {
                    $results = Project::whereNotNull('date_submitted')->where(['semester' => $sem, 'academic_year' => $year, 'project_status' => 'approved', 'adviser_id' => Auth::user()->id])->with('authors', 'panel', 'adviser', 'area', 'chair_panel')->get();
                } else if ($role == 'Chair Panel') {
                    $results = Project::whereNotNull('date_submitted')->where(['semester' => $sem, 'academic_year' => $year, 'project_status' => 'approved', 'chair_panel_id' => Auth::user()->id])->with('authors', 'panel', 'adviser', 'area', 'chair_panel')->get();
                } else {
                    $results = Project::whereHas('project_panel', function($q){
                        $q->where(['panel_id' => Auth::user()->id]);
                })->whereNotNull('date_submitted')->where(['semester' => $sem, 'academic_year' => $year, 'project_status' => 'approved'])->with('authors', 'panel', 'adviser', 'area', 'chair_panel')->get();
                }
            } else if (isset($adviserId)) {
                $results = Project::whereNotNull('date_submitted')->where(['semester' => $sem, 'academic_year' => $year, 'project_status' => 'approved','adviser_id' => $adviserId])->with('authors', 'panel', 'adviser', 'area', 'chair_panel')->get();
            } else if ($currentRole == 'faculty') {
                $results = Project::whereHas('project_panel', function($q){
                        $q->where(['panel_id' => Auth::user()->id]);
                    })->whereNotNull('date_submitted')->where(['semester' => $sem, 'academic_year' => $year, 'project_status' => 'approved'])->with('authors', 'panel', 'adviser', 'area', 'chair_panel')->get();
            } else {
                $results = Project::whereNotNull('date_submitted')->where(['semester' => $sem, 'academic_year' => $year, 'project_status' => 'approved'])->with('authors', 'panel', 'adviser', 'area', 'chair_panel')->get();
            }

            $semester = '';
            switch ($sem) {
                case 1:
                    $semester = '1st Semester ' . $year;
                    break;
                case 2:
                    $semester = '2nd Semester ' . $year;
                    break;
                case 3:
                    $semester = 'Summer ' . $year;
                    break;
                case 4:
                    $semester = 'Tri-sem ' . $year;
                    break;
                default:
                    break;
            }

            $data = [
				'results' => $results,
				'isAdviser' => $isAdviser,
				'role' => $role,
				'semester' => $semester,
                'currentRole' => $currentRole
			]; 

			$pdf = PDF::loadView('pdf.report', $data);
			return $pdf->stream('report.pdf');
        }

		
	}

    public function approveProject(){

             //$count = Project::where(['project_status' => 'pending', 'adviser_id' => Auth::user()->id])->count();

               $users = User::find(Auth::user()->id);

                 $count = $users->unreadNotifications->count();

                 $details = $users->unreadNotifications;
                 

            return Response::json(['count' => $count, 'details' => $details]);


    }
}
