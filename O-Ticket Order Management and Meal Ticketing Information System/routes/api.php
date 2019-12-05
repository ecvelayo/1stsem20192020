<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('profile/{id}','nameController@show');
Route::get('creditHistory/{id}','nameController@showCredit');
Route::get('vehicleinfo/{id}', 'nameController@show3');
Route::get('creditList/{id}', 'nameController@show_Credit_List');
Route::get('datehist/{id}', 'namecontroller@show_date_List');
Route::get('food/{id}', 'nameController@showFood');
Route::get('drink/{id}', 'nameController@showDrink');
Route::get('snack/{id}', 'nameController@showSnack');
Route::get('coffee/{id}', 'nameController@showCoffee');
Route::get('pending/{id}', 'nameController@pending');
Route::get('history/{id}', 'nameController@history');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('insertOrder', 'nameController@insertOrder');
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
