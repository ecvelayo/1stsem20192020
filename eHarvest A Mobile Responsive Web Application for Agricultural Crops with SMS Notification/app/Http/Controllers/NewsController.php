<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Orders;
use Carbon\Carbon;
use App\User;
use App\Supplies;
class NewsController extends Controller
{
    //
    public function storeNews(Request $request){




    }

    public function getUsersOverview()
    {
        $users = User::all();
        $overview = ['Admin'=>0,'Consumer'=>0,'Farmer'=>0,'Driver'=>0];
        foreach($users as $user){
          $overview[$user->type] += 1;
        }
        $orders = Orders::where('status','completed')->get();
        $earningsOverview = ['January'=>0,'February'=>0,'March'=>0,'April'=>0,'May'=>0,'June'=>0,'July'=>0,'August'=>0,'September'=>0,'October'=>0,'November'=>0,'December'=>0];
        // $costsOverview = ['January'=>0,'February'=>0,'March'=>0,'April'=>0,'May'=>0,'June'=>0,'July'=>0,'August'=>0,'September'=>0,'October'=>0,'November'=>0,'December'=>0];
        $revenueOverview = ['January'=>0,'February'=>0,'March'=>0,'April'=>0,'May'=>0,'June'=>0,'July'=>0,'August'=>0,'September'=>0,'October'=>0,'November'=>0,'December'=>0];
        
        foreach($orders as $order){
          $month = new Carbon($order->delivery_date);

          if($month->year == Carbon::now()->year){
            $earningsOverview[$month->format('F')] += $order->grand_total;
            $revenueOverview[$month->format('F')] += $order->grand_total;
          }

        }
        $supplies = Supplies::where('status','Completed')->get();
        $costsOverview = ['January'=>0,'February'=>0,'March'=>0,'April'=>0,'May'=>0,'June'=>0,'July'=>0,'August'=>0,'September'=>0,'October'=>0,'November'=>0,'December'=>0];
        foreach($supplies as $supply){
          $month = new Carbon($supply->updated_at);

          if($month->year == Carbon::now()->year){
            $costsOverview[$month->format('F')] += ($supply->actual_quantity * $supply->expected_price);
            $earningsOverview[$month->format('F')] -= ($supply->actual_quantity * $supply->expected_price);
            // $profitOverview[$month->format('F')] += $earningsOverview[$month->format('F')] - ($supply->actual_quantity * $supply->expected_price);
          }
        }
        return response()->json(['overview'=>$overview,'earningsOverview'=>$earningsOverview,'costsOverview'=>$costsOverview,'revenueOverview'=>$revenueOverview]);
    }
     //method for  display invoice
     public function dashboard()
     {

      $orders = Orders::where('status','completed')->get();
      $pendingOrders = Orders::where('status','for approval')->get();
      $pendingDelivery = Orders::where('status','for delivery')->get();
      $pending = count($pendingOrders);
      $pendingDelivery = count($pendingDelivery);
      // $date = new Carbon($orders[0]->order_datetime);
      // if($date->month == Carbon::now()->month){
      //     dd("this month");
      // }else{
      //     dd("not this month");
      // }
      $monthly = 0;
      $yearly = 0;
      foreach($orders as $order){
          $date = new Carbon($order->delivery_date);
          
          if($date->year == Carbon::now()->year){
            $yearly += $order->grand_total;
            if($date->month == Carbon::now()->month){
              $monthly += $order->grand_total;
            }
          }
      }

      $monthlyCost = 0;
      $yearlyCost = 0;
      $supplies = Supplies::where('status','Completed')->get();
      foreach($supplies as $supply){
        $date = new Carbon($supply->updated_at);
        
        if($date->year == Carbon::now()->year){
          $yearlyCost += ($supply->actual_quantity * $supply->expected_price);
          if($date->month == Carbon::now()->month){
            $monthlyCost += ($supply->actual_quantity * $supply->expected_price);
          }
        }
      }
      // dd($yearly);
      $years = ["2015","2016","2017","2018","2019","2020","2021","2022","2023","2024"];
      if(Auth::user()->type == "Admin")
      {

        return view('manage.dashboard',['monthly'=>$monthly,'annual'=>$yearly,'pending'=>$pending,'pendingDelivery'=>$pendingDelivery,'monthlyCost'=>$monthlyCost,'yearlyCost'=>$yearlyCost,'years'=>$years]);
      }
      else
      {
        alert()->error('You are not allowed to access that page!')->autoclose(5000);
        return redirect('/home');
      }
     }

     //method for  display invoice
     public function news(Request $request){

        $news = News::All();

        if(Auth::user()->type == "Admin")
        {
          return view('manage.news')->with('news', $news);
        }
        else
        {
          alert()->error('You are not allowed to access that page!')->autoclose(5000);
          return redirect('/home');
        }
    }

    public function sampleAddNews(Request $request)
    {

      request()->validate([
        'photo' => 'required|image|mimes:jpeg,png',

        'news_name' => 'required',

      ],
        [
          'photo.required' => 'please fill up this field',
          'photo.image' => 'must be an image file',
          'photo.mimes' => ' must be in jpeg or png format',

          'product_name.required' => 'please fill up this field',

        ]);

      $arr = [];
      $i=0;
      foreach($request->all() as $req){
        $arr[$i] = $req;
        $i++;
      }


      $disk = Storage::disk('gcs');
        $imagePath = $request->file('photo');
        $storagePath = $disk->put('news/photos', $imagePath);



        $news = new News;
        $news->news_name =  $arr[1];
        $news->photo = $disk->url($storagePath);
        $news->save();

        alert()->success('A new news has been uploaded. Please check the home page!')->autoclose(3500);


        return $request;
    }


    public function deleteNews(Request $request){

      News::destroy($request->id);
      alert()->success('Deleted Successfully')->autoclose(2500);

    }

    public function getYearGraph(Request $request)
    {

      $earningsOverview = ['January'=>0,'February'=>0,'March'=>0,'April'=>0,'May'=>0,'June'=>0,'July'=>0,'August'=>0,'September'=>0,'October'=>0,'November'=>0,'December'=>0];
      $revenueOverview = ['January'=>0,'February'=>0,'March'=>0,'April'=>0,'May'=>0,'June'=>0,'July'=>0,'August'=>0,'September'=>0,'October'=>0,'November'=>0,'December'=>0];
      $costsOverview = ['January'=>0,'February'=>0,'March'=>0,'April'=>0,'May'=>0,'June'=>0,'July'=>0,'August'=>0,'September'=>0,'October'=>0,'November'=>0,'December'=>0];
      $orders = Orders::where('status','completed')->get();
      foreach($orders as $order){
        $date = new Carbon($order->delivery_date);
        if($request->year == $date->year){
          $earningsOverview[$date->format('F')] += $order->grand_total;
          $revenueOverview[$date->format('F')] += $order->grand_total;
        }
        // if($month->year == Carbon::now()->year){
        //   $earningsOverview[$month->format('F')] += $order->grand_total;
        //   $revenueOverview[$month->format('F')] += $order->grand_total;
        // }
      }
      $supplies = Supplies::where('status','Completed')->get();
      foreach($supplies as $supply){
        $date = new Carbon($supply->updated_at);
        if($request->year == $date->year){
          $costsOverview[$date->format('F')] += ($supply->actual_quantity * $supply->expected_price);
          $earningsOverview[$date->format('F')] -= ($supply->actual_quantity * $supply->expected_price);
        }
      }
      return response()->json(['earningsOverview'=>$earningsOverview,'costsOverview'=>$costsOverview,'revenueOverview'=>$revenueOverview]);
    }



    public function cost(){

  
      $supplies = Supplies::where('status','Completed')->get();
      $costCollect = collect();
      $costMonthly = 0;
      $month = Carbon::now()->format('F Y');
      foreach($supplies as $supply){
        $date = new Carbon($supply->updated_at);
        if($date->year == Carbon::now()->year){
          if($date->month == Carbon::now()->month){
            $costCollect->push($supply);
            $costMonthly += ($supply->expected_price * $supply->actual_quantity);
          }
        }
        
      }
      return view('manage.cost',['costCollect'=>$costCollect,'costMonthly'=>$costMonthly,'month'=>$month]);
    }

    public function revenue(){

      // return view('manage.revenue');
      $orders = Orders::where('status','completed')->get();
      $revenueCollect = collect();
      $revMonthly = 0;
      // $msg = "";
      $month = Carbon::now()->format('F Y');
      foreach($orders as $order){
        $date = new Carbon($order->delivery_date);
        if($date->year == Carbon::now()->year){
          if($date->month == Carbon::now()->month){
            $revenueCollect->push($order);
            $revMonthly += $order->grand_total;
          }
        }
      }
      // if($orders->isEmpty() == true){
      //   $msg = "No Data";
      // }

      return view('manage.revenue',['revenueCollect'=>$revenueCollect,'revMonthly'=>$revMonthly,'month'=>$month]);
      
    }



    public function profit(){

      return view('manage.profit');
    }

    public function costY(){
      $year = Carbon::now()->format('Y');
      $supplies = Supplies::where('status','Completed')->get();
      $costCollect = collect();
      $costYearly = 0;
      foreach($supplies as $supply){
        $date = new Carbon($supply->updated_at);
        if($date->year == Carbon::now()->year){
            $costCollect->push($supply);
            $costYearly += ($supply->expected_price * $supply->actual_quantity);
        }
      }
      return view('manage.costYear',['year'=>$year,'costCollect'=>$costCollect,'costYearly'=>$costYearly]);
    }

    public function revenueY(){
       $year = Carbon::now()->format('Y');
       $orders = Orders::where('status','completed')->get();
       $revenueCollect = collect();
       $revenueYearly = 0;
       foreach($orders as $order){
         $date = new Carbon($order->delivery_date);
         if($date->year == Carbon::now()->year){
             $revenueCollect->push($order);
             $revenueYearly += $order->grand_total;
         }
       }
       return view('manage.revenueYear',['revenueCollect'=>$revenueCollect,'revenueYearly'=>$revenueYearly,'year'=>$year]);
       
    }

    public function filterCosts(Request $request){
      // $monthRequest;
      // $yearRequest;
      $year;
      $costCollect = collect();
      $costYearly = 0;
      $supplies = Supplies::where('status','Completed')->get();
      if(!$request->has('selectMonth') && !$request->has('selectYear')){

        return $this->costY();

      }else if($request->has('selectYear') && $request->has('selectMonth')){

        $year = new Carbon(''.$request->selectYear.'-'.$request->selectMonth.'');
        foreach($supplies as $supply){
          $date = new Carbon($supply->updated_at);
          if($date->year == $year->year){
            if($date->month == $year->month){
              $costCollect->push($supply);
              $costYearly += ($supply->expected_price * $supply->actual_quantity);
            }
          }
        }
        $year = $year->format('F Y');
      }else if($request->has('selectYear')){
        $year = $request->selectYear;
        foreach($supplies as $supply){
          $date = new Carbon($supply->updated_at);
          if($date->year == $year){
            $costCollect->push($supply);
            $costYearly += ($supply->expected_price * $supply->actual_quantity);
          }
        }
       
      }else if($request->has('selectMonth')){

        $year = new Carbon(''.Carbon::now()->year.'-'.$request->selectMonth.'');
        foreach($supplies as $supply){
          $date = new Carbon($supply->updated_at);
          if($date->year == $year->year){
            if($date->month == $year->month){
              $costCollect->push($supply);
              $costYearly += ($supply->expected_price * $supply->actual_quantity);
            }
          }
        }
        $year = $year->format('F Y');
      }

      // return view('manage.costYear',['year'=>$year]);
      return view('manage.costYear',['year'=>$year,'costCollect'=>$costCollect,'costYearly'=>$costYearly]);
    }


    public function filterRevenue(Request $request){
      // dd($request);
      $year;
      $revenueCollect = collect();
      $revenueYearly = 0;
      $orders = Orders::where('status','completed')->get();

      if(!$request->has('selectMonth') && !$request->has('selectYear')){
        return $this->revenueY();
      }else if($request->has('selectYear') && $request->has('selectMonth')){
        
        $year = new Carbon(''.$request->selectYear.'-'.$request->selectMonth.'');
        foreach($orders as $order){
          $date = new Carbon($order->delivery_date);
          if($date->year == $year->year){
            if($date->month == $year->month){
              $revenueCollect->push($order);
              $revenueYearly += $order->grand_total;
            }
          }
        }
        $year = $year->format('F Y');
        

      }else if($request->has('selectYear')){

        $year = $request->selectYear;
        foreach($orders as $order){
          $date = new Carbon($order->delivery_date);
          if($date->year == $year){
            $revenueCollect->push($order);
            $revenueYearly += $order->grand_total;
          }
        }
   

      }else if($request->has('selectMonth')){

        $year = new Carbon(''.Carbon::now()->year.'-'.$request->selectMonth.'');
        foreach($orders as $order){
          $date = new Carbon($order->delivery_date);
          if($date->year == $year->year){
            if($date->month == $year->month){
              $revenueCollect->push($order);
              $revenueYearly += $order->grand_total;
            }
          }
        }
        $year = $year->format('F Y');
      }
       return view('manage.revenueYear',['revenueCollect'=>$revenueCollect,'revenueYearly'=>$revenueYearly,'year'=>$year]);
    }

}
