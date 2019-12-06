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
use App\Http\Controllers\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Notifications\Notifiable;


class LoginController extends BaseController {


	public function loginnow(Request $request)
	{

		$username = $request->email;
		$password = $request->password;


		$query = new ParseQuery('admin');
		//$query->find();
		 $query->equalTo("username", $username);
 		 $query->equalTo("password", $password);


 		 	$results = $query->find();

			if ($results) {
				
				return redirect('/dashboard');

			}else{

				
			    return back()->withErrors([
	                'message' => 'Please check your credentials and try again.'
	            ])->withInput();

			
			}


	}

	public function logout(Request $request) {
  			Auth::logout();
  			return redirect('');
	}


}