<?php

namespace App\Http\Controllers\Leave;

use Auth;
use App\Models\EmployeeType;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaveTypeController extends Controller
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

    	$data['title'] = "HRMS|Leave Type";
    	$data['emp_types'] = EmployeeType::where('status',1)->get();

    	return view('leave.leave_type', $data);
    }

    public function getAllData(){

        return LeaveType::with('emp_types')->orderBy('id', 'DESC')->get();
    }

    public function create(Request $request){

		$this->validate($request, [
            'type_name' => 'required',
            'emp_type' => 'required',
            'from_year' => 'required',
            'to_year' => 'required',
        ],
        [
		    'emp_type.required' => 'Effective for is mendatory.',
		]);

		$srt_emp_type = implode(', ', $request->emp_type);
		$is_remain = $request->carry_to_next_year > 0?1:0;
		$include_holiday = $request->include_holiday > 0?1:0;

        try{
            LeaveType::create([
                'leave_type_name' => $request->type_name,
                'leave_type_number_of_days' => $request->duration, 
                'leave_type_effective_for' => $srt_emp_type, 
                'leave_type_details' => $request->type_details,
                'leave_type_is_remain' => $is_remain,
                'leave_type_include_holiday' => $include_holiday,
                'leave_type_active_from_year' => $request->from_year,
                'leave_type_active_to_year' => $request->to_year,
                'leave_type_created_by' => Auth::user()->id,
                'leave_type_status' => 1,
            ]);
        
            $data['title'] = 'success';
            $data['message'] = 'data successfully added!';

        }catch (\Exception $e) {
            
           $data['title'] = 'error';
           $data['message'] = 'data not added!';
        }

        return response()->json($data);    	
    }

    public function edit($id){

    	$value = LeaveType::find($id);
    	$data['leave_type_name'] = $value->leave_type_name;
        $data['leave_type_number_of_days'] = $value->leave_type_number_of_days; 
        $data['leave_type_effective_for'] = $value->leave_type_effective_for; 
        $data['leave_type_details'] = $value->leave_type_details;
        $data['leave_type_is_remain'] = $value->leave_type_is_remain;
        $data['leave_type_include_holiday'] = $value->leave_type_include_holiday;
        $data['leave_type_active_from_year'] = $value->leave_type_active_from_year;
        $data['leave_type_active_to_year'] = $value->leave_type_active_to_year;
        $data['leave_type_status'] = $value->leave_type_status;
    	$data['hdn_id'] = $id;

    	return response()->json($data); 
    }

    public function update(Request $request){

        $this->validate($request, [
            'type_name' => 'required',
            'emp_type' => 'required',
            'from_year' => 'required',
            'to_year' => 'required',
            'hdn_id' => 'required',
        ],
        [
		    'emp_type.required' => 'Effective for is mendatory.',
		]);

		$srt_emp_type = implode(', ', $request->emp_type);
		$is_remain = $request->carry_to_next_year > 0?1:0;
		$include_holiday = $request->include_holiday > 0?1:0;

        try{

            $data['data'] = LeaveType::where('id',$request->hdn_id)->update([
                'leave_type_name' => $request->type_name,
                'leave_type_number_of_days' => $request->duration, 
                'leave_type_effective_for' => $srt_emp_type, 
                'leave_type_details' => $request->type_details,
                'leave_type_is_remain' => $is_remain,
                'leave_type_include_holiday' => $include_holiday,
                'leave_type_active_from_year' => $request->from_year,
                'leave_type_active_to_year' => $request->to_year,
                'leave_type_updated_by' => Auth::user()->id,
                'leave_type_status' => $request->leave_type_status,
            ]);
        
            $data['title'] = 'success';
            $data['message'] = 'data successfully updated!';

        }catch (\Exception $e) {
            
            $data['title'] = 'error';
            $data['message'] = 'data not added!';
        }

        return response()->json($data);
    }
}
