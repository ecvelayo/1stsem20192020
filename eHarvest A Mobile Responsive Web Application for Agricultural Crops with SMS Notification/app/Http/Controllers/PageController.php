<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Orders;
use App\Unit;
use App\Type;
use App\News;
use Auth;

class PageController extends Controller
{
    //methods to be called to routes/web.php

     //method for  display home page
    public function index (Request $request){

      $products = Product::orderBy('product_name', 'asc')
              ->where('product_name', 'like', '%' . $request->searchProduct . '%')
              ->where('types_id', 'like', '%' . $request->selectType . '%')
              ->where('price', '>', 0)
              ->where('quantity', '>', 0)
              ->Paginate(1000);
      $units = Unit::all();
      $types = Type::all();
      $news = News::all();
      $msg1 = "";

      if($products->isEmpty() == true){
        $products = Product::orderBy('product_name', 'asc')
        ->where('price', '>', 0)
        ->where('quantity', '>', 0)
                ->Paginate(1000);

        $tempUnit = Type::where('id', $request->selectType)->value('name');

        // alert()->error('No products with type ' . (string)$tempUnit . " found!")->autoclose(3500);

        $msg1 = "No products found!";
      }

        return view('homes.home')->with('Product', $products)->with('units', $units)->with('news', $news)->with('types', $types)->withErrors([$msg1]);
    }



    //method for  display sales page
    public function sales(){

        return view('sales.sales');
    }

    //method for  display tracking page
    public function tracking(){
        $title = "welcome to eharvest Tracking";
        return view('track.tracking')->with('title',$title);
    }

    //method for orders page
     public function orders(){
        // $title = "admin Order";
        $data = Orders::Paginate(5);

        return view('manage.orders')->withData($data);
    }


    //method for orders page
    public function track(){
        // $title = "admin Order";
        $data = Orders::Paginate(5);

        return view('track.tracking')->withData($data);
    }


    //method for sales page
    public function addProduct(){
        $title = "welcome to eharvest Sell";
        return view('pages.addProduct')->with('title',$title);
    }


    //method for  display product info
    public function productInfo(){
        $title = "welcome to eharvest Sell";
        return view('pages.productInfo')->with('title',$title);
    }

   //method for  display supply
    public function supply(){

        return view('manage.supply');
    }

      //method for  display invoice
      public function invoice(){

        return view('sales.invoice');
    }

    public function contact(){

        return view('contact');
    }   
    

    public function tc(){

        return view('tc');
    }


        



    //method for  display profile

    public function profile(){

        return view('pages.profile');
    }


    public function notification(){

        return view('notification.notification');
    }



    //method for  display shopping basket
    // public function shoppingBasket(){
    //     $title = "welcome to eharvest Sell";
    //     return view('basket.shoppingBasket')->with('title',$title);
    // }



}
