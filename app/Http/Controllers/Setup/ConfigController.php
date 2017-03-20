<?php

namespace App\Http\Controllers\Setup;

// model class
use App\Models\User;
use App\Models\Setting;
use App\Models\Setup\UserEmails;
use App\Models\Setup\Config;
use App\Models\Setup\Package;
use App\Models\Setup\User as SetupUser;
use App\Models\Setup\Payment;

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

        $data['packages'] = Package::where('package_status',1)->get();

        return view('setup.config', $data);
    }

    /**
     * @param ConfigRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function config(ConfigRequest $request){

    	$database_name = $this->makeDatabaseName($request->company_name);

        $company_name          = $request->company_name;
        $company_code          = $request->company_code;
        $package_id            = $request->package_name;
        $first_name            = $request->first_name;
        $last_name             = $request->last_name;
        $email                 = $request->email;
        $mobile_number         = $request->mobile_number;
        $password              = $request->password;
        $company_address       = $request->company_address;

        $package_info     = Package::find($package_id);
        $package_amount   = $package_info->package_price;
        $package_duration = $package_info->package_duration;

        $formet = "+$package_duration month";
        $package_end_date = date("Y-m-d", strtotime($formet));

     	DB::beginTransaction();

        // try{

            $setup_user = SetupUser::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => bcrypt($request->password),
                'mobile_number' => $mobile_number,
                'user_type' => 2,
            ]);

	    	$config = Config::create([
	    			'user_id'          => $setup_user->id,
                    'company_name'     => $company_name,
	    			'company_code'     => $company_code,
	    			'company_address'  => $company_address,
	    			'database_name'    => $database_name,
                    'package_end_date' => $package_end_date,
                    'parent_id'        => 0,
	    		]);

	    	UserEmails::create([
	    			'config_id' => $config->id,
	    			'email' => $email,
	    		]);

            Payment::create([
                    'user_id' => $setup_user->id,
                    'config_id' => $config->id,
                    'package_id' => $package_id,
                    'payment_amount' => $package_amount,
                    'payment_duration' => $package_duration,
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
                    'employee_no'    => $config->company_code.'-0000',
                    'employee_type_id' => 1,
                    'branch_id' => 1,
                    'designation_id' => 1,
                    'unit_id' => 1,
                    'first_name'     => $first_name,
                    'last_name'      => $last_name,    
                    'email'          => $email, 
                    'password'       => bcrypt($password),  
                    'mobile_number'  => $mobile_number,
	    		]);

            Setting::insert([
                    ['field_name' => "company_name",'field_value' => $company_name],
                    ['field_name' => "company_code",'field_value' => empty($company_code)?"00":$company_code]
                ]);

	    	$request->session()->flash('success','Application successfully setup!');

	    // }catch(\Exception $e){
	    // 	Artisan::call('db:connect');
	    // 	DB::rollback();

	    // 	Artisan::call('db:connect', ['database'=> $database_name]);
	    // 	Artisan::call("migrate:hrms:rollback");
	    // 	DB::statement('DROP DATABASE IF EXISTS '.$database_name);

	    // 	$request->session()->flash('danger','Application setup not success!');
	    // }

        DB::commit();

    	return back();
    }


    /**
     * @param $database
     * @return mixed
     */
    public function makeDatabaseName($database){

        $database = time().'_'.$database;

        if(stristr($database,' ')){
            $database = str_replace(' ', '_', $database);
        }

        if(stristr($database,'-')){
            $database = str_replace('-', '_', $database);
        }

        $database1 =  preg_replace('/[^A-Za-z0-9\_]/', '', $database);

        if(strlen($database1) > 64){
            $database1 = substr($database1,0,60);
        }

        return $database1;

    }

    public function get_package_info(Request $request){

        $package_id = $request->package_name;

        $info = Package::find($package_id);

        if($info){
            $data['price'] = $info->package_price;
            $data['duration'] = $info->package_duration;

            return $data;
        }
        else{
            return "error";
        }
    }


}
