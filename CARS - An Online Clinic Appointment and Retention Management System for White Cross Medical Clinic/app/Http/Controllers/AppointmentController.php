<?php

namespace App\Http\Controllers;

use App\Notifications\EmailNotification;
use App\Events\AppointmentStatus;
use App\Events\PatientStaff;
use Yajra\Datatables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\notification;
use App\doctor_schedule;
use App\appointment;
use App\User;
use App\medical_service;
use Response;
use Carbon\Carbon;
use Auth;

class AppointmentController extends Controller
{

    public function today()
    {
        $date = date('Y-m-d');

        $today = DB::table('appointments')
                            ->where('appointment_date', '=', Carbon::now()->format('Y-m-d'))
                            ->where('status','APPROVED')
                            ->count();

        $patientrequest = DB::table('appointments')
                            ->where('appointment_date', '=', Carbon::now()->format('Y-m-d'))
                            ->where('status','PENDING')
                            ->count();
        
        $patientcount = DB::table('users')
                            ->where('users.role_id', '=', '2')
                            ->count();
        // dd(Carbon::now()->format('Y-m-d'));

        // return view('pages.admin.dashboard', compact('today', 'patientrequest', 'patientcount'));
    }

    // staff
    public function todaystaff()
    {
        $date = date('Y-m-d');
        

        $appointments = DB::table('appointments')
                            ->where('appointment_date', '=', $date)
                            ->where('staff_id', '=',  Auth::user()->id)
                            ->where('status','APPROVED')
                            ->count();

        return $appointments;
    }

    public function patientrequeststaff(){
        $date = date('Y-m-d');

        $appointments = DB::table('appointments')
                            ->where('appointment_date', '=', $date)
                            ->where('staff_id', '=',  Auth::user()->id)
                            ->where('status','PENDING')
                            ->count();

        return $appointments;
    }


    public function patientcountstaff(){


        $appointments = DB::table('appointments')
                            ->where('staff_id', '=',  Auth::user()->id)
                            ->where('status','DONE')
                            ->count();
        return $appointments;
    }
    
    public function getPatientAppointments()
    {
        $appointments = DB::table('appointments')
            ->select(DB::raw("DATE_FORMAT(appointments.appointment_date, '%b %d, %Y') as date, concat(TIME_FORMAT(doctor_schedules.start_time, '%h:%i'), ' - ', TIME_FORMAT(doctor_schedules.end_time, '%h:%i')) as time"), DB::raw("concat('Dr. ', users.first_name, ' ', users.middle_name, ' ', users.last_name) as doctor"), 'appointments.status')
            ->join('doctor_schedules', 'doctor_schedules.doctor_schedule_id', '=', 'appointments.doctor_schedule_id')
            ->join('users', 'users.id', '=', 'doctor_schedules.doctor_id')
            ->where('patient_id', Auth::user()->id)
            ->get();
        
        return datatables()->of($appointments)
            ->addColumn('Status', function($appointment){
                
                if($appointment->status == 'APPROVED'){
                    $status = "<span class='badge badge-primary'>APPROVED</span>";
                }elseif($appointment->status == 'PENDING'){
                    $status = "<span class='badge badge-warning'>PENDING</span>";
                }elseif($appointment->status == 'CANCELLED'){
                    $status = "<span class='badge badge-primary'>CANCELLED</span>";
                }elseif($appointment->status == 'ONGOING'){
                    $status = "<span class='badge badge-secondary'>ONGOING</span>";
                }elseif($appointment->status == 'DONE'){
                    $status = "<span class='badge badge-success'>DONE</span>";
                }

                return $status;
            })
            ->rawColumns(['Status'])
            ->make(true);
    }

    public function getPatientApproved()
    {
        $appointments = DB::table('appointments')
            ->select(DB::raw("DATE_FORMAT(appointments.appointment_date, '%b %d, %Y') as date, concat(TIME_FORMAT(doctor_schedules.start_time, '%h:%i'), ' - ', TIME_FORMAT(doctor_schedules.end_time, '%h:%i')) as time"), DB::raw("concat('Dr. ', users.first_name, ' ', users.middle_name, ' ', users.last_name) as doctor"))
            ->join('doctor_schedules', 'doctor_schedules.doctor_schedule_id', '=', 'appointments.doctor_schedule_id')
            ->join('users', 'users.id', '=', 'doctor_schedules.doctor_id')
            ->where('patient_id', Auth::user()->id)
            ->where('status', 'APPROVED')
            ->get();

        return compact('appointments');
    }
    
    public function getAppointments(Request $request)
    {
        $appointments = DB::table('appointments')
            ->select('appointments.remarks', DB::raw("concat(users.first_name, ' ', users.middle_name, ' ', users.last_name) as fullname"), DB::raw("concat(TIME_FORMAT(doctor_schedules.start_time, '%h:%i %p'), ' - ', TIME_FORMAT(doctor_schedules.end_time, '%h:%i %p')) as time_schedule"), 'appointments.appointment_id', DB::raw("DATE_FORMAT(appointments.updated_at, '%h:%i %p') as last_update"))
            ->join('doctor_schedules', 'doctor_schedules.doctor_schedule_id', '=', 'appointments.doctor_schedule_id')
            ->join('users', 'users.id', '=', 'appointments.patient_id')
            ->where('doctor_schedules.doctor_id', $request->input('doctor_id'))
            ->where('appointment_date', $request->input('appointment_date'))
            ->where('status', 'PENDING')
            ->get();
        
        return datatables()->of($appointments)
            ->addColumn('Action', function($appointment){
                return "<a id='ApproveBtn' data-id=".$appointment->appointment_id." data-toggle='modal' data-target='#ApproveModal'><i class='fa fa-plus-circle text-primary pr-1' aria-hidden='true'></i></a><a id='CancelBtn' data-id=".$appointment->appointment_id." data-toggle='modal' data-target='#CancelModal'><i class='fas fa-times-circle text-danger'></i></a>";
            })
            ->rawColumns(['Action'])
            ->make(true);
    }

    public function getApprovedAppointments(Request $request)
    {                
        $appointments = DB::table('appointments')
            ->select('appointments.remarks', DB::raw("concat(users.first_name, ' ', users.middle_name, ' ', users.last_name) as fullname"), DB::raw("concat(TIME_FORMAT(doctor_schedules.start_time, '%h:%i %p'), ' - ', TIME_FORMAT(doctor_schedules.end_time, '%h:%i %p')) as time_schedule"), 'appointments.appointment_id', DB::raw("DATE_FORMAT(appointments.updated_at, '%h:%i %p') as last_update"), 'appointments.doctor_schedule_id', 'appointments.status', 'appointments.appointment_date')
            ->join('doctor_schedules', 'doctor_schedules.doctor_schedule_id', '=', 'appointments.doctor_schedule_id')
            ->join('users', 'users.id', '=', 'appointments.patient_id')
            ->where('doctor_schedules.doctor_id', $request->input('doctor_id'))
            ->where('appointment_date', $request->input('appointment_date'))
            ->whereIn('status', ['APPROVED', 'ONGOING'])
            ->get();
        
        return datatables()->of($appointments)
            ->addColumn('Action', function($appointment){
                if($appointment->status == 'APPROVED'){
                    $result = "<a id='OngoingBtn' data-id=".$appointment->appointment_id." data-toggle='modal' data-target='#OngoingModal'><i class='fas fa-arrow-alt-circle-right text-info pr-1'></i></a>";
                    $result .= "<a id='EditBtn' data-id=".$appointment->appointment_id." data-patient=".json_encode($appointment->fullname)." data-date=".$appointment->appointment_date." data-time=".$appointment->doctor_schedule_id." data-toggle='modal' data-target='#EditModal'><i class='fas fa-edit text-warning'></i></a>";
                }elseif($appointment->status == 'ONGOING'){
                    $result = "<a id='DoneBtn' data-id=".$appointment->appointment_id." data-toggle='modal' data-target='#DoneModal'><i class='fas fa-check-circle text-success pr-1' aria-hidden='true'></i></a>";
                    $result .= "<a id='EditBtn' data-id=".$appointment->appointment_id." data-patient=".json_encode($appointment->fullname)." data-date=".$appointment->appointment_date." data-time=".$appointment->doctor_schedule_id." data-toggle='modal' data-target='#EditModal'><i class='fas fa-edit text-warning'></i></a>";
                }
                
                return $result;
            })
            ->rawColumns(['Action'])
            ->make(true);
    }

    public function getDocSchedules(Request $request)
    {
        $doctor_id = $request->get('doctor_id');
        $day = Carbon::parse($request->get('appointment_date'))->isoFormat('ddd');
        
        $query = DB::table('doctor_schedules')
            ->select('doctor_schedule_id', 'start_time', 'end_time')
            ->where('doctor_id', $doctor_id)
            ->whereRaw("FIND_IN_SET('".$day."', day)");

        if ($query->exists()) {
            $result = "<option value=''disabled selected>Select appointment time</option>";

            foreach($query->get() as $row){
                $result .= "<option value='".$row->doctor_schedule_id."'>".Carbon::parse($row->start_time)->format('g:i A')." - ".Carbon::parse($row->end_time)->format('g:i A')."</option>";
            }

            if ($result == NULL) {
                $result[0] = "<option value='' disabled selected>Unavailable</option>";
            }

        } else {
            $result = "<option value='' disabled selected>Unavailable</option>";
        }

        return $result;
    }

    public function approve($id)
    {
        // $basic  = new \Nexmo\Client\Credentials\Basic('0816dbbe', 'I3kGYH92u1kdoDPe');
        // $client = new \Nexmo\Client($basic);
        $type = 'info';
        $title = 'Notification!';
        $message = 'Your appointment has been approved!';

        $appointment = appointment::find($id);
        $user = user::find($appointment->patient_id);
        $user->notify(new EmailNotification($message));
        $appointment->status = 'APPROVED';
        $appointment->staff_id = Auth::user()->id;
        $appointment->save();

        event(new AppointmentStatus($type, $title, $message, $user));
        
        $notification = new notification;
        $notification->user_id = $user->id;
        $notification->message = $message;
        $notification->save();

        // // $message = $client->message()->send([
        // //     'to' => '639171358009',
        // //     'from' => 'Nexmo',
        // //     'text' => $message
        // ]);

    }

    public function done($id)
    {
        // $basic  = new \Nexmo\Client\Credentials\Basic('0816dbbe', 'I3kGYH92u1kdoDPe');
        // $client = new \Nexmo\Client($basic);
        $type = 'success';
        $title = 'Successful!';
        $message = 'Your appointment has been completed!';

        $appointment = appointment::find($id);
        $user = user::find($appointment->patient_id);
        $user->notify(new EmailNotification($message));
        $appointment->status = 'DONE';
        $appointment->staff_id = Auth::user()->id;
        $appointment->save();

        event(new AppointmentStatus($type, $title, $message, $user));

        $notification = new notification;
        $notification->user_id = $user->id;
        $notification->message = $message;
        $notification->save();

        // $message = $client->message()->send([
        //     'to' => '639171358009',
        //     'from' => 'Nexmo',
        //     'text' => $message
        // ]);
    }

    public function ongoing($id)
    {
        // $basic  = new \Nexmo\Client\Credentials\Basic('0816dbbe', 'I3kGYH92u1kdoDPe');
        // $client = new \Nexmo\Client($basic);

        $appointment = appointment::find($id);
        $appointment_date = $appointment->appointment_date;
        $doctor_schedule_id = $appointment->doctor_schedule_id;

        $query = DB::table('appointments')
            ->where('appointment_date', $appointment_date)
            ->where('doctor_schedule_id', $doctor_schedule_id)
            ->where('status', 'ONGOING');

        if ($query->doesntExist()) {
            $user = user::find($appointment->patient_id);
            $user->notify(new EmailNotification('Your appointment is now ongoing!'));
            $appointment->status = 'ONGOING';
            $appointment->staff_id = Auth::user()->id;
            $appointment->save();

            event(new AppointmentStatus('info', 'Notification!', 'Your appointment is now ongoing!', $user));
            
            $notification = new notification;
            $notification->user_id = $user->id;
            $notification->message = 'Your appointment is now ongoing!';
            $notification->save();

            $doctor_sched = doctor_schedules::find($doctor_schedule_id);
            $doctor = user::find($doctor_sched->doctor_id);
            event(new NurseDoctor('info', 'Notification!', 'You have a new ongoing appointment!', $doctor));
        }

        // $message = $client->message()->send([
        //     'to' => '639171358009',
        //     'from' => 'Nexmo',
        //     'text' => $message
        // ]);
    }

    public function cancel(Request $request, $id)
    {
        // $basic  = new \Nexmo\Client\Credentials\Basic('0816dbbe', 'I3kGYH92u1kdoDPe');
        // $client = new \Nexmo\Client($basic);
        $type = 'warning';
        $title = 'Notification!';
        $message = 'Your appointment has been cancelled!'.' '.$request->input('message');
        
        $appointment = appointment::find($id);
        $user = user::find($appointment->patient_id);
        $user->notify(new EmailNotification($message));
        $appointment->status = 'CANCELLED';
        $appointment->staff_id = Auth::user()->id;
        $appointment->save();

        event(new AppointmentStatus($type, $title, $message, $user));
        
        $notification = new notification;
        $notification->user_id = $user->id;
        $notification->message = $message;
        $notification->save();

        // $message = $client->message()->send([
        //     'to' => '639171358009',
        //     'from' => 'Nexmo',
        //     'text' => $message
        // ]);
    }

    public function store(Request $request)
    {
        // $basic  = new \Nexmo\Client\Credentials\Basic('0816dbbe', 'I3kGYH92u1kdoDPe');
        // $client = new \Nexmo\Client($basic);

        $validator = Validator::make($request->all(), [
            'doctor_schedule_id' => 'required',
            'appointment_date' => 'required',
            'patient_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            toastr()->warning('Missing entries');
        } else {
            $query = DB::table('appointments')
                ->where('doctor_schedule_id', $request->input('doctor_schedule_id'))
                ->where('appointment_date', $request->input('appointment_date'))
                ->where('patient_id', $request->input('patient_id'))
                ->whereNotIn('status', ['DONE', 'CANCELLED']);

            if ($query->doesntExist()) {
                $data = new appointment;
                $data->appointment_date = $request->input('appointment_date');
                $data->doctor_schedule_id = $request->input('doctor_schedule_id');
                $data->staff_id = Auth::user()->id;
                $data->remarks = $request->input('remarks');
                $data->patient_id = $request->input('patient_id');
                $data->status = 'APPROVED';
                $data->save();

                $message = "Appointment successfully created!";
                $type = "success";

                $user = user::find($request->input('patient_id'));
                $user->notify(new EmailNotification($message));

                event(new AppointmentStatus('info', 'Notification!', $message, $user));
                
                $notification = new notification;
                $notification->user_id = $user->id;
                $notification->message = $message;
                $notification->save();
            } else {
                $message = "Appointment exists!";
                $type = "error";
            }
        }

        // $message = $client->message()->send([
        //     'to' => '639171358009',
        //     'from' => 'Nexmo',
        //     'text' => $message
        // ]);

        return compact('message', 'type');
    }

    public function reschedule(Request $request)
    {    
        // $basic  = new \Nexmo\Client\Credentials\Basic('0816dbbe', 'I3kGYH92u1kdoDPe');
        // $client = new \Nexmo\Client($basic);
    
        $validator = Validator::make($request->all(), [
            'appointment_id' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required'
        ]);
        
        if (!$validator->fails()) {
            $app = appointment::find($request->input('appointment_id'));
            $query = DB::table('appointments')
                ->where('patient_id', '=', $app->patient_id)
                ->where('appointment_date', '=', $request->input('appointment_date'))
                ->where('doctor_schedule_id', '=', $request->input('appointment_time'))
                ->where('appointment_id', '!=', $request->input('appointment_id'))
                ->whereNotIn('status', ['DONE', 'CANCELLED']);
            
            if ($query->doesntExist()) {
                $data = appointment::find($request->input('appointment_id'));
                $data->appointment_date = $request->input('appointment_date');
                $data->doctor_schedule_id = $request->input('appointment_time');
                $data->save();

                $message = 'Appointment has been rescheduled!';
                $message1 = 'Your appointment has been rescheduled!';
                $type = 'success';

                $user = User::find($app->patient_id);
                $user->notify(new EmailNotification($message1));

                event(new AppointmentStatus('info', 'Notification!', $message1, $user));

                $notification = new notification;
                $notification->user_id = $user->id;
                $notification->message = $message1;
                $notification->save();

                // $message = $client->message()->send([
                //     'to' => '639171358009',
                //     'from' => 'Nexmo',
                //     'text' => $message1
                // ]);
            } else {
                $message = 'Appointment conflicts with an existing record!';
                $type = "error";
            }
        } else {
            $message = 'Missing entry!';
            $type = "error";
        }

        return compact('message', 'type');
    }

    public function getPatient($id)
    {
        $user = user::where('id', $id)->with('bloodtype')->get();
        
        return compact('user');
    }

    public function requestAppointment(Request $request)
    {
        // $basic  = new \Nexmo\Client\Credentials\Basic('0816dbbe', 'I3kGYH92u1kdoDPe');
        // $client = new \Nexmo\Client($basic);

        $validator = Validator::make($request->all(), [
            'doctor_schedule_id' => 'required',
            'appointment_date' => 'required'
        ]);

        if ($validator->fails()) {
            $message = 'Missing Entries';
            $type = 'warning';
        } else {
            $query = DB::table('appointments')
                ->where('doctor_schedule_id', $request->input('doctor_schedule_id'))
                ->where('appointment_date', $request->input('appointment_date'))
                ->where('patient_id', Auth::user()->id)
                ->whereNotIn('status', ['DONE', 'CANCELLED']);

            if ($query->doesntExist()) {
                $message = "Appointment requested by ".Auth::user()->first_name.' '.Auth::user()->last_name;
                $type = "success";

                $data = new appointment;
                $data->appointment_date = $request->input('appointment_date');
                $data->doctor_schedule_id = $request->input('doctor_schedule_id');
                $data->patient_id = Auth::user()->id;
                $data->status = 'PENDING';
                $data->save();

                User::find(Auth::user()->id)->notify(new EmailNotification('You have requested for a new appointment!'));

                event(new PatientStaff('info', 'Notification!', $message));

                $staffs = user::select('id')
                    ->whereIn('role_id', [1, 4])
                    ->get();

                foreach($staffs as $staff){
                    $notification = new notification;
                    $notification->user_id = $staff->id;
                    $notification->message = $message;
                    $notification->save();
                }

                // $message = $client->message()->send([
                //     'to' => '639171358009',
                //     'from' => 'Nexmo',
                //     'text' => 'Your appointment request has been sent!',
                // ]);
                
            } else {
                $message = "Appointment exists!";
                $type = "error";
            }
        }

        return compact('message', 'type');
    }
}
