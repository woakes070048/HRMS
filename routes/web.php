<?php

/************ ...HRMS Login Route... ****************/
Route::group(['prefix'=>'/','namespace'=>'Auth'], function(){
	Route::get('login','LoginController@showLoginForm');
	Route::post('login', 'LoginController@login');
	Route::post('logout', 'LoginController@logout');

	//Password Reset Routes...
	Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm');
	Route::post('password/reset', 'ResetPasswordController@reset');
	Route::get('password/reset/{token?}', 'ResetPasswordController@showResetForm');
	Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
});

/***************** ...HRMS Dashboard Routes... ******************/
Route::group(['prefix'=>'/'], function(){
	Route::get('/','DashboardController@index');
});



// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm');
// Route::post('register', 'Auth\RegisterController@register');


// Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');


/***************** ..Setup System Route... *******************/

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
Route::group(['prefix'=>'setup','namespace'=>'Setup','middleware'=>'auth:setup'], function(){
	Route::get('/','DashboardController@index');
});




// Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');


/************* ...Setup Config Route... ******************/
Route::group(['prefix'=>'config','namespace'=>'Setup'], function(){
	Route::get('/', 'ConfigController@index');
	Route::post('/', 'ConfigController@config');
});

/************************************ ..End Setup System Route.. *********************************/