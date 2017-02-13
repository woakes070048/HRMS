<?php

namespace App\Http\Controllers\Setup\User;

use App\Models\Setup\User;
use App\Models\Setup\Config;
use App\Models\Setup\Package;
use App\Models\Setup\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserSetupDashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth:setup');
    }


    public function index(){

    	$id = Auth::user()->id;
    	$data['title'] = "User Details-HRMS";
    	$data['config_info'] = Config::where('user_id',$id)->first();

    	$data['sister_concern'] = Config::where('parent_id',$data['config_info']->id)->get();
    	$data['user_info'] = User::find($id);
    	$data['payment_info'] = Payment::with('package')->get();

        //var_dump($data['sister_concern']); die();
    	return view('setup.userDetails',$data);
    }
}
