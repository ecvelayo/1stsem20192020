<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\medical_service;
use App\result;
use App\user;
use Auth;
use DB;

class ResultController extends Controller
{
    public function patientResults(Request $request)
    {
        if(Auth::user()->role_id == 1){
            $results = DB::table('results')
                ->select('results.result_id', DB::raw("concat(p.first_name, ' ', p.middle_name, ' ', p.last_name) as patient_name"), 'results.description as description', 'results.created_at as created_at', 'results.updated_at as updated_at', 'results.deleted_at as deleted_at', 'results.status as status')
                ->join('users as p', 'p.id', '=', 'results.patient_id')
                ->where('patient_id', $request->input('patient_hidden'))
                ->get();
        }elseif(Auth::user()->role_id == 4){
            $results = DB::table('results')
                ->select('results.result_id', DB::raw("concat(p.first_name, ' ', p.middle_name, ' ', p.last_name) as patient_name"), 'results.description as description', 'results.created_at as created_at', 'results.updated_at as updated_at', 'results.deleted_at as deleted_at', 'results.status as status')
                ->join('users as p', 'p.id', '=', 'results.patient_id')
                ->where('patient_id', $request->input('patient_hidden'))
                ->where('results.deleted_at', NULL)
                ->get();
        }

        return datatables()->of($results)
            ->addColumn('created_at', function($result){
                return Carbon::parse($result->created_at)->format('M d, Y h:i A');
            })
            ->addColumn('updated_at', function($result){
                return Carbon::parse($result->updated_at)->format('M d, Y h:i A');
            })
            ->addColumn('Status', function($result){
                
                if($result->status == 'READY'){
                    $status = "<a data-id='".$result->result_id."' data-toggle='modal' data-target='#UpdateStatusModal'><span class='badge badge-primary'>READY</span></a>";
                }elseif($result->status == 'CLAIMED'){
                    $status = "<span class='badge badge-success'>CLAIMED</span>";
                }

                return $status;
            })
            ->addColumn('Action', function($result){
                if($result->deleted_at == NULL){
                    $action = "<a href='".route('results.show', ['id' => $result->result_id])."'><i class='fas fa-download text-secondary fa-sm' aria-hidden='true'></i></a>";
                    $action .= "<a href='#' id='EditBtn' data-id='".$result->result_id."' data-des='".$result->description."' data-toggle='modal' data-target='#EditModal'><i class='fas fa-edit text-warning mx-2'></i></a>";
                    $action .= "<a href='#' id='DeleteBtn' data-id='".$result->result_id."' data-toggle='modal' data-target='#DeleteModal'><i class='fas fa-trash text-danger'></i></a>";
                }else{
                    $action = "<a href='#' id='RestoreBtn' data-id='".$result->result_id."' data-toggle='modal' data-target='#RestoreModal'><i class='fas fa-trash text-primary'></i></a>";
                }

                return $action;
            })
            ->rawColumns(['Status', 'Action', 'created_at', 'updated_at'])    
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'upload_file' => 'required|mimes:pdf',
            'description' => 'required',
            'patient' => 'required'
        ]);
    
        if(!$validator->fails()){
            $file_path = Storage::put('public', $request->file('upload_file'));

            $data = new result;
            $data->patient_id = $request->input('patient');
            $data->description = $request->input('description');
            $data->file_name = str_replace('public/', '', $file_path);
            $data->file_path = $file_path;
            $data->status = 'READY';
            $data->save();

            $message = 'File Successfully uploaded!';
            $type = 'success';

        }else{
            $errors = $validator->errors();
            $u = $errors->first('upload_file');
            $d = $errors->first('description');
            $p = $errors->first('patient');

            $message = $u.' '.$d.' '.$p;
            $type = 'error';
        }

        return compact('type', 'message');
    }

    public function show($id)
    {
        $file = result::find($id);

        if(!Storage::disk('public')->exists($file->file_name)){
            toastr()->error('File is not found!');

            return back();
        }else{
            $headers = array('Content-Type: application/pdf');

            return response()->download(storage_path('app/').$file->file_path, $file->description.'.pdf', $headers);   
        }
    }

    public function update(Request $request)
    {   
        $id = $request->input('id');
        $description = $request->input('description');

        $file = result::find($id);
        $file->description = $description;
        $file->save();

        $message = 'File successfully updated!';
        $type = 'info';

        return compact('message', 'type');
    }

    public function destroy(Request $request)
    {
        $file = result::find($request->input('id'))->delete();
        $message = 'File successfully deleted!';
        $type = 'info';

        return compact('message', 'type');
    }

    public function restore(Request $request)
    {
        $file = result::withTrashed()->find($request->input('id'))->restore();
        $message = 'File successfully restored!';
        $type = 'info';

        return compact('message', 'type');
    } 

    public function resultsForPatient(Request $request)
    {
        $results = DB::table('results')
            ->select('results.result_id', DB::raw("concat(p.first_name, ' ', p.middle_name, ' ', p.last_name) as patient_name"), 'results.description as description', 'results.created_at as created_at', 'results.updated_at as updated_at', 'results.deleted_at as deleted_at', 'results.status as status')
            ->join('users as p', 'p.id', '=', 'results.patient_id')
            ->where('patient_id', Auth::user()->id)
            ->get();

        return datatables()->of($results)
            ->addColumn('created_at', function($result){
                return Carbon::parse($result->created_at)->format('M d, Y h:i A');
            })
            ->addColumn('updated_at', function($result){
                return Carbon::parse($result->updated_at)->format('M d, Y h:i A');
            })
            ->addColumn('Status', function($result){
                
                if($result->status == 'READY'){
                    $status = "<a data-id='".$result->result_id."' data-toggle='modal' data-target='#UpdateStatusModal'><span class='badge badge-primary'>READY</span></a>";
                }elseif($result->status == 'CLAIMED'){
                    $status = "<span class='badge badge-success'>CLAIMED</span>";
                }

                return $status;
            })
            ->addColumn('Action', function($result){
                $action = "<a href='".route('results.show', ['id' => $result->result_id])."'><i class='fas fa-download text-secondary fa-sm' aria-hidden='true'></i></a>";

                return $action;
            })
            ->rawColumns(['Status', 'Action', 'created_at', 'updated_at'])    
            ->make(true);
    }
}
