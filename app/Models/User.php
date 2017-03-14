<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_no','branch_id','unit_id','designation_id','employee_type_id','first_name','middle_name','last_name','nick_name','email', 'password','mobile_number','photo','created_by','updated_by',

    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getEffectiveDateFormatAttribute($value){
        return Carbon::parse($value)->format('M d Y');
    }


    public function getFirstNameAttribute($value){
        return ucfirst($value);
    }


    public function getMiddleNameAttribute($value){
        return ucfirst($value);
    }


    public function getLastNameAttribute($value){
        return ucfirst($value);
    }

    public function getNickNameAttribute($value){
        return ucfirst($value);
    }


    public function getFullNameAttribute(){
        return ucfirst($this->first_name). ' ' .ucfirst($this->last_name);
    }


    public function getFullImageAttribute(){
        return Storage::disk('public')->url($this->id.'/'.$this->photo);
    }


    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('d M Y');
    }


    public function createdBy(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }


    public function getNextEmployeeNoAttribute(){
        if($this->employee_no) {
            $employee_no = explode('-', $this->employee_no);
            $next_id_without_zero_prefix = end($employee_no) + 1;
            $zero_perfix_count = strlen(end($employee_no)) - strlen($next_id_without_zero_prefix);
            $next_employee_no = Session('company_code') . '-' . str_repeat('0', $zero_perfix_count) . $next_id_without_zero_prefix;
            return $next_employee_no;
        }else{
            return Session('company_code').'-0000';
        }
    }

    public function employeeType(){
        return $this->belongsTo('App\Models\EmployeeType');
    }

     public function branch(){
         return $this->belongsTo('App\Models\Branch');
     }


    public function designation(){
        return $this->belongsTo('App\Models\Designation');
    }
    

    public function address(){
        return $this->hasOne('App\Models\EmployeeAddress');
    }

    public function unit(){
        return $this->belongsTo('App\Models\Units');
    }


    public function details(){
        return $this->hasOne('App\Models\EmployeeDetail');
    }


    public function educations(){
        return $this->hasMany('App\Models\EmployeeEducation');
    }


    public function experiences(){
        return $this->hasMany('App\Models\EmployeeExperience');
    }


    public function salaries(){
        return $this->hasMany('App\Models\EmployeeSalary');
    }


    public function salaryAccount(){
        return $this->hasOne('App\Models\EmployeeSalaryAccount');
    }


    public function nominees(){
        return $this->hasMany('App\Models\EmployeeNominee');
    }


    public function trainings(){
        return $this->hasMany('App\Models\EmployeeTraining');
    }


    public function references(){
        return $this->hasMany('App\Models\EmployeeReference');
    }


    public function childrens(){
        return $this->hasMany('App\Models\EmployeeChildren');
    }


    public function languages(){
        return $this->hasMany('App\Models\EmployeeLanguage');
    }


    public function get_profile_info($employee_no){
        return User::with('designation.department','designation.level','branch','unit','details.bloodGroup','details.religion','educations.institute.educationLevel','educations.degree','address.presentDivision','address.presentDistrict','address.presentPoliceStation','address.permanentDivision','address.permanentDistrict','address.permanentPoliceStation','experiences','nominees','trainings','references','childrens','languages.language')->where('employee_no',$employee_no)->first();
    }


    public function get_user_data_by_user_tab($user_id,$tab){
        if($tab == ''){
            $basic = User::with('designation.department','designation.level','branch','unit','address.presentDivision','address.presentDistrict','address.presentPoliceStation','address.permanentDivision','address.permanentDistrict','address.permanentPoliceStation')->find($user_id);
            return response()->json($basic);
        }

        if($tab == 'personal'){
            $personal = User::with('details.bloodGroup')->find($user_id);
            return response()->json($personal);
        }

        if($tab == 'experience'){
            $experience = User::with('experiences')->find($user_id);
            return response()->json($experience);
        }

        if($tab == 'education'){
            $education = User::with('educations.institute.educationLevel','educations.degree')->find($user_id);
            return response()->json($education);
        }

        if($tab == 'salary'){
            $salaries = User::with('salaries.basicSalaryInfo','salaryAccount')->find($user_id);
            return response()->json($salaries);
        }

        if($tab == 'nominee'){
            $nominee =  User::with('nominees')->find($user_id);
            return response()->json($nominee);
        }

        if($tab == 'training'){
            $training =  User::with('trainings')->find($user_id);
            return response()->json($training);
        }

        if($tab == 'reference'){
            $references =  User::with('references')->find($user_id);
            return response()->json($references);
        }

        if($tab == 'children'){
            $childrens =  User::with('childrens')->find($user_id);
            return response()->json($childrens);
        }

        if($tab == 'language'){
            $languages = User::with('languages.language')->find($user_id);
            return response()->json($languages);
        }
    }


}
