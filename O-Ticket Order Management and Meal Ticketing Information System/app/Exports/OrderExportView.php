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

class OrderExportView implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $en = Carbon::today()->toDateString();
        // $users = DB::table('users_order')->get();
        // $emp = User::all();
        // $order = Order::all();
        // $item = Item::all();

            return view('cashier.table', [
                'users' =>  DB::table('users_order')->where('date_redeemed', $en)->get(),
                'emp'   =>  User::all(),
                'order' =>  Order::all(),
                'item'  =>  Item::all()
                
               ]);
    }

}
