<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Employee;
use App\Patron;
use App\Driver;
use App\Conductor;
use App\Credit_history;
use App\Order;
use App\Drink;
use App\Food;
use App\Order_Line_Item;
use App\Item;
use App\Meal;
use App\Meal_Detail;
use Carbon\Carbon;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Vehicle_Info as Vehicle_Info_Resource;
use App\Http\Resources\Credit_History as Credit_HistoryResource;
use App\Http\Resources\Food as Food_Resource;
use Illuminate\Support\Facades\DB;
class nameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $isStatus = DB::table('users')->where('user_id', $id)->value('user_type');
    
        if($isStatus == 1){
            //driver info
            $user = DB::table('users')->where('user_id', $id)
                    ->join('patron', 'users.user_id', '=', 'patron.patron_id')
                    ->join('driver', 'users.user_id', '=', 'driver.driver_id')
                    ->select('users.*', 'patron.phone_number','driver.license')
                    ->get();
            

            return new UserResource($user);
        
        }elseif($isStatus == 2){
            $user = DB::table('users')->where('user_id', $id)
            ->join('patron', 'users.user_id', '=', 'patron.patron_id')
            ->join('conductor', 'users.user_id', '=', 'conductor_id')
            ->select('users.*', 'patron.phone_number', 'conductor.cond_experience')
            ->get();

            return new UserResource($user);
        }
        
    }

       /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show3($id)
    {
        $isStatus = DB::table('users')->where('user_id', $id)->value('user_type');
    
        if($isStatus == 1){
            $vehicle_info_id = DB::table('assign_vehicle')->where('driver_id', $id)->value('vehicle_id');

            $vehicle_info = DB::table('vehicle_info')->where('vehicle_id', $vehicle_info_id)->get();

            return new Vehicle_Info_Resource($vehicle_info);
        
        }elseif($isStatus == 2){
            $driver_id = DB::table('conductor_assignment')->where('conductor_id', $id)->value('driver_id');

            $vehicle_id = DB::table('assign_vehicle')->where('driver_id', $driver_id)->value('vehicle_id');

            $vehicle_info = DB::table('vehicle_info')->where('vehicle_id', $vehicle_id)->get();

            return new Vehicle_Info_Resource($vehicle_info);
        }
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Show the form for order the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_order($id)
    {
        //
        

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCredit($id)
    {
        //
            $total = DB::table('Credit_History')->where('patron_id', $id)->sum('points_earned');

            return response()->json([
                'message' => $total
            ]);
            exit();

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_Credit_List($id)
    {
        //
            // $total = DB::table('Credit_History')->where('patron_id', $id)->get();
            $orders = DB::table('order')->where('patron_id', $id)->get();
            $count = DB::table('order')->where('patron_id', $id)->count();
            // echo $count;
            // echo $orders[0]->order_id;
            $arr = array();
            for ($i = 0; $i<$count; $i++) {
            $meal_id_order_line = DB::table('order_line_item')->where('order_id', $orders[$i]->order_id)->value('meal_id');
            array_push($arr, $meal_id_order_line);
            }
            
            $Dates = array();
            for ($i = 0; $i<$count; $i++) {
                $date_order_line = DB::table('order_line_item')->where('order_id', $orders[$i]->order_id)->value('date_redeemed');
                array_push($Dates, $date_order_line);
            }
            // print_r($arr);

            $arr_size = sizeof($arr);
            $meal_type_to_send = array();
            for($i = 0; $i < $arr_size; $i++){
                $meal_type = DB::table('meal')->where('meal_id', $arr[$i])->value('meal_type');
                array_push($meal_type_to_send, $meal_type);
            }
            
            return new Credit_HistoryResource($meal_type_to_send);
    }
     
        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_date_List($id)
    {
        //

            $orders = DB::table('order')->where('patron_id', $id)->get();
            $count = DB::table('order')->where('patron_id', $id)->count();
            // echo $count;
            // echo $orders[0]->order_id;
            $Dates = array();
            for ($i = 0; $i<$count; $i++) {
                $date_order_line = DB::table('order_line_item')->where('order_id', $orders[$i]->order_id)->value('date_redeemed');
                array_push($Dates, $date_order_line);
            }
            // print_r($arr);
            
            return new Credit_HistoryResource($Dates);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFood()
    {
        $meal = 'meal';
        $food = DB::table('item')->where('category', $meal)->get('name');
        return new Food_Resource($food);
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSnack()
    {
        $snack = 'Snacks';
        $food = DB::table('Food')->where('category', $snack)->get('name');
        return new Food_Resource($food);
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDrink()
    {
        $drink = 'drinks';
        $food = DB::table('item')->where('category', $drink)->get('name');
        return new Food_Resource($food);
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCoffee()
    {
        $coffee = 'coffee';
        $food = DB::table('item')->where('category', $coffee)->get('name');
        return new Food_Resource($food);
    }

    
    public function insertOrder(Request $request)
    {
        //

        $request->validate([
                'patron_id' => 'required|string',
                'food' => 'required|string'
        ]);

        $current_date_time = Carbon::today()->toDateString();
        if(Order::where('patron_id', '=', $request->patron_id)->count() > 0){
            $Order_time = DB::table('Order')->where('patron_id', $request->patron_id)
            ->where('order_datetime', $current_date_time)
            ->value('order_datetime');
            if($Order_time == $current_date_time){
                return response()->json([
                    'message' => '1'
                ]);
                exit();
            }
        }

        $order = new Order([
            'patron_id' => $request->patron_id,
            'order_datetime' =>  $current_date_time,
            'status' => '0'
        ]);
        $order->save();

        $order_id = DB::table('Order')->where([
            ['patron_id', $request->patron_id],
            ['order_datetime', $current_date_time],
        ])->value('order_id');
        
        $meal = new Meal([
            'meal_type' => NULL
        ]);
        $meal->save();
        $meal_id = $meal->meal_id;


        $order_line_item = new Order_Line_Item([
            'order_id' => $order_id,
            'meal_id' => $meal_id,
            'status' => '0',
            'date_redeemed' => $current_date_time
        ]);
        $order_line_item->save();
        
        $get_item_id1 = DB::table('item')->where('name', $request->food)->value('item_id');
        
        $food = new Meal_Detail([
            'meal_id' => $meal_id,
            'item_id' => $get_item_id1
        ]);
        $food->save();

        if($request->drink == 'None'){
            $item_id = NULL;
        }else{
            $get_drink_id1 = DB::table('item')->where('name', $request->drink)->value('item_id');
            $item_id = $get_drink_id1;
            $drink = new Meal_Detail([
                'meal_id' =>$meal_id,
                'item_id' =>$item_id
            ]);
            $drink->save();
        }

        // $food = Item::find($request->food);
        // $drink = Item::find($request->drink);
        
        $meal_type = Meal::find($meal_id);
        if($request->drink == 'None'){
            // $meal_type->meal_type = $food->category.' only';
            $food_cat = DB::table('item')->where('name', $request->food)->value('category');
            $meal_update = DB::table('meal')->where('meal_id', $meal_id)->update(['meal_type' => $food_cat .' '.'only']);
        }else{
            // $meal_type->meal_type = $food->category.' with '.$drink->category;
            $food_cat = DB::table('item')->where('name', $request->food)->value('category');
            $drink_cat = DB::table('item')->where('name', $request->drink)->value('category');
            $meal_update = DB::table('meal')->where('meal_id', $meal_id)->update(['meal_type' => $food_cat. ' '. 'with'.' '. $drink_cat]);
        }

        return response()->json([
            'message' => '2'
        ]);
        exit();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pending($id)
    {
        //
        $status = 0;

        $pending = DB::table('order')->where('patron_id', $id)
        ->where('status', $status)
        ->value('order_id');
        // echo $pending;
        // exit;
        if($pending == null){
            return response()->json([
                'food' => null,
                'date' => null    
            ]);
        }
        $pendingReal1 = DB::table('order_line_item')->where('order_id', $pending)->value('meal_id');
        $get_item = DB::table('meal')->where('meal_id', $pendingReal1)->value('meal_type');
        $gettingTime = DB::table('order_line_item')->where('order_id', $pending)->value('date_redeemed');
        return response()->json([
            'food' => $get_item,
            'date' => $gettingTime
        ]);
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history($id)
    {
        //
        $status = 1;
        $pending = DB::table('order')->where('patron_id', $id)
        ->where('status', $status)
        ->value('order_id');
        $pendingReal1 = DB::table('order_line_item')->where('order_id', $pending)->value('food_id');
        $pendingReal2 = DB::table('order_line_item')->where('order_id', $pending)->value('drink_id');

        $food = DB::table('food')->where('food_id', $pendingReal1)->value('name');
        $drink = DB::table('drink')->where('drink_id', $pendingReal2)->value('name');
        
        return response()->json([
            'food' => $food,
            'drink' => $drink
        ]);
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
