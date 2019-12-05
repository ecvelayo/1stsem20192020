<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Item;
use App\Exports\MarketingWeeklyExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DB;

class MarketingAccountingPagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('marketing');
    }

    public function index(){

        $users = DB::table('users_order')->get();
        $emp = User::all();
        $order = Order::all();
        $item = Item::all();


        return view('marketing.index')
            ->with('users', $users)
            ->with('emp', $emp)
            ->with('order', $order)
            ->with('item', $item);
    }
    public function weekly(){
        
        $en = Carbon::now()->locale('en_US');
        $ar = Carbon::now()->locale('ar');

        $start = $en->startOfWeek(Carbon::SUNDAY);
        $end = $en->endOfWeek(Carbon::SATURDAY);

        $users = DB::table('users_order')->get();
        $emp = User::all();
        $orders = Order::whereBetween('order_datetime', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $item = Item::all();
        
        return view('marketing.weekly')
            ->with('users', $users)
            ->with('emp', $emp)
            ->with('orders', $orders)
            ->with('item', $item);
    }
    public function export(){
        return Excel::download(new MarketingWeeklyExport, "WeeklyReport.csv");
    }
}
