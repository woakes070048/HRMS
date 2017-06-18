<?php

namespace App\Http\Controllers\Payroll;

use App\Models\User;
use App\Models\AttendanceTimesheet;

use App\Services\CommonService;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PayrollController extends Controller
{
	use CommonService;

	protected $auth;

    public function __construct(Auth $auth, AttendanceTimesheet $attendanceTimesheet){
    	$this->middleware('auth:hrms');

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            view()->share('auth',$this->auth);
            return $next($request);
        });

        $this->attendanceTimesheet = $attendanceTimesheet;

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


    public function generateSalary($request)
    {
    	$this->validator($request);

    	$branch_id = $request->branch_id;
    	$department_id = $request->department_id;
    	$unit_id = $request->unit_id;
    	$user_id = $request->user_id;
    	$salary_type = $request->salary_type;
    	$salary_month = $request->salary_month;
    	$salary_day = $request->salary_day;

    	$users = $this->getUsers($branch_id, $department_id, $unit_id, $user_id);
    	$days_and_attendance = $this->getDaysAndAttendance($users, $salary_type, $salary_month, $salary_day);
    	// $allowance_and_deduction = $this->getAllowanceAndDeduction($users, );
    	$days = $days_and_attendance['days'];
    	$all_attendance = $days_and_attendance['all_attendance'];

    	// print_r($all_attendance);
    	// echo $days;

    	$salary_reports = (object)[];
    	$allowances = [];
    	$deductions = [];

    	foreach($users as $user)
    	{
    		$user_id = $user->id;
    		$basic_salary = $user->basic_salary;
    		$perday_salary = $basic_salary / $days;

    		$attendance_present = 0;
    		if($salary_type == 'month'){
    			$attendance_present = $all_attendance->where('user_id', $user_id)->count();
    			$salary = $basic_salary * 
    		}
    		elseif($salary_type == 'day')
    		{
    			$salary = $perday_salary * $days;
    		}
    		


    		$salary_reports->$user_id = (object)[
    			'user_id'=> $user->id,
    			'employee_no' =>  $user->employee_no,
    			'full_name' => $user->fullname,
    			'basic_salary' => $basic_salary,
    			'salary_month' => $salary_month,
    			'days' => $days,
    			'attendance' => $attendance_present,
    			'total_allowance' => $total_allowance,
    			'allowances'=> $allowances,
    			'total_deduction' => $total_deduction,
    			'deductions'=> $deductions,
    			'salary' => $salary,
    			'total_salary' => $total_salary
    		];
    	}

    	// foreach($salary_reports as $sr){
    	// 	echo $sr->basic_salary;
    	// }

    	// dd($salary_reports);
    	return [$salary_reports];
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


    protected function getUsers($branch_id, $department_id, $unit_id, $user_id)
    {
    	if($user_id !=0){
    		$users = User::find($user_id);
    	}elseif($branch_id !=0 || $department_id !=0 || $unit_id !=0){
    		$users = $this->getEmployeeByDepartmentUnitBranch($branch_id, $department_id, $unit_id);
    	}else{
    		$users = User::where('status',1)->get();
    	}
    	return $users;
    }


    protected function getDaysAndAttendance($users, $salary_type, $salary_month, $salary_day)
    {
    	if($salary_type == 'month'){
    		$days = Carbon::parse($salary_month)->daysInMonth;
    		$start_date = Carbon::parse($salary_month)->format('Y-m-d');
    		$end_date = Carbon::parse($salary_month)->format('Y-m-t');
    		$user_ids = $users->pluck('id');
    		$all_attendance = AttendanceTimesheet::whereIn('user_id', $user_ids)
    					->whereIn('observation',[1,5,6])
    					->whereBetween('date', [$start_date, $end_date])
    					->get();
    	}elseif($salary_type == 'day'){
    		$days = $salary_day;
    		$all_attendance = [];
    	}

    	return ['days' => $days, 'all_attendance' => $all_attendance];
    }



    protected function getAllowanceAndDeduction(){

    }


}
