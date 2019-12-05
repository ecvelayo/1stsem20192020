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


/* Auth */
    Auth::routes();

// Route::group(['middleware' => ['web', 'auth']], function(){
    /* Custom Login */
    Route::post('/login/custom', [
        'uses' => 'CustomLoginController@login',
        'as' => 'login.custom'
    ]);
    
    Route::get('/', function () { 
        return view('welcome');
    });
    
    
    // Route::get('/redeem', 'CashierPagesController@redeem');
    
    // Route::get('/admin', 'AdminPagesController@index');
    // Route::get('/admin/home','AdminPagesController@home');
    
    //CASHIER stuff
    Route::get('/cashier', 'CashierPagesController@home');
    
    
    //CASHIER Read Orders/landing page
    Route::get('/cashier/home', 'CashierPagesController@home');
    
    //CASHIER EXCEL
    Route::get('/cashier/export', 'CashierPagesController@export')->name('cashier.export');
    
    /* CASHIER Driver Registration */
    Route::get('/cashier/registerDriver', 'CashierPagesController@driverviewReg');
    Route::post('/cashier/registerDriver', 'CashierPagesController@registerDriver');
    
    
    /* CASHIER Conductor Registration */ 
    Route::get('/cashier/registerConductor', 'CashierPagesController@conductorviewReg');
    Route::post('/cashier/registerConductor', 'CashierPagesController@registerConductor');
    
    //CASHIER Meal redeem
    Route::get('/cashier/redeemMeal', 'CashierPagesController@redeemMeal');
    Route::post('/cashier/redeemMeal', 'CashierPagesController@submitRedeemed');
    
    //CASHIER Meal redeem request
    Route::get('/cashier/redeem_request', 'CashierPagesController@redeemRequest');
    Route::get('/cashier/redeem_accept/{id}', 'CashierPagesController@redeemAccept');
    Route::post('/cashier/redeem_accept/{id}', 'CashierPagesController@redeemAccept');
    Route::get('/cashier/redeem_delete/{id}', 'CashierPagesController@redeemDelete');
    
    
    //CASHIER Register Request
    Route::get('/cashier/cashier_request', 'CashierPagesController@regRequest');
    Route::get('/cashier/cashier_activate_request/{id}', 'CashierPagesController@updateRequest');
    Route::get('/cashier/cashier_delete_request/{id}', 'CashierPagesController@deleteRequest');
    
    //EATERY stuff
    Route::get('/eatery', 'EateryPagesController@home');
    Route::get('/eatery/home', 'EateryPagesController@home');
    Route::get('/eatery/weekly', 'EateryPagesController@weekly');
    Route::get('/eatery/export', 'EateryPagesController@export')->name('eatery.export');
    
    //EATERY Add Meal
    Route::get('/eatery/addMeal', 'EateryPagesController@addMeal');
    Route::post('/eatery/addMeal', 'EateryPagesController@addMealSubmit');
    
    //EATERY Meal Redeem request
    Route::get('/eatery/redeem_req', 'EateryPagesController@redeemReq');
    Route::get('/eatery/redeem_accept/{id}', 'EateryPagesController@redeemAccept');
    Route::post('/eatery/redeem_accept/{id}', 'EateryPagesController@redeemAccept');
    Route::get('/eatery/redeem_delete/{id}', 'EateryPagesController@redeemDelete');
    
    //EATERY Meal edit
    Route::get('/eatery/foodEdit', 'EateryPagesController@FoodDrinkEdit');
    Route::get('/eatery/foodChange/{id}', 'EateryPagesController@foodChange');
    // Route::get('/eatery/drinkChange/{id}', 'EateryPagesController@drinkChange');
    
    Route::resource('AdminPages', 'AdminPagesController');
    Route::resource('CashierPages', 'CashierPagesController');
    Route::resource('EateryPages', 'EateryPagesController');
    Auth::routes();
    
    //ADMIN
    Route::get('/admin', 'AdminPagesController@index')->name('index');
    Route::get('/admin/addAccount', 'AdminPagesController@addAccount')->name('add_account');
    Route::get('/admin/driver', 'AdminPagesController@driverRegistration')->name('driver_registration');
    Route::get('/admin/conductor', 'AdminPagesController@conductorRegistration')->name('conductor_registration');
    Route::get('/admin/employee', 'AdminPagesController@employeeRegistration')->name('employee_registration');
    Route::get('/admin/manage', 'AdminPagesController@manageAccounts')->name('manage_accounts');
    Route::get('/admin/meal', 'AdminPagesController@addMeal')->name('add_meal');
    Route::get('/admin/branch', 'AdminPagesController@addBranch')->name('add_branch');
    Route::get('/admin/request', 'AdminPagesController@request')->name('request');
    Route::get('/admin/requestDriver/{id}', 'AdminPagesController@requestDriver')->name('request_driver');
    Route::get('/admin/reports', 'AdminPagesController@reports')->name('reports');
    Route::get('/user/profile/{id}', 'AdminPagesController@userProfile')->name('user_profile');
    Route::get('/user/edit/{id}', 'AdminPagesController@userProfileEdit')->name('user_edit');
    Route::get('/admin/export', 'AdminPagesController@adminExport')->name('admin_export');
    Route::get('/admin/redeem', 'AdminPagesController@redeem')->name('redeem');
    Route::post('/admin/redeemMeal', 'AdminPagesController@redeemMeal')->name('redeem_meal');
    Route::get('/admin/itemList', 'AdminPagesController@itemList')->name('item_list');
    Route::get('/admin/deactivateItem/{id}', 'AdminPagesController@deactivateItem')->name('deactivate_item');
    Route::get('/admin/activateItem/{id}', 'AdminPagesController@activateItem')->name('activate_item');
    Route::get('/admin/changePassword/{id}', 'AdminPagesController@changePassword')->name('change_password');
    Route::post('/admin/changePasswordProc/{id}', 'AdminPagesController@changePasswordProc')->name('change_passwordProc');
    
    
    
    //MARKETING
    Route::get('/marketing', 'MarketingAccountingPagesController@index');
    Route::get('/marketing/weekly', 'MarketingAccountingPagesController@weekly');
    Route::get('/marketing/export', 'MarketingAccountingPagesController@export')->name('marketing.export');
    
    
    // Route::get('/home', 'HomeController@index')->name('home');
    
    /* Controller for Registrations */
    Route::post('/employee', 'RegistrationsController@storeEmployee')->name('employee');
    Route::post('/driver', 'RegistrationsController@storeDriver')->name('driver');
    Route::post('/conductor', 'RegistrationsController@storeConductor')->name('conductor');
    Route::post('/branch', 'RegistrationsController@storeBranch')->name('branch');
    Route::post('/meal', 'RegistrationsController@storeMeal')->name('meal');
    Route::get('/activate_request/{id}', 'RegistrationsController@updateRequest')->name('activate_request');
    Route::get('/delete_request/{id}', 'RegistrationsController@deleteRequest')->name('delete_request');
    Route::get('/deactivate_account/{id}', 'RegistrationsController@deactivateAccount')->name('deactivate_account');
    Route::get('/deactivate/profile/{id}', 'RegistrationsController@deactivateProfile')->name('deactivate_profile');
    Route::put('/request/driver/{id}', 'RegistrationsController@requestDriver')->name('request_driver');
    Route::put('/edit/employee/{id}', 'RegistrationsController@editProfileEmployee')->name('edit_profile_employee');
    Route::put('/edit/driver/{id}', 'RegistrationsController@editProfileDriver')->name('edit_profile_driver');
    Route::put('/edit/conductor/{id}', 'RegistrationsController@editProfileConductor')->name('edit_profile_conductor');


// });