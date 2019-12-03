<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use App\Unit;
use App\Product;
use App\Http\Controllers\ProductsController;
use RealRashid\SweetAlert\Facades\Alert;

class UnitsController extends Controller
{
    //
    public function store(Request $request)
    {
      $u = Unit::where('name', $request->unitName)->first();
      request()->validate([
        'unitName' => 'required|',
      ],
        [
          'unitName.required' => 'please fill up this field',
        ]);

        request()->validate([
            // 'delivery_charge_change' => 'required|numeric|min:0|not_in:0',
            'unitName' => 'required',
          ],
            [
              // 'delivery_charge_change.required' => 'please fill up this field',
              // 'delivery_charge_change.numeric' => 'must be numeric',
              // 'delivery_charge_change.min' => 'must be positive',
              // 'delivery_charge_change.not_in' => 'cannot be zero',

              'unitName.required' => 'please fill up this field',

            ]);

        if($u){
          alert()->error("$request->unitName already exists as a unit. Please try again.")->autoclose(3500);
        }else{

        $unit = new Unit;
        $unit->name = $request->unitName;
        $unit->save();

        alert()->success('Successfully Added New Product Unit.')->autoclose(3500);
      }


        return response()->json($request);


    }

    public function addUnitName(Request $request)
    {
      request()->validate([
        // 'delivery_charge_change' => 'required|numeric|min:0|not_in:0',
        'unitName' => 'required|numuric|min:0|not_in:0',
      ],
        [
          // 'delivery_charge_change.required' => 'please fill up this field',
          // 'delivery_charge_change.numeric' => 'must be numeric',
          // 'delivery_charge_change.min' => 'must be positive',
          // 'delivery_charge_change.not_in' => 'cannot be zero',

          'unitName.required' => 'please fill up this field',
          'unitName.numeric' => 'must be numeric',
          'unitName.min' => 'must be positive',
           'unitName.not_in' => 'cannot be zero',
        ]);


        // config(['pickup.delivery_fee' => 45]);

      return response()->json($request);


    }



    public function index(){
        $unit = Unit::all();

        $this->ProductsController->index($unit);
    }
}
