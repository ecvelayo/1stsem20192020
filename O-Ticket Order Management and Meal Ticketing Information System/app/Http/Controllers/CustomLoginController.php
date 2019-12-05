<?php

namespace App\Http\Controllers;

use Validator, Input, Redirect;
use Illuminate\Http\Request;
use App\Order_Line_Item;
use App\Credit_History;
use App\Employee;
use App\Patron;
use App\Order;
use App\User;
use App\Item;
use Carbon;
use Auth;
use DB;
use App\Exports\adminExport;
use Maatwebsite\Excel\Facades\Excel;


class CustomLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function login(Request $request)
    {
        // dd($request->all());
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            $email = $request->input('email');
            $request->session()->put('email', $email);
            // $output = $request->session()->get('email');

            $user = new User;
            $user_type = DB::table('users')->where('email', $request->email)->value('user_type');
            $status = DB::table('users')->where('email', $request->email)->value('status');
            // USER TYPE
            // 0 for ADMIN
            // 1 for EMPLOYEE
            // 2 for PATRON

            if($user_type == 0 && $status != 0)
            {
                $users = DB::table('users_order')->get();
                $emp = User::all();
                $order = Order::all();
                $item = Item::all();
        

                return view('admin.index')
                    ->with('users', $users)
                    ->with('emp', $emp)
                    ->with('order', $order)
                    ->with('item', $item);
            }
            else if($user_type == 1 && $status != 0)
            {
                $user_id = DB::table('users')->where('email', $request->email)->value('user_id');
                $emp_type = DB::table('employee')->where('employee_id', $user_id)->value('emp_type');

                // EMPLOYEE USER TYPE
                // 1 for CASHIER
                // 2 for MARKETING & ACCOUNTING

                if($emp_type == 1)
                {
         
                    $users = DB::table('users_order')->get();
                    $emp = User::all();
                    $order = Order::all(); 
                    $credit = Credit_history::all();
                    
            
                    return view('cashier.home')
                        ->with('users', $users)
                        ->with('emp', $emp)
                        ->with('order', $order)
                        ->with('credit', $credit);

                }
                else if($emp_type == 2)
                {
                    $users = DB::table('users_order')->get();
                    $emp = User::all();
                    $order = Order::all();
                    $item = Item::all();


                    return view('marketing.index')
                        ->with('users', $users)
                        ->with('emp', $emp)
                        ->with('order', $order)
                        ->with('item', $item);

                } else if($emp_type == 3)
                {
                    $users = DB::table('users_order')->get();
                    $emp = User::all();
                    $order = Order::all();
                    $item = Item::all();
            

                    return view('eatery.home')
                        ->with('users', $users)
                        ->with('emp', $emp)
                        ->with('order', $order)
                        ->with('item', $item);
                } else if($emp_type == 3)
                {
                    $users = DB::table('users_order')->get();
                    $emp = User::all();
                    $order = Order::all();
                    $food = Food::all();
                    $drink = Drink::all(); 
            

                    return view('eatery.home')
                        ->with('users', $users)
                        ->with('emp', $emp)
                        ->with('order', $order)
                        ->with('food', $food)
                        ->with('drink', $drink);
                }
                else
                {
                     
                }

            }
            else if($user_type == 2 && $status != 0)
            {
                return view('driver.home');
            }
            else
            {
                return redirect()->back()->with('error', 'Login Failed! Account invalid or deactivated.');
            }
        }

        return redirect()->back()->with('error', 'Login Failed! Invalid Credentials');
    }
}
