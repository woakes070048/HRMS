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


/******************************* ..End Setup System Route.. **********************************/







/******************************* ..Start HRMS Routes.. ***************************************/


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


/******************** ...HRMS Employee Routes... **************/
Route::group(['prefix' => '/employee', 'namespace' => 'Pim'],function (){
    Route::get('/index','EmployeeController@index');
    Route::get('/view/{employee_no?}','EmployeeController@viewEmployeeProfile');
    Route::get('/add/{id?}/{tab?}','EmployeeController@showEmployeeAddForm');
    Route::post('/add','EmployeeController@addEmployee');
    Route::post('/add/{id}/personal/','EmployeeController@addPersonalInfo');
    Route::post('/add/{id}/education/','EmployeeController@addEducation');
    Route::post('/add/{id}/experience/','EmployeeController@addExperience');
    Route::post('/add/{id}/salary/','EmployeeController@addSalary');
    Route::post('/add/{id}/nominee/','EmployeeController@addNominee');
    Route::post('/add/{id}/training/','EmployeeController@addTraining');
    Route::post('/add/{id}/reference/','EmployeeController@addReference');
    Route::post('/add/{id}/children/','EmployeeController@addChildren');
    Route::post('/add/{id}/language/','EmployeeController@addLanguage');

    Route::get('/edit/{id}/{tab?}','EmployeeController@showEmployeeEditForm');
    Route::post('/edit/{id}','EmployeeController@editEmployee');
});


/******************** ...HRMS Emp Level Routes... **************/
Route::group(['prefix' => '/levels', 'namespace' => 'Pim'],function (){
    Route::get('/index','LevelController@index');
    Route::get('/add','LevelController@add');
    Route::post('/add','LevelController@create');
    Route::get('/edit/{id}','LevelController@edit');
    Route::post('/edit','LevelController@update');
    Route::post('/edit/info','LevelController@update_info');
    Route::get('/delete/{id}','LevelController@delete');
});


/******************** ...HRMS Emp Department Routes... **************/
Route::group(['prefix' => '/department', 'namespace' => 'Pim'],function (){
    Route::get('/index','DepartmentController@index');
    Route::post('/add','DepartmentController@create');
    Route::get('/edit/{id}','DepartmentController@edit');
    Route::post('/edit','DepartmentController@update');
    Route::get('/delete/{id}','DepartmentController@delete');
});


/******************** ...HRMS Emp Designations Routes... **************/
Route::group(['prefix' => '/designation', 'namespace' => 'Pim'],function (){
    Route::get('/index','DesignationController@index');
    Route::post('/add','DesignationController@create');
    Route::get('/edit/{id}','DesignationController@edit');
    Route::post('/edit','DesignationController@update');
    Route::get('/delete/{id}','DesignationController@delete');
});


/******************** ...HRMS Emp Designations Routes... **************/
Route::group(['prefix' => 'salaryInfo', 'namespace' => 'Pim'],function (){
    Route::get('/index','SalaryInfoController@index');
    Route::get('/getAllInfo','SalaryInfoController@getAllInfo');
    
    Route::post('/add','SalaryInfoController@create');
    Route::get('/edit/{id}','SalaryInfoController@edit');
    Route::post('/edit','SalaryInfoController@update');
    Route::get('/delete/{id}','SalaryInfoController@delete');
});



/******************** ...HRMS Common Function Routes... **************/
Route::group(['prefix' => '/'], function(){
    Route::get('get-employee-type','CommonController@getEmployeeType');
    Route::get('get-departments','CommonController@getDepartments');
    Route::get('get-levels','CommonController@getLevels');
    Route::get('get-designations','CommonController@getDesignations');
    Route::get('get-divisions','CommonController@getDivisions');
    Route::get('get-district-by-division/{id}','CommonController@getDistrictByDivision');
    Route::get('get-police-station-by-district/{id}','CommonController@getPolicStationByDistrict');
    Route::get('get-blood-groups','CommonController@getBloodGroups');
    Route::get('get-education-levels','CommonController@getEducationLevels');
    Route::get('get-institute-by-education-level/{id}','CommonController@getInstituteByEducationLevel');
    Route::get('get-degree-by-education-level/{id}','CommonController@getDegreeByEducationLevel');
    Route::get('get-banks','CommonController@getBanks');
    Route::get('get-level-salary-info/{id}','CommonController@getLevelSalaryInfoByUser');
    Route::get('get-allowance-by-ids/{ids}','CommonController@getAllowanceByIds');
    Route::get('get-allowance-notin-level','CommonController@getAllowanceNotinLevel');
    Route::get('get-language','CommonController@getLanguage');

    Route::post('add-designation','CommonController@addDesignation');
    Route::post('add-language','CommonController@addLanguage');

});


/********** ..End HRMS Routes.. *****************/
