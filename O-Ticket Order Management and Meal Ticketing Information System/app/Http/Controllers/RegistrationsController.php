<?php

namespace App\Http\Controllers;

use Illuminate\Html\FormBuilder;
use Illuminate\Http\Request;
use Validator, Input, Redirect;
use App\Conductor_Assignment;
use App\Order_Line_Item;
use App\Credit_History;
use App\Vehicle_info;
use App\Conductor;
use App\Employee;
use App\Patron;
use App\Driver;
use App\Order;
use App\Store;
use App\Item;
use App\User;
use Carbon;
use DB;

class RegistrationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeEmployee(Request $request)
    {
        $datenow = Carbon\Carbon::today('Asia/Singapore');
        $timenow = Carbon\Carbon::now('Asia/Singapore');
        // $date = date('Y-m-d');

        $data = $request->all();

        $rules = [
            'firstname'     => 'required|alpha',
            'middlename'    => 'required|alpha',
            'lastname'      => 'required|alpha',
            'email'         => 'required|unique:users',
            'birthday'      => 'required|after:1/1/1960|before:1/1/2000',
            'type' => 'required',
        ];

        $validation = Validator::make($data , $rules);
        if($validation->fails())
        {
            return redirect()->back()->with('error', 'Registration Failed!');
        }

        $user = new User;

        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthday;
        $user->email = $request->email;
        $user->email_verified_at = $timenow;
        $user->password = 'password';
        $user->status = '1';
        $user->user_type = '1';
        $user->created_at = $timenow;
        $user->updated_at = $timenow;
        $user->date_registered = $timenow;
        $user->save();
        $newUser = $user->user_id;

        $employee = new Employee;
        $employee->employee_id = $newUser;
        $employee->emp_type = $request->type;
        $employee->date_hired = $timenow;
        $employee->save();

        if($request->type == '1'){
            $type = 'Cashier';
        }elseif($request->type == '2'){
            $type = 'Marketing';
        }elseif($request->type == '3'){
            $type = 'Eatery';
        }

        return redirect('/admin/employee')->with('success', $type.' '.'Registered!');
    }

    public function storeDriver(Request $request)
    {
        $datenow = Carbon\Carbon::today('Asia/Singapore');
        $timenow = Carbon\Carbon::now('Asia/Singapore');
        // $date = date('Y-m-d');

        $data = $request->all();

        $rules = [
            'firstname'     => 'required|alpha',
            'middlename'    => 'required|alpha',
            'lastname'      => 'required|alpha',
            'email'         => 'required|unique:users',
            'birthday'      => 'required|after:1/1/1960|before:1/1/2000',
            'phone_number'  => 'required|numeric|unique:patron',
            'license'       => 'required|unique:driver',
            'vehicle_type'  => 'required',
            'plate_number'  => 'required|unique:vehicle_info',
            'owner_name'    => 'required',
        ];

        $validation = Validator::make($data , $rules);
        if($validation->fails())
        {
            return redirect()->back()->with('error', 'Registration Failed!');
        }

        $user = new User;

        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthday;
        $user->email = $request->email;
        $user->email_verified_at = $timenow;
        $user->password = $request->phone_number;
        $user->status = '1';
        $user->user_type = '2';
        $user->created_at = $timenow;
        $user->updated_at = $timenow;
        $user->date_registered = $timenow;
        $user->save();
        $newUser = $user->user_id;

        $patron = new Patron;
        $patron->patron_id = $newUser;
        $patron->phone_number = $request->phone_number;
        $patron->patron_type = '1';
        $patron->save();

        $driver = new Driver;
        $driver->driver_id = $newUser;
        $driver->assigned = '0';
        $driver->license = $request->license;
        $driver->save();
        $driver_id = $driver->id;
        
        $vehicle = new Vehicle_info;
        $vehicle->vehicle_type = $request->vehicle_type;
        $vehicle->plate_number = $request->plate_number;
        $vehicle->owner_name = $request->owner_name;
        $vehicle->save();


        $num = '0'.$request->phone_number;
        $message = "You are now registered to Titay!";
        $apicode = 'TR-KATHL468414_EAIS6' ;
        $url = 'https://www.itexmo.com/php_api/api.php'; 
    
        $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );

        $context  = stream_context_create($param);
        $err = file_get_contents($url, false, $context);




        $name = $request->firstname.' '.$request->lastname;
        return redirect('/admin/driver')->with('success', $name.' '.'Registered!');
    }

    public function storeConductor(Request $request)
    {
        $datenow = Carbon\Carbon::today('Asia/Singapore');
        $timenow = Carbon\Carbon::now('Asia/Singapore');
        $data = $request->all();
        
        $rules = [

            'firstname'     => 'required|alpha',
            'middlename'    => 'required|alpha',
            'lastname'      => 'required|alpha',
            'birthday'      => 'required|after:1/1/1960|before:1/1/2000',
            'email'         => 'required|unique:users',
            'phone_number'  => 'required|numeric|unique:patron',
            'cond_experience' => 'required',
            'driver_id'     => 'unique:conductor_assignment'
        ];

        $validation = Validator::make($data , $rules);
        if($validation->fails())
        {
            return redirect()->back()->with('error', 'Registration Failed!');
        }

        $user = new User;
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthday;
        $user->email = $request->email;
        $user->email_verified_at = $timenow;
        $user->password = $request->phone_number;
        $user->status = '1';
        $user->user_type = '2';
        $user->created_at = $timenow;
        $user->updated_at = $timenow;
        $user->date_registered = $timenow;
        $user->save();
        $user_id = $user->user_id;

        

        $patron = new Patron;
        $patron->patron_id = $user_id;
        $patron->phone_number = $request->phone_number;
        $patron->patron_type = '2';
        $patron->save();

        $conductor = new Conductor;
        $conductor->conductor_id = $user_id;
        $conductor->cond_experience = $request->cond_experience;
        $conductor->save();
        $latestCond = $conductor->conductor_id;

        $assignCond = new Conductor_Assignment;
        $assignCond->driver_id = $request->driver_id;
        $assignCond->conductor_id = $user_id;
        $assignCond->status = '1';
        $assignCond->date_assigned = $timenow;
        $assignCond->save();
        
        $driver = Driver::find($request->driver_id);
        $driver->assigned = '1';
        $driver->save();

        $num = '0'.$request->phone_number;
        $message = "You are now registered to Titay!";
        $apicode = 'TR-KATHL468414_EAIS6' ;
        $url = 'https://www.itexmo.com/php_api/api.php'; 
    
        $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );

        $context  = stream_context_create($param);
        $err = file_get_contents($url, false, $context);

        $name = $request->firstname.' '.$request->lastname;
        return redirect('/admin/conductor')->with('success', $name.' '.'Registered!');

    }
    public function storeBranch(Request $request)
    {
        $datenow = Carbon\Carbon::today('Asia/Singapore');
        $timenow = Carbon\Carbon::now('Asia/Singapore');
        // $date = date('Y-m-d');

        $data = $request->all();

        $rules = [
            'firstname'     => 'required|alpha',
            'middlename'    => 'required|alpha',
            'lastname'      => 'required|alpha',
            'birthday'      => 'required|after:1/1/1960|before:1/1/2000',
            'email'         => 'required|unique:users',
            'password'      => 'required',
            'phone_number'  => 'required|digits:10',
            'type'          => 'required',
            'business_permit' => 'required|unique:store',
        ];

        $validation = Validator::make($data , $rules);
        if($validation->fails())
        {
            return redirect()->back()->with('error', 'Registration Failed!');
        }

        $user = new User;

        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthday;
        $user->email = $request->email;
        $user->email_verified_at = $timenow;
        $user->password = $request->password;
        $user->status = '1';
        $user->user_type = '1';
        $user->created_at = $timenow;
        $user->updated_at = $timenow;
        $user->date_registered = $timenow;
        $user->save();
        $newUser = $user->user_id;

        $status = '1';
        $store = new Store;
        $store->owner_id = $newUser;
        $store->type = $request->type;
        $store->business_permit = $request->business_permit;
        $store->status = $status;
        $store->save();
        

        return redirect('/admin/branch')->with('success', 'User and Store Registered!');
    }
    public function storeMeal(Request $request)
    {
        $datenow = Carbon\Carbon::today('Asia/Singapore');
        $timenow = Carbon\Carbon::now('Asia/Singapore');
        $data = $request->all();
        
        $rules = [
            'mealname' => 'required',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
        ];

        $validation = Validator::make($data , $rules);
        if($validation->fails())
        {
            return redirect()->back()->with('error', 'Registration Failed!');
        }

        $status = '1';

        $food = new Item;
        $food->name = $request->mealname;
        $food->category = $request->category;
        $food->price = $request->price;
        $food->description = $request->description;
        $food->status = $status;
        $food->date_added = $datenow;
        $food->save();

        return redirect('/admin/meal')->with('success', 'Meal Registered!');
    }
    
    public function updateRequest($id)
    {
        $datenow = Carbon\Carbon::today('Asia/Singapore');
        $timenow = Carbon\Carbon::now('Asia/Singapore');
        $status = '1';

        $user = User::find($id);
        if($user->user_type == '1')
        {
            $user->status = $status;
            $user->save();
            return redirect('/admin/request')->with('success', 'User Activated!');
        }else{
            $user->status = $status;
            $user->save();
            
            $patron = Patron::find($id);
            $phone = $patron->phone_number;
    
            if($patron->patron_type == '1'){
                $cond = Conductor_Assignment::all();
                foreach ($cond as $c) {
                    if($c->driver_id == $id){
                        $cond_id = $c->con_ass_id;
                        $con_id = $c->conductor_id;
                        foreach ($cond as $co) {
                            if($co->conductor_id == $con_id && $co->status == '1'){
                                $num = '0'.$phone;
                                $message = "Your account has been activated!";
                                $apicode = 'TR-KATHL468414_EAIS6' ;
                                $url = 'https://www.itexmo.com/php_api/api.php'; 
                            
                                $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
                                $param = array(
                                    'http' => array(
                                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                                        'method'  => 'POST',
                                        'content' => http_build_query($itexmo),
                                    ),
                                );
    
                                $context  = stream_context_create($param);
                                $err = file_get_contents($url, false, $context);
    
                                return redirect('/admin/request')->with('success', 'User Activated!');
    
                            }
                        }
                        $user = User::find($con_id);
                        if($user->status == '1'){
                            $d = Driver::find($id);
                            $d->assigned = '1';
                            $d->save();
    
                            $conAss = Conductor_Assignment::find($cond_id);
                            $conAss->status = '1';
                            $conAss->save();
    
                            $num = '0'.$phone;
                            $message = "Your account has been activated!";
                            $apicode = 'TR-KATHL468414_EAIS6' ;
                            $url = 'https://www.itexmo.com/php_api/api.php'; 
                        
                            $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
                            $param = array(
                                'http' => array(
                                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                                    'method'  => 'POST',
                                    'content' => http_build_query($itexmo),
                                ),
                            );
    
                            $context  = stream_context_create($param);
                            $err = file_get_contents($url, false, $context);
    
                            return redirect('/admin/request')->with('success', 'User Activated!');
                        }else{
                            // $d = Driver::find($id);
                            // $d->assigned = '1';
                            // $d->save();
    
                            // $conAss = Conductor_Assignment::find($cond_id);
                            // $conAss->status = '1';
                            // $conAss->save();
    
                            $num = '0'.$phone;
                            $message = "Your account has been activated!";
                            $apicode = 'TR-KATHL468414_EAIS6' ;
                            $url = 'https://www.itexmo.com/php_api/api.php'; 
                        
                            $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
                            $param = array(
                                'http' => array(
                                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                                    'method'  => 'POST',
                                    'content' => http_build_query($itexmo),
                                ),
                            );
    
                            $context  = stream_context_create($param);
                            $err = file_get_contents($url, false, $context);
    
                            return redirect('/admin/request')->with('success', 'User Activated!');
                        }
                    }
                }
            }else{
                $cons = Conductor_Assignment::all();
                foreach ($cons as $c) {
                    if($c->conductor_id == $id){
                        $con_id = $c->con_ass_id;
                        $driver_id = $c->driver_id;
                        $u_status = User::find($driver_id);
                        $assign_stat = Driver::find($driver_id);
    
                        if($u_status->status == '1' && $assign_stat->assigned == '0'){
                            $con = Conductor_Assignment::find($con_id);
                            $con->datetime = $timenow;
                            $con->status = '1';
                            $con->save();
    
                            $driver = Driver::find($driver_id);
                            $driver->assigned = '1';
                            $driver->save();
    
                            $num = '0'.$phone;
                            $message = "Your account has been activated!";
                            $apicode = 'TR-KATHL468414_EAIS6' ;
                            $url = 'https://www.itexmo.com/php_api/api.php'; 
                        
                            $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
                            $param = array(
                                'http' => array(
                                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                                    'method'  => 'POST',
                                    'content' => http_build_query($itexmo),
                                ),
                            );
    
                            $context  = stream_context_create($param);
                            $err = file_get_contents($url, false, $context);
    
                            return redirect('/admin/request')->with('success', 'User Activated!');
    
                        }else{
                            $user = User::find($id);
                            $user->status = $status;
                            $user->save();
    
                            $num = '0'.$phone;
                            $message = "Your account has been activated!";
                            $apicode = 'TR-KATHL468414_EAIS6' ;
                            $url = 'https://www.itexmo.com/php_api/api.php'; 
                        
                            $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
                            $param = array(
                                'http' => array(
                                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                                    'method'  => 'POST',
                                    'content' => http_build_query($itexmo),
                                ),
                            );
    
                            $context  = stream_context_create($param);
                            $err = file_get_contents($url, false, $context);
    
                            return redirect('/admin/requestDriver/'.$id)->with('error', 'Unable to activate account! Please select another driver.');
                        }
                    }
                }
            }
        }


        
    }
    public function deleteRequest($id)
    {
        $user = User::find($id);
        $user->status = '2';
        $user->save();

        return redirect('/admin/request')->with('success', 'User Deleted!');
    }
    public function deactivateAccount($id)
    {
        $status = '0';

        $userCheck = User::find($id);

        if($userCheck->user_type == '1'){

            $user = User::find($id);
            $user->status = $status;
            $user->save();

            return redirect('/admin/manage')->with('success', 'User Deactivated!');

        }else{

            $user = User::find($id);
            $user->status = $status;
            $user->save();

            $patron = Patron::find($id);
            $phone = $patron->phone_number;

            if($patron->patron_type == '1'){

                $driver = Driver::find($id);
                $driver->assigned = $status;
                $driver->save();
                
                $cond = Conductor_Assignment::all();
                foreach($cond as $c){

                    if($c->driver_id == $id && $c->status == '1'){

                        $conductor = User::find($c->conductor_id);
                        $conductor->status = $status;
                        $conductor->save();

                        $conAss = Conductor_Assignment::find($c->con_ass_id);
                        $conAss->status = $status;
                        $conAss->save();

                        $num = '0'.$phone;
                        $message = "Your account has been deactivated!";
                        $apicode = 'TR-KATHL468414_EAIS6';
                        $url = 'https://www.itexmo.com/php_api/api.php';
                    
                        $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
                        $param = array(
                            'http' => array(
                                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                                'method'  => 'POST',
                                'content' => http_build_query($itexmo),
                            ),
                        );

                        $context  = stream_context_create($param);
                        $err = file_get_contents($url, false, $context);

                        return redirect('/admin/manage')->with('success', 'User Deactivated!');
                    }
                }
                // $cond = Conductor_Assignment::all();
                // foreach ($cond as $c) {
                //     if($c->driver_id == $id){
                        // $c->status = $status;
                        // $con_id = $c->conductor_id;
                        // $c->save();

                        // $user = User::find($con_id);
                        // $user->status = $status;
                        // $user->save();

                        // $patron = Patron::find($con_id);
                        // $phone = $patron->phone_number;

                        // $num = '0'.$phone;
                        // $message = "Your account has been deactivated!";
                        // $apicode = 'TR-KATHL468414_EAIS6';
                        // $url = 'https://www.itexmo.com/php_api/api.php';
                    
                        // $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
                        // $param = array(
                        //     'http' => array(
                        //         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        //         'method'  => 'POST',
                        //         'content' => http_build_query($itexmo),
                        //     ),
                        // );
                
                        // $context  = stream_context_create($param);
                        // $err = file_get_contents($url, false, $context);
                
                        // return redirect('/admin/manage')->with('success', 'User Deactivated!');
                    // }
                // }
            }else{

                $user = User::find($id);
                $user->status = $status;
                $user->save();

                $cond = Conductor_Assignment::all();

                foreach($cond as $c){
                    $driver_id = $c->driver_id;
                    if($c->conductor_id == $id){
                        $c->status = $status;
                        $c->save();

                        $driver = Driver::find($driver_id);
                        $driver->assigned = $status;
                        $driver->save();
                    }
                }

                $patron = Patron::find($id);
                $phone = $patron->phone_number;

                $cond = Conductor_Assignment::all();
                foreach ($cond as $c) {
                    if($c->conductor_id == $id){
                        $c->status = $status;
                        $con_id = $c->conductor_id;
                        $c->save();

                        $num = '0'.$phone;
                        $message = "Your account has been deactivated!";
                        $apicode = 'TR-KATHL468414_EAIS6';
                        $url = 'https://www.itexmo.com/php_api/api.php';
                    
                        $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
                        $param = array(
                            'http' => array(
                                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                                'method'  => 'POST',
                                'content' => http_build_query($itexmo),
                            ),
                        );

                        $context  = stream_context_create($param);
                        $err = file_get_contents($url, false, $context);

                        return redirect('/admin/manage')->with('success', 'User Deactivated!');
                    }
                }

                $num = '0'.$phone;
                $message = "Your account has been deactivated!";
                $apicode = 'TR-KATHL468414_EAIS6';
                $url = 'https://www.itexmo.com/php_api/api.php';
            
                $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
                $param = array(
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($itexmo),
                    ),
                );
        
                $context  = stream_context_create($param);
                $err = file_get_contents($url, false, $context);
        
                return redirect('/admin/manage')->with('success', 'User Deactivated!');
            }
        }
    }
    public function deactivateProfile($id)
    {
        $status = '0';

        $user = User::find($id);

        $user->status = $status;
        $user->save();

        $patron = Patron::find($id);
        $phone = $patron->phone_number;

        $num = '0'.$phone;
        $message = "Your account has been deactivated!";
        $apicode = 'TR-KATHL468414_EAIS6';
        $url = 'https://www.itexmo.com/php_api/api.php'; 
    
        $itexmo = array('1' => $num, '2' => $message, '3' => $apicode);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        
        return redirect('/admin/manage')->with('success', 'User Deactivated!');
    }
    public function requestDriver(Request $request, $id){
        $datenow = Carbon\Carbon::today('Asia/Singapore');
        $timenow = Carbon\Carbon::now('Asia/Singapore');

        $status = '1';

        $user = User::find($id);
        $user->status = $status;
        $user->save();

        $cond = new Conductor_Assignment;
        $cond->driver_id = $request->driver_id;
        $cond->conductor_id = $id;
        $cond->status = $status;
        $cond->datetime = $timenow;
        $cond->save();

        $driver = Driver::find($request->driver_id);
        $driver->assigned = $status;
        $driver->save();

        return redirect('/admin/request')->with('success', 'User Reactivated!');
    }
    public function editProfileEmployee(Request $request, $id){
        $datenow = Carbon\Carbon::today('Asia/Singapore');
        $timenow = Carbon\Carbon::now('Asia/Singapore');
        // $date = date('Y-m-d');

        $data = $request->all();

        $rules = [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'birthday' => 'required|date',
            'email' => 'required|email',
        ];

        $validation = Validator::make($data , $rules);
        if($validation->fails())
        {
            return redirect()->back()->with('error', 'Update Failed!');
        }

        $user = User::find($id);
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthday;
        $user->email = $request->email;
        $user->save();

        // return redirect('admin.pages.profile')->with('success', 'User Reactivated!');
        return redirect('/user/profile/'.$user->user_id);
    }
    public function editProfileDriver(Request $request, $id){
        $datenow = Carbon\Carbon::today('Asia/Singapore');
        $timenow = Carbon\Carbon::now('Asia/Singapore');
        // $date = date('Y-m-d');

        $data = $request->all();

        $rules = [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'birthday' => 'required|date',
            'email' => 'required|email',
            'phone_number' => 'required|digits:10',
            'license' => 'required'
        ];

        $validation = Validator::make($data , $rules);
        if($validation->fails())
        {
            return redirect()->back()->with('error', 'Update Failed!');
        }

        $user = User::find($id);
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthday;
        $user->email = $request->email;
        $user->save();

        $patron = Patron::find($id);
        $patron->phone_number = $request->phone_number;
        $patron->save();

        $driver = Driver::find($id);
        $driver->license = $request->license;
        $driver->save();

        return redirect('/user/profile/'.$user->user_id);
    }
    public function editProfileConductor(Request $request, $id){
        $datenow = Carbon\Carbon::today('Asia/Singapore');
        $timenow = Carbon\Carbon::now('Asia/Singapore');
        // $date = date('Y-m-d');

        $data = $request->all();

        $rules = [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'birthday' => 'required|date',
            'email' => 'required|email',
            'phone_number' => 'required|digits:10'
        ];

        $validation = Validator::make($data , $rules);
        if($validation->fails())
        {
            return redirect()->back()->with('error', 'Update Failed!');
        }

        $user = User::find($id);
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthday;
        $user->email = $request->email;
        $user->save();

        $patron = Patron::find($id);
        $patron->phone_number = $request->phone_number;
        $patron->save();

        return redirect('/user/profile/'.$user->user_id);
    }
}
