<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//ADMIN, LEVEL 0
Route::group(['middleware' => 'admin'], function(){

	//Dashboard
	Route::get('/dash', 'Admin\DashboardController@index');

	//CRUD Agent
	//tampil semua record
	Route::get('/dash/agents', 'Admin\AgentsController@showAll');
	//form create agent
	Route::get('/dash/agentcreate','Admin\AgentsController@createByAdmin');
	//store ke database
	Route::post('/dash/agents','Admin\AgentsController@storeByAdmin');
	//edit record
	Route::get('/dash/agent/{id}/edit','Admin\AgentsController@editByAdmin');
	//update record
	Route::PUT('/dash/agent/{id}/update','Admin\AgentsController@updateByAdmin');
	//hapus record
	Route::get('/dash/agentdelete/{id}','Admin\AgentsController@destroy');
	//approve
	Route::get('/dash/agents/{id}/approve','Admin\AgentsController@approve');
	//show alasan rejcet
	Route::get('/dash/agents/{id}/showreject','Admin\AgentsController@showreject');
	//post rejcet
	Route::post('/dash/agents/{id}/reject','Admin\AgentsController@reject');


	//CRUD Customer
	//tampil semua record
	Route::get('/dash/customers', 'Admin\CustomersController@showAll');
	//form create
	Route::get('/dash/customercreate/', 'Admin\CustomersController@createByAdmin');
	//store ke database
	Route::post('/dash/customers', 'Admin\CustomersController@storeByAdmin');
	//edit record
	Route::get('/dash/customer/{id}/edit','Admin\CustomersController@editByAdmin');
	//update record
	Route::PUT('/dash/customer/{id}/update','Admin\CustomersController@updateByAdmin');
	//hapus record
	Route::get('/dash/customerdelete/{id}', 'Admin\CustomersController@destroy');

	//CRUD Product
	//tampil semua record
	Route::get('dash/products', 'Admin\PaketController@showAll');
	//form create
	Route::get('dash/productcreate', 'Admin\PaketController@createByAdmin');
	//store ke db
	Route::post('dash/products', 'Admin\PaketController@storeByAdmin');
	//edit record
	Route::get('/dash/product/{id}/edit','Admin\PaketController@editByAdmin');
	//update record
	Route::PUT('/dash/product/{id}/update','Admin\PaketController@updateByAdmin');
	//hapus record
	Route::get('/dash/productdelete/{id}', 'Admin\PaketController@destroy');

});

//CUSTOMER, LEVEL 1
Route::group(['middleware' => 'customer'], function(){
	//lengkapiDataSetelahVerif
	Route::get('/{id}/customer/completing', 'Customer\LengkapiDataController@edit');
	Route::PUT('/{id}/customer', 'Customer\LengkapiDataController@update');

	// Manage Profile
	Route::get('/{id}/customer/showedit', 'Customer\EditProfilController@edit');
	Route::PUT('/{id}/update', 'Customer\EditProfilController@update');

	//Booking
	Route::get('/booking/{id}/{query2}', 'BookingController@create');
	//coba
	Route::post('/createbooking/{idpaket}/{iduser}', 'BookingController@store');
	//akhircoba

});

//AGENT, LEVEL 2
Route::group(['middleware' => 'agent'], function(){
	//lengkapiDataSetelahVerif
	Route::get('/{id}/agent/completing', 'Agent\LengkapiDataController@edit');
	Route::PUT('/{id}/agent', 'Agent\LengkapiDataController@update');

	//Agent
	Route::get('/dashboardagent', 'Agent\DashboardController@index');

	//Product
	//tampil semua record
	Route::get('/productagent', 'Agent\ProductController@showAll');
	//form create
	Route::get('/productcreate', 'Agent\ProductController@create');
	//store ke database
	Route::post('/productagent', 'Agent\ProductController@store');
	//edit
	Route::get('/product/{id}/edit', 'Agent\ProductController@edit');
	//update
	Route::PUT('/product/{id}/update', 'Agent\ProductController@update');
	//delete
	Route::get('/productdelete/{id}', 'Agent\ProductController@destroy');

	//Booking
	Route::get('/bookingagent', 'Agent\BookingController@index');
	//show approve
	Route::get('/bookingagent/{id}/showapprove','Agent\BookingController@showapprove');
	//post approve
	Route::post('/bookingagent/{id}/approve','Agent\BookingController@approve');
	//show alasan rejcet
	Route::get('/bookingagent/{id}/showreject','Agent\BookingController@showreject');
	//post rejcet
	Route::post('/bookingagent/{id}/reject','Agent\BookingController@reject');
});

Route::get('/', 'WelcomeController@index');
Route::post('/mail/{pakets}', 'BookingController@mail');
Route::get('/listing', 'WelcomeController@show');
Route::get('/detail/{id}', 'ListingController@detail');
// Route::get('/booking/{id}/NULL', 'BookingController@create');
// Route::get('/booking/{id}/{query2}', 'BookingController@create');
// Route::post('/booking', 'BookingController@mail');

Route::get('/verify/{ver_token}/{id}','Auth\RegisterController@verify_register');

Auth::routes();
