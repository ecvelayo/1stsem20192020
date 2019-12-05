<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    public function login(Request $request)
    {
        // dd($request->all());

        
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]))
            $email = $request->input('email');
            $request->session()->put('email', $email);
            $output = $request->session()->get('email');

        {
            
            $user = new User;
            $user_type = DB::table('users')->where('email', $request->email)->value('user_type');
            // USER TYPE
            // 0 for ADMIN
            // 1 for EMPLOYEE
            // 2 for PATRON

            if($user_type == 0)
            {
                $users = DB::table('users_order')->get();
                $emp = User::all();
                $order = Order::all();
                $food = Food::all();
                $drink = Drink::all(); 
        

                return view('admin.index')
                    ->with('users', $users)
                    ->with('emp', $emp)
                    ->with('order', $order)
                    ->with('food', $food)
                    ->with('drink', $drink);
            }
            else if($user_type == 1)
            {
                $user_id = DB::table('users')->where('email', $request->email)->value('user_id');
                $emp_type = DB::table('employee')->where('employee_id', $user_id)->value('emp_type');

                // EMPLOYEE USER TYPE
                // 1 for CASHIER
                // 2 for MARKETING & ACCOUNTING

                if($emp_type == 1)
                {
                    
                    // $date = Carbon\Carbon::today('Asia/Singapore');
        
                    // $user = User::all();
                    // $orders = Order::all();


                    // //  $user = DB::table('patron')
                    // //         ->leftJoin('users', 'patron.patron_id', '=', 'user_id')
                    // //         ->get();
                    // //  $orders = DB::table('order')
                    // //              ->leftJoin('patron', 'patron.patron_id', '=', 'order.patron_id')->orderBy('order_id','desc')
                    // //              ->get();
            
                    // $credit = DB::table('credit_history')
                    //         ->leftJoin('users', 'credit_history.employee_id', '=', 'user_id')
                    //         ->get();
                    // // $credit = Credit_History::all();
                    // //   $aw = Patron::select('patron_id')->get();
                    // //   $wa = User::where('user_id', $aw)->get();                   
                    
                    // //  $orders = Order::with('patron')->get();
                    // // $result = $orders->$user;
                    // // return $orders;
                    // return view('cashier.home')->with('orders',$orders)->with('user',$user)->with('credit',$credit);

                    // $user = User::all();
                    $orders = DB::table('order')
                    ->leftJoin('credit_history', 'order.order_datetime', '=', 'datetime_earned')->orderBy('datetime_earned','asc')
                    ->get();
                    

                        $user = DB::table('patron')
                                ->leftJoin('users', 'patron.patron_id', '=', 'user_id')
                                ->get();
                        //  $orders = DB::table('order')
                        //              ->leftJoin('patron', 'patron.patron_id', '=', 'order.patron_id')->orderBy('order_id','desc')
                        //              ->get();
                
                    $credit = DB::table('credit_history')
                            ->leftJoin('users', 'credit_history.employee_id', '=', 'user_id')
                            ->get();
                    // $credit = Credit_History::all();
                    //   $aw = Patron::select('patron_id')->get();
                    //   $wa = User::where('user_id', $aw)->get();                   
                    
                    //  $orders = Order::with('patron')->get();
                    // $result = $orders->$user;
                    // return $orders;
                        return view('cashier.home')->with('orders',$orders)->with('user',$user)->with('credit',$credit);

                }
                else if($emp_type == 2)
                {
                    $users = DB::table('users_order')->get();
                    $emp = User::all();
                    return view('marketing.index')->with('users', $users)->with('emp', $emp);
                }
                else
                {
                     
                }

            }
            else if($user_type == 2)
            {
                return view('driver.home');
            }
            else
            {
                return redirect()->back()->with('error', 'Login Failed!');
            }
        }

        return redirect()->back()->with('error', 'Login Failed! Invalid Credentials');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
