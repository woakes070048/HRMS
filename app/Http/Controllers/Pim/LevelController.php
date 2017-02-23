<?php

namespace App\Http\Controllers\Pim;

use App\Models\Level;
use App\Models\BasicSalaryInfo;
use App\Models\LevelSalaryInfoMap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class LevelController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:hrms');
    }

    public function index(){

    	$data['title'] = "Employee Levels-HRMS";
    	$data['levels'] = Level::with('salaryInfo')
                        ->where('status',1)->orderBy('id','DESC')->get();

        return view('pim.level.levels', $data);
    }

    public function add(){

    	$data['title'] = "Employee Levels Add-HRMS";
    	$data['info'] = "";
        $data['salary_info'] = BasicSalaryInfo::all();
        //$data['selected_info_id'] = array();

        return view('pim.level.add', $data);
    }

    public function create(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'salary_amount' => 'required'
        ]);

        $percent = $request->salryInfoPercent;
        $infoId = $request->salryInfoId;
        $name = $request->name;
        $salary_amount = $request->salary_amount;
        $description = !empty($request->details)?$request->details:"No description...";
        $status = $request->status;

        $length = count($infoId);

    	
        DB::beginTransaction();

        try {
    		$save = new Level;
    		$save->level_name = $name;
            $save->level_salary_amount =  $salary_amount;
    		$save->description = $description;
    		$save->status = $status;
    		$save->created_by = Auth::user()->id;
    		$save->save();

            for($i=0; $i<$length; $i++){

                if($percent[$i] > 0){
                    $data[] = [
                                'level_id' => $save->id, //last insert level id
                                'amount' => $percent[$i],
                                'basic_salary_info_id' => $infoId[$i]
                            ];
                }
            }

            if(!empty($data)){
                LevelSalaryInfoMap::insert($data);
            }

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
    	$data['info'] = Level::with('salaryInfo')->find($id);
        $data['salary_info'] = BasicSalaryInfo::all();

        return view('pim.level.add', $data);
    }

    public function update(Request $request){

    	$this->validate($request, [
		    'name' => 'required',
            'salary_amount' => 'required'
		]);

        $id = $request->id;
        $percent = $request->salryInfoPercent;
        $infoId = $request->salryInfoId;
        $name = $request->name;
        $salary_amount = $request->salary_amount;
        $description = !empty($request->details)?$request->details:"No description...";
        $status = $request->status;

		$length = count($infoId);
        
        DB::beginTransaction();

        try {
            $save = Level::find($id);
            $save->level_name = $name;
            $save->level_salary_amount =  $salary_amount;
            $save->description = $description;
            $save->status = $status;
            $save->updated_by = Auth::user()->id;
            $save->save();

            for($i=0; $i<$length; $i++){

                if($percent[$i] > 0){
                    LevelSalaryInfoMap::where('level_id', $id)
                                    ->where('basic_salary_info_id', $infoId[$i])
                                    ->update(['amount' => $percent[$i]]);
                }
                else{
                    LevelSalaryInfoMap::where('level_id', $id)
                                    ->where('basic_salary_info_id', $infoId[$i])
                                    ->delete();
                }
            }

            DB::commit();
            
            $request->session()->flash('success','Data updated successfully!');

        } catch (\Exception $e) {
            DB::rollback();

            $request->session()->flash('danger','Data not updated!');
        }

    	return redirect('levels/index');
    }

    public function update_info(Request $request){

        $id = $request->id;
        $percent = $request->salryInfoPercent;
        $infoId = $request->salryInfoId;

        $length = count($infoId);

        DB::beginTransaction();

        try {

            for($i=0; $i<$length; $i++){

                if($percent[$i] > 0){
                    $data[] = [
                                'level_id' => $id,
                                'amount' => $percent[$i],
                                'basic_salary_info_id' => $infoId[$i]
                            ];
                }
            }

            LevelSalaryInfoMap::insert($data);

            DB::commit();
            
            $request->session()->flash('success','New info successfully added!');

        } catch (\Exception $e) {
            DB::rollback();
            
            $request->session()->flash('danger','Data not added!');
        }

        return redirect("levels/edit/$id");
    }

    public function delete(Request $request,$id){

        DB::beginTransaction();

        try {

            $del = Level::find($id);
            $del->salaryInfo()->delete();
            $del->delete();

            DB::commit();
            
            $request->session()->flash('success','Level removed !');

        } catch (\Exception $e) {
            DB::rollback();

            if($e->errorInfo[1] == 1451){

                $request->session()->flash('danger','Cannot delete or update a parent row!');
            }
            else{
                $request->session()->flash('danger','Level not removed !');
            }
        }

    	return redirect('levels/index');
    }
}
