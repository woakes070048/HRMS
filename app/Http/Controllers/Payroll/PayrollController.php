<?php

namespace App\Http\Controllers\Payroll;

use App\Services\CommonService;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PayrollController extends Controller
{
	use CommonService;

	protected $auth;

    public function __construct(Auth $auth){
    	$this->middleware('auth:hrms');

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            view()->share('auth',$this->auth);
            return $next($request);
        });
    }


    public function index(Request $request)
    {
    	if($request->ajax()){
    		if($request->isMethod('post')){
	    		return $this->generateSalary($request);
    		}else{
    			return $this->getEmployeeByDepartmentUnitBranch($request->segment(3), $request->segment(4), $request->segment(5));
    		}
    	}

    	$data['sidebar_hide'] = true;
    	$data['departments'] = $this->getDepartments();
    	$data['branches'] = $this->getBranches();
    	return view('payroll.payroll')->with($data);
    }


    protected function validator($request){
    	$this->validate($request,[
            'salary_month' => 'required',
            'salary_type' => 'required',
            'salary_day' => 'required_if:salary_type,day|numeric',
        ],[],[
        	'salary_type' => 'type',
        	'salary_month' => 'month',
        ]);
    }


    public function generateSalary($request)
    {
    	$this->validator($request);

    	$user_id = $request->user_id;
    	$branch_id = $request->branch_id;
    	$department_id = $request->department_id;
    	$unit_id = $request->unit_id;

    	if($user_id !=0){
    		$users = User::find($user_id);
    	}elseif($branch_id !=0 || $department_id !=0 || $unit_id !=0){
    		$users = $this->getEmployeeByDepartmentUnitBranch($branch_id, $department_id, $unit_id);
    	}

    	if($request->salary_type == 'month'){
    		$days = Carbon::parse($request->salary_month)->daysInMonth;
    	}elseif($request->salary_type == 'day'){
    		$days = $request->salary_day;
    	}

    	echo $days;
    	
    	return $users;
    }






}
