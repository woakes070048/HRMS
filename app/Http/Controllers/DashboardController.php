<?php

namespace App\Http\Controllers;

use App\Models\Setup\Config;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{

	protected $auth;

    public function __construct(){
        $this->middleware('auth:hrms');

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            view()->share('auth',$this->auth);
            return $next($request);
        });
    }


    public function index(){
        if(Session('config_id')){
            $data['sisterConcern'] = $this->getSisterConcern(Session('config_id'));
        }
    	return view('dashboard');
    }


    public function getSisterConcern($config_id){
        Artisan::call('db:connect');
        return Config::where('parent_id',$config_id)->get();
    }


}
