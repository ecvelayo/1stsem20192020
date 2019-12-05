<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Employee;
use App\Patron;
use App\Driver;
use App\Conductor;
use App\Vehicle_Info;
use App\Conductor_Assignment;
use App\Assign_Vehicle;
use App\Http\Resources\User as UserResource;
class AuthController extends Controller
{
    //
    public function signup(Request $request){
        
        $request->validate([
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'lastname' => 'required|string',
            'birthday' => 'required|string',
            'email'=> 'required|string|email|unique:users',
            'password' => 'required|string',
            'user_type' => 'required|string',
            'status' => 'required|string',
            'vehicle_type' => 'required|string',
            'plate_number' => 'required|string',
            'owner_name' =>'required|string',
            'date_assigned' => 'required|string',
            'phone_number' => 'required|string'
        ]);
        
        if($request->user_type == 1)
        {   
            $current_date_time = Carbon::now()->toDateTimeString();
            $user = new User([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                "birthdate" => $request->birthday,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'user_type' => $request->user_type,
                'status' => $request->status,
                'date_registered' => $current_date_time
            ]);
            
            $user->save();
            $getUserId = DB::table('users')->where('email', $request->email)->value('user_id');
    
            $patron = new Patron([
                'patron_id' => $getUserId,
                'phone_number' => $request->phone_number,
                'patron_type' => $request->user_type
            ]);
            $patron->save();

            $request->validate([
                'license' => 'required|string'
            ]);

            $getPatronId = DB::table('patron')->where('phone_number', $request->phone_number)->value('patron_id');
        
            $driver = new Driver([
                'driver_id' => $getPatronId,
                'license' => $request->license,
                'assigned' => '0'
            ]);
        
            $driver ->save();

            $vehicle_info = new Vehicle_Info([
                'vehicle_type' => $request->vehicle_type,
                'plate_number' => $request->plate_number,
                'owner_name' => $request->owner_name
            ]);
        
            $vehicle_info->save();

            $getVehicle_info_id = DB::table('vehicle_info')->where('plate_number', $request->plate_number)->value('vehicle_id');
        
            $assign_vehicle = new Assign_Vehicle([
                'driver_id' => $getPatronId,
                'vehicle_id' => $getVehicle_info_id,
                'datetime_assigned' => $request->date_assigned
            ]);
        
            $assign_vehicle->save();
        
        }elseif($request->user_type == 2){
            
            $request->validate([
                'cond_experience' => 'required|string',
                'driver_id' => 'required|string'
            ]);
            $driver = DB::table('driver')->where('driver_id', $request->driver_id)->exists();
            if($driver != NULL){
                $current_date_time = Carbon::now()->toDateTimeString();
                $user = new User([
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'lastname' => $request->lastname,
                    "birthdate" => $request->birthday,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'user_type' => $request->user_type,
                    'status' => $request->status,
                    'date_registered' => $current_date_time    
                ]);
    
                $user->save();
                                    
                $getUserId = DB::table('users')->where('email', $request->email)->value('user_id');
    
                $patron = new Patron([
                    'patron_id' => $getUserId,
                    'phone_number' => $request->phone_number,
                    'patron_type' => $request->user_type
                ]);
                $patron->save();
    
    
                $getPatronId2 = DB::table('patron')->where('phone_number', $request->phone_number)->value('patron_id');
                $conductor = New Conductor([
                    'conductor_id' => $getPatronId2,
                    'cond_experience' => $request->cond_experience
                ]);
                $conductor->save();

                // $conductor_assignment = new conductor_assignment([
                //     'driver_id' => $request->driver_id,
                //     'conductor_id' => $getPatronId2,
                //     'datetime' => $current_date_time
                // ]);
                // $conductor_assignment->save();
            }else{
                return response()->json([
                    'message' => 'Driver does not exist!'
                ]);
            }

        }

        return response() ->json([
            'message'=> 'Successfuly Created User!'
        ], 201);

    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' =>'Incorrect username or password.'
            ], 401);

        $user = $request->user();
        
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->user_id = $user->user_id;
        if($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'user_id' => $user->user_id,
            'token_type' => 'Bearer',
            'status' => $user->status,
            'Expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
    public function logout(Request $request){
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    // public function user($request){
    //     $user = User::findOrFail($request);
    //     return new UserResource($user);
    // }
}
