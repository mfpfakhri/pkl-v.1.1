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
	
	//Agent
	Route::get('/agent', function(){
		return view('admin.agent');
	});
	
	//Dashboard
	Route::get('/dashboard', 'DashboardController@index');

	//CRUD Agent
	Route::get('/agent', 'AgentsController@showAll');
	Route::get('/agent/{id}','AgentsController@show');
	Route::post('/agent','AgentsController@storeByAdmin');

	Route::get('/agentcreate','AgentsController@createByAdmin');
	Route::post('/agentupdate/{id}','AgentsController@edit');
	Route::get('/agentdelete/{id}','AgentsController@destroy');

	//CRUD Customer
	Route::get('/addcustomer/', 'CustomerController@addNew');
	Route::post('/addcustomerprocess/', 'CustomerController@add');
	Route::get('/customer', 'CustomerController@showAll');
	Route::get('/customer/{id}', 'CustomerController@show');
	Route::post('/customerupdate/{id}', 'CustomerController@edit');
	Route::get('/customerdelete/{id}', 'CustomerController@destroy');

	//CRUD Product
	Route::get('/product', function(){
		return view('admin.product');
	});

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