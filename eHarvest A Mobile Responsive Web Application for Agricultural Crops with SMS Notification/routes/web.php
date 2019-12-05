<?php
use Illuminate\Support\Facades\Input;
use App\Orders;
use App\User;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Following;
use App\Transactions;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'PageController@index')->name('home');



//route for the side nav menu ('/"filename', controller file name @ method from Http/Controllers/PageController.php )
//Route::get('/', 'PageController@index');
Route::get('/home', 'PageController@index')->name('home');
Route::get('/buy', 'PageController@buy');


//for invoice page
Route::get('/invoice', 'PageController@invoice');
Route::get('/contact', 'PageController@contact');
Route::get('/tc', 'PageController@tc');

//for dashboard page
Route::get('/dashboard', 'NewsController@dashboard');
Route::get('/getUsersOverview', 'NewsController@getUsersOverview');
Route::get('/news', 'NewsController@news');
Route::post('/sampleAddNews','NewsController@sampleAddNews');
Route::post('/deleteNews','NewsController@deleteNews');
Route::get('/getYearGraph','NewsController@getYearGraph');
Route::get('/cost','NewsController@cost');
Route::get('/revenue','NewsController@revenue');
Route::get('/costY','NewsController@costY');
Route::get('/revenueY','NewsController@revenueY');
Route::get('/profit','NewsController@profit');
Route::get('/filterCosts','NewsController@filterCosts');
Route::get('/filterRevenue','NewsController@filterRevenue');
//Notification page
Route::get('/notification', 'PageController@notification');
Route::post('/markAsRead', 'NotificationsController@markAsRead');

//chart
Route::get('/sales', 'ChartDataController@sales');
Route::get('/get-post-chart-data', 'ChartDataController@getMonthlyProducts');
// Route::get('/sales', 'ChartDataController@getMonthlyProducts');



//orders
Route::get('/getBasketOrders','OrdersController@getBasketOrders');
Route::get('/orders', 'OrdersController@getAllOrders');
Route::post('/confirmOrder', 'OrdersController@confirmOrders');
Route::post('/completeOrder','OrdersController@completeOrder');
Route::post('/cancelOrder','OrdersController@cancelOrder');
Route::get('/orderSearch', 'OrdersController@orderSearch');
Route::get('/orderFilter', 'OrdersController@filterOrders');
Route::post('/declineAnOrder','OrdersController@declineAnOrder');
//deliver
Route::get('/delivery', 'TransactionsController@viewDelivery');
Route::get('/getDeliveryDetails', 'TransactionsController@getDeliveryDetails');
Route::post('/completeDelivery', 'TransactionsController@completeDelivery');
Route::get('/searchDelivery', 'TransactionsController@searchDelivery');
Route::get('/filterDelivery', 'TransactionsController@filterDelivery');
Route::post('/declineADelivery','TransactionsController@declineADelivery');
//changing delivery charge
Route::post('/updateDeliveryCharge','TransactionsController@updateDeliveryCharge');




Route::get('/addProduct', 'PageController@addProduct');
//end of side nav route menu

// for following products
Route::post('/followProduct','FollowController@followProduct');
// for products
Route::get('/product', 'ProductsController@index');
Route::get('/filterProducts', 'ProductsController@filterProducts');
Route::get('/createProduct', 'ProductsController@create');
Route::post('/store','ProductsController@store');

Route::get('productInfo/{id}', [
    "uses" => 'ProductsController@productInfo',
    "as" => 'productInfo'
]);

Route::get('/productDet', 'ProductsController@productDet');
Route::post('/priceUpdate', 'ProductsController@priceUpdate');
Route::post('/delete', 'ProductsController@delete');
Route::post('/restock/{id}', 'ProductsController@restock');
Route::get('/productDet', 'ProductsController@productDet');
Route::post('/updateProductStock', 'ProductsController@updateProductStock');

// for users
Route::get('/users', 'UsersController@index');
Route::get('/searchUsers', 'UsersController@searchUsers');
Route::get('/filterUsers', 'UsersController@filterUsers');
Route::get('/profile', 'UsersController@show');
Route::post('/update', 'UsersController@update');
Route::post('/changePP', 'UsersController@changePP');
Route::get('/showDetails', 'UsersController@showDetails');
Route::post('/edit', 'UsersController@edit');

// for cart or basket

Route::get('/shoppingBasket', 'BasketController@getBasket');
Route::post('/reserve','BasketController@store');
Route::post('/checkout', 'BasketController@checkoutBasket');
Route::get('/deleteFromCart','BasketController@deleteItem');
Route::post('/homeAddToCart','BasketController@homeAddToCart');
Route::post('/updateShoppingBasket', 'BasketController@updateShoppingBasket');
// for add units
Route::post('/unit', 'UnitsController@store');

//for add types
Route::post('/types', 'TypesController@store');




//track
Route::get('/tracking', 'OrdersController@viewOrdersAsAdmin');
Route::get('/searchTrack', 'OrdersController@searchTracking');
Route::get('/filterTrack', 'OrdersController@filterTracking');


//for testing sessions
Route::get('/sampleTest','BasketController@test');


//for changing password
// Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changedPassword','HomeController@changePassword');

//for supplies
Route::post('/addSupply', 'SuppliesController@addSupply');
Route::post('/acknowledgeSupply', 'SuppliesController@acknowledgeSupply');
Route::post('/declineSupplyQuery', 'SuppliesController@declineSupplyQuery');
Route::get('/supply', 'SuppliesController@getSupply');
Route::get('/getSupplyDetails', 'SuppliesController@getSupplyDetails');
Route::post('/supplyAction', 'SuppliesController@supplyAction');
Route::get('/searchSupply', 'SuppliesController@searchSupply');
Route::get('/filterSupply', 'SuppliesController@filterSupply');
Route::post('/sampleAddProduct', 'ProductsController@sampleAddProduct');
Route::post('/declineASupply','SuppliesController@declineASupply');

Route::post('/getYearMonth','ChartDataController@getYearMonth');
Route::get('/testss',function(){
    $a = Session::get('cart');
    dd($a);
    $orders = Orders::find(1);
    $earningsOverview = ['January'=>0,'February'=>0,'March'=>0,'April'=>0,'May'=>0,'June'=>0,'July'=>0,'August'=>0,'September'=>0,'October'=>0,'November'=>0,'December'=>0];
    $date = new Carbon($orders->delivery_date);
    $earningsOverview[$date->format('F')] += 25;
    dd($earningsOverview);
    dd($date->format('F'));
    $overview = ['Admin'=>0,'User'=>1];

    dd($overview);
    $orders = Orders::where('status','for approval')->get();
    // $date = new Carbon($orders[0]->order_datetime);
    // if($date->month == Carbon::now()->month){
    //     dd("this month");
    // }else{
    //     dd("not this month");
    // }
    $monthly = 0;
    foreach($orders as $order){
        $date = new Carbon($order->delivery_date);
        if($date->month == Carbon::now()->month){
            $monthly += $order->grand_total;
        }
    }
    dd($monthly);
    dd($orders);
    $month =$date->month;
    $year = $date->year;

    dd(App\Delivery_Fee::first());
    dd(Transactions::all()->sortByDesc('created_at')->paginate(5));
    $email = Session::get('cart');
    dd($email);

    $items = null;
        $orders = Orders::all();
        // dd($orders->products[0]->pivot['quantity']);
        $storedItem = ['qty' =>0];

        $asd = 1;
        foreach($orders as $order){
            $date = new Carbon($order->delivery_date);
            $month = $date->month;
            $year = $date->year;
            if($order->status == "completed" && $month == 11 && $year = 2019){
                $asd++;
                // foreach($order->products as $prod){

                //     if($items){
                //         if(array_key_exists($prod->product_name,$items)){
                //             $storedItem = $items[$prod->product_name];
                //         }
                //     }
                //     $storedItem['qty'] += $prod->pivot['quantity'];
                //     $items[$prod->product_name] = $storedItem;
                //     $storedItem['qty'] = 0;
                // }


            }

        }
        dd($asd);

        // $storedItem = ['qty' =>0, 'name'=>null];


        // foreach($orders as $order){

        //     if($order->status == "completed"){

        //         foreach($order->products as $prod){

        //             if($items){
        //                 if(array_key_exists($prod->id,$items)){
        //                     $storedItem = $items[$prod->id];
        //                 }
        //             }
        //             $storedItem['qty'] += $prod->pivot['quantity'];
        //             $storedItem['name'] = $prod->product_name;
        //             $items[$prod->id] = $storedItem;
        //             $storedItem['qty'] = 0;
        //         }


        //     }

        // }
        // dd($items);




    if($a->isEmpty()){
        dd("wai sud");
    }else{
        dd("naai sud");
    }
    dd(Following::where('user_id',1)->where('product_id',2)->get());
    dd(Carbon::now()->toDateTimeString());
    $or = Orders::find(1);

    $message = 1;
    if($or->status == "for delivery"){
        $message = "Your order with an order code of has been accepted. To be delivered on September";
    }else if($or =="cancelled"){
        $message = "Your order with an order code of has been declined.";
    }else if($or->status == "for approval"){
        $message = "Piste";
    }
    dd($message);
    dd(config('pickup.pickup_place'));
    dd(User::where("type","Consumer")->get());
    return view('test');
    $samp = count(auth()->user()->unreadNotifications);

    dd($samp);
    // $notifications = auth()->user()->unreadNotifications;
    // foreach($notifications as $notification){
    //     dd($notification->data['product']['product_name']);
    // }
    // dd(str_random(5));
    $adminData = Orders::simplePaginate(5);
    // $data = Orders::orderBy('id','desc')simplePaginate(5);
        $data = Orders::all();
        $datas = Orders::simplePaginate(5);
        $col = collect();
        foreach($data as $try){
            if($try->users['id']==Auth::user()->id){
                $col->push($try);
            }
        }
        $collection = $col->paginate(3);
        // $collect->paginate(5);
        // $hey = Orders::all();
        // $samp = $hey->where($hey->users['id'],Auth::user()->id);
        // $filtered = $collection->where('price', 100);
        // $col->paginate(5);
        $page = collect([1, 2, 3, 4, 5, 6, 7, 8, 9]);
        $pages = $page->paginate(5);

        dd($collection,$pages);
        dd(["data"=>$data,"datas"=>$datas,"collect"=>$collect]);

});
