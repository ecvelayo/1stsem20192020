<?php

namespace App\Http\Controllers;


use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Notifications\Notifiable;



class ApprovedPartner extends BaseController
{

		public function approved(Request $request){

			if($request['buttonapproved'] == 1){
				$query = new ParseObject('Partner', $request['fbid']);
				$query->set("Status",1);
				$query->save();
				 return redirect()->back()->with('alert', 'Approved');
			}else{
				$query = new ParseObject('Partner', $request['fbid']);
				$query->set("Status",2);
				$query->save();
				return redirect()->back()->with('alert', 'Denied!');
			}
			       
		}
}
