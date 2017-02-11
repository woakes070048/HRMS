<?php
// Route::get('test',function(){
// 	$result = DB::table('packages')->get();
// 	foreach($result as $info){
// 		echo "['package_name'=>'".$info->package_name."',
// 		'package_details'=>'".$info->package_details."',
// 		'package_price'=>'".$info->package_price."',
// 		'package_duration'=>'".$info->package_duration."',
// 		'package_type'=>'".$info->package_type."',
// 		'package_sister_concern_limit'=>'".$info->package_sister_concern_limit."',
// 		'package_level_limit'=>'".$info->package_level_limit."',
// 		'package_user_limit'=>'".$info->package_user_limit."',
// 		'package_status'=>'".$info->package_status."',
// 		'package_created_by'=>'".$info->package_created_by."'],
// 		<br>";
// 	}
// });

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
Route::group(['prefix'=>'setup','namespace'=>'Setup','middleware'=>'auth:setup'], function(){
	Route::get('/','DashboardController@index');
});


/************* ...Setup Config Route... ******************/
Route::group(['prefix'=>'config','namespace'=>'Setup'], function(){
	Route::get('/', 'ConfigController@index');
	Route::post('/', 'ConfigController@config');
	Route::post('/get_package_info', 'ConfigController@get_package_info');
});


/************************************ ..End Setup System Route.. *********************************/







/************************************ ..Start HRMS Routes.. ***************************************/


/************ ...HRMS Login Route... ****************/
Route::group(['prefix' => '/','namespace'=>'Auth'], function(){
    Route::get('login','LoginController@showLoginForm');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout');

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
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


/************************************ ..End HRMS Routes.. ***************************************/
