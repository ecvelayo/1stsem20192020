<?php


namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use App\User;
use App\Project;
use Illuminate\Http\Request;

class ReportsController extends \App\Http\Controllers\Adviser\ReportsController
{
    protected function prepareData(Request $request)
    {
        $projects = collect();
        if ($adviserId = $request->input('adviser', null)) {
            $projects = User::query()->find($adviserId)
                            ->handledProjects()
                            ->whereNotNull('date_submitted')
                            ->where('project_status', '=', 'approved')
                            ->get();
        } else {
            $projects = Project::whereNotNull('date_submitted')
                            ->where('project_status', '=', 'approved')
                            ->get();
        }

        return $this->formatData($projects, $request);
    }

    
}