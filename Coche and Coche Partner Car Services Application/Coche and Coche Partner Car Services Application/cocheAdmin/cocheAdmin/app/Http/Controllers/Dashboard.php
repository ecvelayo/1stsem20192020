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


class Dashboard extends BaseController
{

		public function boarddash(){

			$query = new ParseQuery('Partner');
			$query->equalTo("Status", 0);

			$result = $query->find();


			return view('dashboard')->with('result', $result);
		}

		public function home(){

				$query = new ParseQuery('Car');

			$response = $query->find();


		}
}

