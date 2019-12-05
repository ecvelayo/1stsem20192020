<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\User;
use App\Item;
use App\Order;

class adminExport implements FromView
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

         // $users = DB::table('users_order')->get();
        // $emp = User::all();
        // $order = Order::all();
        // $item = Item::all();
        return view('admin.table', [
            'users' => DB::table('users_order')->get(),
            'emp' => User::all(),
            'order' => Order::all(),
            'item' => Item::all()
           ]);
    }
}
