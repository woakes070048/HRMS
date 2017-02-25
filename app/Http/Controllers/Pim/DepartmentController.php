<?php

namespace App\Http\Controllers\Pim;

use App\Models\Department;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class DepartmentController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:hrms');

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            view()->share('auth',$this->auth);
            return $next($request);
        });
    }

    public function index(){

    	$data['title'] = "Employee Departments-HRMS";
    	$data['departments'] = Department::orderBy('id','DESC')->get();

    	return view('pim.department', $data);
    }

    public function create(Request $request){

    	$this->validate($request, [
		    'name' => 'required'
		]);

        DB::beginTransaction();

        try {
		$save = new Department;
		$save->department_name = $request->name;
		$save->status = $request->status;
		$save->created_by = Auth::user()->id;
		$save->save();
    	
    	DB::commit();
            $data = ['title'=>'Success', 'message'=>'Department successfully added!'];

        } catch (\Exception $e) {
            DB::rollback();
            $data = ['title'=>'Error', 'message'=>'Department not added!'];
        }

        return response()->json($data);
    }

    public function edit($id){

    	$data['title'] = "Edit Employee Department-HRMS";
    	$info = Department::find($id);

        $data['id'] = $info->id;
        $data['department_name'] = $info->department_name;
        $data['status'] = $info->status;

        return $data;
        //return view('pim.depAdd', $data);
    }

    public function update(Request $request){

    	$this->validate($request, [
		    'name' => 'required'
		]);


        DB::beginTransaction();

        try {

            $save = Department::find($request->id);
            $save->department_name = $request->name;
            $save->status = $request->status;
            $save->updated_by = Auth::user()->id;
            $save->save();

            DB::commit();    
            $data = ['title'=>'Success', 'message'=>'Department successfully updated!'];

        } catch (\Exception $e) {
            
            DB::rollback();
            $data = ['title'=>'Error', 'message'=>'Department not updated!'];
        }

        return response()->json($data);
    }

    public function delete(Request $request,$id){

    	$save = Department::find($id);
		
		if(count($save->id) > 0){
			$save->delete();
			$request->session()->flash('success','Department removed !');
		}
		else{
			$request->session()->flash('danger','Department not removed !');
		}
		
    	return redirect('department/index');
    }

}
