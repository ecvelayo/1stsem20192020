<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transactions;
use Auth;
use App\Orders;
use Carbon\Carbon;
use App\Delivery_Fee;
Use App\Notifications\declineAndDelivery;
use App\User;
class TransactionsController extends Controller
{
    //
    public function viewDelivery()
    {
        $msg = "";
        $adminData = Transactions::orderBy('created_at','desc')->Paginate(10);

        $getDelivery = Transactions::all()->sortByDesc("created_at");
        $col = collect();
        foreach($getDelivery as $delivery){
            if($delivery->user_id==Auth::user()->id){
                $col->push($delivery);
            }
        }

        if($getDelivery->isEmpty() == true){
          $msg = "No deliveries found!";
        }

        $userDelivery = $col->paginate(5);
        if(Auth::user()->type == 'Admin' || Auth::user()->type == 'Driver'){

          return view('deliver.delivery',['userDelivery'=>$userDelivery,'adminData'=>$adminData])->withErrors([$msg]);
        }else{
          alert()->error('You are not allowed to access that page!')->autoclose(5000);
          return redirect('/home');
        }
    }

    public function searchDelivery(Request $request)
    {
      if($request->searchDelivery != ''){
      $msg = "";

      $order = Orders::where('order_code', 'like', '%' . $request->searchDelivery . '%')->value('id');
      $adminData = Transactions::where('orders_id', $order)->Paginate(10);

      // $adminData = Transactions::where('orders_id->orders->order_code', 'like', '%' . $request->searchDelivery . '%')->Paginate(10);

      $getDelivery = $adminData;
      $col = collect();
      foreach($getDelivery as $delivery){
        if($delivery->user_id==Auth::user()->id){
            $col->push($delivery);
        }
      }
      if(Auth::user()->type == 'Driver'){
        if($col->isEmpty() == true){
          $msg = "No deliveries found!";
          alert()->error('No deliveries found!')->autoclose(2500);
        }
      }else if(Auth::user()->type =='Admin'){
        if($adminData->isEmpty() == true){
          $msg = "No deliveries found!";
          alert()->error('No deliveries found!')->autoclose(2500);
        }
      }

      $userDelivery = $col->paginate(5);
      return view('deliver.delivery',['userDelivery'=>$userDelivery,'adminData'=>$adminData])->withErrors([$msg]);
      }
      else
      {
        return $this->viewDelivery();
      }
    }

    public function filterDelivery(Request $request)
    {
        $msg = "";

        // $getDelivery = Transactions::orderBy('trans_datetime', 'desc')->get();
        $adminData = Transactions::where('status', 'like', '%' . $request->selectType . '%')->Paginate(10)->appends('selectType',$request->selectType);
        $getDelivery = Transactions::orderBy('trans_datetime', 'desc')->where('status', 'like', '%' . $request->selectType . '%')->get();
        $col = collect();
        foreach($getDelivery as $delivery){
          if($delivery->user_id==Auth::user()->id){
              $col->push($delivery);
          }
        }
        if(Auth::user()->type == 'Driver'){
          if($col->isEmpty() == true){
            $msg = "No deliveries found!";
            alert()->error('No deliveries found!')->autoclose(2500);
          }
        }else if(Auth::user()->type =='Admin'){
          if($adminData->isEmpty() == true){
            $msg = "No deliveries found!";
            alert()->error('No deliveries found!')->autoclose(2500);
          }
        }

        $userDelivery = $col->paginate(10)->appends('selectType',$request->selectType);
        return view('deliver.delivery',['userDelivery'=>$userDelivery,'adminData'=>$adminData])->withErrors([$msg]);
    }

    public function getDeliveryDetails(Request $request)
    {
          $trans = Transactions::where('id',$request->id)->with('orders','orders.products','orders.products.unit','orders.users','users')->get();

        // $trans = Transactions::find($request->id);
        // $order = Orders::find($trans->orders_id)->products;
        // $orderDetails = $trans->orders;
        // $deliveryManDetails = $trans->users;

        // $order = Orders::find($request->id)->products;
        // $orderDetails = Orders::find($request->id);
         return response()->json(["transactions" => $trans]);
    }

    public function completeDelivery (Request $request)
    {
      $trans = Transactions::find($request->id);
      if($request->action == "Cancelled")
      {
              $orders = Orders::find($trans->orders_id);
              $trans->status = "Cancelled";
              $trans->save();

              alert()->error('Order has been cancelled. Please return the items to the warehouse.')->autoclose(2500);
      }
      else
      {
              request()->validate([
                'price_paid' => "required|numeric|min:$request->total|not_in:0",
              ],
                [
                  'price_paid.required' => 'please fill up this field',
                  'price_paid.numeric' => 'must be numeric',
                  'price_paid.min' => 'price paid must be  greater than or equal to grand total',
                  'price_paid.not_in' => 'price paid must be  greater than or equal to grand total',
                ]);



                $trans->status = $request->action;
                $trans->trans_datetime = Carbon::now()->toDateTimeString();
                $trans->price_paid = $request->price_paid;
                $trans->change = $request->change;
                $trans->save();

                alert()->success('Items delivered to consumer.')->autoclose(2500);

        }


        return response()->json($request);

    }


    public function updateDeliveryCharge(Request $request)
    {
      request()->validate([
        'delivery_charge_change' => 'required|numeric|min:0|not_in:0',
      ],
        [
          'delivery_charge_change.required' => 'please fill up this field',
          'delivery_charge_change.numeric' => 'must be numeric',
          'delivery_charge_change.min' => 'must be positive',
          'delivery_charge_change.not_in' => 'cannot be zero',
        ]);

          $deliveryFee = Delivery_Fee::first();
          if($deliveryFee){
            $deliveryFee->price = $request->delivery_charge_change;
          }else{
            $deliveryFee = new Delivery_Fee;
            $deliveryFee->price = $request->delivery_charge_change;
          }
          $deliveryFee->save();

        alert()->success('Changed delivery charge to ₱' . number_format($request->delivery_charge_change, 2) . ' successfully.')->autoclose();

      return response()->json($request);
    }

    public function declineADelivery(Request $request)
    {
      $trans = Transactions::find($request->id);
      $trans->status = "Cancelled";
      $trans->save();
      User::find($trans->orders->user_id)->notify(new declineAndDelivery($trans,$request->msg));
      alert()->success('Transaction has been cancelled.')->autoclose(2500);
      return response()->json($request);
    }


}
