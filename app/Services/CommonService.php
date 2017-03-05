<?php

namespace App\Services;

use App\Models\User;
use App\Models\Level;
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

trait CommonService
{
    
    public function getEmployeeType(){
        return EmployeeType::where('status',1)->get();
    }


    public function getDepartments(){
        return Department::where('status',1)->get();
    }


    public function getLevels(){
        return Level::where('status',1)->get();
    }


	public function getDesignations(){
		return Designation::with('department','level')->where('status',1)->get();
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


    public function getAllowanceNotinLevel(){
        return BasicSalaryInfo::select('basic_salary_info.*')->leftJoin('level_salary_info_map','level_salary_info_map.basic_salary_info_id','=','basic_salary_info.id')->where('level_salary_info_map.level_id','=',null)->get();
    }


    public function getAllowanceByIds($ids){
        $ids = explode(',',$ids);
        return BasicSalaryInfo::whereIn('id',$ids)->get();
    }


    public function getLanguage(){
        return Language::all();
    }


}
