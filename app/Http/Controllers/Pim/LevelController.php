<?php

namespace App\Http\Controllers\Pim;

use App\Models\Level;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LevelController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:hrms');
    }

    public function index(){

    	$data['title'] = "Employee Levels-HRMS";
    	$data['levels'] = Level::all();

        return view('pim.level.levels', $data);
    }

    public function add(){

    	$data['title'] = "Employee Levels Add-HRMS";
    	$data['info'] = "";

        return view('pim.level.add', $data);
    }

    public function create(Request $request){

    	$this->validate($request, [
		    'name' => 'required'
		]);

		$save = new Level;
		$save->level_name = $request->name;
		$save->description = !empty($request->details)?$request->details:"No description...";
		$save->status = $request->status;
		$save->created_by = Auth::user()->id;
		$save->save();
    	
    	$request->session()->flash('success','Level successfully added!');

    	return redirect()->back();
    }

    public function edit($id){

    	$data['title'] = "Edit Employee Levels-HRMS";
    	$data['info'] = Level::find($id);

        return view('pim.level.add', $data);
    }

    public function update(Request $request){

    	$this->validate($request, [
		    'name' => 'required'
		]);

		$save = Level::find($request->id);
		$save->level_name = $request->name;
		$save->description = !empty($request->details)?$request->details:"No description...";
		$save->status = $request->status;
		$save->updated_by = Auth::user()->id;
		$save->save();
    	
    	$request->session()->flash('success','Level successfully updated!');

    	return redirect('levels/index');
    }

    public function delete(Request $request,$id){

    	$save = Level::find($id);
		
		if(count($save->id) > 0){
			$save->delete();
			$request->session()->flash('success','Level removed !');
		}
		else{
			$request->session()->flash('danger','Level not removed !');
		}
		
    	return redirect('levels/index');
    }
}
