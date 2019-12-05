<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transactions;
use App\Orders;
use Carbon\Carbon;
class ChartDataController extends Controller
{


    public function sales(){
        
        $start = 1;
        $end = 12;
       
        //  dd(date('F', mktime(0, 0, 0, 13, 1)));
        $result = [['monthName'=>[],'value'=>[]]];
        
        // $result[0] = "asd";
        // $result[1] = "qwe";
        $q = 1;
        $t = Orders::all();
        foreach($t as $ord){
            if($ord->status =="completed"){
                // dd($ord);
                $date = new Carbon($ord->delivery_date);
                foreach($ord->products as $products){
                    $q++;
                }
                // dd($ord->products);
            }else{
                // dd("wa");
            }
        }
        // dd(Carbon::now());
        
        // $date = new Carbon($t->trans_datetime);
        // dd($date->year);
        
        // dd($t->trans_datetime);
        // $a = Carbon::parse(date_format($t['trans_datetime'],'H:i:s m/d/Y'));
        // dd($a);
        // dd($t->trans_datetime->toFormattedDateString());
        // dd(date('F',mktime($t->trans_datetime)));
        for($i = 0; $i<$end; $i++,$start++){
            //  $result->push(date('F', mktime(0, 0, 0, $i, 1)));
             
             $result[$i]['monthName'] = date('F',mktime(0,0,0,$start,1));
             $result[$i]['value'] = $start;
        }
        
        return view('sales.sales',['result'=>$result]);
    }

    public function getYearMonth(Request $request)
    {
        request()->validate([
            'year' => 'required',
            'month' => 'required',
          ],
            [
              'year.required' => 'this field is required',
              'month.required' => 'this field is required',
            
        ]);
        
        $items = null;
        $orders = Orders::all();
        $storedItem = ['qty' =>0];
        

        foreach($orders as $order){
            
            $date = new Carbon($order->delivery_date);
            $month =$date->month;
            $year = $date->year;

            if($order->status == "completed" && $month == $request->month && $year = $request->year){

                foreach($order->products as $prod){

                    if($items){
                        if(array_key_exists($prod->product_name,$items)){
                            $storedItem = $items[$prod->product_name];
                        }
                    }
                    $storedItem['qty'] += $prod->pivot['quantity'];
                    $items[$prod->product_name] = $storedItem;
                    $storedItem['qty'] = 0;
                }
                

            }

        }
        // asd
        // if($this->items){
        //     if(array_key_exists($id,$this->items)){
        //         $storedItem = $this->items[$id];
        //     }
        // }
        // $storedItem['qty'] += $cartQuantity;
        // $storedItem['price'] = $price * $storedItem['qty'];
        // $this->items[$id] = $storedItem;
        // $this->totalQty += $cartQuantity;
        // $this->totalPrice += $price * $cartQuantity;
        $monthName = date('F',mktime(0,0,0,$request->month,1));
        return response()->json(["items"=>$items, "monthName"=>$monthName]);
    }


    function getAllMonths(){
        $month_array = array();
        $trans_date = Transactions::orderBy('trans_datetime', 'ASC')->pluck('trans_datetime');
       $trans_date = json_decode($trans_date); 
        
    //    return $trans_date;
       if(!empty($trans_date) ){
           foreach($trans_date as $unformat_date){
               $date = new \DateTime ($unformat_date);
               $month_no = $date->format('m'); //key
               $month_name = $date->format('M'); // value
               $month_array[$month_no] = $month_name;
             
           }
       }
       
       return $month_array;

    // return $this->getMonthlyPostCount(11);

    }


    function getMonthlyPostCount($month){

        $monthly_post_count = Transactions::whereMonth('trans_datetime', $month)->get()->count();
        return $monthly_post_count;


    }


    function getMonthlyProducts(){
        $monthly_post_count_array = array(); // array of post count
        $month_array = $this->getAllMonths(); // function to get months
        $month_name_array =array();

        if(!empty($month_array)){
            foreach($month_array as $month_no => $month_name){

                $monthly_post_count = $this->getMonthlyPostCount($month_no);
                array_push($monthly_post_count_array,$monthly_post_count ); //store month count in array 
                array_push($month_name_array,$month_name ); // store month name in array



            }

        }

        $max_no= max($monthly_post_count_array);
        $max_no = round(($max_no + 10/2) /10) * 10;


        $month_array = $this->getAllMonths();
        

        // array to store all data  and to be return
        $month_post_data_array = array(
            'months' =>$month_name_array,
            'post_count_data' =>$monthly_post_count_array, 
            'max' => $max_no,
        );


        return $month_post_data_array;
        
        // $month_post_data_array = ["months"=>$month_name_array,
        // "post_count_data"=>$monthly_post_count_array,
        // "max"=>$max_no];


        // return $month_array = $this->getAllMonths();
        
        // return  view('sales.sales',["month_post_data_array"=>$month_post_data_array]);
        // return response()->json($month_post_data_array);
        // return view('sales.sales')->with('title',$title);
        // return view('manage.product')->with('data', $data)
        // return view('sales.sales')->with('month_post_data_array',$month_post_data_array);

         
    }
}
