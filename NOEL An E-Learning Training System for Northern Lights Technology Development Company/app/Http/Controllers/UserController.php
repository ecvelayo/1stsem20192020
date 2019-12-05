<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    public function create(Request $request) {
        $request->validate([
        'fname' => ['required', 'string', 'max:255'],
        'lname' => ['required', 'string', 'max:255'],
        'mname' => ['nullable', 'string', 'max:255'],
        'contact' => ['required', 'digits:10', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $messages = [
            'required' => 'This field is required',
            'digits' => 'Please enter a valid phone number'
        ]);

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'mname' => $request->mname,
            'contact' => $request->contact,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->getAllUsers();
    }
        

    public function register(Request $request) {
        $request->validate([
        'fname' => ['required', 'string', 'max:255'],
        'lname' => ['required', 'string', 'max:255'],
        'mname' => ['nullable', 'string', 'max:255'],
        'contact' => ['required', 'digits:10', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $messages = [
            'required' => 'This field is required',
            'digits' => 'Please enter a valid phone number'
        ]);

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'mname' => $request->mname,
            'contact' => $request->contact,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'api_token' => Str::random(60),
        ]);

        $token = $user->createToken('NOEL Password Grant Client', ['view-trainings', 'enroll-trainings'])->accessToken;

        // $credentials = $request->only('email', 'password');        

        return response()->json($token);
        // return $this->authenticate($credentials);
        // return response([
        //     'message' => 'Account created successfully', 
        //     'token' => $token,
        //     'user_token' => $user->api_token
        // ], 200);
    } 

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        
        $user = User::where('email', '=', $request->email)->first();
        
        if ($user) {
            $credentials = $request->only('email', 'password');
        
            if (Auth::attempt($credentials)) {
                // Authentication passed...
                // $whoami = Auth::user();
                $token = $user->createToken('NOEL Password Grant Client', ['view-trainings', 'enroll-trainings'])->accessToken;
                return response()->json($token);
            }
        }

        return response([
            'errors' => [
                'email' => [
                    Lang::get('auth.failed')
                ]
            ]
        ], 422);
        // return $this->authenticate($credentials);
        // return response()->json('Login successful');
    }

    public function authenticate($credentials) {
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return response()->json([
                'user' => [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email
                ]
            ]);
        }
        return null;
    }

    public function resetPass(Request $request, User $user) {
        $request->validate([
            'old_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        if (Hash::check($request->old_password, $user->password)) { 
            // put a condition that checks if old and new are the same
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();
            return response()->json('Password changed successfully', 200);
        }
        return response()->json(['errors' => ['old_password' => ['The old password does not match our records.']]], 422);
    }

    public function updateUserPicture(Request $request, User $user) {
        $request->validate([
            'profile_image' => 'file|image|max:4000',
        ]);
        if($request->hasFile('profile_image')) {
            if ($request->file('profile_image')->isValid()) {
                $file = $request->file('profile_image');
                $extension = $file->getClientOriginalExtension();
                $randomFilename = Str::random(20);
                $newFilename = $randomFilename.'.'.$extension;
                $destinationPath = public_path('storage/user/');
                $file->move($destinationPath, $newFilename);
                $user->profile_image = $newFilename;
                $user->update();
            }
        }
        return response()->json($user->profile_image);
    }

    public function adminResetPass(Request $request, User $user) {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        $user->password = Hash::make($request->password);
        $user->update();
        return $this->getUser($user->id);
    }

    public function adminUpdateUser(Request $request, User $user) {
        $role = $request->input('role');
        if($role == "Administrator") {
            $user->isAdmin = true;
            $user->isHR = false;
            $user->isManager = false;
        } else if($role == "HR") {
            $user->isAdmin = false;
            $user->isHR = true;
            $user->isManager = false;
        } else if($role == "Manager") {
            $user->isAdmin = false;
            $user->isHR = false;
            $user->isManager = true;
        } else {
            $user->isAdmin = false;
            $user->isHR = false;
            $user->isManager = false;
        }
        $user->fname = $request->fname;
        $user->mname = $request->mname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->update();
        return $this->getUser($user->id);
    }

    public function getAllUsers() {
        $getAllUsers = User::all();
        // $getAllUsers = User::where('active', '=', true)->get();
        // get all Users
        return response()->json($getAllUsers);
    }

    public function deleteUser($id) {
        $deleteUser = User::find($id);
        $deleteUser->delete();
        return $this->getAllUsers();
        // return response()->json($id);
    }

    public function updateUser(Request $request, $id){
        $request->validate([
            'contact' => ['required', 'digits:10'],
        ], $messages = [
            'digits' => 'Please enter a valid phone number'
        ]);
        $user = User::find($id);
        $user->update($request->all());
        return $this->getUser($id);
    }

    public function getUser($id){
        $getUser = User::findOrFail($id);
        return response()->json($getUser);
    }

    public function getUserTrainings($id){
        $getUserTrainings = User::findOrFail($id);
        return response()->json($getUserTrainings);
    }
    
    public function archive(User $user){
        $user->active = false;
        $user->update();
        return response(200);
    }
    
    public function getAllInactive() {
        $getAllInactive = User::where('active', '=', false)->get();
        return response()->json($getAllInactive);
    }

    public function unArchive(User $user) {
        $user->active = true;
        $user->update();
        return response(200);
    }
    public function editProfile(Request $request, $id){
        $updateUser = $request->all();
        User::find($id)->update($updateUser);
        return $this->getUser($id);
    }
    
    public function getUserProfile($id){
        $getUserProfile = User::findOrFail($id);
        return response()->json($getUserProfile);
        }
}
