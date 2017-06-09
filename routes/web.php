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

Route::group(['middleware' => 'admin'], function(){	
	//Dashboard
	Route::get('/dashboard', 'DashboardController@index');

	//CRUD Agent
	Route::get('/agent', 'AgentsController@showAll');
	Route::get('/agent/{id}','AgentsController@show');
	Route::get('/agentcreate','AgentsController@createByAdmin');
	Route::post('/agent','AgentsController@storeByAdmin');
	Route::post('/agentupdate/{id}','AgentsController@edit');
	Route::get('/agentdelete/{id}','AgentsController@destroy');

	//CRUD Customer
	Route::get('/customer', 'CustomerController@showAll');
	Route::get('/customer/{id}', 'CustomerController@show');
	Route::get('/customercreate', 'CustomerController@createByAdmin');
	Route::post('/customer', 'CustomerController@storeByAdmin');
	Route::post('/customerupdate/{id}', 'CustomerController@edit');
	Route::get('/customerdelete/{id}', 'CustomerController@destroy');

	//CRUD Product
	Route::get('/product', 'PaketController@showAll');
	Route::get('/product/{id}', 'PaketController@show');
	Route::get('/productcreate', 'PaketController@createByAdmin');
	Route::post('/product', 'PaketController@storeByAdmin');
	Route::post('/product/{id}', 'PaketController@edit');
	Route::get('/productdelete/{id}', 'PaketController@destroy');

});

//Agent
	Route::get('/dashboardagent', function(){
		return view('agent.dashboardAgent');
	});

//Product
	Route::get('/productagent', function(){
		return view('agent.productAgent');
	});

//Booking
	Route::get('/bookingagent', function(){
		return view('agent.BookingAgent');
	});

//Create and register Agent
Route::get('/registeragent', 'AgentsController@index');
Route::post('/registeragentprocess', 'AgentsController@register');
Route::get('/createagent/{id}', 'AgentsController@create');
Route::post('/createagentprocess/{id}', 'AgentsController@store');

//Create and register Customer
Route::get('/registercustomer', 'CustomerController@index');
Route::post('/registercustomerprocess', 'CustomerController@register');
Route::get('/createcustomer/{id}', 'CustomerController@create');
Route::post('/createcustomerprocess/{id}', 'CustomerController@store');

//Create product
Route::get('/createproduct', 'PaketController@index');
Route::post('/createproduct/submit', 'PaketController@store');

Route::get('/', 'WelcomeController@index');
Route::get('/listing', 'WelcomeController@index');
Route::post('/listing', 'WelcomeController@show');

Route::get('/verify/{ver_token}/{id}','Auth\RegisterController@verify_register');

Auth::routes();

Route::get('/home', 'HomeController@index');

// Manage Profile
Route::get('/booking', function () {
    return view('bookingform');
});