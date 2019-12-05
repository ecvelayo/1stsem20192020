<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\medical_service;

class HomeController extends Controller
{
    public function index()
    {
        $data = medical_service::all();

        return view('home', compact('data'));
    }
}
