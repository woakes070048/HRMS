<?php

namespace App\Http\Controllers\Setup;

// form validation class
use App\Http\Requests\AddSisterConcern;

// model class
use App\Models\User;
use App\Models\Setup\UserEmails;
use App\Models\Setup\Config;
use App\Models\Setup\Package;

// laravel service class
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Session;

class SisterConcernController extends Controller
{
    public function __construct(){
        $this->middleware('auth:setup');
    }

    public function add(){

    	$data['title'] = "Add Concern-HRMS";

    	return view('setup.sisterConcern.addSisterConcern', $data);
    }

    public function create(AddSisterConcern $request){

	    $database_name = $this->makeDatabaseName($request->company_name);

        $company_name          = $request->company_name;
        $first_name            = $request->first_name;
        $last_name             = $request->last_name;
        $email                 = $request->email;
        $mobile_number         = $request->mobile_number;
        $password              = $request->password;
        $password_confirmation = $request->password_confirmation;
        $company_address       = $request->company_address;

    	// try{
	    //  	DB::beginTransaction();

	    	$config = Config::create([
	    			'user_id'          => session('user_id'),
	    			'company_name'     => $company_name,
	    			'company_address'  => $company_address,
	    			'database_name'    => $database_name,
                    'package_end_date' => session('end_date'),
                    'parent_id'        => session('parent_id'),
	    		]);

	    	UserEmails::create([
	    			'config_id' => $config->id,
	    			'email' => $email,
	    		]);

			if(!DB::statement('CREATE DATABASE IF NOT EXISTS '.$database_name)){
                Artisan::call('db:connect');
                DB::rollback();
                $request->session()->flash('danger','Application setup not success!');
                return back();
            }
			
	    	Artisan::call("db:connect", ['database'=> $database_name]);
	    	Artisan::call("migrate:hrms");
            Artisan::call("db:seed");

	    	User::create([
	    			'employee_no'    => '0-00', 
                    'designation_id' => 1,   
                    'first_name'     => $first_name, 
                    'last_name'      => $last_name,    
                    'email'          => $email, 
                    'password'       => bcrypt($password),  
                    'mobile_number'  => $mobile_number,
	    		]);

	    	//DB::commit();

	    	$request->session()->flash('success','Application successfully setup!');

	    // }catch(\Exception $e){
	    // 	Artisan::call('db:connect');
	    // 	DB::rollback();

	    // 	Artisan::call('db:connect', ['database'=> $database_name]);
	    // 	Artisan::call("migrate:hrms:rollback");
	    // 	DB::statement('DROP DATABASE IF EXISTS '.$database_name);

	    // 	$request->session()->flash('danger','Application setup not success!');
	    // }

    	return back();
    }

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
