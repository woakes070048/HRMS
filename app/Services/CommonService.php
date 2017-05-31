<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\User;
use App\Models\Level;
use App\Models\Units;
use App\Models\Bank;
use App\Models\BasicSalaryInfo;
use App\Models\Department;
use App\Models\Designation;
use App\Models\EmployeeType;
use App\Models\Division;
use App\Models\District;
use App\Models\PoliceStation;
use App\Models\BloodGroup;
use App\Models\EducationLevel;
use App\Models\Institute;
use App\Models\Degree;
use App\Models\Language;
use App\Models\Religion;

use App\Models\WorkShift;
use App\Models\BonusType;
use App\Models\IncrementType;
use App\Models\LoanType;

use App\Models\Setting;

use Auth;
use App\Models\Setup\Config;
use Illuminate\Support\Facades\Artisan;

trait CommonService
{
    
    public function settings(){
        $settings = Setting::all();
        foreach ($settings as $setting) {
            // $settingData[$setting->field_name] = $setting->field_value;
            // \Config::set('hrms.'.$setting->field_name,$setting->field_value);
            Session([$setting->field_name => $setting->field_value]);
        }
    }

    public function getEmployeeType(){
        return EmployeeType::where('status',1)->get();
    }

    public function getEmployee(){
        return User::where('status',1)->get();
    }

    public function getBranches(){
        return Branch::where('branch_status',1)->get();
    }


    public function getDepartments(){
        return Department::where('status',1)->get();
    }


    public function getLevels(){
        return Level::where('status',1)->get();
    }


	public function getDesignations(){
		return Designation::with('department','level')->where('status',1)->orderBy('id','desc')->get();
	}


    public function getUnits(){
        return Units::where('unit_status',1)->get();
    }


    public function getUnitByDesignationId($id){
        $units =  Designation::with('department.units')->orderBy('id','desc')->find($id);
        return $units->department->units;
    }


    public function levelRecursive($parentRecursive,$data){
        if($parentRecursive){
            array_push($data,$parentRecursive->id);
            return $this->levelRecursive($parentRecursive->parentRecursive,$data);
        }
        return $data;
    }


    public function getSupervisorByDesignationId($id,$user_id=null){
        $designations = Designation::with('level.parentRecursive')->find($id);
        $data[] = $designations->level->id;
        $dataRecursive = $this->levelRecursive($designations->level->parentRecursive,$data);
        // $supervisor = Designation::with('user')->whereIn('level_id',$dataRecursive)->get();

        $supervisor = User::select('users.*',\DB::raw('CONCAT(users.first_name," ",users.last_name) as fullname'),'designations.designation_name','levels.level_name');

            if(!empty($user_id)){$supervisor->where('users.id','!=',$user_id);}

            return $supervisor->join('designations','designations.id','=','users.designation_id')
                        ->join('levels','levels.id','=','designations.level_id')
                        ->whereIn('designations.level_id',$dataRecursive)->get();             
        // dd($supervisor);
    }


    // public function getSupervisorByDesignationId($id){
        // $designations = Designation::with([
        //     'level.designation.user' => function($query){$query->where('users.id','!=',Auth::guard('hrms')->user()->id);},
        //     'level.parent.designation.user' => function($query){$query->where('users.id','!=',Auth::guard('hrms')->user()->id);}
        //     ])->find($id);

        // $designations = Designation::with('level.designation.user','level.parent.designation.user')->find($id);

        // $designations = Designation::with('level.parentRecursive')->find($id);
        // dd($designations);
        // dd($designations->level->id);

        // $data = [];
        // $data[] = $designations->level->id;
        // dd($data);
        // $dataRecursive = $this->levelRecursive($designations->level->parentRecursive,$data);

        // dd($dataRecursive);

        // foreach($designations->level->designation as $dinfo){
        //     $level_name = $dinfo->level->level_name;
        //     $department_name = $dinfo->department->department_name;

        //     foreach($dinfo->user as $uinfo){
        //         $data[] = [
        //             'designation_name' => $dinfo->designation_name,
        //             'level_name' => $level_name,
        //             'department_name' => $department_name,
        //             'fullname' => $uinfo->fullname,
        //             'employee_no' => $uinfo->employee_no,
        //             'user_id' => $uinfo->id,
        //         ];
        //     }
        // }

        // if($designations->level->parent){
        //     foreach($designations->level->parent->designation as $dinfo){
        //         $level_name = $dinfo->level->level_name;
        //         $department_name = $dinfo->department->department_name;

        //         foreach($dinfo->user as $uinfo){
        //             $data[] = [
        //                 'designation_name' => $dinfo->designation_name,
        //                 'level_name' => $level_name,
        //                 'department_name' => $department_name,
        //                 'fullname' => $uinfo->fullname,
        //                 'employee_no' => $uinfo->employee_no,
        //                 'user_id' => $uinfo->id,
        //             ];
        //         }
        //     }
        // }

        // return response()->json($data);

        // dd($data);
        // dd($designations);
    // }


	public function getDivisions(){
		return Division::get();
	}


    public function getDistrictByDivision($division_id){
        return District::where('division_id',$division_id)->get();
    }


	public function getPolicStationByDistrict($district_id){
		return PoliceStation::where('district_id',$district_id)->get();
	}


    public function getBloodGroups(){
    	return BloodGroup::get();
    }


    public function getEducationLevels(){
    	return EducationLevel::get();
    }


    public function getInstituteByEducationLevel($education_level_id){
    	return Institute::where('education_level_id',$education_level_id)->get();
    }


    public function getDegreeByEducationLevel($education_level_id){
        return Degree::where('education_level_id',$education_level_id)->get();
    }


    public function getBanks(){
        return Bank::where('status',1)->get();
    }


    public function getAllowances(){
        return BasicSalaryInfo::all();
    }


    public function getLevelSalaryInfoByUser($user_id){
        return User::with('designation.level.salaryInfo.basicSalaryInfo')->find($user_id);
    }


    public function getAllowanceNotinLevel($ids=null){

        $basicSalaryInfo =  BasicSalaryInfo::select('basic_salary_info.*')
            ->leftJoin('level_salary_info_map',function($q){
                $q->on('level_salary_info_map.basic_salary_info_id','=','basic_salary_info.id')
                ->where('level_salary_info_map.level_id','=',null);
            })
            
            ->leftJoin('employee_salaries',function($q){
                $q->on('employee_salaries.basic_salary_info_id','=','basic_salary_info.id')
                    ->where('employee_salaries.basic_salary_info_id','=',null);
            });
            
            if($ids !=null){
                $ids = explode(',',$ids);
                $basicSalaryInfo->whereNotIn('basic_salary_info.id',$ids);
            }
        return $basicSalaryInfo->get();
    }


    public function getAllowanceByIds($ids){
        $ids = explode(',',$ids);
        return BasicSalaryInfo::whereIn('id',$ids)->get();
    }


    public function getLanguage(){
        return Language::where('status',1)->get();
    }
    

    public function getReligions(){
        return Religion::all();
    }


    public function getSisterConcern($config_id){
        Artisan::call('db:connect');
        return Config::find($config_id)->sister()->get();
    }


    public function getMotherConcern($config_id){
        Artisan::call('db:connect');
        return Config::find($config_id)->mother()->get();
    }


    public function getWorkShift($id=null,$status=null){

        if((!empty($id) && $id!='null') && $status !=null){
            return WorkShift::where('id',$id)->where('work_shift_status',$status)->get();
        }else if(!empty($id) && $id!='null'){
            return WorkShift::find($id);
        }else if($status){
            return WorkShift::where('work_shift_status',$status)->get();
        }else{
            return WorkShift::all();
        }
    }


    public function getBonusType(){
        return BonusType::where('bonus_type_status',1)->orderBy('id','desc')->get();
    }


    public function getEmployees(){
        return User::select('users.*',\DB::raw('CONCAT(users.first_name," ",users.last_name) as fullname'),'designations.designation_name','levels.level_name')
            ->where('users.status',1)
            ->join('designations','designations.id','=','users.designation_id')
            ->join('levels','levels.id','=','designations.level_id')
            ->get();
    }


    public function getEmployeeByDesignationId($id){
        return User::select('users.*',\DB::raw('CONCAT(users.first_name," ",users.last_name) as fullname'),'designations.designation_name','levels.level_name')
            ->where('users.status',1)->where('users.designation_id',$id)
            ->join('designations','designations.id','=','users.designation_id')
            ->join('levels','levels.id','=','designations.level_id')
            ->get();
    }


    public function getIncrementType(){
        return IncrementType::where('increment_type_status',1)->orderBy('id','desc')->get();
    }


    public function getLoanType(){
        return LoanType::where('loan_type_status',1)->orderBy('id','desc')->get();
    }




}
