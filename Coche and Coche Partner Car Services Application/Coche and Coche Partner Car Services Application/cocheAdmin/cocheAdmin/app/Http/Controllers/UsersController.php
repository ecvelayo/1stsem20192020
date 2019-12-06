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


class UsersController extends BaseController
{

		
		public function cochepartner(){

			$query = new ParseQuery('Partner');
			$query->equalTo("Status", 1);

			$result = $query->find();


			return view('cochepartner')->with('result', $result);
		}

		public function deniedpartner(){

			$query = new ParseQuery('Partner');
			$query->equalTo("Status", 2);

			$result = $query->find();


			return view('deniedpartner')->with('result', $result);
		}


}