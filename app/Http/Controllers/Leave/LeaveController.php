<?php

namespace App\Http\Controllers\Leave;

use Auth;
use DB;
use App\Models\LeaveType;
use App\Models\UserLeaveTypeMap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hrms');
        // $this->middleware('CheckPermissions');

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            view()->share('auth',$this->auth);
            return $next($request);
        });
    }

    public function index(){

    	$data['title'] = "HRMS|Leave";
    	return view('leave.leave', $data);
    }

    public function userLeaveTypes($id){
    
        $data['userHaveLeavs'] = UserLeaveTypeMap::with('leaveType')->where('user_id', $id)->where('status', 1)->get();

        return $data;
    }
}
