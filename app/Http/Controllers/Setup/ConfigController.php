<?php

namespace App\Http\Controllers\Setup;


// model class
use App\Models\User;
use App\Models\Setup\UserEmails;
use App\Models\Setup\Config;
use App\Models\Setup\User as SetupUser;

// form validation class
use App\Http\Requests\ConfigRequest;

// laravel service class
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class ConfigController extends Controller
{
    /**
     * ConfigController constructor.
     */
    public function __construct(){
    	$this->middleware('auth:setup');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
    	Artisan::call('db:connect');
    	return view('setup.config');
    }


    /**
     * @param ConfigRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function config(ConfigRequest $request){

    	$database_name = $this->makeDatabaseName($request->company_name);

    	try{
	    	DB::beginTransaction();

            $setup_user = SetupUser::create([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'email'         => $request->email,
                'password'      => bcrypt($request->password),
                'mobile_number' => $request->mobile_number,
            ]);

	    	$config = Config::create([
	    			'user_id'           => $setup_user->id,
	    			'company_name'      => $request->company_name,
	    			'company_address'   => $request->company_address,
	    			'database_name'     => $database_name,
                    'package_end_date'  => Carbon::now()->addDays(30),
	    		]);

	    	UserEmails::create([
	    			'config_id' => $config->id,
	    			'email' => $request->email,
	    		]);


			if(!DB::statement('CREATE DATABASE IF NOT EXISTS '.$database_name)){
                Artisan::call('db:connect');
                DB::rollback();
                $request->session()->flash('danger','Application setup not success!');
                return back();
            }
			
	    	Artisan::call("db:connect", ['database'=> $database_name]);
	    	Artisan::call("migrate:hrms");

	    	User::create([
	    			'employee_id'    => '0-00',
	    			'designation_id' => 1,
	    			'first_name'     => $request->first_name,
	    			'last_name'      => $request->last_name,
	    			'email'          => $request->email,
	    			'password'       => bcrypt($request->password),
	    			'mobile_number'  => $request->mobile_number,
	    		]);

	    	DB::commit();

	    	$request->session()->flash('success','Application successfully setup!');

	    }catch(\Exception $e){
	    	Artisan::call('db:connect');
	    	DB::rollback();

	    	Artisan::call('db:connect', ['database'=> $database_name]);
	    	Artisan::call("migrate:hrms:rollback");
	    	DB::statement('DROP DATABASE IF EXISTS '.$database_name);

	    	$request->session()->flash('danger','Application setup not success!');
	    }

    	return back();
    }


    /**
     * @param $database
     * @return mixed
     */
    private function makeDatabaseName($database){
    	if(stristr($database,' ')){
    		$database = str_replace(' ', '_', $database);
    		if(stristr($database,'-')){
    			$database = str_replace(' ', '_', $database);
    		}
    	}
    	return $database;
    }


}
