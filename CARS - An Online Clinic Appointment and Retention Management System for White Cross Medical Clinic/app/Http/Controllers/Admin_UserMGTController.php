<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class Admin_UserMGTController extends Controller
{
    public function update(Request $request, $id)
    {
        $data = User::find($id);
        $data->role_id = $request->input('role_id');
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
        $data->bloodtype_id = $request->input('bloodtype_id');
        $data->save();

        toastr()->info('User Profile Updated!');

        return redirect()->route('admin.user_mgt', ['name' => Auth::user()->username]);
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();
        toastr()->info('User Account Deleted!');

        return redirect()->route('admin.user_mgt', ['name' => Auth::user()->username]);
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id)->restore();
        toastr()->info('User Account Restored!');
        
        return redirect()->route('admin.user_mgt', ['name' => Auth::user()->username]);
    }
}
