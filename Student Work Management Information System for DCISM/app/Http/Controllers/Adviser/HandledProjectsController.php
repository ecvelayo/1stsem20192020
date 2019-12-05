<?php

namespace App\Http\Controllers\Adviser;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Notifications\MyNotifications;
use Notification;


class HandledProjectsController extends Controller
{
    public function index(Request $request)
    {
        /** @var Validator $validator */
        $validator = \Validator::make($request->all(), [
            'academic_year' => 'sometimes|required|date_format:Y',
            'semester'      => 'sometimes|nullable|in:1,2',
        ]);;

        /** @var Builder $query */
        $query = Auth::user()->handledProjects()
                     ->with(['adviser', 'area', 'authors'])
                     ->latest()
                     ->when($q = trim($request->input('title')),
                         function (Builder $query) use ($q) {
                             return $query->where('title', 'like', "%{$q}%");
                         })
                    ->when(in_array($request->input('status'), ['pending', 'approved']),
                        function (Builder $query) use ($request) {
                            return $query->where('project_status', '=', $request->input('status'));
                        })
                    ->when(in_array($request->input('call_number'), ['with_call_number', 'without_call_number']),
                        function (Builder $query) use ($request) {
                            if ($request->input('call_number') == 'with_call_number') {
                                return $query->whereNotNull('call_number');
                            } else if ($request->input('call_number') == 'without_call_number') {
                                return $query->whereNull('call_number');
                            }
                            
                        });

//        if ($validator->passes()) {
//            $dates = Project::determinePeriod(
//                $request->input('academic_year', date('Y')),
//                $request->input('semester', null)
//            );
//            $query = $query->whereBetween('date_submitted', $dates);
//        }
//
        $projects = $query->paginate(5);


        return view('projects.index', [
            'projects' => $projects
        ]);
    }


    public function show(Project $project)
    {
        $project->load(['adviser', 'area', 'authors']);

        return view('projects.show', [
            'project' => $project,
        ]);
    }

    public function update(Project $project, Request $request)
     {
        $request->validate([
            'project_status' => 'required|in:rejected,approved'
        ]);

        $project->project_status = $request->input('project_status');

        $project->save();

  ///  $proj = Project::where('id', $project->id)->pluck('authors.id')->toArray();

        $projAuthor = [];

            foreach ($project->authors as $author) {

                $projAuthor[] = $author->id;
            }



        $adviser = User::where('id', $project->adviser_id)->first();
        
        $notice = User::whereIn('id', $projAuthor)->orWhere('user_role', User::USER_TYPE_ADMIN)->get();

         $users = [
            'status' => $request->input('project_status'),
            'project_id' =>  $project->id,
            'title' => $project->title,
            'adviser_id' =>  $project->adviser_id,
            'adviser_fname' => $adviser->firstname,
            'adviser_lname' => $adviser->lastname
        ];

         Notification::send($notice, new MyNotifications($users));

        return redirect()->back();
    }
}
