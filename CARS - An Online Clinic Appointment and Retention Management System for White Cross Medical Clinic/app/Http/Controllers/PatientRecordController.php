<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\DataTables;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\medical_history;
use App\user_vital_signs;
use Response;
use Carbon\Carbon;
use Auth;


class PatientRecordController extends Controller
{
    public function getMedicalHistory(Request $request)
    {
        $datas = DB::table('medical_histories')
            ->select('medical_histories.medical_history_id', 'medical_histories.description', DB::raw("DATE_FORMAT(medical_histories.created_at, '%b %d, %Y %l:%i %p') as created_at"), DB::raw("DATE_FORMAT(medical_histories.updated_at, '%b %d, %Y %l:%i %p') as updated_at"), 'medical_histories.deleted_at')
            ->join('users', 'users.id', '=', 'medical_histories.user_id')
            ->where('user_id', '=', $request->input('patient_id'))
            ->get();
        if(Auth::user()->role_id == 1){
            return datatables()->of($datas)
            ->addColumn('Action', function($data){
                if(is_null($data->deleted_at)){
                    $result = "<a id='EditMHBtn' data-id=".$data->medical_history_id." data-description=".$data->description." data-toggle='modal' data-target='#EditMHModal'><i class='fas fa-edit text-warning pr-1'></i></a>";
                    $result .= "<a href='#' id='DeleteMHBtn' data-id=".$data->medical_history_id." data-toggle='modal' data-target='#DeleteMHModal'><i class='fa fa-trash text-danger' aria-hidden='true'></i></a>";
                }elseif(!(is_null($data->deleted_at))){
                    $result = "<a id='EditMHBtn' data-id=".$data->medical_history_id." data-description=".$data->description." data-toggle='modal' data-target='#EditMHModal'><i class='fas fa-edit text-warning pr-1'></i></a>";
                    $result .= "<a href='#' id='RestoreMHBtn' data-id=".$data->medical_history_id." data-toggle='modal' data-target='#RestoreMHModal'><i class='fas fa-trash-restore text-primary'></i></a>";
                }
                
                return $result;
            })
            ->rawColumns(['Action'])
            ->make(true);
        }elseif(Auth::user()->role_id == 3){
            return datatables()->of($datas)->make(true);
        }
        
    }

    public function getVitalSigns(Request $request)
    {
        $datas = DB::table('user_vital_signs')
            ->select(DB::raw("concat(s.first_name, ' ', s.middle_name, ' ', s.last_name) as fullname"), 'p.id', 'vital_signs.vital_sign_id', 'vital_signs.name', 'user_vital_signs.value', 'user_vital_signs.created_at', 'user_vital_signs.updated_at', 'user_vital_signs.deleted_at', DB::raw("DATE_FORMAT(user_vital_signs.created_at, '%b %d, %Y %l:%i %p') as add_on"), DB::raw("DATE_FORMAT(user_vital_signs.updated_at, '%b %d, %Y %l:%i %p') as last_update"))
            ->join('users as s', 's.id', '=', 'user_vital_signs.staff_id')
            ->join('users as p', 'p.id', '=', 'user_vital_signs.patient_id')
            ->join('vital_signs', 'vital_signs.vital_sign_id', '=', 'user_vital_signs.vital_sign_id')
            ->where('patient_id', '=', $request->input('patient_id'))
            ->get();
            
        if(Auth::user()->role_id == 1){
            return datatables()->of($datas)
                ->addColumn('Action', function($data){
                    if(is_null($data->deleted_at)){
                        $result = "<a id='EditVSBtn' data-created=".json_encode($data->created_at)." data-patient_id=".$data->id." data-vs_id=".$data->vital_sign_id." data-value=".$data->value." data-toggle='modal' data-target='#EditVSModal'><i class='fas fa-edit text-warning pr-1'></i></a>";
                        $result .= "<a href='#' id='DeleteVSBtn' data-patient_id=".$data->id." data-vs_id=".$data->vital_sign_id." data-value=".$data->value." data-created_at=".json_encode($data->created_at)." data-toggle='modal' data-target='#DeleteVSModal'><i class='fa fa-trash text-danger' aria-hidden='true'></i></a>";
                    }elseif(!(is_null($data->deleted_at))){
                        $result = "<a id='EditVSBtn' data-created=".json_encode($data->created_at)." data-patient_id=".$data->id." data-vs_id=".$data->vital_sign_id." data-value=".$data->value." data-toggle='modal' data-target='#EditVSModal'><i class='fas fa-edit text-warning pr-1'></i></a>";
                    $result .= "<a href='#' id='RestoreVSBtn' data-patient_id=".$data->id." data-vs_id=".$data->vital_sign_id." data-value=".$data->value." data-created_at=".json_encode($data->created_at)." data-toggle='modal' data-target='#RestoreVSModal'><i class='fas fa-trash-restore text-primary'></i></a>";
                    }
                    return $result;
                })
                ->rawColumns(['Action'])
                ->make(true);
        }elseif(Auth::user()->role_id == 3){
            return datatables()->of($datas)->make(true);
        }
    }

    public function updateMedicalHistory(Request $request)
    {
        $data = medical_history::find($request->input('id'));
        $data->description = $request->input('description');
        $data->save();
    }

    public function updateVitalSign(Request $request)
    {
        $data = user_vital_signs::where('patient_id', $request->input('patient_id'))
            ->where('created_at', $request->input('created_at'))
            ->where('vital_sign_id', $request->input('vital_sign_id'))
            ->where('value', $request->input('value'))
            ->update(['vital_sign_id' => $request->input('edit_vital_sign_id'), 'value' => $request->input('edit_value')]);
    }

    public function deleteMedicalHistory(Request $request)
    {
        $data = medical_history::find($request->input('id'))->delete();
    }

    public function deleteVitalSign(Request $request)
    {
        $data = user_vital_signs::where('patient_id', $request->input('patient_id'))
            ->where('created_at', $request->input('created_at'))
            ->where('vital_sign_id', $request->input('vital_sign_id'))
            ->where('value', $request->input('value'))
            ->update(['deleted_at' => Carbon::now()]);

            dd($data);
    }

    public function restoreMedicalHistory(Request $request)
    {
        $data = medical_history::withTrashed()->find($request->input('id'))->restore();
    }

    public function restoreVitalSign(Request $request)
    {
        $data = user_vital_signs::withTrashed()
            ->where('patient_id', $request->input('patient_id'))
            ->where('created_at', $request->input('created_at'))
            ->where('vital_sign_id', $request->input('vital_sign_id'))
            ->where('value', $request->input('value'))
            ->update(['deleted_at' => null]);
    }

    public function storeMedicalHistory(Request $request)
    {
        $data = new medical_history;
        $data->user_id = $request->input('user_id');
        $data->description = $request->input('description');
        $data->save();
    }

    public function storeVitalSigns(Request $request)
    {
        $p_id = $request->input('patient_id');
        $temperature = $request->input('temperature');
        $respiratory_rate = $request->input('respiratory_rate');
        $pulse_rate = $request->input('pulse_rate');
        $blood_pressure = $request->input('blood_pressure');
        $height = $request->input('height');
        $weight = $request->input('weight');
        $last_menstrual_period = $request->input('last_menstrual_period');

        if($request->has('temperature')){
            if($request->input('temperature') > 29){
            $data = new user_vital_signs;
            $data->patient_id = $p_id;
            $data->staff_id = Auth::id();
            $data->vital_sign_id = 1;
            $data->value = $temperature;
            $data->save();
            }
        }

        if($request->has('respiratory_rate')){
            if($request->input('respiratory_rate') > 5){
            $data = new user_vital_signs;
            $data->patient_id = $p_id;
            $data->staff_id = Auth::id();
            $data->vital_sign_id = 2;
            $data->value = $respiratory_rate;
            $data->save();
            }
            
        }

        if($request->has('pulse_rate')){
            if($request->input('pulse_rate') >= 0){
            $data = new user_vital_signs;
            $data->patient_id = $p_id;
            $data->staff_id = Auth::id();
            $data->vital_sign_id = 3;
            $data->value = $pulse_rate;
            $data->save();
            }
            
        }

        if($request->has('blood_pressure')){
            $data = new user_vital_signs;
            $data->patient_id = $p_id;
            $data->staff_id = Auth::id();
            $data->vital_sign_id = 4;
            $data->value = $blood_pressure;
            $data->save();   
            
        }

        if($request->has('height')){
            if($request->input('height') > 0){
            $data = new user_vital_signs;
            $data->patient_id = $p_id;
            $data->staff_id = Auth::id();
            $data->vital_sign_id = 5;
            $data->value = $height;
            $data->save();
            }
            
        }

        if($request->has('weight')){
            if($request->input('weight') > 0){
            $data = new user_vital_signs;
            $data->patient_id = $p_id;
            $data->staff_id = Auth::id();
            $data->vital_sign_id = 6;
            $data->value = $weight;
            $data->save();
            }
            
        }

        if($request->has('last_menstrual_period')){
            $data = new user_vital_signs;
            $data->patient_id = $p_id;
            $data->staff_id = Auth::id();
            $data->vital_sign_id = 7;
            $data->value = $last_menstrual_period;
            $data->save();
        }
    }
}
