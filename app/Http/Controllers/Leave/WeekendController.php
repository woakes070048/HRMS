<?php

namespace App\Http\Controllers\Leave;

use Auth;
use DB;
use App\Models\Weekend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeekendController extends Controller
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

    	return view('leave.weekend');
    }

    public function getAllData(){

        return Weekend::orderBy('id', 'DESC')->get();
    }

    public function create(Request $request){

		$this->validate($request, [
            'weekend_name' => 'required',
            'weekend_status' => 'required',
        ]);

        $srt_name = implode(', ', $request->weekend_name);

        try{
            Weekend::create([
                'weekend' => $srt_name,
                'created_by' => Auth::user()->id,
                'status' => $request->weekend_status,
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

    	$value = Weekend::find($id);
    	$data['weekend_name'] = $value->weekend; 
    	$data['weekend_status'] = $value->status; 
    	$data['hdn_id'] = $id;

    	return response()->json($data); 
    }

    public function update(Request $request){

        $this->validate($request, [
            'hdn_id' => 'required',
            'edit_weekend_name' => 'required',
            'edit_weekend_status' => 'required',
        ]);

        $srt_name = implode(', ', $request->edit_weekend_name);

        try{

            $data['data'] = Weekend::where('id',$request->hdn_id)->update([
                'weekend' => $srt_name,
                'updated_by' => Auth::user()->id,
                'status' => $request->edit_weekend_status,
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
