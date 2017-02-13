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
//	Route::get('/', 'RegisterController@showRegistrationForm');
//	Route::post('/', 'RegisterController@register');
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


/******************** ...HRMS Employee Routes... **************/
Route::group(['prefix' => '/employee', 'namespace' => 'Pim'],function (){
    Route::get('/index','EmployeeController@index');
    Route::get('/add/{id?}','EmployeeController@showEmployeeForm');
    Route::post('/add','EmployeeController@addEmployee');
});

/******************** ...HRMS Emp Level Routes... **************/
Route::group(['prefix' => '/levels', 'namespace' => 'Pim'],function (){
    Route::get('/index','LevelController@index');
    Route::get('/add','LevelController@add');
    Route::post('/add','LevelController@create');
    Route::get('/edit/{id}','LevelController@edit');
    Route::post('/edit','LevelController@update');
    Route::get('/delete/{id}','LevelController@delete');
});

/******************** ...HRMS Emp Department Routes... **************/
Route::group(['prefix' => '/department', 'namespace' => 'Pim'],function (){
    Route::get('/index','DepartmentController@index');
    Route::get('/add','DepartmentController@add');
    Route::post('/add','DepartmentController@create');
    Route::get('/edit/{id}','DepartmentController@edit');
    Route::post('/edit','DepartmentController@update');
    Route::get('/delete/{id}','DepartmentController@delete');
});

/******************** ...HRMS Emp Designations Routes... **************/
Route::group(['prefix' => '/designation', 'namespace' => 'Pim'],function (){
    Route::get('/index','DesignationController@index');
    Route::get('/add','DesignationController@add');
    Route::post('/add','DesignationController@create');
    Route::get('/edit/{id}','DesignationController@edit');
    Route::post('/edit','DesignationController@update');
    Route::get('/delete/{id}','DesignationController@delete');
});

/********** ..End HRMS Routes.. *****************/
