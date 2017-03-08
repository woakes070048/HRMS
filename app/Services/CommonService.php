<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Designation;
use App\Models\Department;
use App\Models\Level;
use App\Models\Units;

trait CommonService
{

    public function getDepartments(){
        return Department::where('status',1)->get();
    }


    public function getLevels(){
        return Level::where('status',1)->get();
    }


	public function getDesignations(){
		return Designation::where('status',1)->get();
	}


	public function getDivisions(){
		return DB::table('divisions')->get();
	}


    public function getDistrictByDivision($division_id){
        return DB::table('districts')->where('division_id',$division_id)->get();
    }


	public function getPolicStationByDistrict($district_id){
		return DB::table('police_stations')->where('district_id',$district_id)->get();
	}


    public function getBloodGroups(){
    	return DB::table('blood_groups')->get();
    }


    public function getEducationLevels(){
    	return DB::table('education_levels')->get();
    }


    public function getInstituteByEducationLevel($education_level_id){
    	return DB::table('institutes')->where('education_level_id',$education_level_id)->get();
    }

    public function getDegreeByEducationLevel($education_level_id){
        return DB::table('degrees')->where('education_level_id',$education_level_id)->get();
    }

    public function getUnits(){
        return Units::where('unit_status',1)->get();
    }


}
