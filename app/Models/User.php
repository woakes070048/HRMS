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
        'employee_no','designation_id','employee_type_id','first_name','middle_name','last_name','nick_name','email', 'password','mobile_number','photo','created_by','update_by',

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
            $next_employee_no = $employee_no[0] . '-' . str_repeat('0', $zero_perfix_count) . $next_id_without_zero_prefix;
            return $next_employee_no;
        }else{
            Artisan::call('db:connect');
            $config = Setup\Config::where('id',Session('config_id'))->first();
            Artisan::call("db:connect", ['database' => Session('database')]);
            return $config->company_code.'-0000';
        }
    }

    public function employeeType(){
        return $this->belongsTo('App\Models\EmployeeType');
    }


    public function designation(){
        return $this->belongsTo('App\Models\Designation');
    }
    

    public function address(){
        return $this->hasOne('App\Models\EmployeeAddress');
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
        return $this->hasOne('App\Models\EmployeeNominee');
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
        return User::with('designation.department','designation.department','details.bloodGroup','educations.institute.educationLevel','educations.degree','address.presentDivision','address.presentDistrict','address.presentPoliceStation','address.permanentDivision','address.permanentDistrict','address.permanentPoliceStation','experiences','nominees','trainings','references','childrens','languages.language')->where('employee_no',$employee_no)->first();
    }


}
