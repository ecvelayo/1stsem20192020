<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Product;
use App\Cart;
Use App\Orders;
use Carbon\Carbon;
Use App\Basket;
Use App\Notifications\SystemNotification;
Use App\Notifications\orderMade;
Use Auth;
use App\User;
use App\Events\orderPlaced;
use Illuminate\Support\Facades\Notification;
use App\Delivery_Fee;
use Illuminate\Support\Facades\Validator;
use \StdClass;
class BasketController extends Controller
{
    //
    public function store(Request $request)
    {

      request()->validate([
        'quantity' => 'required|numeric|integer|min:0|not_in:0',
      ],
        [
          'quantity.required' => 'please fill up this field',
          'quantity.numeric' => 'must be a number',
          'quantity.min' => 'must be more than 0',
          'quantity.not_in' => 'must be more than 0',
        ]);
      $product = Product::find($request->id);
      $request->input( 'name' );
      // $product = Product::find(2);
      // dd($product);
      // dd($request);
      // // dd($request->input( 'id' ));
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->add($product->id,$request->price,$request->quantity);

      if($cart->items[$request->id]['qty'] > $product->quantity){
        return response()->json(['stock_error'=> "Insufficient stocks"]);
      }else{
        $request->session()->put('cart',$cart);
      }




      $prod = Product::where('id', $request->id)->value('product_name');

      alert()->success('Added ' . $request->quantity . ' ' . $prod . '(s) to basket')->autoclose(2500);


      // dd($request->session()->get('cart'));
      // return redirect('/home');


//       $basic  = new \Nexmo\Client\Credentials\Basic('7ce90ae4', 'a0NwlCRcbx2BxeOt');
// $client = new \Nexmo\Client($basic);

// $message = $client->message()->send([
//     'to' => '639055626875',
//     'from' => 'eharvest',
//     'text' => 'Hello from eharvest test 2'
// ]);


      // $us = App\User::find(1);
      // $us->notify(new SystemNotification());
      // Auth::user()->notify(new SystemNotification($product));

      return response()->json($product);

    }

    public function getBasket()
    {
      $delivery_fee = Delivery_Fee::first();
      if(!Session::has('cart')){
        return view('basket.shoppingBasket',['products' => null]);
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      $totalPrice = $cart->totalPrice;
      if($totalPrice < 1000){
        $totalPrice += $delivery_fee['price'];
      }
      return view('basket.shoppingBasket',['products' => $cart->items, 'totalPrice' => $totalPrice, 'delivery_fee' => $delivery_fee]);
    }

    public function checkoutBasket(Request $request)
    {


        request()->validate([
          'delivery_place' => 'required|',
          'grandTotal' => 'numeric|min:300'
        ],
        [
          'delivery_place.required' => 'Please fill up this field',
          'grandTotal.min' => 'Orders must be worth ₱300 or more',

        ]);

        $cartz = Session::get('cart');
       foreach($cartz->items as $cartsz){

        if($cartsz['qty'] > $cartsz['item']['quantity']){
          return response()->json(['stock_error'=> "Product ".$cartsz['item']['product_name']. " is greater than our available ".$cartsz['item']['product_name']." stocks"]);
        }
       }

        $order = new Orders;
        $order->user_id = $request->userid;

        //
        $order->order_code = "EH_OC-".str_random(5);
        $order->status = "for approval";
        $order->order_datetime = Carbon::now()->toDateTimeString();
        $order->obtaining_method = $request->obtainingMethod;
        $order->delivery_fee = $request->deliveryFee;
        $order->delivery_place = $request->delivery_place;
        $order->delivery_date = null;
        $order->grand_total = $request->grandTotal;
        $order->created_at = Carbon::now()->toDateTimeString();
        $order->save();

        alert()->success('A text message will be sent to you once your ordered has been accepted.', 'Items from basket succesfully checked out.')->autoclose(20000);


        // put order to pusher notification
        // User::find($order->user_id)->notify(new SystemNotification($order));


        // User::find($order->user_id)->notify(new orderMade($order));


        // add to basket database
        $cart = Session::get('cart');

        foreach($cart->items as $carts){
          $basket = new Basket;
          $basket->orders_id = $order->id;
          $basket->product_id = $carts['item']['id'];
          $basket->quantity = $carts['qty'];
          $prod = Product::find($basket->product_id);
          $prod->quantity -= $basket->quantity;
          $prod->save();
          $basket->price_at_current_order = $carts['item']['price'];
          $basket->created_at = Carbon::now()->toDateTimeString();
          $basket->save();
        }
        $request->session()->forget('cart');
        $countsa = count(auth()->user()->unreadNotifications);

         event(new orderPlaced($order));
        // return response()->json($order);
        // return response()->json(['success'=>'Got Simple Ajax Request.']);

    }

    public function deleteItem(Request $request)
    {
      $oldcart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldcart);
      $cart->removeItem($request->id);

      $prod = Product::where('id', $request->id)->value('product_name');

      alert()->success('Removed ' . $prod . '(s) from your basket')->autoclose(2500);

      if($cart->totalQty<=0){
        $request->session()->forget('cart');
        // $request->session()->forget('cart');
        return response()->json("QTY=0");
      }else{
        Session::put('cart',$cart);
        return response()->json("QTY>0");
      }

    }
    public function homeAddToCart(Request $request)
    {

      request()->validate([
        'qty' => "required|numeric|integer|min:0|not_in:0|max:$request->stocks",
      ],
        [
          'qty.required' => '*please fill up this field',
          'qty.numeric' => '*must be a number',
          'qty.min' => '*must be more than 0',
          'qty.not_in' => '*must be more than 0',
          'qty.max' => '*quantity must be lesser or equal to stocks',

        ]);

      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $productAdded = Product::find($request->prodID);
      $cart = new Cart($oldCart);
      $cart->add($request->prodID,$request->price,$request->qty);

      if($cart->items[$request->prodID]['qty'] > $productAdded->quantity){
        return response()->json(['stock_error'=> "Insufficient stocks"]);
      }else{
        $request->session()->put('cart',$cart);
      }


      $prod = Product::where('id', $request->prodID)->value('product_name');

      alert()->success('Added ' . $request->qty . ' ' . $prod . '(s) to basket')->autoclose(2500);

      return response()->json($request);
    }
    public function test(Request $request)
    {

      return response()->json($request);

    }

    public function updateShoppingBasket(Request $request)
    {
      request()->validate([
        'quantity' => 'required|numeric|integer|min:0|not_in:0',
      ],
      [
        'quantity.required' => 'Please fill up this field',
        'quantity.numeric' => 'Must be numeric',
        'quantity.min' => 'Cannot be negative value',
        'quantity.not_in' => 'Cannot be 0',
      ]);

      $cart = Session::get('cart');

      $prodID = $request->productID;

      if($request->quantity > $cart->items[$prodID]['item']['quantity']){
        return response()->json(['stock_error'=> "Insufficient stocks"]);
      }else{
        $totalPrice = 0;
        $totalQty =0;
        $cart->items[$prodID]['qty'] = $request->quantity;
        $cart->items[$prodID]['price'] = ($request->quantity * $cart->items[$prodID]['item']['price']);
        foreach($cart->items as $carts){
          $totalPrice += $carts['price'];
          $totalQty += $carts['qty'];
        }
        $cart->editTotalPrice($totalPrice);
        $cart->editTotalQty($totalQty);
        $request->session()->put('cart',$cart);
      }

      //  foreach($cartz->items as $cartsz){

      //   if($cartsz['qty'] > $cartsz['item']['quantity']){
      //     return response()->json(['stock_error'=> "Product ".$cartsz['item']['product_name']. " is greater than our available ".$cartsz['item']['product_name']." stocks"]);
      //   }
      //  }
      return response()->json($request);
    }
}
