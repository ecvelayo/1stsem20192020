<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\appointment;
use App\doctor_schedule;
use App\User;
use App\user_vital_signs;
use DB;
use Auth;

class DoctorPageController extends Controller
{
    public function dashboard()
    {
        return view('pages.doctor.dashboard');
    }
    public function appointments()
    {
        
        $doctors = user::where('role_id', 3)->get();
        $patients = user::where('role_id', 2)->get();
        $schedules = doctor_schedule::all();

        return view('pages.doctor.appointment', compact('doctors', 'schedules', 'patients'));
        // return view('pages.doctor.appointment');
    }
    public function patientRecords()
    {
        $patients = appointment::join('doctor_schedules', 'doctor_schedules.doctor_schedule_id', '=', 'appointments.doctor_schedule_id')
        ->join('users', 'users.id', '=', 'appointments.patient_id')
        ->join('medical_histories', 'medical_histories.user_id', '=', 'users.id')
        ->join('user_vital_signs', 'user_vital_signs.patient_id', '=', 'users.id')        
        ->get(); 

        $users = user::all()->where('role_id', 2);

        $vitals = user_vital_signs::all();
                    
        return view('pages.doctor.patient_record', compact('patients', 'vitals', 'users'));
    }
    // public function billings()
    // {
    //     $bill = DB::table('services_availed')
    //     ->join('users as d', 'd.id', '=', 'services_availed.staff_id')
    //     ->join('users as p', 'p.id', '=', 'services_availed.patient_id')
    //     ->join('medical_services as ms', 'ms.medical_service_id', '=', 'services_availed.medical_service_id')
    //     ->select('services_availed.services_availed_id as id', 'p.first_name as Patientfname', 'p.middle_name as Patientmname', 'p.last_name as Patientlname', 'services_availed.description', 'services_availed.updated_at as date', 'status', 'ms.rate as total')
    //     ->where('d.id', '=', AUTH::user()->id)
    //     ->get();

    //     return view('pages.doctor.billing')->with('bills', $bill);
    // }

    public function settings()
    {
        $items_1 = user::getEnumValues('civil_status');
        $items_2 = user::getEnumValues('sex');
        $user = user::find(Auth::user()->id);

        return view('pages.doctor.setting', compact('user', 'items_1', 'items_2'));
    }

   
}
