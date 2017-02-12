<?php

Route::get('testing', 'Auth\LoginController@testing');

/***************** ...Setup Login Routes... ******************/
Route::group(['prefix'=>'setup','namespace'=>'Setup\Auth'], function(){
	Route::get('login', 'LoginController@showLoginForm');
	Route::post('login', 'LoginController@login');
	Route::post('logout', 'LoginController@logout');

	//Password Reset Routes...
	Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm');
	Route::post('password/reset', 'ResetPasswordController@reset');
	Route::get('password/reset/{token?}', 'ResetPasswordController@showResetForm');
	Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
});


/*************** ...Setup Registration Routes... *****************/
Route::group(['prefix'=>'signup','namespace'=>'Setup\Auth'], function(){
	Route::get('/', 'RegisterController@showRegistrationForm');
	Route::post('/', 'RegisterController@register');
});


/***************** ...Setup Dashboard Routes... ******************/
Route::group(['prefix'=>'setup','middleware'=>'auth:setup'], function(){

	Route::get('/', function(){

		if(Auth::user()->user_type == 1){
			return redirect('setup/admin/home');
		}
		elseif(Auth::user()->user_type == 2){
			return redirect('setup/user/home');
		}
	});
});

Route::group(['prefix'=>'setup/admin','namespace'=>'Setup','middleware'=>'auth:setup'], function(){

	Route::get('/home','DashboardController@index');
	Route::get('/details/{id}','UserDetailsController@index');
});

/*************** ... Setup Admin Sister Concern Routes... **************/
Route::group(['prefix'=>'setup/admin/concern','namespace'=>'Setup','middleware'=>'auth:setup'], function(){
	
	Route::get('/add','SisterConcernController@add');
	Route::post('/create','SisterConcernController@create');
});

/************* ...Setup Admin Config Route... ******************/
Route::group(['prefix'=>'config','namespace'=>'Setup'], function(){
	Route::get('/', 'ConfigController@index');
	Route::post('/', 'ConfigController@config');
	Route::post('/get_package_info', 'ConfigController@get_package_info');
});

Route::group(['prefix'=>'setup/user','namespace'=>'Setup\User','middleware'=>'auth:setup'], function(){

	Route::get('/home','UserSetupDashboardController@index');
	Route::get('concern/add','UserSisterConcernController@add');
	Route::post('concern/create','UserSisterConcernController@create');
});


/******** ..End Setup System Route.. *********/







/******** ..Start HRMS Routes.. **************/


/************ ...HRMS Login Route... ****************/
Route::group(['prefix' => '/','namespace'=>'Auth'], function(){
    Route::get('login','LoginController@showLoginForm');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout');

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm');
    Route::post('password/reset', 'ResetPasswordController@reset');
});


/***************** ...HRMS Dashboard Routes... ******************/
Route::group(['prefix' => '/'], function(){
    Route::get('/','DashboardController@index');
});


/***************** ...HRMS Dashboard Routes... ******************/
Route::group(['prefix' => '/'], function(){
    Route::get('/','DashboardController@index');
});


/******************** ... HRMS Employee Routes... **************/
Route::group(['prefix' => '/employee', 'namespace' => 'Pim'],function (){
    Route::get('/index','EmployeeController@index');
    Route::get('/add','EmployeeController@add');
});


/********** ..End HRMS Routes.. *****************/
