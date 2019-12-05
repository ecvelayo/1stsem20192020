<?php

namespace App\Http\Controllers\Adviser;


use App\Http\Controllers\Controller;
use App\Project;
use App\User;
use App\ProjectPanel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Response;

class ReportsController extends Controller
{
    public function adviserReports(Request $request)
    {
        return view('reports.handled-projects', [
            'data'     => $this->prepareData($request),
            'advisers' => User::query()
                              ->select('id', 'firstname', 'lastname', 'middle_initial')
                              ->where('user_role', User::USER_TYPE_ADVISER)
                              ->get()
                              ->pluck('fullname', 'id')
        ]);
    }

    public function adminReports(Request $request)
    {
        return view('reports.handled-projects', [
            'data'     => $this->prepareData($request),
            'advisers' => User::query()
                              ->select('id', 'firstname', 'lastname', 'middle_initial')
                              ->where('user_role', User::USER_TYPE_ADVISER)
                              ->get()
                              ->pluck('fullname', 'id')
        ]);
    }

    protected function prepareData(Request $request)
    {
        $currentRole = Auth::user() ?  Auth::user()->user_role : 'admin';
        if ($request->role == 'Panel' || $request->role == '' && $currentRole == 'faculty') {
            $projects = Project::whereHas('project_panel', function($q){
                        $q->where(['panel_id' => Auth::user()->id]);
                })->whereNotNull('date_submitted')->where(['project_status' => 'approved'])->with('authors', 'panel', 'adviser', 'area', 'chair_panel')->get();
        } else if ($request->role == 'Chair Panel') {
            $projects = Project::whereNotNull('date_submitted')->where(['chair_panel_id' => Auth::user()->id, 'project_status' => 'approved'])->with('authors', 'panel', 'adviser', 'area', 'chair_panel')->get();
        } else if ($request->role == 'Panel') {
            $projects =  Project::whereHas('project_panel', function($q){
                        $q->where(['panel_id' => Auth::user()->id]);
                })->whereNotNull('date_submitted')->where(['project_status' => 'approved'])->with('authors', 'panel', 'adviser', 'area', 'chair_panel')->get();
        } else {
            /** @var Collection $projects */
            if (Auth::user()->user_role == "adviser") {
                $projects = Auth::user()->handledProjects()
                        ->whereNotNull('date_submitted')
                        ->where('project_status', '=', 'approved')
                        ->get();
            } else {
                $projects = Project::whereHas('project_panel', function($q){
                        $q->where(['panel_id' => Auth::user()->id]);
                })->whereNotNull('date_submitted')->where(['project_status' => 'approved'])->with('authors', 'panel', 'adviser', 'area', 'chair_panel')->get();
            }
            
        }
        
        return $this->formatData($projects, $request);
    }

    protected function formatData(Collection $projects, $request = null) : Collection
    {
        $data = collect();

        $currentYear = date('Y');

        $yearRange  = isset($request) && $request->from_year && $request->to_year ? range($request->from_year, $request->to_year) : range($currentYear, $currentYear - 4, -1);

        foreach ($yearRange as $year) {
            $data->put($year, [
                '1' => $projects->filter(function (Project $project) use ($year) {
                    return $project->academic_year == $year && $project->semester == 1;
                })->count(),
                '2' => $projects->filter(function (Project $project) use ($year) {
                    return $project->academic_year == $year && $project->semester == 2;
                })->count(),
                '3' => $projects->filter(function (Project $project) use ($year) {
                    return $project->academic_year == $year && $project->semester == 3;
                })->count(),
                '4' => $projects->filter(function (Project $project) use ($year) {
                    return $project->academic_year == $year && $project->semester == 4;
                })->count()
            ]);

        }

        return $data;
    }

    public function getProjectBySemester(Request $request)
    {   
        $sem = $request->semester;
        $year = $request->year;
        $adviserId = $request->adviserId;
        $role = $request->role;
        $currentRole = Auth::user()->user_role;

        $isAdviser = Auth::user()->isRole('adviser');
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

            return response()->json(['results' => $results, 'isAdviser' => $isAdviser, 'currentRole' => $currentRole]);
        }
    }
}