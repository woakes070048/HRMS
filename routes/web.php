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
Route::group(['prefix'=>'setup','namespace'=>'Setup'], function(){

    Route::get('/','DashboardController@index');
    Route::get('/home','DashboardController@index');
    Route::get('/details/{id}','UserDetailsController@index');
});

/*************** ... Setup Admin Sister Concern Routes... **************/
Route::group(['prefix'=>'setup/concern','namespace'=>'Setup'], function(){
	
	Route::get('/add','SisterConcernController@add');
	Route::post('/create','SisterConcernController@create');
});

/************* ...Setup Admin Config Route... ******************/
Route::group(['prefix'=>'config','namespace'=>'Setup'], function(){
	Route::get('/', 'ConfigController@index');
	Route::post('/', 'ConfigController@config');
	Route::post('/get_package_info', 'ConfigController@get_package_info');
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


/******************* ...HRMS Switch Account... ************************/
Route::group(['prefix' => '/switch','namespace' => 'Auth'],function(){
    Route::post('/account/{database_name}/{config_id}','SwitchAccountController@switchAccount');
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

    Route::get('/edit/{id}/{tab?}','EmployeeController@showEmployeeEditForm');
    Route::get('/edit/tab/{data_tab}/{data_id}','EmployeeController@getDataByTabAndId');
    Route::post('/edit/{userId}','EmployeeController@editEmployee');

    Route::get('/delete/{id}','EmployeeController@deleteEmployee');
    Route::post('/status-change','EmployeeController@statusChange');

    Route::post('/add/{userId}/personal/','EmployeeController@addPersonalInfo');
    Route::post('/edit/{userId}/personal','EmployeeController@editPersonalInfo');

    Route::post('/add/{userId}/education/','EmployeeController@addEditEducation');
    Route::post('/edit/{userId}/education','EmployeeController@addEditEducation');
    Route::delete('/delete/{id}/education','EmployeeController@deleteEmployeeData');

    Route::post('/add/{userId}/experience/','EmployeeController@addEditExperience');
    Route::post('/edit/{userId}/experience','EmployeeController@addEditExperience');
    Route::delete('/delete/{id}/experience','EmployeeController@deleteEmployeeData');

    Route::post('/add/{userId}/salary/','EmployeeController@addSalary');
    Route::post('/edit/{userId}/salary','EmployeeController@editSalary');

    Route::post('/add/{userId}/nominee/','EmployeeController@addEditNominee');
    Route::post('/edit/{userId}/nominee/','EmployeeController@addEditNominee');
    Route::delete('/delete/{id}/nominee/','EmployeeController@deleteEmployeeData');

    Route::post('/add/{userId}/training/','EmployeeController@addEditTraining');
    Route::post('/edit/{userId}/training/','EmployeeController@addEditTraining');
    Route::delete('/delete/{id}/training','EmployeeController@deleteEmployeeData');

    Route::post('/add/{userId}/reference/','EmployeeController@addEditReference');
    Route::post('/edit/{userId}/reference/','EmployeeController@addEditReference');
    Route::delete('/delete/{id}/reference/','EmployeeController@deleteEmployeeData');

    Route::post('/add/{userId}/children/','EmployeeController@addEditChildren');
    Route::post('/edit/{userId}/children/','EmployeeController@addEditChildren');
    Route::delete('/delete/{id}/children/','EmployeeController@deleteEmployeeData');

    Route::post('/add/{userId}/language/','EmployeeController@addEditLanguage');
    Route::post('/edit/{userId}/language/','EmployeeController@addEditLanguage');
    Route::post('/delete/{id}/language/','EmployeeController@deleteEmployeeData');

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


/******************** ...HRMS Emp SalaryInfo Routes... **************/
Route::group(['prefix' => 'salaryInfo', 'namespace' => 'Pim'],function (){
    Route::get('/index','SalaryInfoController@index');
    Route::get('/getAllInfo','SalaryInfoController@getAllInfo');
    Route::post('/add','SalaryInfoController@create');
    Route::get('/edit/{id}','SalaryInfoController@edit');
    Route::post('/edit','SalaryInfoController@update');
    Route::get('/delete/{id}/{indexId}','SalaryInfoController@delete');
});

/******************** ...HRMS Emp Units Routes... **************/
Route::group(['prefix' => 'unit', 'namespace' => 'Pim'],function (){
    Route::get('/index','UnitController@index');
    Route::get('/getUnits','UnitController@getUnits');
    Route::post('/add','UnitController@create');
    Route::post('/edit','UnitController@update');
    Route::get('/delete/{id}/{indexId}','UnitController@delete');
});

/******************** ...HRMS Emp Settings Routes... **************/
Route::group(['prefix' => 'settings', 'namespace' => 'Setting'],function (){
    Route::get('/index','SettingsController@index');
    Route::get('/getSettings','SettingsController@getSettings');
    Route::post('/add','SettingsController@create');
    Route::post('/edit','SettingsController@update');
});

/******************** ...HRMS Emp Units Routes... **************/
Route::group(['prefix' => 'branch', 'namespace' => 'Pim'],function (){
    Route::get('/index','BranchController@index');
    Route::get('/getBranch','BranchController@getBranch');
    Route::post('/add','BranchController@create');
    Route::post('/edit','BranchController@update');
    Route::get('/delete/{id}/{indexId}','BranchController@delete');
});

/******************** ...HRMS Emp promotion/transfer Routes... **************/
Route::group(['prefix' => '/promotion', 'namespace' => 'Pim'],function (){
    Route::get('/index','PromotionController@index');
    Route::get('/getPromotionsData','PromotionController@getPromotionsData');
    Route::get('/getSingelUser/{id}','PromotionController@getSingelUser');
    // Route::get('/add','PromotionController@add');
    // Route::post('/add','PromotionController@create');
    // Route::get('/edit/{id}','PromotionController@edit');
    // Route::post('/edit','PromotionController@update');
    // Route::post('/edit/info','PromotionController@update_info');
    // Route::get('/delete/{id}','PromotionController@delete');
});



/******************** ...HRMS Common Function Routes... **************/
Route::group(['prefix' => '/'], function(){
    Route::get('get-employee-type','CommonController@getEmployeeType');
    Route::get('get-employee','CommonController@getEmployee');
    Route::get('get-departments','CommonController@getDepartments');
    Route::get('get-levels','CommonController@getLevels');
    Route::get('get-branches','CommonController@getBranches');
    Route::get('get-units','CommonController@getUnits');
    Route::get('get-designations','CommonController@getDesignations');
    Route::get('get-unit-by-designation-id/{id}','CommonController@getUnitByDesignationId');
    Route::get('get-supervisor-by-designation-id/{id}','CommonController@getSupervisorByDesignationId');
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
    Route::get('get-allowance-notin-level/{ids?}','CommonController@getAllowanceNotinLevel');
    Route::get('get-language','CommonController@getLanguage');
    Route::get('get-religions','CommonController@getReligions');

    Route::post('add-designation','CommonController@addDesignation');
    Route::post('add-language','CommonController@addLanguage');

});


/********** ..End HRMS Routes.. *****************/
