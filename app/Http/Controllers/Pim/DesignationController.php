<?php

namespace App\Http\Controllers\Pim;

use App\Models\Designation;
use App\Models\Department;
use App\Models\Level;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class DesignationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hrms');
    }

    public function index(){

    	$data['title'] = "Employee Designations-HRMS";
    	$data['designations'] = Designation::with('department','level')->get();

        return view('pim.designation.designation', $data);
    }

    public function add(){

    	$data['title'] = "Employee Designation Add-HRMS";
    	$data['departments'] = Department::where('status',1)->get();
    	$data['levels'] = Level::where('status',1)->get();
    	$data['info'] = "";

        return view('pim.designation.degAdd', $data);
    }

    public function create(Request $request){

    	$this->validate($request, [
		    'name' => 'required',
		    'department' => 'required',
		    'level' => 'required'
		]);

        DB::beginTransaction();

        try {
    	$save = new Designation;
		$save->designation_name = $request->name;
		$save->department_id = $request->department;
		$save->level_id = $request->level;
		$save->designation_description = !empty($request->details)?$request->details:"No description...";
		$save->status = $request->status;
		$save->created_by = Auth::user()->id;
		$save->save();

    	DB::commit();    
        $request->session()->flash('success','Designation successfully added!');

        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('danger','Designation not added!');
        }


    	return redirect()->back();
    }

    public function edit($id){

    	$data['title'] = "Edit Employee Designation-HRMS";
    	$data['departments'] = Department::where('status',1)->get();
    	$data['levels'] = Level::where('status',1)->get();
    	$data['info'] = Designation::find($id);

        return view('pim.designation.degAdd', $data);
    }

    public function update(Request $request){

		$this->validate($request, [
		    'name' => 'required',
		    'department' => 'required',
		    'level' => 'required'
		]);

    	$save = Designation::find($request->id);
		$save->designation_name = $request->name;
		$save->department_id = $request->department;
		$save->level_id = $request->level;
		$save->designation_description = !empty($request->details)?$request->details:"No description...";
		$save->status = $request->status;
		$save->updated_by = Auth::user()->id;
		$save->save();
    	
    	$request->session()->flash('success','Designation successfully updated!');

    	return redirect('designation/index');    	
    }

    public function delete(Request $request,$id){

    	$save = Designation::find($id);
		
		if(count($save->id) > 0){
			$save->delete();
			$request->session()->flash('success','Designation removed !');
		}
		else{
			$request->session()->flash('danger','Designation not removed !');
		}
		
    	return redirect('designation/index');
    }
}
