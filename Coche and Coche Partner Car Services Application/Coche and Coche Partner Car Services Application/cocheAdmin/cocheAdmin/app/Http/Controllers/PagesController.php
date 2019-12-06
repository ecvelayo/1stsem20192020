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


class PagesController extends BaseController {

	public function showWelcome()
	{

			// $query = new ParseQuery("Car");
			// $object = $query->get();

			$query = new ParseQuery('Car');

			$response = $query->find();

			dd($response);


// 	$query = new ParseQuery("Car");

// // Get a specific object:
// 		$object = $query->get("anObjectId");

// 		var_dump($object);

		// $object = ParseObject::create("TestObject");
		// $objectId = $object->getObjectId();
		// $php = $object->get("elephant");

		// // Set values:
		// $object->set("elephant", "php");
		// $object->set("today", new DateTime());
		// $object->setArray("mylist", [1, 2, 3]);
		// $object->setAssociativeArray(
		//   "languageTypes", array("php" => "awesome", "ruby" => "wtf")
		// );

		// // Save:
		// $object->save();

		//return View::make('index');
	}

}