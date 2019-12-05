<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\role;
use App\doctor_schedule;
use App\appointment;
use App\user_vital_signs;
use App\medical_service;
use Carbon\Carbon;
use Auth;
use DB;


class NursePageController extends Controller
{
    public function dashboard()
    {
        $date = date('Y-m-d');

        $todaystaff = DB::table('appointments')
                            ->where('appointment_date', '=', Carbon::now()->format('Y-m-d'))
                            ->where('status','APPROVED')
                            ->count();

        $patientrequeststaff = DB::table('appointments')
                            // ->where('appointment_date', '=', Carbon::now()->format('Y-m-d'))
                            ->where('status','PENDING')
                            ->count();

        $patientcountstaff = DB::table('users')
                            ->where('users.role_id', '=', '2')
                            ->count();

        return view('pages.nurse.dashboard', compact('todaystaff', 'patientrequeststaff', 'patientcountstaff'));
    }

    public function appointment()
    {
        $doctors = user::where('role_id', 3)->get();
        $patients = user::where('role_id', 2)->get();
        $schedules = doctor_schedule::all();
        $medical_services = medical_service::all();

        return view('pages.nurse.appointment', compact('doctors', 'patients', 'schedules', 'medical_services'));
    }

    public function billing()
    {
        $patients = user::where('role_id', 2)->get();

        return view('pages.nurse.billing', compact('patients'));
    }

    public function results()
    {
        $patients = user::where('role_id', 2)->get();
        $services = medical_service::all();

        return view('pages.nurse.results', compact('patients', 'services'));
    }

    public function patientRecords()
    {
        $patients = user::all()->where('role_id', 2);
                    
        return view('pages.nurse.patient_record', compact('patients'));
    }

    public function settings()
    {
        $items_1 = user::getEnumValues('civil_status');
        $items_2 = user::getEnumValues('sex');
        $user = user::find(Auth::user()->id);

        return view('pages.nurse.setting', compact('user', 'items_1', 'items_2'));
    }

    public function UpdateSettings(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->username = $request->input('username');
        $data->email = $request->input('email');
        $data->contact_no = $request->input('contact_no');
        $data->first_name = $request->input('first_name');
        $data->last_name = $request->input('last_name');
        $data->middle_name = $request->input('middle_name');
        $data->sex = $request->input('sex');
        $data->birthday = $request->input('birthday');
        $data->citizenship = $request->input('citizenship');
        $data->civil_status = $request->input('civil_status');
        $data->address_line_1 = $request->input('address_line_1');
        $data->address_line_2 = $request->input('address_line_2');
        $data->save();

        toastr()->info('User Profile Updated!', 'Notification');

        return redirect()->route('pages.nurse.settings', ['name' => Auth::user()->username]);
    }
}
