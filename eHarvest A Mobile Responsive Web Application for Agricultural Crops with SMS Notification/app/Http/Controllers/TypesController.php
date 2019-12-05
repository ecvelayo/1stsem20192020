<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use App\Type;
use App\Product;
use App\Http\Controllers\ProductsController;
use RealRashid\SweetAlert\Facades\Alert;

class TypesController extends Controller
{
    //
    public function store(Request $request){

        request()->validate([
            // 'delivery_charge_change' => 'required|numeric|min:0|not_in:0',
            'typeName' => 'required',
          ],
            [
              // 'delivery_charge_change.required' => 'please fill up this field',
              // 'delivery_charge_change.numeric' => 'must be numeric',
              // 'delivery_charge_change.min' => 'must be positive',
              // 'delivery_charge_change.not_in' => 'cannot be zero',

              'typeName.required' => 'please fill up this field',

            ]);

        $t = Type::where('name', $request->typeName)->first();

        if($t){
          alert()->error("$request->typeName already exists as a product type. Please try again.")->autoclose(3500);
        }else{

        $type = new Type;
        $type->name = $request->typeName;
        $type->save();

        alert()->success('Successfully Added New Product Type.')->autoclose(3500);
      }

        // return redirect('/product');
    }




    public function index(){
        $type = Type::all();

        $this->ProductsController->index($type);
    }
}
