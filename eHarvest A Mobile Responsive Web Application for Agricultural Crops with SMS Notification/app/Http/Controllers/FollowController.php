<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Following;
use Auth;
use App\User;
class FollowController extends Controller
{
    public function followProduct(Request $request)
    {
        $followProduct = Following::where('product_id',$request->prodID)->where('user_id',Auth::user()->id)->first();
        $status;
        if($followProduct == null){
            $followProduct = new Following();
            $followProduct->user_id = Auth::user()->id;
            $followProduct->product_id = $request->prodID;
            $followProduct->save();
            $status = "Following";
        }else if($followProduct){
            Following::where('user_id',Auth::user()->id)->where('product_id',$request->prodID)->forceDelete();
            $status = "Follow";
        }
        return response()->json($status);
    }
}
