<?php

namespace App\Http\Controllers\Setup;

use App\Models\Setup\User as SetupUser;
use App\Models\Setup\Config;
use App\Models\Setup\Package;
use App\Models\Setup\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDetailsController extends Controller
{
	public function __construct(){
        $this->middleware('auth:setup');
    }


    public function index($id){

    	$data['title'] = "User Details-HRMS";
    	$data['config_info'] = Config::where('user_id',$id)->first();

    	$data['sister_concern'] = Config::where('parent_id',$data['config_info']->id)->get();
    	$data['user_info']      = SetupUser::find($id);
    	$data['payment_info']   = Payment::with('package')->where('user_id',$id)->get();

    	return view('setup.userDetails',$data);
    }

}
