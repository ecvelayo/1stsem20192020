<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Inventory;
use App\Orders;
use App\Unit;
use App\Type;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon;
use App\Following;
use Auth;
use App\User;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');

    }



    public function create()
    {
        return view('manage.addProduct');
    }



    public function store (Request $request)
    {
        $disk = Storage::disk('gcs');
        $imagePath = $request->file('product_photo');
        $storagePath = $disk->put('product/photos', $imagePath);

        $product = new Product;
        $product->product_name = $request->input('product_name');
        $product->types_id = $request->input('product_type');
        $product->product_description = $request->input('product_description');
        $product->quantity = '0';
        $product->price = null;
        $product->units_id = $request->input('unit');
        $product->photo = $disk->url($storagePath);
        $product->save();

        alert()->success('Successfully Added New Product')->autoclose(3500);
        return redirect('/product');
    }



    //for joining with inventory class
    public function inventory(){
        return $this->belongsTo('App\Inventory');
    }



    public function index (Request $request)
    {
        $msg = "";
        $data = Product::orderBy('product_name', 'asc')
                ->where('product_name', 'like', '%' . $request->searchProduct . '%')
                ->Paginate(10);
        $units = Unit::all();
        $types = Type::all();

        if($data->isEmpty() == true){
          $msg = "No products found!";
          alert()->error('No products found!')->autoclose(3500);
        }

        if(Auth::user()->type == 'Admin' || Auth::user()->type == 'Farmer'){

          return view('manage.product')->with('data', $data)->with('units', $units)->with('types',$types)->withErrors([$msg]);
        }
        else{
          alert()->error('You are not allowed to access that page!')->autoclose(5000);
          return redirect('/home');
        }
    }

    public function filterProducts (Request $request)
    {
        $msg = "";
        $data = Product::orderBy('product_name', 'asc')
                ->where('types_id', 'like', '%' . $request->selectType . '%')
                ->where('units_id', 'like', '%' . $request->selectUnit . '%')
                ->Paginate(10)->appends('selectUnit',$request->selectUnit)->appends('selectType',$request->selectType);
        $units = Unit::all();
        $types = Type::all();

        if($data->isEmpty() == true){
          $msg = "No products found!";
          alert()->error('No products found!')->autoclose(3500);
        }

        if(Auth::user()->type == 'Admin' || Auth::user()->type == 'Farmer'){

          return view('manage.product')->with('data', $data)->with('units', $units)->with('types',$types)->withErrors([$msg]);
        }
        else{
          alert()->error('You are not allowed to access that page!')->autoclose(5000);
          return redirect('/home');
        }
    }


    public function productInfo ($id){

        $prod = Product::where('id', $id)->get();
        $followed = Following::where('user_id',Auth::user()->id)->where('product_id',$id)->first();
        return view('pages.productInfo',['prod'=>$prod,'followed'=>$followed,'prodid'=>$id]);
    }


    public function productDet (Request $request){
        $prod = Product::where('id', $request->id)->get();
        return response()->json(["prod" => $prod]);
    }



    public function restock (Request $request, $id){

      $temp = Inventory::where('product_id', $id)->value('quantity');

        $updateDetails = [
            'quantity' => (int) $temp + $request->input('quantity2'),
            'date_stocked' => $request->input('date_stocked'),
        ];

        Inventory::where('product_id', $id)->update($updateDetails);

        alert()->success('Successfully Updated Product')->autoclose(2500);

        return redirect("/productInfo/".$id."");
    }



    public function priceUpdate(Request $request)
    {

      request()->validate([
        'srp2' => 'required|min:0|numeric',
        'markup2' => 'required|min:1|numeric|max:100',
      ],
        [
          'srp2.required' => 'must not be empty',
          'srp2.min' => 'must not be negative',
          'srp2.numeric' => 'please input a number',
          'markup2.required' => 'must not be empty',
          'markup2.min' => 'must not be negative or 0',
          'markup2.numeric' => 'please input a number',
          'markup2.max' => 'must not exceed 100',
        ]);

      $name = Product::where('id', $request->id)->value('product_name');

      $percentage = $request->markup2 / 100;

      $sellingPrice = $request->srp2 * ($percentage + 1);

      Product::where('id', $request->id)->update(['srp' => $request->srp2, 'markup' => $percentage, 'price' => $sellingPrice]);

      alert()->success('Successfully changed ' . $name . ' price to ₱' . $sellingPrice . '.')->autoclose(10000);


      // if ($price > 0)
      // {
      //   Product::where('id', $request->id)
      //           ->update(['price' => $price]);
      //
      //       alert()->success('Successfully change price for ' . $name . ' to ₱' . $price . '.')->autoclose(2500);
      // }
      // else if($price == '')
      // {
      //   alert()->error('Price field should not be left empty. Please try again.')->autoclose(2500);
      // }
      // else {
      //   alert()->error('Price should be higher than 0!')->autoclose(2500);
      // }

      // alert()->success('test ' . $name . 'test2 ' . $price. '!')->autoclose(2500);

    }



    public function delete(Request $request){

        Product::destroy($request->id);
        alert()->success('Deleted Successfully')->autoclose(2500);

      }


        public function sampleAddProduct(Request $request)
        {

          request()->validate([
            'photo' => 'required|image|mimes:jpeg,png',
            'product_description' => 'required',
            'product_name' => 'required',
            'product_type' => 'required',
            'unit' => 'required',
            // 'srp' => 'required|numeric|min:0',
            'markup' => 'required|numeric|min:1'
          ],
            [
              'photo.required' => 'please fill up this field',
              'photo.image' => 'must be an image file',
              'photo.mimes' => ' must be in jpeg or png format',
              'product_description.required' => 'please fill up this field',
              'product_name.required' => 'please fill up this field',
              'product_type.required' => 'please fill up this field',
              'unit.required' => 'please fill up this field',
              // 'srp.required' => 'please fill up this field',
              // 'srp.numeric' => 'please only enter numbers',
              // 'srp.min' => 'must not be negative',
              'markup.required' => 'please fill up this field',
              'markup.numeric' => 'please only enter numbers',
              'markup.min' => 'must not be negative or 0',
            ]);

            $t = Type::where('id', $request->product_type)->value('name');
            $u = Unit::where('id', $request->unit)->value('name');



            $percentage = $request->markup / 100;

            $arr = [];
            $i=0;
            foreach($request->all() as $req){
              $arr[$i] = $req;
              $i++;
            }

            $sampleProduct = Product::where('product_name',$arr[1])->where('types_id',$request->product_type)->where('units_id',$request->unit)->first();
            if($sampleProduct){
              alert()->error("A product with name " . $request->product_name . ", type " . $t . " and unit " . $u . " already exists. Please try again!", "Product already exists!")->autoclose(3500);
            }else{
              $disk = Storage::disk('gcs');
              $imagePath = $request->file('photo');
              $storagePath = $disk->put('product/photos', $imagePath);

              $product = new Product;
              $product->product_name = $arr[1];
              $product->types_id = $request->product_type;
              $product->product_description = $arr[6];
              $product->quantity = '0';
              $product->markup = $percentage;
              $product->srp = 0;          // for suggested retail price
              $product->price = $request->srp * ($percentage + 1);        // for selling price
              $product->units_id = $request->unit;
              $product->photo = $disk->url($storagePath);
              $product->save();

              alert()->success('A new product has been successfully created!')->autoclose(3500);
            }

          return $request;

        }





    public function updateProductStock(Request $request)
    {
      request()->validate([
        'prod_stock' => 'required|numeric|min:0|',
      ],
        [
          'prod_stock.required' => 'please fill up this field',
          'prod_stock.numeric' => 'must be numeric',
          'prod_stock.min' => 'must be positive',

        ]);
        $product = Product::find($request->id);
        $product->quantity = $request->prod_stock;
        $product->save();
        alert()->success('Successfully change quantity stock for ' . $product->product_name . ' to ' . $request->prod_stock . '.')->autoclose(2500);
      return response()->json($request);
    }

}
