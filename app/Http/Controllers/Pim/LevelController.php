<?php

namespace App\Http\Controllers\Pim;

use App\Models\Level;
use App\Models\BasicSalaryInfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class LevelController extends Controller
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

    	$data['title'] = "Employee Levels-HRMS";
    	$data['levels'] = Level::all();

        return view('pim.level.levels', $data);
    }

    public function add(){

    	$data['title'] = "Employee Levels Add-HRMS";
    	$data['info'] = "";
        $data['salary_info'] = BasicSalaryInfo::all();

        return view('pim.level.add', $data);
    }

    public function create(Request $request){

        $percent = $request->salryInfoPercent;
        $name = $request->salryInfoName;

        $length = count($name);

        for($i=0; $i<$length; $i++){
            echo $name[$i]." ===> ".$percent[$i]."<br>";
        }

        die();
    	$this->validate($request, [
		    'name' => 'required'
		]);

        DB::beginTransaction();

        try {
    		$save = new Level;
    		$save->level_name = $request->name;
    		$save->description = !empty($request->details)?$request->details:"No description...";
    		$save->status = $request->status;
    		$save->created_by = Auth::user()->id;
    		$save->save();

            DB::commit();
            
            $request->session()->flash('success','Level successfully added!');

        } catch (\Exception $e) {
            DB::rollback();
            
            $request->session()->flash('danger','Level not added!');
        }

    	return redirect('levels/index');
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
