<?php

namespace App\Exports;

use App\Order;
use App\User;
use App\Credit_history;
use App\Patron;
use App\Item;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class MarketingWeeklyExport implements FromView
{
 
    public function view(): View
    {
        $en = Carbon::now();
        $start = $en->startOfWeek(Carbon::SUNDAY)->toDateString();
        $end = $en->endOfWeek(Carbon::SATURDAY)->toDateString();
        // $orders = DB::table('order')
        //         ->leftJoin('credit_history', 'order.order_datetime', '=', 'datetime_earned')->orderBy('datetime_earned','asc')
        //         ->get();

        // $user = DB::table('patron')
        //         ->leftJoin('users', 'patron.patron_id', '=', 'user_id')
        //         ->get();


         // $users = DB::table('users_order')->get();
        // $emp = User::all();
        // $order = Order::all();
        // $item = Item::all();
               return view('marketing.table', [
                'users' =>  DB::table('users_order')->whereBetween('date_redeemed', [$start, $end])->get(),
                'emp'   =>  User::all(),
                'order' =>  Order::all(),
                'item'  =>  Item::all()
                
               ]);
    }

// //     public function headings(): array
// //     {
// //         return [
// //             'Name',
// //             'Customer Type',
// //             'Passengers',
// //             'Time redeemed'
// //         ];
//     }
}
