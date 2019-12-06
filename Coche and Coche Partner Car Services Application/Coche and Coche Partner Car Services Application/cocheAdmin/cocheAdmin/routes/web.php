<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });




//Route::any('/', "PagesController@showWelcome");

Route::view('/', "homepage");



Route::any('logout', 'Auth\LoginController@logout');

Route::any('/dashboard', "Dashboard@boarddash");

Route::any('/loginnow', "LoginController@loginnow");

Route::any('/cochepartner', "UsersController@cochepartner");

Route::any('/transactions', "TransactionController@transactions");

Route::post('/approved', "ApprovedPartner@approved");

Route::any('/deniedpartner', "UsersController@deniedpartner");



Route::group(['middleware' =>'auth'], function()
{



});