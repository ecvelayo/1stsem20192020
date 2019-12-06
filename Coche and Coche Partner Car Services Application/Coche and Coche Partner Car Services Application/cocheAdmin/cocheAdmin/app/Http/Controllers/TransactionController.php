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


class TransactionController extends BaseController
{

		
		public function transactions(){

			$results1 = "";
			$fbid = "";
			$query = new ParseQuery('Reservation');
			// $query->equalTo("FBID", "Service");

			$result = $query->find();
		    $query1 = new ParseQuery('Users');
		    $results1 = $query1->find();

		    $query2 = new ParseQuery('Partner');
		    $results2 = $query2->find();
			


			return view('transactions', compact([ 
		            'result',
		            'results1',
		            'results2'
		            ]));  

			//return view('transactions')->with('result', $result, 'query', $query1);
		}


}