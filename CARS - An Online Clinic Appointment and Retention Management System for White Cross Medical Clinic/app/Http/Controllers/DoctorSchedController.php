<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\doctor_schedule;

class DoctorSchedController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'day' => 'required',
            'time_schedule' => 'required'
        ]);
        
        $doctor_id = $request->input('doctor_id');
        $days = $request->input('day');
        
        if ($request->input('time_schedule') == 1) {
            $start_time = '9:00';
            $end_time = '12:00';
        } elseif ($request->input('time_schedule') == 2) {
            $start_time = '13:00';
            $end_time = '17:00';
        }

        if ($validator->fails()) {
            toastr()->warning('Missing entries');
        } else {
            
            foreach($days as $day){
                $query = DB::table('doctor_schedules')
                        ->select('doctor_schedule_id', 'day')
                        ->where('doctor_id', $doctor_id)
                        ->whereRaw("FIND_IN_SET('".$day."', day)")
                        ->where('start_time', $start_time)
                        ->where('end_time', $end_time);

                if ($query->exists()) {
                    toastr()->error('Conflicts with existing record!');
                    return redirect()->back();
                }

                $query = DB::table('doctor_schedules')
                        ->select('doctor_schedule_id', 'day')
                        ->where('doctor_id', $doctor_id)
                        ->where('start_time', $start_time)
                        ->where('end_time', $end_time);

                if ($query->exists()) {
                    $query_id = implode('', $query->get()->pluck('doctor_schedule_id')->toArray());
                    $query_day = implode('', $query->get()->pluck('day')->toArray());

                    $data = doctor_schedule::find($query_id);
                    $data->doctor_id = $doctor_id;
                    $data->day = implode(',', $days).','.$query_day;
                    $data->start_time = $start_time;
                    $data->end_time = $end_time;
                    $data->save();
                    
                    toastr()->success('Doctor schedule added!');
                    return redirect()->back();
                }
            }

            $data = new doctor_schedule;
            $data->doctor_id = $request->input('doctor_id');
            $data->day = implode(',', $days);
            $data->start_time = $start_time;
            $data->end_time = $end_time;
            $data->save();
            
            toastr()->success('New doctor schedule created!');
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'day' => 'required',
            'time_schedule_edit' => 'required'
        ]);
        
        $doctor_id = $request->input('doctor_id');
        $days = $request->input('day');

        if ($request->input('time_schedule_edit') == 1) {
            $start_time = '9:00';
            $end_time = '12:00';
        } elseif ($request->input('time_schedule_edit') == 2) {
            $start_time = '13:00';
            $end_time = '17:00';
        }

        if ($validator->fails()) {
            toastr()->warning('Missing entries');
        } else {
            
            foreach($days as $day){     // Checks if record exists in an existing record
                $query = DB::table('doctor_schedules')
                        ->select('doctor_schedule_id', 'day')
                        ->where('doctor_schedule_id', '!=', $id)
                        ->where('doctor_id', $doctor_id)
                        ->whereRaw("FIND_IN_SET('".$day."', day)")
                        ->where('start_time', $start_time)
                        ->where('end_time', $end_time);

                if ($query->exists()) {
                    toastr()->error('Conflicts with existing record!');
                    return redirect()->back();
                }

                $query = DB::table('doctor_schedules')
                        ->select('doctor_schedule_id', 'day')
                        ->where('doctor_schedule_id', '!=', $id)
                        ->where('doctor_id', $doctor_id)
                        ->where('start_time', $start_time)
                        ->where('end_time', $end_time);

                if ($query->exists()) {
                    toastr()->error('Conflicts with existing record! '.$start_time.' - '.$end_time.' already exists.');
                    return redirect()->back();
                }
            }

            $data = doctor_schedule::find($id);
            $data->doctor_id = $doctor_id;
            $data->day = implode(',', $days);
            $data->start_time = $start_time;
            $data->end_time = $end_time;
            $data->save();

            toastr()->success('Doctor schedule updated!');
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $data = doctor_schedule::find($id)->delete();
        toastr()->error('Doctor schedule deleted!');

        return redirect()->back();
    }

    public function restore($id)
    {
        $data = doctor_schedule::withTrashed()->find($id)->restore();
        toastr()->info('Doctor schedule restored!');

        return redirect()->back();
    }
}
