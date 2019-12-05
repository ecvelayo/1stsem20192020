<?php

namespace App\Http\Controllers;

use Illuminate\Html\FormBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Order;
use App\Patron;
use App\User;
use App\Driver;
use App\Vehicle_info;
use App\Conductor_Assignment;
use App\Conductor;
use App\Order_Line_Item;
use App\Credit_History;
use App\Item;
use App\Meal;
use App\Meal_Detail;
use App\Exports\OrderExportView;
use Maatwebsite\Excel\Facades\Excel;

use Carbon;
use Auth;

class CashierPagesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('cashier');
    }

     // HOME PAGE
    public function home(){


        $users = DB::table('users_order')->get();
        $emp = User::all();
        $order = Order::all();
        $item = Item::all();


        return view('cashier.home')
            ->with('users', $users)
            ->with('emp', $emp)
            ->with('order', $order)
            ->with('item', $item);
    
                

        // return view('cashier.home')->with('orders',$orders)->with('user',$user);
    }

    // EXPORT TO EXCEL
    public function export(){
        return Excel::download(new OrderExportView, "sample.csv");
    }
    
    // REGSITERS DRIVER AND CONDUCTOR
    public function driverviewReg(){
        return view('cashier.register');
     }
     
    public function registerDriver(Request $request){

        //static time
        $datenow = Carbon\Carbon::today('Asia/Singapore');
        $timenow = Carbon\Carbon::now('Asia/Singapore');

        // return $request;

        //checking declaration
        // $userCheck = User::where('email', $request->email)->first();
        // $patronCheck = Patron::where('phone_number', $request->phone_number)->first();
        // $vehicleCheck = Vehicle_info::where('plate_number', $request->plate_number);
        // $driverCheck = Driver::where('license', $request->license);

        $reqValidate = $request->validate([
            'firstname'     => 'required|alpha',
            'middlename'    => 'required|alpha',
            'lastname'      => 'required|alpha',
            'email'         => 'required|unique:users',
            'birthday'      => 'required|after:1/1/1960|before:1/1/2000',
            'phone_number'  => 'required|numeric|unique:patron',
            'plate_number'  => 'required|unique:vehicle_info',
            'license'       => 'required|unique:driver'
        ]);

        
        $user = new User;
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthday;
        $user->email = $request->email;
        $user->email_verified_at = $timenow;
        $user->password = $request->password;
        $user->status = '1';
        $user->user_type = '2';
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
        $driver->license = $request->license;
        $driver->assigned = '0';
        $driver->save();
        $driver_id = $driver->id;
        
        $vehicle = new Vehicle_info;
        $vehicle->vehicle_type = $request->vehicle_type;
        $vehicle->plate_number = $request->plate_number;
        $vehicle->owner_name = $request->owner_name;
        $vehicle->save();

        $num = "0".$request->phone_number;
        $message = "You are already registered!";
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


        return redirect('/cashier/home')->with('success', 'User Registered!');
        
    }
    public function conductorviewReg(){
        
        $drivers = DB::table('driver')
        ->leftJoin('users', 'driver.driver_id', '=', 'user_id')
        ->get();
        $users = User::all();

    
        return view('cashier.registerConductor')->with('drivers', $drivers)->with('users', $users);
     }

     public function registerConductor(Request $request){
         //static times
        $datenow = Carbon\Carbon::today('Asia/Singapore');
        $timenow = Carbon\Carbon::now('Asia/Singapore');

        
                 $reqValidate = $request->validate([
                'email'         => 'required|unique:users',
                'phone_number'  => 'required|numeric|unique:patron',
                'driver_id'     => 'unique:conductor_assignment'
            ],
            [
                'driver_id.unique' => "Driver already assigned to a different Conductor"
            ]);

        $user = new User;
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthday;
        $user->email = $request->email;
        $user->email_verified_at = $timenow;
        $user->password = $request->password;
        $user->status = '1';
        $user->user_type = '2';
        $user->date_registered = $timenow;
        $user->created_at = $timenow;
        $user->updated_at = $timenow;
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

        $num = "0".$request->phone_number;
        $message = "You are already registered!";
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

        return redirect('/cashier/home')->with('success', 'User Registered!');
        
    }

    //Meal Redeem 
    public function redeemMeal(){

        $users = DB::table('patron')
        ->leftJoin('users', 'patron.patron_id', '=', 'user_id')
        ->get();
        $order = Order::all();
        // $orderDeets = Order_Line_Item::all();
        $credit = Credit_History::all();
        $item = Item::all();

        return view('cashier.redeem')
            ->with('users', $users)
            ->with('item', $item)
            ->with('credit', $credit);
    }

    public function submitRedeemed(Request $request){
      //static times
       
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

          $drink = new Meal_Detail;
          $drink->meal_id = $meal_id;
          if($request->drink == 'None'){
              $drink->item_id = NULL;
          }else{
              $drink->item_id = $request->drink;
          }
          $drink->save();

          $food = Item::find($request->food);
          $drink = Item::find($request->drink);

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
              //if already ordered today error 
               
              // $reqValidate = $request->validate([
              //     'user_id'         => 'required|unique:users', 
              // ],
              // [
              //     'user_id.unique' => "You already had your free meal, come again tomorrow"
              // ]);

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

              $drink = new Meal_Detail;
              $drink->meal_id = $meal_id;
              if($request->drink == 'None'){
                  $drink->item_id = NULL;
              }else{
                  $drink->item_id = $request->drink;
              }
              $drink->save();

              $food = Item::find($request->food);
              $drink = Item::find($request->drink);

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

    //REDEEM REQUEST
    public function redeemRequest(){

        $orders = DB::table('order')->where('status', '=', '0')->get();
        
        $user = DB::table('patron')
                ->leftJoin('users', 'patron.patron_id', '=', 'user_id')
                ->get();

        
        return view('cashier.redeemRequest')->with('orders',$orders)->with('user',$user);
        

    }

    public function redeemAccept(Request $request, $id)
    {
        $status = '1';

        $order = Order::find($id);
        $order->status = $status;
      
        $order->save();

        // foreach($order as $ord){
        //     $o = $ord->order_datetime;
        // }

        $points = $request->no_of_passenger * 0.25;
             
        $id = Auth::id();
             $credit = new Credit_history;
             $credit->no_of_passenger = $request->no_of_passenger;
             $credit->points_earned = $points;
             $credit->employee_id = $id;
             $credit->patron_id = $order->patron_id;
             $credit->date_earned = $order->order_datetime;
             $credit->save();

        return redirect('/cashier/redeem_request')->with('success', 'Order Accepted!');
    }
    public function redeemDelete($id)
    {
        $status = '2';

        $order = Order::find($id);
        $order->status = $status;
        $order->save();

        return redirect('/cashier/redeem_request')->with('error', 'Order Cancelled!');
    }

    //Register Request
    public function regRequest(){

        $users = DB::table('users')->where('status', '=', '0')->get();
        $patrons = Patron::All();
        
        return view('cashier.regRequest')
            ->with('users', $users)
            ->with('patrons', $patrons);
        

    }

    public function updateRequest($id)
    {
        $status = '1';

        $user = User::find($id);
        $user->status = $status;
        $user->save();

        return redirect('/cashier/cashier_request')->with('success', 'User Activated!');
    }
    public function deleteRequest($id)
    {
        $status = '2';

        $user = User::find($id);
        $user->status = $status;
        $user->save();

        return redirect('/cashier/cashier_request')->with('error', 'User Activation cancelled');
    }
}
