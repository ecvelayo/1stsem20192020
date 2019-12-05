<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Calendar;
use App\Users;
use App\User_roles;
use App\Departments;
use App\Events;
use App\Patients;
use App\Interventions;
use App\Patient_Event_List;
use App\Transfer_Requests;
use Hash;
use Session;
use PDF;

class ReportController extends Controller
{
	public function index(){

			retrun view('PdfDemo');
	}

	public function samplePDF(){

			$html_content = '<h1>Generate a PDF using TCPDF in laravel </h1>
					<h4>by<br/>Learn Infinity</h4>';

			PDF::setTitle('Sample PDF');
			PDF::AddPage();
			PDF::writeHTML($html_content, true, false, true, false,'');

			PDF::Output('SamplePDF.pdf')
	}
}