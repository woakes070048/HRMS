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
    }

    public function index(){

    	$data['title'] = "Employee Departments-HRMS";
    	$data['departments'] = Department::all();

    	return view('pim.department.department', $data);
    }

    public function add(){

    	$data['title'] = "Employee Department Add-HRMS";
    	$data['info'] = "";

        return view('pim.department.depAdd', $data);
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
        $request->session()->flash('success','Department successfully added!');

        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('danger','Department not added!');
        }

    	return redirect()->back();
    }

    public function edit($id){

    	$data['title'] = "Edit Employee Department-HRMS";
    	$info = Department::find($id);

        $data['id'] = $info->id;
        $data['department_name'] = $info->department_name;
        $data['status'] = $info->status;

        return $data;
        //return view('pim.department.depAdd', $data);
    }

    public function update(Request $request){

    	$this->validate($request, [
		    'name' => 'required'
		]);

		$save = Department::find($request->id);
		$save->department_name = $request->name;
		$save->status = $request->status;
		$save->updated_by = Auth::user()->id;
		$save->save();
    	
    	$request->session()->flash('success','Department successfully updated!');

    	return redirect('department/index');
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
