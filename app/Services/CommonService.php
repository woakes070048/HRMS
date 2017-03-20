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

use App\Models\Setting;


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


    public function getLevelSalaryInfoByUser($user_id){
        return User::with('designation.level.salaryInfo.basicSalaryInfo')->find($user_id);
    }


    public function getAllowanceNotinLevel($ids=null){
        $basicSalaryInfo =  BasicSalaryInfo::select('basic_salary_info.*')
            ->leftJoin('level_salary_info_map','level_salary_info_map.basic_salary_info_id','=','basic_salary_info.id')
            ->leftJoin('employee_salaries','employee_salaries.basic_salary_info_id','=','basic_salary_info.id')
            ->where('employee_salaries.basic_salary_info_id','=',null)
            ->where('level_salary_info_map.level_id','=',null);
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


}
