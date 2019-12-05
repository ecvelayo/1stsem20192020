<?php

namespace App\Http\Controllers;
use App\Orders;
use Illuminate\Http\Request;
Use App\Notifications\SystemNotification;
Use App\Notifications\orderAccepted;
Use App\Notifications\declineAnOrder;
Use App\Notifications\driverAssigned;
Use App\User;
Use App\Transactions;
Use App\unit;
use Illuminate\Support\Collection;
use Auth;
use App\Events\orderIsAccepted;
class OrdersController extends Controller

{
    //
    public function getAllOrders()
    {
        $data = Orders::orderBy('order_datetime', 'desc')
              ->Paginate(10);
        $drivers = User::where("type","Driver")->get();

        $msg1 = "";

        if($data->isEmpty() == true){

          $msg1 = "No Orders Found!";
        }

        if(Auth::user()->type == 'Admin'){

          return view('manage.orders',["data"=>$data,"drivers"=>$drivers])->withErrors([$msg1]);
        }else{
          alert()->error('You are not allowed to access that page!')->autoclose(5000);
          return redirect('/home');
        }
    }

    //for searching specific order
    public function orderSearch (Request $request)
    {
      $msg = "";
      $data = Orders::orderBy('order_datetime', 'desc')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('users.firstname', 'like', '%' . $request->searchOrders . '%')
            ->orWhere('users.lastname', 'like', '%' . $request->searchOrders . '%')
            ->orWhere('order_code', 'like', '%' . $request->searchOrders . '%')
            ->Paginate(10);
      $drivers = User::where("type","Driver")->get();

      if($data->isEmpty() == true)
      {
        $msg = "No Orders Found!";
        alert()->error('No Orders Found!')->autoclose(3500);
      }

      return view('manage.orders',["data"=>$data,"drivers"=>$drivers])->withErrors([$msg]);
    }

    public function filterOrders (Request $request)
    {
      $msg = "";
      $data = Orders::orderBy('order_datetime', 'desc')
            ->where('status', 'like', '%' . $request->selectType . '%')
            ->Paginate(10)->appends('selectType',$request->selectType);

      $drivers = User::where("type","Driver")->get();
      if($data->isEmpty() == true)
      {
              $msg = "No Orders Found!!";
              alert()->error('No Orders Found!')->autoclose(3500);
      }

      return view('manage.orders',["data"=>$data,"drivers"=>$drivers])->withErrors([$msg]);
    }

    public function getBasketOrders(Request $request)
    {
        // $order = Orders::find($request->id)->products;
        // $unit = unit::find($request->id);
        // $orderDetails = Orders::find($request->id);
        $order = Orders::where('id',$request->id)->with(['users','products','products.unit','transactions','transactions.users'])->get();
        // $orderz = $order[$request->id];
        return response()->json(["orders" => $order]);
    }
    public function confirmOrders(Request $request)
    {
      $order = Orders::find($request->id);
      if($request->decisions =="decline"){
        $order->status = "cancelled";
        foreach($order->products as $product){
          $product->quantity += $product->pivot['quantity'];
          $product->save();
        }
        $order->save();
        
        alert()->error('Order has been declined')->autoclose(2500);

      }else if($request->decisions == 'accept'){
      request()->validate([
        'driver' => 'required',
        'deliveryDate' => 'required|date|after_or_equal:today',
        'valid' => 'not_in:0',
      ],
        [
          'driver.required' => 'please fill out this field.',
          'deliveryDate.required' => 'please fill out this field',
          'deliveryDate.date' => 'please enter a date',
          'deliveryDate.after_or_equal' => 'must not be before today',
          'valid.not_in' => 'delivery day must be wednesday or sunday',

        
        
          

        ]);

        $order->status = "for delivery";
        $order->delivery_date = $request->deliveryDate;
        $order->save();
        User::find($order->user_id)->notify(new orderAccepted($order));
        event(new orderIsAccepted($order));
        $transact = new Transactions();
        $transact->user_id = $request->driver;
        $transact->orders_id = $order->id;


        $transact->status = "Pending";
        $transact->trans_datetime = null;
        $transact->price_paid = null;
        $transact->change = null;
        $transact->save();
        
        User::find($transact->user_id)->notify(new driverAssigned($order));

        alert()->success('Order has been accepted.')->autoclose(2500);
        return response()->json($order);

      }
      return response()->json($order);

        // $order = Orders::find($request->id);
        // if($request->decisions == "accept"){
            
        //     alert()->success('Order has been accepted.')->autoclose(2500);
        // }else if($request->decisions == "decline"){
            
        // }
        // $order->save();
        // User::find($order->user_id)->notify(new orderAccepted($order));
        // event(new orderIsAccepted($order));
        // $transact = new Transactions();
        // $transact->user_id = $request->driver;
        // $transact->orders_id = $order->id;


        // $transact->status = "Pending";
        // $transact->trans_datetime = null;
        // $transact->price_paid = null;
        // $transact->change = null;
        // $transact->save();



        // return redirect('/orders');

        
    }
    public function viewOrdersAsAdmin()
    {
        $data = Orders::orderBy('order_datetime','desc')->Paginate(10);
        $getUserData = Orders::all()->sortByDesc("order_datetime");
        $msg1 = "";
        $col = collect();
        foreach($getUserData as $usersD){
            if($usersD->users['id']==Auth::user()->id){
                $col->push($usersD);
            }
        }
        $userCollect = $col->paginate(10);
        // return view('track.tracking')->withData($data,$datas);

        if($data->isEmpty() == true)
        {

                $msg1 = "No Orders Found!";
        }

        return view('track.tracking', ["data"=>$data,"userData"=>$userCollect,"message"=>"There are no orders!"])->withErrors([$msg1]);
    }

    // for searching in tracking
    public function searchTracking (Request $request)
    {
      $msg = "";
      $data = Orders::where('order_code', 'like', '%' . $request->searchOrders . '%')->Paginate(10);
      $getUserData = Orders::all();
      $col = collect();
      foreach($getUserData as $usersD){
          if($usersD->users['id']==Auth::user()->id){
              $col->push($usersD);
          }
      }
      $userCollect = $col->paginate(10);
      // return view('track.tracking')->withData($data,$datas);
      if($data->isEmpty() == true)
      {
        $msg = "No Orders Found!";
        alert()->error('No Orders Found!')->autoclose(3500);
      }
      // alert()->error($request->searchOrders);

      return view('track.tracking', ["data"=>$data,"userData"=>$userCollect,"message"=>"There are no orders!"])->withErrors([$msg]);
    }

    //for filtering in searchTracking
    public function filterTracking (Request $request)
    {
      $msg = "";
      $data = Orders::where('status', 'like', '%' . $request->selectType . '%')->Paginate(10)->appends('selectType',$request->selectType);
      $getUserData = Orders::where('status','like','%'.$request->selectType.'%')->get();
      $col = collect();
      foreach($getUserData as $usersD){
          if($usersD->users['id']==Auth::user()->id){
              $col->push($usersD);
          }
      }
      if(Auth::user()->type == 'Consumer'){
        if($col->isEmpty() == true){
          $msg = "No Orders found!";
          alert()->error('No Orders found!')->autoclose(3500);
        }
      }else if(Auth::user()->type =='Admin'){
        if($data->isEmpty() == true){
          $msg = "No Orders found!";
          alert()->error('No Orders found!')->autoclose(2500);
        }
      }
      
      
      // return view('track.tracking')->withData($data,$datas);
      // if($data->isEmpty() == true)
      // {
      //   $msg = "No Orders Found!";
      //   alert()->error('No Orders Found! ')->autoclose(3500);
      // }
      $userCollect = $col->paginate(10)->appends('selectType',$request->selectType);
      return view('track.tracking', ["data"=>$data,"userData"=>$userCollect,"message"=>"There are no orders!"])->withErrors([$msg]);
    }

     //method for  display tracking page
     public function deliver(){

        return view('deliver.delivery');
    }

    public function completeOrder(Request $request){
        $order = Orders::find($request->orderID);
        // foreach($order->products as $product){
        //   $product->quantity -= $product->pivot['quantity'];
        //   $product->save();
        // }
        $order->status = "completed";
        $order->save();
        alert()->success('Order has been completed.')->autoclose(2500);
        return response()->json($request);
    }
    public function cancelOrder(Request $request){
      $order = Orders::find($request->orderID);
      foreach($order->products as $product){
        $product->quantity += $product->pivot['quantity'];
        $product->save();
      }
      $order->status = "cancelled";
      $order->save();
      alert()->success('Order has been cancelled.')->autoclose(2500);
      return response()->json($request);
  }
  
  public function declineAnOrder(Request $request){
    $order = Orders::find($request->id);
    $order->status="cancelled";
    foreach($order->products as $product){
      $product->quantity += $product->pivot['quantity'];
      $product->save();
    }
    $order->save();
    User::find($order->user_id)->notify(new declineAnOrder($order,$request->msg));
    alert()->success('Order has been cancelled.')->autoclose(2500);

    return response()->json($request);
  }
}
