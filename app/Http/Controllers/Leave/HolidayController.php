<?php

namespace App\Http\Controllers\Leave;

use Auth;
use DB;
use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hrms');
        $this->middleware('CheckPermissions', ['except' => ['getAllData']]);

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            view()->share('auth',$this->auth);
            return $next($request);
        });
    }

    public function index(){

    	$data['title'] = "HRMS-Holiday";
    	return view('leave.holidays', $data);
    }

    public function getAllData(){

        return Holiday::orderBy('holiday_from', 'DESC')->get();
    }

    public function create(Request $request){

		$this->validate($request, [
            'holiday_name' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'holiday_status' => 'required',
        ]);

        try{
            Holiday::create([
                'holiday_name' => $request->holiday_name,
                'holiday_from' => $request->from_date, 
                'holiday_to' => $request->to_date, 
                'holiday_details' => $request->holiday_description,
                'holiday_status' => $request->holiday_status,
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

    	$value = Holiday::find($id);
    	$data['holiday_name'] = $value->holiday_name;
        $data['holiday_from'] = $value->holiday_from; 
        $data['holiday_to'] = $value->holiday_to; 
        $data['holiday_details'] = $value->holiday_details;
        $data['holiday_status'] = $value->holiday_status;
    	$data['hdn_id'] = $id;

    	return response()->json($data); 
    }

    public function update(Request $request){

        $this->validate($request, [
            'edit_holiday_name' => 'required',
            'edit_from_date' => 'required',
            'edit_to_date' => 'required',
            'edit_holiday_status' => 'required',
        ]);

        try{

            $data['data'] = Holiday::where('id',$request->hdn_id)->update([
                'holiday_name' => $request->edit_holiday_name,
                'holiday_from' => $request->edit_from_date, 
                'holiday_to' => $request->edit_to_date, 
                'holiday_details' => $request->edit_holiday_description,
                'holiday_status' => $request->edit_holiday_status,
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
