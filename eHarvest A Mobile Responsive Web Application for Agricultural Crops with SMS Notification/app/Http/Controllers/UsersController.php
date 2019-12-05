<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Auth;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        $msg = "";


        $data = User::orderBy('id', 'asc')->paginate(10);

        if($data->isEmpty() == true){
          $msg = "No users found!";
          alert()->error('No users found!')->autoclose(3500);
        }
        if(Auth::user()->type == 'Admin'){
          return view('manage.users')->withData($data)->withErrors([$msg]);
        }else{
          alert()->error('You are not allowed to access that page!')->autoclose(5000);
          return redirect('/home');
        }
    }

    public function searchUsers(Request $request)
    {
        $msg = "";
        $data = User::whereRaw("concat(firstname,' ',lastname) LIKE '%$request->searchUser%'")
                        // ->get();
                        ->paginate(10);

        if($data->isEmpty() == true){
          $msg = "No users found!";
          alert()->error('No users found!')->autoclose(3500);
        }
        if(Auth::user()->type == 'Admin'){
          return view('manage.users')->withData($data)->withErrors([$msg]);
        }else{
          alert()->error('You are not allowed to access that page!')->autoclose(5000);
          return redirect('/home');
        }
    }

    public function filterUsers(Request $request)
    {
        $msg = "";
        $data = User::orderBy('id', 'asc')
                ->where('type', 'like', '%' . $request->selectType . '%')
                ->Paginate(10)->appends('selectType',$request->selectType);

        if($data->isEmpty() == true){
          $msg = "No users found!";
          alert()->error('No users found!')->autoclose(3500);
        }
        if(Auth::user()->type == 'Admin'){
          return view('manage.users')->withData($data)->withErrors([$msg]);
        }else{
          alert()->error('You are not allowed to access that page!')->autoclose(5000);
          return redirect('/home');
        }
    }




    public function showDetails(Request $request)
    {
        $user = User::where('id', $request->id)->get();
        //return view('pages.userDetails', compact('det'));
        return response()->json(["user" => $user]);
    }




    use AuthenticatesUsers;

    public function show()
    {
        return view('pages.profile');
    }




    public function edit(Request $request)
    {
        $user = User::where('id', $request->id)->value('type');

        $det = User::where('id', $request->id)->value('firstname');

        $type = $request->type;

        $msg = " ";

        if((string)$user != (string)$type){
            User::where('id', $request->id)->update(['type' => $request->type]);
            $msg = $msg . "Successfully changed " . (string)$det . "'s user type to " . (string)$type;
            alert()->success($msg)->autoclose(3500);
        }else{
            $msg = $msg . (string)$det . "'s user type was already a " . (string)$type;
            alert()->error($msg)->autoclose(3500);
        }
    }





    public function update(Request $request)
    {

            $dt = Carbon::now();
            $before = $dt->subYears(13)->format('Y-m-d');

      request()->validate([
        'firstname' => 'required|string|regex:/^[\pL\s\-]+$/u|max:255',
        'lastname' => 'required|string|regex:/^[\pL\s\-]+$/u|max:255',
        'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
        'address' => 'required|string|max:255',
        'bdate' => 'required|before:'.$before,
      ],
        [
          'firstname.required' => 'Must not be empty',
          'lastname.required' => 'Must not be empty',
          'contact.required' => 'Must not be empty',
          'contact.numeric' => 'Must be numbers',
          'firstname.required' => 'Must not be empty',
          'bdate.before'=> "Age must be 13 and above",
          'address.required' => 'Must not be empty',

        ]);

        $user = User::where('id', Auth::user()->id)->get();

        $no = "63";

        if(substr($request->contact, 0, 2) == '09'){
          $no = $no . substr($request->contact, 1);
        }else if(substr($request->contact, 0, 3) == '+63'){
          $no = $no . substr($request->contact, 3);
        }else{
          $no = $request->contact;
        }

        $userDetails = [
            // 'firstname' => $request->input('firstname'),
            // 'lastname' => $request->input('lastname'),
            // 'contact' => $request->input('contact'),
            // 'address' => $request->input('address')
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'contact' => $no,
            'address' => $request->address,
            'birthdate' => $request->bdate
        ];

        User::where('id', Auth::user()->id)->update($userDetails);

        alert()->success('Successfuly edited profile')->autoclose(3500);

        // return redirect("/profile");
    }




    public function changePP(Request $request)
    {
      $disk = Storage::disk('gcs');
      $imagePath = $request->file('photo');
      $storagePath = $disk->put('user/photos', $imagePath);
      //$image->save();

      User::where('id', Auth::user()->id)->update(['photo' => $disk->url($storagePath)]);

      alert()->success('Successfuly changed profile photo')->autoclose(3500);

      return redirect("/profile");
    }

}
