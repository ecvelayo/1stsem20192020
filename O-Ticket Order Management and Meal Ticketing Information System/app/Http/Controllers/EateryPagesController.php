<?php

namespace App\Http\Controllers;

use Validator, Input, Redirect;
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
use App\Item;
use App\Meal;
use App\Meal_Detail;
use App\Order_Line_Item;
use App\Credit_History;
use App\Exports\WeeklyExportView;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;

class EateryPagesController extends Controller
{
 
  public function __construct()
  {
      $this->middleware('eatery');
  }

     public function home(){

      $users = DB::table('users_order')->get();
      $emp = User::all();
      $order = Order::all();
      $item = Item::all();


      return view('eatery.home')
          ->with('users', $users)
          ->with('emp', $emp)
          ->with('order', $order)
          ->with('item', $item);

      // $users = DB::table('users_order')->get();
      // $emp = User::all();
      // $order = Order::all();
      // $food = Food::all();
      // $drink = Drink::all(); 


      // return view('eatery.home')
      //     ->with('users', $users)
      //     ->with('emp', $emp)
      //     ->with('order', $order)
      //     ->with('food', $food)
      //     ->with('drink', $drink);
     }
     public function weekly(){

      $en = Carbon::now();
      $ar = Carbon::now()->locale('ar');

      $start = $en->startOfWeek(Carbon::SUNDAY)->toDateString();
      $end = $en->endOfWeek(Carbon::SATURDAY)->toDateString();

      $users = DB::table('users_order')->whereBetween('date_redeemed', [$start, $end])->get();
      // return $users;
      $emp = User::all();
      $orders = Order::whereBetween('order_datetime', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
      $item = Item::all();
     
      

      return view('eatery.weekly')
          ->with('users', $users)
          ->with('emp', $emp)
          ->with('orders', $orders)
          ->with('item', $item);
   }
   public function export(){
    return Excel::download(new WeeklyExportView, "sample.csv");
  }
     public function addMeal(){

       return view('eatery.addMeal');
     }

     public function addMealSubmit(Request $request){
      $datenow = Carbon::today('Asia/Singapore');
      $timenow = Carbon::now('Asia/Singapore');
      $data = $request->all();
      
      $rules = [
          'name' => 'required|unique:item',
          'category' => 'required',
          'price' => 'required',
          'description' => 'required',
      ];

      $validation = Validator::make($data , $rules);
      if($validation->fails())
      {
          return redirect()->back()->with('error', 'Registration Failed! Food or Drink is already registered');
      }

      $status = '1';

      $food = new Item;
      $food->name = $request->name;
      $food->category = $request->category;
      $food->price = $request->price;
      $food->description = $request->description;
      $food->status = $status;
      $food->date_added = $datenow;
      $food->save();

      return redirect('/eatery/addMeal')->with('success', 'Meal Registered!');
     }

     public function FoodDrinkEdit(){
      $item = Item::orderBy('name', 'asc')->paginate(5);
      return view('eatery.foodEdit')->with('item', $item);
     }

     public function foodChange($id){
       $status1 = '1';
       $status0 = '0';

      $f = Item::find($id);

    

      if($f->status == 1){
        $f->status = $status0;
        $f->save();
        return redirect('/eatery/foodEdit')->with('success', 'Availability of food changed');
      }elseif($f->status == 0){
        $f->status = $status1;
        $f->save();
        return redirect('/eatery/foodEdit')->with('success', 'Availability of food changed');
      }

     }


    // public function drinkChange($id){
    //   $status1 = '1';
    //   $status0 = '0';

    //  $d = Drink::find($id);

   

    //  if($d->status == 1){
    //    $d->status = $status0;
    //    $d->save();
    //    return redirect('/eatery/foodEdit')->with('success', 'Availability of drink changed');
    //  }elseif($d->status == 0){
    //    $d->status = $status1;
    //    $d->save();
    //    return redirect('/eatery/foodEdit')->with('success', 'Availability of drink changed');
    //  }

    // }


     public function redeemReq(){

      $orders = DB::table('order')->where('status', '=', '0')->get();

      $user = DB::table('patron')
              ->leftJoin('users', 'patron.patron_id', '=', 'user_id')
              ->get();

      
      return view('eatery.redeemReq')->with('orders',$orders)->with('user',$user);
      

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

      return redirect('/eatery/redeem_req')->with('success', 'Order Accepted!');
  }
  public function redeemDelete($id)
  {
      $status = '2';

      $order = Order::find($id);
      $order->status = $status;
      $order->save();

      return redirect('/eatery/redeem_req')->with('error', 'Order Cancelled');
  }
}

