<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplies;
use Auth;
use App\User;
use App\Notifications\supplyAcknowledged;
use App\Events\supplyIsAcknowledged;
use App\Following;
Use App\Notifications\restockProductForFollowers;
Use App\Notifications\declineAndSupply;
use App\Events\supplyRestocked;
class SuppliesController extends Controller
{
    //
    public function addSupply(Request $request)
    {


      request()->validate([

        'expected_quantity' => 'required|numeric|min:0|not_in:0',
        // 'expected_price' => "required|numeric|min:0|not_in:0|max:$request->srp",
        'expected_price' => "required|numeric|min:0|not_in:0",
        'expected_harvest_date' => "required|date|after_or_equal:today",
        'expected_delivery_date' => "required|date|after:$request->expected_harvest_date",
      ],
        [


          'expected_quantity.required' => 'please fill up this field',
          'expected_quantity.numeric' => 'must be numeric',
          'expected_quantity.min' => 'must be positive',
          'expected_quantity.not_in' => 'cannot be zero',

          'expected_price.required' => 'please fill up this field',
          'expected_price.numeric' => 'must be numeric',
          'expected_price.min' => 'must be positive',
          'expected_price.not_in' => 'cannot be zero',
          // 'expected_price.max' => "price must not exceed ₱$request->srp",


          'expected_harvest_date.required' => 'please fill up this field',
          'expected_harvest_date.date' => 'Enter a Date',
          'expected_harvest_date.after_or_equal' => 'Must not be before today',

          'expected_delivery_date.required' => 'please fill up this field',
          'expected_delivery_date.date' => 'Enter a Date',
          'expected_delivery_date.after' => 'Must not be yesterday or today',


        ]);

        $supply = new Supplies();
        $supply->user_id = Auth::user()->id;
        $supply->product_id = $request->prodID;
        $supply->expected_price = $request->expected_price;
        $supply->expected_quantity = $request->expected_quantity;
        $supply->product_id = $request->prodID;
        $supply->expected_harvest_date = $request->expected_harvest_date;
        $supply->expected_delivery_date = $request->expected_delivery_date;
        $supply->actual_quantity = 0;
        $supply->status = "Pending";
        $supply->save();

        alert()->success("Please wait for the acknowledgement of your supply. A text message will be sent to your number.", "Applied stock request successfully!")->autoclose(20000);
        return response()->json($supply);
    }

    public function getSupply()
    {
        $data = Supplies::Paginate(10);
        $msg1 = "";

        if($data->isEmpty() == true){
          $msg1 = "No Stock Requests Found!";
        }

        if(Auth::user()->type == 'Admin'){
          return view('manage.supply')->withData($data)->withErrors([$msg1]);
        }else{
          alert()->error('You are not allowed to access that page!')->autoclose(5000);
          return redirect('/home');
        }
    }


    //for searching specific supply
    public function searchSupply (Request $request)
    {
      $msg = "";
      $data = Supplies::orderBy('product_id', 'asc')
                ->join('products', 'products.id', '=', 'supplies.product_id')
                ->join('users', 'users.id', '=', 'supplies.user_id')
                ->whereRaw("concat(users.firstname,' ',users.lastname) LIKE '%$request->searchSupply%'")
                ->orWhere('products.product_name', 'like', '%' . $request->searchSupply . '%')
                // ->orWhere('users.firstname', 'like', '%' . $request->searchSupply . '%')
                // ->orWhere('users.lastname', 'like', '%' . $request->searchSupply . '%')
                ->Paginate(10);

      if($data->isEmpty() == true){
        $msg = "No stock requests found!";
        alert()->error('No supplies found!')->autoclose(3500);
      }
      return view('manage.supply')->withData($data)->withErrors([$msg]);

    }

    public function filterSupply (Request $request)
    {
      $msg = "";
      $data = Supplies::where('status', 'like', '%' . $request->selectType . '%')
                ->Paginate(10)->appends('selectType',$request->selectType);

      if($data->isEmpty() == true){
        $msg = "No stock requests found!";
        alert()->error('No supplies found!')->autoclose(3500);
      }
      return view('manage.supply')->withData($data)->withErrors([$msg]);
    }

    public function getSupplyDetails(Request $request)
    {
        $supply = Supplies::find($request->id);
        return response()->json(["unitDetails"=> $supply->products->unit['name'],
        "typeDetails"=> $supply->products->type['name'],"productDetails" =>$supply->products,
        "farmerDetails" => $supply->users, "supplyDetails"=>$supply]);


    }

    public function acknowledgeSupply(Request $request)
    {
        // alert()->success('Supply has been acknowledged')->autoclose(3500);

        $supply = Supplies::find($request->id);

        // $prod = Product::find($supply->product_id);

        $supply->status = "Acknowledged";
        $supply->save();
        alert()->success('Supply has been acknowledged.')->autoclose(3500);
        User::find($supply->user_id)->notify(new supplyAcknowledged($supply));
        event(new supplyIsAcknowledged($supply));


        return response()->json($supply);
    }
    public function declineSupplyQuery(Request $request)
    {
        // alert()->success('Supply has been acknowledged')->autoclose(3500);
        $supply = Supplies::find($request->id);
        $supply->status = "Cancelled";
        $supply->save();
        alert()->success('Supply query has been declined.')->autoclose(3500);
        // User::find($supply->user_id)->notify(new supplyAcknowledged($supply));
        // event(new supplyIsAcknowledged($supply));


        return response()->json($supply);
    }


    public function supplyAction(Request $request)
    {
      if ($request->action == 'accept'){
      request()->validate([
        'actualQuantity' => 'required|numeric|min:0|not_in:0',
      ],
        [
          'actualQuantity.required' => 'please fill up this field',
          'actualQuantity.numeric' => 'must be a number',
          'actualQuantity.min' => 'must be more than 0',
          'actualQuantity.not_in' => 'must be more than 0',
        ]);
      }
        $supply = Supplies::find($request->prodID);
        // $prod = Product::find($supply->product_id);

        if($request->action =="accept"){
            $supply->actual_quantity = $request->actualQuantity;
            $supply->products['quantity'] += $request->actualQuantity;
            $supply->status="Completed";

            if($supply->products->srp < $supply->expected_price){
              $supply->products->srp = $supply->expected_price;
              $supply->products->price = $supply->expected_price * ($supply->products->markup + 1);
            }

            $supply->save();

            $supply->products->save();

            // $supply->products['price'] = $this->calculateProductPrice($supply->product_id);
            // $supply->products->save();

            $followers = Following::where('product_id',$supply->product_id)->get();
            foreach($followers as $follower){
                User::find($follower->user_id)->notify(new restockProductForFollowers($supply));
                event(new supplyRestocked($supply));
                // User::find($order->user_id)->notify(new orderAccepted($order));
            }
            alert()->success('Supply has been accepted.')->autoclose(3500);
        }else if($request->action =="decline"){
            $supply->status = "Cancelled";
            $supply->save();

            alert()->error('Supply has been declined')->autoclose(3500);
        }
        return response()->json($supply->products);
    }

    public function calculateProductPrice($productID)
    {
        $supp = Supplies::where('product_id',$productID)->get();
        $totalQty =0;
        $totalPrice =0;
        $percentage = 1.15;
        foreach($supp as $supplies){
            if($supplies->status=="Completed"){
                $totalQty += $supplies->actual_quantity;
                $totalPrice += ($supplies->expected_price * $supplies->actual_quantity);
            }
        }
        $averagePrice = $totalPrice / $totalQty;
        $price = $averagePrice * $percentage;
        return $price;
    }

    public function declineASupply(Request $request)
    {
      $supply = Supplies::find($request->id);
      $supply->status = "Cancelled";
      $supply->save();
      User::find($supply->user_id)->notify(new declineAndSupply($supply,$request->msg));
      alert()->success('Supply request has been cancelled.')->autoclose(2500);
      return response()->json($request);
    }
}
