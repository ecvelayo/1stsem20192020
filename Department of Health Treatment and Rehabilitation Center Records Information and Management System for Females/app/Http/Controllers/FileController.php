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
use App\Users;
use App\User_roles;
use App\Departments;
use App\Patients;
use App\Transfer_Requests;
use App\Graduate_Requests;
use Notifications;
use Carbon\Carbon;
use App\Charts\PatientChart;
use Hash;
use Session;

class FileController extends Controller
{
    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function fileUpload()

    {

   	  $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $userss = Patients::where('department_id', Auth::user()->department)->get();

    	return view('fileUpload')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);

    }

 

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function fileUploadPost(Request $request)

    {

        $request->validate([

            'file' => 'required',

		]);

 

        $fileName = time().'.'.request()->file->getClientOriginalExtension();

 

        request()->file->move(public_path('files'), $fileName);

 

        return response()->json(['success'=>'You have successfully upload file.']);

    }
}
