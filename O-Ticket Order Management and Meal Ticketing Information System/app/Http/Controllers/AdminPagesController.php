<?php

namespace App\Http\Controllers;

use Validator, Input, Redirect;
use Illuminate\Http\Request;
use App\Conductor_Assignment;
use App\Order_Line_Item;
use App\Credit_History;
use App\Conductor;
use App\Employee;
use App\Patron;
use App\Driver;
use App\Order;
use App\User;
use App\Item;
use App\Meal;
use App\Meal_Detail;
use Carbon;
use Auth;
use DB;
use App\Exports\adminExport;
use App\Exports\OrderExportView;
use Maatwebsite\Excel\Facades\Excel;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;




class AdminPagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }


    public function index(){
        
        $users = DB::table('users_order')->get();
        $emp = User::all();
        $order = Order::all();
        $item = Item::all();


        return view('admin.index')
            ->with('users', $users)
            ->with('emp', $emp)
            ->with('order', $order)
            ->with('item', $item);
    
    }
    public function addAccount(){

        return view('admin.pages.addAccount');

    }
    public function driverRegistration(){

        return view('admin.pages.driverRegistration');

    }
    public function conductorRegistration(){

        $driver = DB::table('driver')
            ->leftJoin('users', 'driver.driver_id', '=', 'users.user_id')
            ->get();

        return view('admin.pages.conductorRegistration')
            ->with('driver', $driver);

    }
    public function employeeRegistration(){

        return view('admin.pages.employeeRegistration');

    }
    public function manageAccounts(){

        $users = User::orderBy('firstname', 'asc')->paginate(6);
        $emp = Employee::all();
        $pat = Patron::all();

        return view('admin.pages.manageAccounts')
            ->with('users', $users)
            ->with('emp', $emp)
            ->with('pat', $pat);

    }
    public function addMeal(){

        return view('admin.pages.addMeal');

    }
    public function addBranch(){

        return view('admin.pages.addBranch');

    }
    public function request(){

        $users = DB::table('users')->where('status', '=', '0')->get();
        $patrons = Patron::All();
        $employee = Employee::All();
        
        return view('admin.pages.request')
            ->with('users', $users)
            ->with('patrons', $patrons)
            ->with('employee', $employee);
        
    }
    public function reports(){
        
        $users = DB::table('users_order')->orderBy('date_earned', 'asc')->paginate(5);;
        $emp = User::all();
        $order = Order::all();
        $item = Item::all();


        return view('admin.pages.reports')
            ->with('users', $users)
            ->with('emp', $emp)
            ->with('order', $order)
            ->with('item', $item);

    }
    public function userProfile($id){

        $user = User::find($id);
        $emp = Employee::find($id);
        $pat = Patron::find($id);
        $credits = Credit_History::Where('patron_id', '=', $id)->get();
        $driver = Driver::all();
        $cond = Conductor::all();
        $conAs = Conductor_Assignment::all();
        $assTo = User::all();

        return view('admin.pages.profile')
            ->with('user', $user)
            ->with('emp', $emp)
            ->with('pat', $pat)
            ->with('driver', $driver)
            ->with('cond', $cond)
            ->with('conAs', $conAs)
            ->with('assTo', $assTo)
            ->with('credits', $credits);

    }
    public function userProfileEdit($id){

        $user = User::find($id);
        if($user->user_type == '1'){


            return view('admin.pages.editProfileEmployee')->with('user', $user);
        }elseif($user->user_type == '2'){
            $patron = Patron::find($id);
            if($patron->patron_type == '1'){
                $driver = Driver::find($id);
                return view('admin.pages.editProfileDriver')
                    ->with('user', $user)
                    ->with('patron', $patron)
                    ->with('driver', $driver);
            }elseif($patron->patron_type == '2'){
                $conductor = Conductor::find($id);
                return view('admin.pages.editProfileConductor')
                    ->with('user', $user)
                    ->with('patron', $patron)
                    ->with('conductor', $conductor);
            }
        }
        return redirect()->back();
        
    }
    public function adminExport(){

        return Excel::download(new adminExport, "Titay's Patron Today.csv");
    
    }
    public function redeem(){
        
        $users = DB::table('patron')
        ->leftJoin('users', 'users.user_id', '=', 'patron.patron_id')
        ->get();

        $order = Order::all();
        $item = Item::all();

        return view('admin.pages.redeemMeal')
            ->with('users', $users)
            ->with('item', $item);
    }

    public function redeemMeal(Request $request){

        $datenow = Carbon\Carbon::today('Asia/Singapore')->toDateString();
        $timenow = Carbon\Carbon::now('Asia/Singapore');
   
        $orderCheck = Order::all();

        $phone = DB::table('patron')->where('patron_id', $request->user_id)->get();

        foreach($phone as $p){
            $phoneNum = $p->phone_number;
        }

        if(count($orderCheck) == 0){
            
            $order = new Order;
            $order->patron_id = $request->user_id;
            $order->order_datetime = $datenow;
            $order->status = '1';
            $order->save();
            $order_id = $order->order_id;


            $meal = new Meal;
            $meal->meal_type = NULL;
            $meal->save();
            $meal_id = $meal->meal_id;

            $points = $request->no_of_passenger * 0.25;
            
            $orderLine = new Order_Line_Item;
            $orderLine->order_id = $order_id;
            $orderLine->meal_id = $meal_id;
            $orderLine->status = '1';
            $orderLine->date_redeemed = $datenow;
            $orderLine->save();


            $food = new Meal_Detail;
            $food->meal_id = $meal_id;
            $food->item_id = $request->food;
            $food->save();
            $food = Item::find($request->food);

            

            if($request->drink != 'None' || $request->drink != 'none'){
                $drink = new Meal_Detail;
                $drink->meal_id = $meal_id;
                $drink->item_id = $request->drink;
                $drink->save();
                $drink = Item::find($request->drink);
            }
            

            $meal_type = Meal::find($meal_id);
            if($request->drink == 'None' || $request->drink != 'none'){
                $meal_type->meal_type = $food->category.' only';
            }else{
                $meal_type->meal_type = $food->category.' with '.$drink->category;
            }
            $meal_type->save();

            $id = Auth::id();
            $credit = new Credit_history;
            $credit->no_of_passenger = $request->no_of_passenger;
            $credit->points_earned = $points;
            $credit->employee_id = $id;
            $credit->patron_id = $request->user_id;
            $credit->date_earned = $timenow;
            $credit->save();

            $patron = Patron::find($request->user_id);
            $patron->last_redeemed = $datenow;
            $patron->save();

            $num = "0".$phoneNum;
            $message = "You are can now claim your meal or snacks";
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
            
            return redirect()->back()->with('success', 'Meal redeemed');
            
        }else{

            foreach($orderCheck as $o){
                $dateCheck = $timenow->isSameDay($o->order_datetime);
                $uCheck = $o->patron_id;
            }

            foreach($phone as $p){
                $phoneNum = $p->phone_number;
            }

            if($uCheck == $request->user_id && $dateCheck == 1 ){

                return redirect()->back()->with('error', 'You already had your free meal, come again tomorrow');

            }else{
                
                $order = new Order;
                $order->patron_id = $request->user_id;
                $order->order_datetime = $datenow;
                $order->status = '1';
                $order->save();
                $order_id = $order->order_id;


                $meal = new Meal;
                $meal->meal_type = NULL;
                $meal->save();
                $meal_id = $meal->meal_id;

                $points = $request->no_of_passenger * 0.25;
                
                $orderLine = new Order_Line_Item;
                $orderLine->order_id = $order_id;
                $orderLine->meal_id = $meal_id;
                $orderLine->status = '1';
                $orderLine->date_redeemed = $datenow;
                $orderLine->save();


                $food = new Meal_Detail;
                $food->meal_id = $meal_id;
                $food->item_id = $request->food;
                $food->save();
                $food = Item::find($request->food);


                if($request->drink != 'None'){
                    $drink = new Meal_Detail;
                    $drink->meal_id = $meal_id;
                    $drink->item_id = $request->drink;
                    $drink->save();
                    $drink = Item::find($request->drink);
                }
                

                $meal_type = Meal::find($meal_id);
                if($request->drink == 'None'){
                    $meal_type->meal_type = $food->category.' only';
                }else{
                    $meal_type->meal_type = $food->category.' with '.$drink->category;
                }
                $meal_type->save();

                $id = Auth::id();
                $credit = new Credit_history;
                $credit->no_of_passenger = $request->no_of_passenger;
                $credit->points_earned = $points;
                $credit->employee_id = $id;
                $credit->patron_id = $request->user_id;
                $credit->date_earned = $timenow;
                $credit->save();

                $patron = Patron::find($request->user_id);
                $patron->last_redeemed = $datenow;
                $patron->save();
        

                $num = "0".$phoneNum;
                $message = "You are can now claim your meal or snacks";
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
                
                return redirect()->back()->with('success', 'Meal redeemed');
            } 
        }
    }   


    public function requestDriver($id)
    {
        $driver = DB::table('driver')
            ->leftJoin('users', 'driver.driver_id', '=', 'users.user_id')
            ->get();
        return view('admin.pages.requestDriver')->with('id', $id)->with('driver', $driver);
    }
    
    public function itemList(){
        
        $item = Item::orderBy('name', 'asc')->paginate(5);
        return view('admin.pages.itemList')->with('item', $item);
    }

    public function deactivateItem($id){
        $food = Item::find($id);
        $food->status = '0';
        $food->save();

        return redirect('admin/itemList')->with('success', 'Food Deactivated!');
    }

    public function activateItem($id){
        $food = Item::find($id);
        $food->status = '1';
        $food->save();

        return redirect('admin/itemList')->with('success', 'Food Activated!');
    }

    public function changePassword($id){

        $user = User::find($id);

        return view('admin.pages.changePassword')->with('user', $user);
        
    }

    public function changePasswordProc(Request $request, $id){

        $data = $request->all();

        $rules = [
            // 'current_password' => ['required', new MatchOldPassword],
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ];

        $validation = Validator::make($data , $rules);
        if($validation->fails())
        {
            return redirect()->back()->with('error', 'Change Password Failed!');
        }



        
        $user = User::find($id);

        if(Hash::check($request->current_password, $user->password) == false)
        {
            return redirect()->back()->with('error', 'Invalid Current Password!');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        $emp = Employee::find($id);
        $pat = Patron::find($id);
        $credits = Credit_History::Where('patron_id', '=', $id)->get();
        $driver = Driver::all();
        $cond = Conductor::all();
        $conAs = Conductor_Assignment::all();
        $assTo = User::all();

        return view('admin.pages.profile')
            ->with('user', $user)
            ->with('emp', $emp)
            ->with('pat', $pat)
            ->with('driver', $driver)
            ->with('cond', $cond)
            ->with('conAs', $conAs)
            ->with('assTo', $assTo)
            ->with('credits', $credits);
        return view('admin.pages.profile')->with('user', $user)->with('success', 'Password Change!');

    }
}
